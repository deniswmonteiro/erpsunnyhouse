@foreach ($generators as $generator)
    <p class='text-start mb-0'>
        CC {{$generator->generator_contract_account}} &ndash; {{ucwords(Str::lower(Str::replaceFirst('_', ' ', $generator->generator_status)))}}
    </p>
@endforeach