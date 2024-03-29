<?php
//avvio la sessione
session_start();

include("../../config.php");

//controllo l'appartenenza del blog all'utente [DOPPIO CONTROLLO]
if(isset($_SESSION["userCode"])){
    //memorizzo il mio codice utente
    $userCode = $_SESSION["userCode"];

    //verifico il set del pulsante salva
    if (isset($_POST["blogSave"])){
        //memorizzo del informazioni di POST
        $blogTitle = $_POST["blogTitle"];
        $blogBio = $_POST["blogBio"];
        $blogTheme = $_POST["blogTheme"];
        $blogStyle = $_POST["blogStyle"];

        //definisco le posizioni delle immagini predefinite
        $profileImgLocation = "assets\img\default.jpg";
        $coverImgLocation = "assets\img\coverDefault.jpg";

        //creo una variabile stato della procedura di creazione del blog
        $blogCreationState = array();

        //definisco i formati di immagini validi per il caricamento
        $allowedImgExtensions = array('jpg', 'jpeg', 'png');

        //verifico se sono stati selezionati dei sottotemi
        if (isset($_POST["blogSubThemes"])){
            //memorizzo i sottotemi
            $blogSubThemes = $_POST["blogSubThemes"];

        }

        //verifico se l'immagine di profilo deve essere cambiata
        if(!empty($_FILES['blogProfileImg']["name"])){
            //memorizzo il FILE immagine
            $blogProfileImg = $_FILES["blogProfileImg"];

            //memorizzo le informazioni relative all'immagine di profilo caricata
            $profileImgName = $_FILES["blogProfileImg"]["name"];
            $profileImgTmpName = $_FILES["blogProfileImg"]["tmp_name"];
            $profileImgSize= $_FILES["blogProfileImg"]["size"];
            $profileImgError = $_FILES["blogProfileImg"]["error"];
            $profileImgType = $_FILES["blogProfileImg"]["type"];
            $profileImgExtension = explode('.', $profileImgName);
            $profileImgActualExt = strtolower(end($profileImgExtension));

            //controllo la correttezza dell'estensione dell'immagine
            if (!checkImgExtension($profileImgActualExt, $allowedImgExtensions) || !checkImgSize($profileImgSize)){
                //codice di errore numero 1
                array_push($blogCreationState, 1);

            }

            //controllo la corretta esecuzione dell'upload dell'immagine
            if (!checkImgUpload($profileImgError)){
                //codice di errore numero 2
                array_push($blogCreationState, 2);

            }   

            //definisco la posizione del file immagine
            $profileImgLocation = imgUpload($profileImgTmpName, $profileImgActualExt);

        }

        //verifico se l'immagine di copertina deve essere cambiata
        if(!empty($_FILES['blogCoverImg']["name"])){
            //memorizzo il FILE immagine
            $blogCoverImg = $_FILES["blogCoverImg"];

            //memorizzo le informazioni relative all'immagine di copertina caricata
            $coverImgName = $_FILES["blogCoverImg"]["name"];
            $coverImgTmpName = $_FILES["blogCoverImg"]["tmp_name"];
            $coverImgSize= $_FILES["blogCoverImg"]["size"];
            $coverImgError = $_FILES["blogCoverImg"]["error"];
            $coverImgType = $_FILES["blogCoverImg"]["type"];
            $coverImgExtension = explode('.', $coverImgName);
            $coverImgActualExt = strtolower(end($coverImgExtension));

            //controllo la correttezza dell'estensione dell'immagine
            if (!checkImgExtension($coverImgActualExt, $allowedImgExtensions) || !checkImgSize($coverImgSize)){
                //codice di errore numero 3
                array_push($blogCreationState, 3);

            }

            //controllo la corretta esecuzione dell'upload dell'immagine
            if (!checkImgUpload($coverImgError)){
                //codice di errore numero 4
                array_push($blogCreationState, 4);

            }

            //memorizzo la posizione dell'immagine
            $coverImgLocation = imgUpload($coverImgTmpName, $coverImgActualExt);

        }
        
        //verifico la validità del nome
        if (invalidName($blogTitle) !== false){
            //codice di errore 0
            array_push($blogCreationState, 0);
        }

        //verifico che lo stato sia vuoto (privo di errori)
        if(empty($blogCreationState)){
            //modifico il blog
            $blogCode = createBlog($conn, $blogTitle, $blogBio, $profileImgLocation, $coverImgLocation, $blogStyle);
            //aggiungo il nuovo tema principale del blog
            editBlogTheme($conn, $blogCode, $blogTheme);

            //verifico che siano stati definiti dei sottotemi
            if (isset($blogSubThemes)){
                //aggiungo i nuovi sottotemi del blog
                editBlogSubthemes($conn, $blogCode, $blogSubThemes);

            }

        } else {
            //invio ad ajax il codice di errore
            print json_encode($blogCreationState);

        }
    }
    
} else {
    die("NON HAI IL PERMESSO DI CREARE UN BLOG SENZA AVER ESEGUITO L'ACCESSO");

}