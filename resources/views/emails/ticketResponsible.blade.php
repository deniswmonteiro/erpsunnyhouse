@component('mail::layout')
@slot('header')
    @component('mail::header', ['url' => config('app.url')])
        Sunny House &ndash; Ticket
    @endcomponent
@endslot

<div class="mb-2">
<p>
Olá, {{$maildata['user_name']}}!
</p>
<p>
Você foi atribuído(a) a uma OS.
</p>
<a href="{{$maildata['url']}}" class="btn btn-primary">
Visualizar Ticket
</a>

<hr class="mt-5 mb-4">

<div class="mb-2">
<p>
Caso você não seja direcionado para o site a partir do botão acima, copie e cole o link abaixo no seu navegador.
</p>
<p class="text-primary">
{{$maildata['url']}}
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