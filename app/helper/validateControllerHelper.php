<?php
function phoneIsValid($attribute, $value, $fail)
{
    if (strlen($value) != strlen('(00) 0000-0000') && strlen($value) != strlen('(00) 00000-0000')) {
        $fail('The ' . $attribute . ' is invalid.');
    }
}

function cpfIsValid($attribute, $value, $fail)
{
    if (strlen($value) != strlen('000.000.000-00')) {
        $fail('The ' . $attribute . ' is invalid.');
    }
}
