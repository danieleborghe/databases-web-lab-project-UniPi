<?php
//avvio la sessione
session_start();

include("../../config.php");

if (isset($_SESSION['profileCode'])) {
    //estraggo il codice dell'utente dalla sessione
    $profileCode = $_SESSION['profileCode'];
    //estraggo le informazioni dell'utente dal DB
    $userInfo = getUser($conn, $profileCode);

    //estraggo i blog dell'utente dal db
    $userBlog = getUserBlogs($conn, $profileCode);
    //appendo i blog e le loro immagini all'array
    $userInfo['blog'] = $userBlog;

    //estraggo le collaborazioni dell'utente dal db
    $userCollabs = getUserCollabs($conn, $profileCode);
    //appendo i blog e le loro immagini all'array
    $userInfo['collabs'] = $userCollabs;

    //invio ad AJAX i dati in formato JSON
    echo json_encode($userInfo);

    //elimino il codice temporaneo
    $_SESSION['profileCode'] = NULL;

}