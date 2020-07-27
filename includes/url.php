<?php

// redirect to another URL 

function redirect($path)
{
    header("Location: $path");

    exit;
}
