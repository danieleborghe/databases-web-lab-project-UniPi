<?php
//avvio la sessione
session_start();

include("../../config.php");

if(isset($_SESSION["userCode"])){
    echo("HAI GIA' ESEGUITO L'ACCESSO AL SITO WEB");
    exit();
} else if (isset($_POST["suSubmit"])) {
    //memorizzo le informazioni del form di registrazione
    $suName = $_POST["suName"];
    $suSurname = $_POST["suSurname"];
    $suBDate = $_POST["suBDate"];
    $suPhone = $_POST["suPhone"];
    $suDocument = $_POST["suDocument"];
    $suGenderSelect = $_POST["suGenderSelect"];
    $suUsername = $_POST["suUsername"];
    $suEmail = $_POST["suEmail"];
    $suPassword = $_POST["suPassword"];
    $suCheckPassword = $_POST["suCheckPassword"];

    //imposto la data di scadenza della password
    $suDate = new DateTime("now");
    $suDate = $suDate->format('Y-m-d');

    //creo una variabile stato della procedura di registrazione
    $signupState = array();

    //verifico la validità del nome
    if (invalidName($suName) !== false){
        //codice di errore 1
        array_push($signupState, 0);
    }
    
    //verifico la validità del cognome
    if (invalidSurname($suSurname) !== false){
        //codice di errore 2
        array_push($signupState, 1);
    }
    
    //verifico la validità della data di nascita
    if (invalidBDate($suBDate) !== false){
        //codice di errore 3
        array_push($signupState, 2);
    }
    
    //verifico la validità del numero di telefono
    if (invalidPhone($suPhone) !== false){
        //codice di errore 4
        array_push($signupState, 3);
    }
    
    //verifico la validità del documento di identità
    if (invalidDocument($suDocument) !== false){
        //codice di errore 5
        array_push($signupState, 4);
    }
    
    //verifico la validità del nome utente
    if (invalidUsername($suUsername) !== false){
        //codice di errore 6
        array_push($signupState, 5);
    }
    
    //verifico la validità dell'indirizzo email
    if (invalidEmail($suEmail) !== false){
        //codice di errore 7
        array_push($signupState, 6);
    }
    
    //verifico la validità della password
    if (invalidPassword($suPassword) !== false){
        //codice di errore 8
        array_push($signupState, 7);
    }

    //verifico la corretta copia della password
    if (invalidCheckPassword($suPassword, $suCheckPassword) !== false){
        //codice di errore 8
        array_push($signupState, 8);
    }
    
    //verifico se il nome utente è già utilizzato
    if (checkUserExistence($conn, $suUsername, $suEmail, $suDocument) !== false){
        //codice di errore 9
        array_push($signupState, 9);
    }

    if(empty($signupState)){
        //creo l'utente
        createUser($conn, $suPhone, $suDocument, $suGenderSelect, $suUsername, $suEmail, $suPassword, $suDate, $suBDate, $suName, $suSurname);
    } else {
        //invio ad ajax lo stato della procedura con i relativi errori
        print json_encode($signupState);
    }
}