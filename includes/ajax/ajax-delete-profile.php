<?php
//avvio la sessione
session_start();

include("../../config.php");

if (isset($_SESSION["userCode"]) && isset($_COOKIE["profileCode"])){
    //memorizzo il codice dell'utente
    $userCode = $_SESSION["userCode"];
    //memorizzo il codice del profilo
    $profileCode = $_COOKIE["profileCode"];

    if ($profileCode == $userCode){
        //cancello il profilo dell'utente
        deleteProfile($conn, $userCode);

    } else {
        die("NON PUOI ELIMINARE IL PROFILO DI UN ALTRO UTENTE!");

    }

} else {
    die("NON PUOI ELIMINARE IL PROFILO SENZA PRIMA AVER ESEGUITO L'ACCESSO!");

}

