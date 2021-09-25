<?php
//avvio la sessione
session_start();

include("../../config.php");

//verifico l'avvenuta esecuzione dell'accesso
if(isset($_SESSION["userCode"]) && isset($_COOKIE["profileCode"])){
    //memorizzo il mio codice utente
    $userCode = $_SESSION["userCode"];
    //memorizzo il codice del profilo
    $profileCode = $_COOKIE["profileCode"];

    if ($profileCode == $userCode){
        //verifico il set del pulsante di invio
        if (isset($_POST["changePassword"])) {
            //memorizzo le informazioni del POST
            $profileOldPassword = $_POST["oldPassword"];
            $profileNewPassword = $_POST["newPassword"];
            $checkNewPassword = $_POST["checkNewPassword"];

            //memorizzo la data di oggi e calcolo la scadenza della password
            $suDate = new DateTime("now");
            $suDate = $suDate->format('Y-m-d');

            //creo una variabile stato della procedura di registrazione
            $pswEditingState = array();

            //estraggo la password dell'utente
            $userInfo = getUser($conn, $userCode);
            $actualHashedPsw = $userInfo['parolaChiave'];
            
            //verifico la corrispondenza della vecchia password
            if (!password_verify($profileOldPassword, $actualHashedPsw)){
                //codice di errore 0
                array_push($pswEditingState, 0);
            }

            if (invalidCheckPassword($profileOldPassword, $profileNewPassword) == false){
                //codice di errore 1
                array_push($pswEditingState, 1);
            }

            //verifico la validità della nuova password
            if (invalidPassword($profileNewPassword) !== false){
                //codice di errore 2
                array_push($pswEditingState, 2);
            }

            //verifico la corretta copia della password
            if (invalidCheckPassword($profileNewPassword, $checkNewPassword) !== false){
                //codice di errore 3
                array_push($pswEditingState, 3);
            }

            if(empty($pswEditingState)){
                //modifico la password
                editPassword($conn, $profileNewPassword);
            } else {
                print json_encode($pswEditingState);
            }
        }

    } else {
        die("NON PUOI MODIFICARE LA PASSWORD DI UN ALTRO UTENTE!");

    }
} else {
    die("DEVI PRIMA ESEGUIRE L'ACCESSO PER MODIFICARE LA PASSWORD!");
    
}
?>