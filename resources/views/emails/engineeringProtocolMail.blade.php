@component('mail::layout')
@slot('header')
    @component('mail::header', ['url' => config('app.url')])
        Sunny House &ndash; Projeto de Engenharia
    @endcomponent
@endslot

<div class="mb-2">
<p>
Alerta de protocolo pendente.
</p>
</div>

<hr class="mt-4 mb-4">

<div class="d-flex mb-2">
<div class="col me-5">
<p>
<span class="d-block fw-bold">Cliente:</span>
{{$maildata['client']}}
</p>
</div>
<div class="col me-5">
<p>
<span class="d-block fw-bold">Conta Contrato:</span>
{{$maildata['contract_account']}}
</p>
</div>
<div class="col me-5">
<p>
<span class="d-block fw-bold">Status do Projeto:</span>
{{$maildata['status']}}
</p>
</div>
</div>

<div class="d-flex mb-2">
<div class="col me-5">
<p>
<span class="d-block fw-bold">Número do Protocolo:</span>
{{$maildata['protocol_number']}}
</p>
</div>
<div class="col me-5">
<p>
<span class="d-block fw-bold">Data do Protocolo:</span>
{{$maildata['protocol_date']}}
</p>
</div>
<div class="col me-5">
<p>
<span class="d-block fw-bold">Prazo:</span>
{{$maildata['protocol_deadline']}}
</p>
</div>
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
