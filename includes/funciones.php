<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// validar 
function validarORedireccionar(string $url){
    $token=$_GET['token'];
    $id=filter_var($token,FILTER_VALIDATE_URL);
    
    if(!$token){
        header("Location:${url}");
    }
    return $token;
}