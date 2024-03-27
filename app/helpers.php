<?php

function removePlussesEmail(string $email)
{
    // Deconstruct
    $parts = explode('@', $email);

    // Find '+'
    $firstPart = $parts[0];
    $plusIndex = strpos($firstPart, '+');

    // Truncate '+' and everything after it in the username
    if ($plusIndex)
        $firstPart = substr($firstPart, 0, $plusIndex);

    // return (new) username@domain
    return  $firstPart . '@' . (isset($parts[1]) ? $parts[1] : null);
}


