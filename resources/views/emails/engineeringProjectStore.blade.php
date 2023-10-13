@component('mail::layout')
@slot('header')
    @component('mail::header', ['url' => config('app.url')])
        Sunny House &ndash; Projeto de Engenharia
    @endcomponent
@endslot

<div class="mb-2">
<p>
Um novo projeto foi <span class="fw-bold">cadastrado</span> no sistema.
</p>
</div>

<hr class="mt-4 mb-4">

<div class="d-flex mb-2">
<div class="col me-5 pe-5">
<p>
<span class="d-block fw-bold">Cliente:</span>
{{$maildata['client']}}
</p>
</div>
<div class="col me-5 pe-5">
<p>
<span class="d-block fw-bold">Potência do Gerador:</span>
{{$maildata['power']}}
</p>
</div>
</div>

@foreach ($maildata['project']->generator as $gen_key => $generator)
@php
if ($generator->client != null) {
    $generator_client = $generator->client->is_corporate ?
        $generator->client->corporate_name :
        $generator->client->name;
}
@endphp

<div class="generator rounded pb-3 mb-4">
<p class="generator-title">Geradora {{$gen_key + 1}} &ndash; Conta Contrato: {{$generator->generator_contract_account}}</p>

<div class="mb-2 ps-4 pe-4">
<p>
<span class="d-block fw-bold">Tipo de Projeto:</span>
@switch ($generator->generator_project_type)
@case ('INDIVIDUAL')
Individual  
@break
@case ('AUTOCONSUMO_REMOTO')
Autoconsumo Remoto
@break
@case ('GERACAO_COMPARTILHADA')
Geração Compartilhada
@break
@endswitch
</p>
</div>

<div class="mb-2 ps-4 pe-4">
<p>
<span class="d-block fw-bold">Cliente:</span> {{$generator_client}}
</p>
</div>

<div class="mb-2 ps-4 pe-4">
<p>
<span class="d-block fw-bold">CEP:</span> {{$generator->generator_cep}}
</p>
</div>

<div class="d-flex mb-2 ps-4 pe-4">
<div class="col me-5">
<p>
<span class="d-block fw-bold">Endereço:</span> {{$generator->generator_address}}
</p>
</div>
<div class="col me-5">
<p>
<span class="d-block fw-bold">Número:</span> {{$generator->generator_number}}
</p>
</div>
<div class="col me-5">
<p>
<span class="d-block fw-bold">Complemento:</span>
@if ($generator->generator_complement != null) {{$generator->generator_complement}} @else &mdash; @endif
</p>
</div>
</div>

<div class="d-flex mb-2 ps-4 pe-4">
<div class="col me-5">
<p>
<span class="d-block fw-bold">Bairro:</span> {{$generator->generator_neighborhood}}
</p>
</div>
<div class="col me-5">
<p>
<span class="d-block fw-bold">Cidade:</span> {{$generator->generator_city}}
</p>
</div>
<div class="col me-5">
<p>
<span class="d-block fw-bold">Estado:</span> {{$generator->generator_state}}
</p>
</div>
</div>

<div class="d-flex mb-2 ps-4 pe-4">
<div class="col me-5">
<p>
<span class="d-block fw-bold">Conta Contrato:</span> {{$generator->generator_contract_account}}
</p>
</div>
<div class="col me-5">
<p>
<span class="d-block fw-bold">Potência da Geradora (kWp):</span>
{{Str::replaceFirst('.', ',', $generator->generator_power / 1000)}}
</p>
</div>
<div class="col me-5">
<p>
<span class="d-block fw-bold">Consumo da Geradora (kWh):</span>
@if ($generator->generator_consumption != null) {{number_format($generator->generator_consumption, 2, ',', '.')}}
@else &mdash;
@endif
</p>
</div>
</div>

@if (count($generator->beneficiary) > 0)
@foreach ($generator->beneficiary as $ben_key => $beneficiary)
@php
    if ($beneficiary->client != null) {
    $beneficiary_client = $beneficiary->client->is_corporate ? 
        $beneficiary->client->corporate_name :
        $beneficiary->client->name;
    }

    switch ($beneficiary->beneficiary_consumption_class) {
        case ('RESIDENCIAL'):
            $beneficiary_class = 'Residencial';
            break;
        case ('INDUSTRIAL'):
            $beneficiary_class = 'Industrial';
            break;
        case ('COMERCIO_SERVICOS_OUTROS'):
            $beneficiary_class = 'Comércio, Serviço e outras atividades';
            break;
        case ('RURAL'):
            $beneficiary_class = 'Rural';
            break;
        case ('PODER_PUBLICO'):
            $beneficiary_class = 'Poder Público';
            break;
        case ('ILUMINACAO_PUBLICA'):
            $beneficiary_class = 'Iluminação Pública';
            break;
        case ('SERVICO_PUBLICO'):
            $beneficiary_class = 'Serviço Público';
            break;
        case ('CONSUMO_PROPRIO'):
            $beneficiary_class = 'Consumo Próprio';
            break;
    }
@endphp

<div class="beneficiary rounded pb-3 mb-4">
<p class="beneficiary-title">Beneficiária {{$ben_key + 1}} &ndash; Conta Contrato: {{$beneficiary->beneficiary_contract_account}}</p>

@if ($maildata['project']->engineering_project_type == 'GERACAO_COMPARTILHADA' && $beneficiary->client != null)
<div class="mb-2 ps-4 pe-4">
<p>
<span class="d-block fw-bold">Cliente:</span> {{$beneficiary_client}}
</p>
</div>
@endif

<div class="d-flex mb-2 ps-4 pe-4">
<div class="col me-5">
<p>
<span class="d-block fw-bold">Conta Contrato:</span> {{$beneficiary->beneficiary_contract_account}}
</p>
</div>
<div class="col me-5">
<p>
<span class="d-block fw-bold">Classe de Consumo:</span> {{$beneficiary_class}}
</p>
</div>
<div class="col me-5">
<p>
<span class="d-block fw-bold">Rateio (%):</span> {{Str::replaceFirst('.', ',', $beneficiary->beneficiary_rate)}}
</p>
</div>
</div>

<div class="mb-2 ps-4 pe-4">
<p>
<span class="d-block fw-bold">Endereço:</span> {{$beneficiary->beneficiary_address}}
</p>
</div>
</div>
@endforeach
@endif
</div>
@endforeach

<div class="mb-2">
<p>
<span class="d-block fw-bold">Observações:</span>
@if ($maildata['project']->observation != null) {{$maildata['project']->observation}}
@else &mdash;
@endif
</p>
</div>

<hr class="mt-4 mb-4">

<div class="mt-5">
<p>
Atenciosamente,<br>
{{config('app.name')}}
</p>
</div>

@slot('footer')
    @component('mail::footer')
        &copy;{{date('Y')}} {{config('app.name')}} &ndash; Todos os direitos reservados.
    @endcomponent
@endslot
@endcomponent