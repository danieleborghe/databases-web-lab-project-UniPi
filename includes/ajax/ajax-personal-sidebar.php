<?php
//avvio la sessione
session_start();

include("../../config.php");

//verifico l'accesso dell'utente
if (isset($_SESSION['userCode'])) {
    //estraggo il codice dell'utente dalla sessione
    $userCode = $_SESSION['userCode'];
    //creo un array di response
    $userInfo = array();

    //estraggo i blog dell'utente dal db
    $userBlog = getUserBlogs($conn, $userCode);
    //appendo i blog e le loro immagini all'array
    $userInfo['blog'] = $userBlog;

    //estraggo le collaborazioni dell'utente dal db
    $userCollabs = getUserCollabs($conn, $userCode);
    //appendo i blog e le loro immagini all'array
    $userInfo['collabs'] = $userCollabs;

    //invio ad AJAX i dati in formato JSON
    echo json_encode($userInfo);

} else {
    die("Accesso non eseguito!");
    
}
?>