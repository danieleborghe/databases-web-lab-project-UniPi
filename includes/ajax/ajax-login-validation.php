<?php
//avvio la sessione
session_start();

include("../../config.php");

//verifico l'invio del form
if (isset($_POST["loginSubmit"])) {

    //verifico che l'utente non abbia già effettuato l'accesso
    if (isset($_SESSION["userCode"])){
        //invio la comunicazione ad Ajax
        $loginState = "alreadyLogged";
        echo json_encode($loginState);

    } else {
        //memorizzo le informazioni del form
        $siID = $_POST["loginID"];
        $siPassword = $_POST["loginPassword"];

        //verifico l'esistenza dell'utente
        if (checkUserExistence($conn, $siID, $siID, $siID) === false){
            //segnalo ad Ajax che l'utente non esiste
            $loginState = "wrongID";
            echo json_encode($loginState);

        } else {
            //memorizzo le informazioni dell'utete
            $userExistence = checkUserExistence($conn, $siID, $siID, $siID);
            $hashedPassword = $userExistence["parolaChiave"];

            //verifico la correttezza della password
            if (password_verify($siPassword, $hashedPassword)){
                //eseguo il login
                loginUser($userExistence);

                //segnalo ad Ajax la correttezza della password
                $loginState = "successLogin";
                echo json_encode($loginState);
            } else {
                //segnalo ad Ajax che la password è errata
                $loginState = "wrongPassword";
                echo json_encode($loginState);

            }
        }
    }
}