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


// ver si existe el token en la url 
function validarORedireccionar($url){
    if(isset($_GET['token'])){
        $token = $_GET['token'];
        return $token;
    }else{
        header('Location : '.$url);
    }
}
