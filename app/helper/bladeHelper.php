<?php

use \App\Http\Controllers\ContractController;

function has_active_url($list)
{
    $exist = false;
    foreach ($list as $item) {
        if (str_contains(Request::path(), $item)) {
            $exist = true;
        }
    }
    return $exist;
}

function format_money($value)
{
    $value = floatval($value);
    return number_format($value, 2, ',', '.');
}

function format_money_to_double($value)
{
    $value = number_format(
        str_replace(",", ".",
            str_replace(".", "", $value)), 2, '.', '');
    return $value;
}

function contract_number($contract)
{
    return ContractController::$MAGIC_NUMBER + $contract->id;;
}

function contract_payment_is($contract, $text)
{
    return ($contract->payment->type->name == $text);
}

function contract_payment_in($contract, $list)
{
    foreach ($list as $text) {
        if ($contract->payment->type->name == $text) {
            return true;
        }
    }

    return false;

}

function contract_name_cash()
{
    return ContractController::$PAYMENT_CASH;
}

function contract_name_partial_parceled()
{
    return ContractController::$PAYMENT_PARTIAL_PARCELED;
}

function contract_name_total_parceled()
{
    return ContractController::$PAYMENT_TOTAL_PARCELED;
}

function contract_name_company_installment()
{
    return ContractController::$PAYMENT_COMPANY_INSTALLMENT;
}

function contract_name_custom()
{
    return ContractController::$PAYMENT_CUSTOM;
}

function in_collection($item, $array)
{
    foreach ($array as $element) {
        if ($item->id == $element->id) {
            return true;
        }
    }
    return false;
}

function remove_accent($string) {
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"), explode(" ","a A e E i I o O u U n N"), $string);
}
