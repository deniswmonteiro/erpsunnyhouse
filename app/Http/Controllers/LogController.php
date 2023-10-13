<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Client;
use App\Models\Contract;
use App\Models\EquipmentGenerator;
use App\Models\EquipmentCable;
use App\Models\EquipmentConnector;
use App\Models\EquipmentOther;
use App\Models\EquipmentSolarInverter;
use App\Models\EquipmentStringBox;
use App\Models\Log;
use App\Models\User;
use App\Models\Seller;
use App\Models\UserCategory;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public static $USUARIO = 'USUARIO';
    public static $USUARIO_CRIADO = 'USUÁRIO CRIADO';
    public static $USUARIO_EDITADO = 'USUÁRIO EDITADO';
    public static $USUARIO_DELETADO = 'USUÁRIO DELETADO';

    public static $CLIENTE = 'CLIENTE';
    public static $CLIENTE_CRIADO = 'CLIENTE CRIADO';
    public static $CLIENTE_EDITADO = 'CLIENTE EDITADO';
    public static $CLIENTE_DELETADO = 'CLIENTE DELETADO';

    public static $VENDEDOR = 'VENDEDOR';
    public static $VENDEDOR_CRIADO = 'VENDEDOR CRIADO';
    public static $VENDEDOR_EDITADO = 'VENDEDOR EDITADO';
    public static $VENDEDOR_DELETADO = 'VENDEDOR DELETADO';

    public static $CONTRATO = 'CONTRATO';
    public static $CONTRATO_CRIADO = 'CONTRATO CRIADO';
    public static $CONTRATO_EDITADO = 'CONTRATO EDITADO';
    public static $CONTRATO_DELETADO = 'CONTRATO DELETADO';

    public static $BANCO = 'BANCO';
    public static $BANCO_CRIADO = 'BANCO CRIADO';
    public static $BANCO_EDITADO = 'BANCO EDITADO';
    public static $BANCO_DELETADO = 'BANCO DELETADO';

    public static $EQUIPAMENTO = 'EQUIPAMENTO';
    public static $EQUIPAMENTO_CRIADO = 'EQUIPAMENTO CRIADO';
    public static $EQUIPAMENTO_EDITADO = 'EQUIPAMENTO EDITADO';
    public static $EQUIPAMENTO_DELETADO = 'EQUIPAMENTO DELETADO';

    public function __construct()
    {
        $this->middleware('auth.not_engineering');
    }


    public static function getChangesUser(User $user)
    {
        $text = "";

        if ($user->name != $user->getOriginal('name')) {
            $original = $user->getOriginal('name');
            $text = $text . "<li>Nome alterado de '$original' para '$user->name'</li>";
        }

        if ($user->email != $user->getOriginal('email')) {
            $original = $user->getOriginal('email');
            $text = $text . "<li>E-mail alterado de '$original' para '$user->email'</li>";
        }

        if ($user->category_id != $user->getOriginal('category_id')) {
            $category_old = UserCategory::find($user->getOriginal('category_id'))->name;
            $category_new = UserCategory::find($user->category_id)->name;
            $text = $text . "<li>Categoria alterada de '$category_old' para '$category_new'</li>";
        }

        if ($user->status != $user->getOriginal('status')) {
            $status_new = ($user->status) ? 'ATIVO' : 'BLOQUEADO';
            $status_old = (!$user->status) ? 'ATIVO' : 'BLOQUEADO';
            $text . "<li>Categoria alterada de '$status_old' para '$status_new'</li>";
        }

        if ($user->password != $user->getOriginal('password')) {
            $text = $text . "<li>Senha de Usuário Alterada</li>";
        }

        return $text;
    }

    public static function getChangesClient(Client $client)
    {
        $text = "";

        if ($client->name != $client->getOriginal('name')) {
            $original = $client->getOriginal('name');
            $text = $text . "<li>Nome alterado de '$original' para '$client->name'</li>";
        }

        if ($client->cpf != $client->getOriginal('cpf')) {
            $original = $client->getOriginal('cpf');
            $text = $text . "<li>CPF alterado de '$original' para '$client->cpf'</li>";
        }

        if ($client->is_corporate != $client->getOriginal('is_corporate')) {
            if ($client->is_corporate) {
                $text = $text . "<li>Tipo de cliente alterado de 'Pessoa Física' para 'Pessoa Jurídica'</li>";
            }
            
            else {
                $text = $text . "<li>Tipo de cliente alterado de 'Pessoa Jurídica' para 'Pessoa Física'</li>";
            }
        }

        if ($client->cnpj != $client->getOriginal('cnpj')) {
            $original = $client->getOriginal('cnpj');

            if (($client->cnpj != '') && ($client->getOriginal('cnpj') != '')) {
                $text = $text . "<li>CNPJ alterado de '$original' para '$client->cnpj'</li>";
            }
            
            else if ($client->cnpj == '') {
                $text = $text . "<li>CNPJ removido: '$original'";
            }
            
            else {
                $text = $text . "<li>CNPJ inserido: '$client->cnpj'";
            }
        }

        if ($client->email != $client->getOriginal('email')) {
            $original = $client->getOriginal('email');
            $text = $text . "<li>E-mail alterado de '$original' para '$client->email'</li>";
        }

        if ($client->corporate_name != $client->getOriginal('corporate_name')) {
            $original = $client->getOriginal('corporate_name');
            
            if ($client->getOriginal('corporate_name') == "") {
                $text = $text . "<li>Razão Social inserida: '$client->corporate_name'</li>";
            }
            
            else if ($client->corporate_name == '') {
                $text = $text . "<li>Razão Social removida.: '$original'</li>";
            }
            
            else {
                $text = $text . "<li>Razão Social alterada de '$original' para '$client->corporate_name'</li>";
            }
        }

        if ($client->phone != $client->getOriginal('phone')) {
            $original = $client->getOriginal('phone');
            $text = $text . "<li>Telefone alterado de '$original' para '$client->phone'</li>";
        }

        if ($client->address_cep != $client->getOriginal('address_cep')) {
            $original = $client->getOriginal('address_cep');
            $text = $text . "<li>CEP alterado de '$original' para '$client->address_cep'</li>";
        }

        if ($client->address != $client->getOriginal('address')) {
            $original = $client->getOriginal('address');
            $text = $text . "<li>Endereço alterado de '$original' para '$client->address'</li>";
        }

        if ($client->address_state != $client->getOriginal('address_state')) {
            $original = $client->getOriginal('address_state');
            $text = $text . "<li>Estado alterado de '$original' para '$client->address_state'</li>";
        }

        if ($client->address_city != $client->getOriginal('address_city')) {
            $original = $client->getOriginal('address_city');
            $text = $text . "<li>Cidade alterada de '$original' para '$client->address_city'</li>";
        }

        if ($client->address_neighborhood != $client->getOriginal('address_neighborhood')) {
            $original = $client->getOriginal('address_neighborhood');
            $text = $text . "<li>Bairro alterado de '$original' para '$client->address_neighborhood'</li>";
        }

        if ($client->address_number != $client->getOriginal('address_number')) {
            $original = $client->getOriginal('address_number');
            $text = $text . "<li>Número/Apt alterado de '$original' para '$client->address_number'</li>";
        }

        if ($client->address_complement != $client->getOriginal('address_complement')) {
            $original = $client->getOriginal('address_complement');
            $text = $text . "<li>Complemento alterado de '$original' para '$client->address_complement'</li>";
        }

        return $text;
    }

    public static function getChangesBank(Bank $bank)
    {
        $text = "";

        if ($bank->code != $bank->getOriginal('code')) {
            $original = $bank->getOriginal('code');
            $text = $text . "<li>Código alterado de '$original' para '$bank->code'</li>";
        }

        if ($bank->name != $bank->getOriginal('name')) {
            $original = $bank->getOriginal('name');
            $text = $text . "<li>Nome alterado de '$original' para '$bank->name'</li>";
        }

        return $text;
    }

    public static function getChangesEquipmentGenerator(EquipmentGenerator $equipment)
    {
        $text = "";

        if ($equipment->module != $equipment->getOriginal('module')) {
            $original = $equipment->getOriginal('module');
            $text = $text . "<li>Módulo alterado de '$original' para '$equipment->module'</li>";
        }

        if ($equipment->producer != $equipment->getOriginal('producer')) {
            $original = $equipment->getOriginal('producer');
            $text = $text . "<li>Fabricante alterado de '$original' para '$equipment->producer'</li>";
        }

        if ($equipment->technology != $equipment->getOriginal('technology')) {
            $original = $equipment->getOriginal('technology');
            $text = $text . "<li>Tecnologia alterada de '$original' para '$equipment->technology'</li>";
        }

        if ($equipment->power != $equipment->getOriginal('power')) {
            $original = $equipment->getOriginal('power');
            $text = $text . "<li>Potencia alterada de '$original' para '$equipment->power'</li>";
        }

        if ($equipment->guarantee != $equipment->getOriginal('guarantee')) {
            $original = $equipment->getOriginal('guarantee');
            $text = $text . "<li>Garantia alterada de '$original' para '$equipment->guarantee'</li>";
        }

        return $text;
    }

    public static function getChangesEquipmentStringBox(EquipmentStringBox $equipment)
    {
        $text = "";

        if ($equipment->model != $equipment->getOriginal('model')) {
            $original = $equipment->getOriginal('model');
            $text = $text . "<li>Modelo alterado de '$original' para '$equipment->model'</li>";
        }

        if ($equipment->producer != $equipment->getOriginal('producer')) {
            $original = $equipment->getOriginal('producer');
            $text = $text . "<li>Fabricante alterado de '$original' para '$equipment->producer'</li>";
        }

        return $text;
    }

    public static function getChangesEquipmentSolarInverter(EquipmentSolarInverter $equipment)
    {
        $text = "";

        if ($equipment->mppt != $equipment->getOriginal('mppt')) {
            $original = $equipment->getOriginal('mppt');
            $text = $text . "<li>MPPT alterado de '$original' para '$equipment->mppt'</li>";
        }

        if ($equipment->producer != $equipment->getOriginal('producer')) {
            $original = $equipment->getOriginal('producer');
            $text = $text . "<li>Fabricante alterado de '$original' para '$equipment->producer'</li>";
        }

        if ($equipment->technology != $equipment->getOriginal('technology')) {
            $original = $equipment->getOriginal('technology');
            $text = $text . "<li>Tecnologia alterada de '$original' para '$equipment->technology'</li>";
        }

        if ($equipment->power != $equipment->getOriginal('power')) {
            $original = $equipment->getOriginal('power');
            $text = $text . "<li>Potencia alterada de '$original' para '$equipment->power'</li>";
        }

        if ($equipment->voltage != $equipment->getOriginal('voltage')) {
            $original = $equipment->getOriginal('voltage');
            $text = $text . "<li>Voltagem alterada de '$original V' para '$equipment->voltage V'</li>";
        }

        if ($equipment->guarantee != $equipment->getOriginal('guarantee')) {
            $original = $equipment->getOriginal('guarantee');
            $text = $text . "<li>Garantia alterada de '$original' para '$equipment->guarantee'</li>";
        }

        return $text;
    }

    public static function getChangesEquipmentCable(EquipmentCable $equipment)
    {
        $text = "";

        if ($equipment->name !== $equipment->getOriginal('name')) {
            $original = $equipment->getOriginal('name');
            $text = $text . "<li>Nome alterado de '$original' para '$equipment->name'</li>";
        }

        return $text;
    }

    public static function getChangesEquipmentConnector(EquipmentConnector $equipment)
    {
        $text = "";

        if ($equipment->name != $equipment->getOriginal('name')) {
            $original = $equipment->getOriginal('name');
            $text = $text . "<li>Nome alterado de '$original' para '$equipment->name'</li>";
        }

        return $text;
    }

    public static function getChangesEquipmentOther(EquipmentOther $equipment)
    {
        $text = "";

        if ($equipment->name != $equipment->getOriginal('name')) {
            $original = $equipment->getOriginal('name');
            $text = $text . "<li>Nome alterado de '$original' para '$equipment->name'</li>";
        }

        return $text;
    }

    public static function getChangesSeller(Seller $seller)
    {
        $text = "";

        if ($seller->name != $seller->getOriginal('name')) {
            $original = $seller->getOriginal('name');
            $text = $text . "<li>Nome alterado de '$original' para '$seller->name'</li>";
        }

        if ($seller->email != $seller->getOriginal('email')) {
            $original = $seller->getOriginal('email');
            $text = $text . "<li>E-mail alterado de '$original' para '$seller->email'</li>";
        }

        if ($seller->phone != $seller->getOriginal('phone')) {
            $original = $seller->getOriginal('phone');
            $text = $text . "<li>Telefone alterado de '$original' para '$seller->phone'</li>";
        }

        if ($seller->address_cep != $seller->getOriginal('address_cep')) {
            $original = $seller->getOriginal('address_cep');
            $text = $text . "<li>CEP alterado de '$original' para '$seller->cep'</li>";
        }

        if ($seller->address != $seller->getOriginal('address')) {
            $original = $seller->getOriginal('address');
            $text = $text . "<li>Endereço alterado de '$original' para '$seller->address'</li>";
        }

        if ($seller->address_number != $seller->getOriginal('address_number')) {
            $original = $seller->getOriginal('address_number');
            $text = $text . "<li>Número/Apt alterado de '$original' para '$seller->address_number'</li>";
        }

        if ($seller->complement != $seller->getOriginal('complement')) {
            $original = $seller->getOriginal('complement');
            $text = $text . "<li>Complemento alterado de '$original' para '$seller->complement'</li>";
        }

        return $text;
    }

    public static function getChangesContract(Contract $contract)
    {
        $text = "";

        if ($contract->seller_id != $contract->getOriginal('seller_id')) {
            $original = Seller::find($contract->getOriginal('seller_id'))->name;
            $new = Seller::find($contract->seller_id)->name;
            $text = $text . "<li>Vendedor alterado de '$original' para '$new'</li>";
        }

        if ($contract->client_id != $contract->getOriginal('client_id')) {
            $original = Client::find($contract->getOriginal('client_id'))->name;
            $new = Client::find($contract->client_id)->name;
            $text = $text . "<li>Cliente alterado de '$original' para '$new'</li>";
        }

        if ($contract->value != $contract->getOriginal('value')) {
            $original = $contract->getOriginal('value');
            $original = format_money($original);
            $new = format_money($contract->value);
            $text = $text . "<li>Valor alterado de R$ $original para R$ $new</li>";
        }

        if ($contract->status != $contract->getOriginal('status')) {
            $original = $contract->getOriginal('status');
            $new = $contract->status;
            $text = $text . "<li>Status alterado de $original para $new</li>";
        }

        if ($contract->description != $contract->getOriginal('description')) {
            $original = $contract->getOriginal('description');
            $new = $contract->description;
            $text = $text . "<li>Descrição alterada de $original para $new</li>";
        }

        if ($contract->type != $contract->getOriginal('type')) {
            $original = ($contract->getOriginal('type') == 1) ? 'INSTALAÇÃO' : 'MANUTENÇÃO';
            $new = ($contract->getOriginal('type') == 1) ? 'MANUTENÇÃO' : 'INSTALAÇÃO';
            $text = $text . "<li>Tipo alterado de $original para $new</li>";
        }

        if ($contract->started_at != $contract->getOriginal('started_at')) {
            $original = $contract->getOriginal('started_at')->format('d/m/Y');
            $new = $contract->started_at->format('d/m/Y');
            $text = $text . "<li>Datade Início Altearda de '$original' para '$new'</li>";
        }

        if ($contract->contract_name != $contract->getOriginal('contract_name')) {
            $original = $contract->getOriginal('contract_name');
            $new = $contract->contract_name;
            $text = $text . "<li>Descrição alterada de '$original' para '$new'</li>";
        }

        if ($contract->phone != $contract->getOriginal('phone')) {
            $original = $contract->getOriginal('phone');
            $new = $contract->phone;
            $text = $text . "<li>Telefone alterado de '$original' para '$new'</li>";
        }

        if ($contract->address_cep != $contract->getOriginal('address_cep')) {
            $original = $contract->getOriginal('address_cep');
            $new = $contract->address_cep;
            $text = $text . "<li>CEP alterado de '$original' para '$new'</li>";
        }

        if ($contract->address != $contract->getOriginal('address')) {
            $original = $contract->getOriginal('address');
            $new = $contract->address;
            $text = $text . "<li>Endereço alterado de '$original' para '$new'</li>";
        }

        if ($contract->address_state != $contract->getOriginal('address_state')) {
            $original = $contract->getOriginal('address_state');
            $new = $contract->address_state;
            $text = $text . "<li>Estado alterado de '$original' para '$new'</li>";
        }

        if ($contract->address_city != $contract->getOriginal('address_city')) {
            $original = $contract->getOriginal('address_city');
            $new = $contract->address_city;
            $text = $text . "<li>Cidade alterada de '$original' para '$new'</li>";
        }

        if ($contract->address_neighborhood != $contract->getOriginal('address_neighborhood')) {
            $original = $contract->getOriginal('address_neighborhood');
            $new = $contract->address_neighborhood;
            $text = $text . "<li>Bairro alterado de '$original' para '$new'</li>";
        }

        if ($contract->address_number != $contract->getOriginal('address_number')) {
            $original = $contract->getOriginal('address_number');
            $new = $contract->address_number;
            $text = $text . "<li>Numero/Apt alterado de '$original' para '$new'</li>";
        }

        if ($contract->address_complement != $contract->getOriginal('address_complement')) {
            $original = $contract->getOriginal('address_complement');
            $new = $contract->address_complement;
            $text = $text . "<li>Complemento alterado de '$original' para '$new'</li>";
        }

        if ($contract->generator_structure != $contract->getOriginal('generator_structure')) {
            $original = $contract->getOriginal('generator_structure');
            $new = $contract->generator_structure;

            switch ($original) {
                case 1:
                    $original = 'Solo Monoposte';
                    break;

                case 2:
                    $original = 'Laje';
                    break;

                case 3:
                    $original = 'Fibrocimento';
                    break;

                case 4:
                    $original = 'Cerâmico';
                    break;
            }

            switch ($new) {
                case 1:
                    $new = 'Solo Monoposte';
                    break;

                case 2:
                    $new = 'Laje';
                    break;

                case 3:
                    $new = 'Fibrocimento';
                    break;
                
                case 4:
                    $new = 'Cerâmico';
                    break;
            }

            $text = $text . "<li>Estrutura alterada de '$original' para '$new'</li>";
        }

        if ($contract->area != $contract->getOriginal('area')) {
            $original = $contract->getOriginal('area');
            $new = $contract->area;
            $text = $text . "<li>Área Configurada alterada de '$original' para '$new'</li>";
        }

        if ($contract->monthly_avg_generation != $contract->getOriginal('monthly_avg_generation')) {
            $original = $contract->getOriginal('monthly_avg_generation');
            $new = $contract->monthly_avg_generation;
            $text = $text . "<li>Geração Média Mensal alterada de '$original' para '$new'</li>";
        }

        if ($contract->finished_at != $contract->getOriginal('finished_at')) {
            $original = $contract->getOriginal('finished_at')->format('d/m/Y');
            $new = $contract->finished_at->format('d/m/Y');
            $text = $text . "<li>Datade Término alterada de '$original' para '$new'</li>";
        }

        return $text;
    }

    public function index()
    {
        $logs = Log::orderBy('created_at', 'desc')->get();

        return view('log.list', [
            'logs' => $logs
        ]);
    }
}
