<?php
//avvio la sessione
session_start();

include("../../config.php");

//memorizzo il codice del blog
$blogCode = $_COOKIE["blogCode"];

//verifico l'appartenenza del blog all'utente [DOPPIO CONTROLLO]
if (checkBlogOwner($conn, $_SESSION['userCode'], $blogCode)){
    //verifico che sia stato richiesto di aggiungere un collaboratore al blog
    if (isset($_POST["addCollab"])) {
        //memorizzo il nome del nuovo collaboratore
        $newCollab = $_POST["addCollabForm"];

        //controllo che il collaboratore non sia già associato al blog
        if (checkCollaboration($conn, $blogCode, $newCollab) || $newCollab == $_SESSION["userID"]){
            //altrimenti invio ad Ajax il codice di errore 0
            print json_encode(0);
            exit();

        //controllo che il collaboratore inserito sia un utente esistente
        } else if (!checkUserExistence($conn, $newCollab, $newCollab, $newCollab)){
            //altrimenti invio il codice di errore 1
            print json_encode(1);
            exit();

        } else {
            //memorizzo il numero di attuali collaborazioni dell'utente
            $newCollabNum = countUserCollabs($conn, $newCollab);

            //controllo che il collaboratore inserito non collabori già con 5 blog
            if ($newCollabNum["nCollabs"] >= 5){
                //altrimenti invio il codice di errore 2
                print json_encode(2);
                exit();

            } else {
                //aggiungo il collaboratore
                addCollaborator($conn, $blogCode, $newCollab);

                //invio ad ajax il codice di successo 3
                print json_encode(3);
                exit();

            }
        }
    }

    //verifico che sia stato rischiesto di rimuovere un collaboratore
    if (isset($_POST["deleteCollab"])){
        //memorizzo il nome del collaboratore da eliminare
        $oldCollab = $_POST["deleteCollabName"];

        if (isset($_POST["deleteCollabName"])){
            //elimino il collaboratore
            endCollab($conn, $blogCode, $oldCollab);
            //invio ad Ajax il codice di successo 0
            print json_encode(0);
            exit();

        }

    }
}
    