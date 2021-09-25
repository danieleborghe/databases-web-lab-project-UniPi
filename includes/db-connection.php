<?php

    //memorizzo i dati di accesso al DB
    $dbServername = DB_HOST;
    $dbUsername = DB_USER;
    $dbPassword = DB_PASSWORD;
    $dbName = DB_NAME;

    //richiamo la connessione al DB
    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

    //controllo l'avvenuta connessione
    if (!$conn) { 
        //in caso stampo un messaggio di errore
        die("ERRORE DI CONNESSIONE AL DATABASE --> ".mysqli_connect_error());
    }