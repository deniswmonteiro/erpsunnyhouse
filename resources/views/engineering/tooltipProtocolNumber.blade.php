@if ($generator->submission != null)
    <p class='mb-0'>
        {{$generator->submission->protocol_number}}
    </p>
@endif

@if ($generator->feedback != null)
    <p class='mb-0'>
        {{$generator->feedback->protocol_number}}
    </p>
@endif

@if ($generator->issued != null)
    <p class='mb-0'>
        {{$generator->issued->protocol_number}}
    </p>
@endif

@if ($generator->provisional != null)
    <p class='mb-0'>
        {{$generator->provisional->protocol_number}}
    </p>
@endif

@if ($generator->survey != null)
    <p class='mb-0'>
        {{$generator->survey->protocol_number}}
    </p>
@endif