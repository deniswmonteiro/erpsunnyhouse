<?php

namespace App\Models;

use App\Http\Controllers\ContractController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * contract_id in:
 * - Service
 */
class Contract extends Model
{
    use HasFactory;

    protected $table = 'contract';

    protected $fillable = [
        'seller_id',
        'client_id',
        'payment_id',
        'status',
        'description',
        'profit_estimate',
        'kit_quota',
        'installation_quota',
        'type',
        'contract_date',
        'installation_deadline',

        'generator_structure',
        'area',
        'monthly_avg_generation',
        'equipment_date_acquisition',
        'equipment_delivery_date',
        'file_invoice_name',
        'file_invoice_path',

        'created_at',
        'updated_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function ticket()
    {
        return $this->hasOne(Ticket::class, 'contract_client_id', 'id');
    }
    
    public function project()
    {
        return $this->hasOne(EngineeringProject::class, 'contract_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id', 'id');
    }

    public function payment()
    {
        return $this->belongsTo(ContractPayment::class, 'payment_id', 'id');
    }

    public function paymentData()
    {
        $contract = $this;

        switch ($contract->payment->type->name) {
            case ContractController::$PAYMENT_CASH:
                $payment = new \stdClass();
                $p = PaymentCash::find($contract->payment->payment_id);
                $payment->cash = $p->value_initial;
                $payment->value = $p->value;
                $payment->text = '';
                $payment->quantity_parcel = '';
                $payment->value_parcel = '';
                $payment->bank = '';
                $payment->payment_after_by = $p->afterBy->name;
                break;

            case ContractController::$PAYMENT_PARTIAL_PARCELED:
                $payment = new \stdClass();
                $p = PaymentPartialParceled::find($contract->payment->payment_id);
                $payment->cash = $p->cash;
                $payment->value = $p->value;
                $payment->quantity_parcel = '';
                $payment->value_parcel = '';
                $payment->text = '';
                $payment->bank = ($p->bank == null) ? '' : $p->bank->code . " - " . $p->bank->name;
                $payment->payment_after_by = '';
                break;

            case ContractController::$PAYMENT_TOTAL_PARCELED:
                $payment = new \stdClass();
                $p = PaymentTotalParceled::find($contract->payment->payment_id);
                $payment->cash = '';
                $payment->value = $p->value;
                $payment->text = '';
                $payment->quantity_parcel = '';
                $payment->value_parcel = '';
                $payment->bank = ($p->bank == null) ? '' : $p->bank->code . " - " . $p->bank->name;
                $payment->payment_after_by = '';
                break;

            case ContractController::$PAYMENT_COMPANY_INSTALLMENT:
                $payment = new \stdClass();
                $p = PaymentCompanyInstallment::find($contract->payment->payment_id);
                $payment->cash = $p->cash;
                $payment->value = $p->value;
                $payment->quantity_parcel = $p->quantity_parcel;
                $payment->value_parcel = ($payment->value - $payment->cash) / $payment->quantity_parcel;
                $payment->text = '';
                $payment->bank = ($p->bank == null) ? '' : $p->bank->code . " - " . $p->bank->name;
                $payment->payment_after_by = $p->afterBy->name;
                break;

            case ContractController::$PAYMENT_CUSTOM:
                $payment = new \stdClass();
                $p = PaymentCustom::find($contract->payment->payment_id);
                $payment->cash = '';
                $payment->value = $p->value;
                $payment->text = $p->text;
                $payment->quantity_parcel = '';
                $payment->value_parcel = '';
                $payment->bank = '';
                $payment->payment_after_by = '';
                break;
        }

        return $payment;
    }

    public function getValue()
    {
        $contract = $this;
        $value = 0;
        $cp = ContractPayment::find($contract->payment_id);

        switch (ContractPayment::find($contract->payment_id)->type->name) {
            case ContractController::$PAYMENT_CASH:
                $value = PaymentCash::find($cp->payment_id)->value;
                break;

            case ContractController::$PAYMENT_PARTIAL_PARCELED:
                $payment = PaymentPartialParceled::find($cp->payment_id);
                $value = $payment->value;;
                break;

            case ContractController::$PAYMENT_TOTAL_PARCELED:
                $payment = PaymentTotalParceled::find($cp->payment_id);
                $value = $payment->value;;
                break;

            case ContractController::$PAYMENT_COMPANY_INSTALLMENT:
                $payment = PaymentCompanyInstallment::find($cp->payment_id);
                $value = $payment->value;;
                break;

            case ContractController::$PAYMENT_CUSTOM:
                $value = PaymentCustom::find($cp->payment_id)->value;
                break;
        }

        return $value;
    }

    public function contractsProducts()
    {
        $contractProducts = ContractEquipment::where('contract_id', $this->id)->get();
        $products = [];

        foreach ($contractProducts as $item) {
            $type = $item->type;
            $equipment = null;

            switch ($type) {
                case 'GENERATOR':
                    $equipment = EquipmentGenerator::find($item->product_id);
                    $text = 'Módulo Solar ' . $equipment->producer . ' - ' . $equipment->module . ' - ' . $equipment->technology . ' - ' . str_replace('.', ',', $equipment->power) . ' W';
                    break;

                case 'SOLAR_INVERTER':
                    $equipment = EquipmentSolarInverter::find($item->product_id);
                    $text = 'Inversor ' . $equipment->producer . ' - ' . str_replace('.', ',', $equipment->power) . ' kW - ' . $equipment->mppt . ' MPPT - '. $equipment->voltage . ' V';
                    break;

                case 'STRING_BOX':
                    $equipment = EquipmentStringBox::find($item->product_id);
                    $text = 'String Box ' . $equipment->producer . ' ' . $equipment->module;
                    break;

                case 'CABLE':
                    $equipment = EquipmentCable::find($item->product_id);
                    $text = $equipment->name;
                    break;

                case 'CONNECTOR':
                    $equipment = EquipmentConnector::find($item->product_id);
                    $text = $equipment->name;
                    break;

                case 'OTHER':
                    $equipment = EquipmentOther::find($item->product_id);
                    $text = $equipment->name;
                    break;
            }

            array_push($products, ['name' => $text, 'quantity' => $item->quantity]);
        }

        return json_decode(json_encode($products), FALSE);
    }

    public function contractsProductsType($type)
    {
        $contractProducts = ContractEquipment::where('contract_id', $this->id)->get();
        $products = [];
        
        foreach ($contractProducts as $item) {
            if ($type == $item->type) {
                $equipment = null;

                switch ($item->type) {
                    case 'GENERATOR':
                        $equipment = EquipmentGenerator::find($item->product_id);
                        $text = 'Módulo Solar ' . $equipment->producer;
                        $guarantee = $equipment->guarantee . ' anos';
                        break;

                    case 'SOLAR_INVERTER':
                        $equipment = EquipmentSolarInverter::find($item->product_id);
                        $text = 'Inversor ' . $equipment->producer;
                        $guarantee = $equipment->guarantee . ' anos';
                        break;

                    case 'STRING_BOX':
                        $equipment = EquipmentStringBox::find($item->product_id);
                        $text = 'String Box ' . $equipment->producer . ' ' . $equipment->module;
                        $guarantee = '12 meses';
                        break;

                    case 'CABLE':
                        $equipment = EquipmentCable::find($item->product_id);
                        $text = $equipment->name;
                        $guarantee = '';
                        break;

                    case 'CONNECTOR':
                        $equipment = EquipmentConnector::find($item->product_id);
                        $text = $equipment->name;
                        $guarantee = '';
                        break;

                    case 'OTHER':
                        $equipment = EquipmentOther::find($item->product_id);
                        $text = $equipment->name;
                        $guarantee = '';
                        break;
                }

                array_push($products, ['name' => $text, 'guarantee' => $guarantee]);
            }
        }

        return json_decode(json_encode($products), FALSE);
    }

    public function getGeneratorPower()
    {
        $power = 0;
        $oversizing = 0;
        $power_text = '';
        $oversizing_text = '';
        $contractProducts = ContractEquipment::where('contract_id', $this->id)->get();
        
        if (count($contractProducts) !== 0) {
            foreach ($contractProducts as $item) {
                $type = $item->type;
                
                if ($type == 'GENERATOR') {
                    $equipment = EquipmentGenerator::find($item->product_id);
                    $power = $power + ($equipment->power * $item->quantity);
                }

                if ($type == 'SOLAR_INVERTER') {
                    $equipment = EquipmentSolarInverter::find($item->product_id);
                    $oversizing = $oversizing + ($equipment->power * $item->quantity) * 1000; // convert w to kw
                }
            }

            if ($oversizing > 0) {
                $percentage = round(($power / $oversizing) * 100, 0);
                $oversizing_text = '<p class="mt-2"><small>(sobredimensionamento de inversor: ' . $percentage . '%)</small></p>';
            }

            if ($power > 1000) {
                $power = str_replace('.', ',', ($power / 1000));
                // $power_text =  $power . ' kWp' . $oversizing_text;
                $power_text = '<span id="total-generator-power">' . $power . ' kWp</span>' . $oversizing_text;
            }
            
            else $power_text = '<span id="total-generator-power">' .  $power . ' Wp';
        }

        return 'Gerador ' . $power_text;
    }

    public function getGeneratorPowerValue()
    {
        $power = 0;
        $contractProducts = ContractEquipment::where('contract_id', $this->id)->get();
        
        if (count($contractProducts) !== 0) {
            foreach ($contractProducts as $item) {
                $type = $item->type;
                
                if ($type == 'GENERATOR') {
                    $equipment = EquipmentGenerator::find($item->product_id);
                    $power = $power + ($equipment->power * $item->quantity);
                }
            }
        }

        return $power;
    }

    public function getGeneratorPowerPrint()
    {
        $power = 0;
        $oversizing = 0;
        $power_text = '';
        $contractProducts = ContractEquipment::where('contract_id', $this->id)->get();

        if (count($contractProducts) != 0) {
            foreach ($contractProducts as $item) {
                $type = $item->type;
                
                if ($type == 'GENERATOR') {
                    $equipment = EquipmentGenerator::find($item->product_id);
                    $power = $power + ($equipment->power * $item->quantity);
                }

                if ($type == 'SOLAR_INVERTER') {
                    $equipment = EquipmentSolarInverter::find($item->product_id);
                    $oversizing = $oversizing + ($equipment->power * $item->quantity) * 1000; // convert w to kw
                }
            }

            if ($oversizing > 0) $percentage = round(($power / $oversizing) * 100, 0);

            if ($power > 1000) {
                $power = str_replace('.', ',', ($power / 1000));
                $power_text = $power . ' kWp';
            }
            
            else $power_text = $power . ' Wp';
        }

        return $power_text;
    }

    public function deleteContractProducts()
    {
        $contractProducts = ContractEquipment::where('contract_id', $this->id)->get();

        foreach ($contractProducts as $product) {
            $product->delete();
        }
    }
}
