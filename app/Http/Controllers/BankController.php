<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Contract;
use App\Models\ContractPayment;
use App\Models\PaymentCompanyInstallment;
use App\Models\PaymentPartialParceled;
use App\Models\PaymentTotalParceled;
use App\Models\PaymentType;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.not_engineering');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $bank = Bank::orderBy('code', 'asc')->get();
        return view('bank.list', ['banks' => $bank]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $code = $data['code'];
        $name = $data['name'];

        $name = ucwords(mb_strtolower($name, 'UTF-8'));

        try {
            $code = sprintf('%03d', $code);
        } catch (\Exception $e) {
            return redirect('/login');
        }

        $has_code = Bank::where('code', $code)->first();
        $has_name = Bank::where('name', $name)->first();

        if (!$has_code && !$has_name) {
            // Create bank
            Bank::create([
                'code' => $code,
                'name' => $name
            ]);

            return redirect()->route('banks_index')->with('success', 'Banco salvo com sucesso.');
        }

        else return back()->with('error', 'Banco já cadastrado no sistema.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $code = $data['code'];
        $name = $data['name'];

        $name = ucwords(mb_strtolower($name, 'UTF-8'));

        try {
            $id = decrypt($id);
            $code = sprintf('%03d', $code);
        } catch (\Exception $e) {
            return redirect('/login');
        }

        $has_code = Bank::where('code', $code)->where('id', '!=', $id)->first();
        $has_name = Bank::where('name', $name)->where('id', '!=', $id)->first();

        if (!$has_code && !$has_name) {
            $bank = Bank::find($id);

            // Update bank
            $bank->code = $code;
            $bank->name = $name;
            $bank->save();

            return redirect()->route('banks_index')->with('success', 'Banco atualizado com sucesso.');
        }
        
        else return redirect()->route('banks_index')->with('error', 'Banco já cadastrado no sistema.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $bank = Bank::find($id);
        
        if ($bank) {
            $contracts = [];
            $bankPartialParceled = PaymentPartialParceled::where('bank_id', $bank->id)->get();
            $bankTotalParceled = PaymentTotalParceled::where('bank_id', $bank->id)->get();
            $bankCompanyInstallment = PaymentCompanyInstallment::where('bank_id', $bank->id)->get();

            if (count($bankPartialParceled) != 0) {
                foreach ($bankPartialParceled as $partial) {
                    $id_type = PaymentType::where('name', ContractController::$PAYMENT_PARTIAL_PARCELED)
                        ->first()->id;
                    $contract_payment = ContractPayment::where('payment_type_id', $id_type)
                        ->where('payment_id', $partial->id)
                        ->get();
                    
                    foreach ($contract_payment as $payment) {
                        $contract = Contract::where('payment_id', $payment->id)->first();
                        array_push($contracts, $contract);
                    }
                }
            }

            if (count($bankTotalParceled) != 0) {
                foreach ($bankTotalParceled as $total) {
                    $id_type = PaymentType::where('name', ContractController::$PAYMENT_TOTAL_PARCELED)
                        ->first()->id;
                    $contract_payment = ContractPayment::where('payment_type_id', $id_type)
                        ->where('payment_id', $total->id)
                        ->get();

                    foreach ($contract_payment as $payment) {
                        $contract = Contract::where('payment_id', $payment->id)->first();
                        array_push($contracts, $contract);
                    }
                }
            }
            
            if (count($bankCompanyInstallment) != 0) {
                foreach ($bankCompanyInstallment as $company) {    
                    $id_type = PaymentType::where('name', ContractController::$PAYMENT_COMPANY_INSTALLMENT)
                        ->first()->id;
                    $contract_payment = ContractPayment::where('payment_type_id', $id_type)
                        ->where('payment_id', $company->id)
                        ->get();
                    
                    foreach ($contract_payment as $payment) {
                        $contract = Contract::where('payment_id', $payment->id)->first();
                        array_push($contracts, $contract);
                    }
                }
            }

            if (empty($contracts)) {
                $bank->delete();
                
                return redirect()->route('banks_index')->with('success', 'Banco deletado com sucesso.');
            }
    
            else {
                return view('bank.listBankContracts', [
                    'bank' => $bank,
                    'contracts' => $contracts
                ]);
            }
        }
        
        else return redirect('/');
    }
}
