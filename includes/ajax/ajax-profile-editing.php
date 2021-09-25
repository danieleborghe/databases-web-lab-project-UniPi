<?php
//avvio la sessione
session_start();

include("../../config.php");

if(isset($_SESSION["userCode"]) && isset($_COOKIE["profileCode"])){
    //memorizzo il mio codice utente
    $userCode = $_SESSION["userCode"];
    //memorizzo il codice del profilo
    $profileCode = $_COOKIE["profileCode"];

    if ($profileCode == $userCode){
        //verifico il set del pulsante di invio
        if (isset($_POST["saveProfile"])) {
            //estraggo le attuali informazioni dell'utente
            $profileInfo = getUser($conn, $userCode);
            $profileImgLocation = $profileInfo['posizioneImgProfilo'];

            //memorizzo le informazioni del POST
            $profileName = $_POST["profileName"];
            $profileSurname = $_POST["profileSurname"];
            $profileBDate = $_POST["profileBDate"];

            if (isset($_POST["profileGender"])){
                $profileGender = $_POST["profileGender"];
            } else $profileGender = $profileInfo["genere"];
            
            $profilePhone = $_POST["profilePhone"];
            $profileDocument = $_POST["profileDocument"];
            $profileEmail = $_POST["profileEmail"];
            $profileUsername = $_POST["profileUsername"];
            $profileBio = $_POST["profileBio"];

            

            //creo una variabile stato della procedura di registrazione
            $profileEditingState = array();

            if(!empty($_FILES['profileImgForm']["name"])){
                $profileImg = $_FILES['profileImgForm'];

                //memorizzo le informazioni relative all'immagine del profilo caricata
                $profileImgName = $_FILES["profileImgForm"]["name"];
                $profileImgTmpName = $_FILES["profileImgForm"]["tmp_name"];
                $profileImgSize= $_FILES["profileImgForm"]["size"];
                $profileImgError = $_FILES["profileImgForm"]["error"];
                $profileImgType = $_FILES["profileImgForm"]["type"];
                $profileImgExtension = explode('.', $profileImgName);
                $profileImgActualExt = strtolower(end($profileImgExtension));

                //definisco le estensioni consentite per l'immagine di profilo
                $allowedImgExtensions = array('jpg', 'jpeg', 'png');

                //verifico la corretta estensione e la dimensione del file immagine
                if (checkImgExtension($profileImgActualExt, $allowedImgExtensions) !== true || checkImgSize($profileImgSize) !== true){
                    //codice di errore numero 7
                    array_push($profileEditingState, 7);
                }

                //verifico eventuali errori nel caricamento del file
                if (checkImgUpload($profileImgError) !== true){
                    //codice di errore numero 8
                    array_push($profileEditingState, 8);
                }
                $profileImgLocation = imgUpload($profileImgTmpName, $profileImgActualExt);
            }

            //verifico la validità del nome
            if (invalidName($profileName) !== false){
                //codice di errore 1
                array_push($profileEditingState, 0);
            }
            
            //verifico la validità del cognome
            if (invalidSurname($profileSurname) !== false){
                //codice di errore 2
                array_push($profileEditingState, 1);
            }
            
            //verifico la validità della data di nascita
            if (invalidBDate($profileBDate) !== false){
                //codice di errore 3
                array_push($profileEditingState, 2);
            }
            
            //verifico la validità del numero di telefono
            if (invalidPhone($profilePhone) !== false){
                //codice di errore 4
                array_push($profileEditingState, 3);
            }
            
            //verifico la validità del documento di identità
            if (invalidDocument($profileDocument) !== false){
                //codice di errore 5
                array_push($profileEditingState, 4);
            }

            //verifico la validità dell'indirizzo email
            if (invalidEmail($profileEmail) !== false){
                //codice di errore 7
                array_push($profileEditingState, 5);
            }
            
            //verifico la validità del nome utente
            if (invalidUsername($profileUsername) !== false){
                //codice di errore 6
                array_push($profileEditingState, 6);
            }
            
            //verifico se il nome utente è già utilizzato
            if (checkUserExistenceExcept($conn, $profileUsername, $profileEmail, $profileDocument, $userCode) !== false){
                //codice di errore 9
                array_push($profileEditingState, 9);
            }

            if(empty($profileEditingState)){
                //creo l'utente
                editProfile($conn, $profileName, $profileSurname, $profileBDate, $profileGender, $profilePhone, $profileDocument, $profileEmail, $profileUsername, $profileImgLocation, $profileBio);
            
            } else {
                //invio ad ajax lo stato della procedura con gli errori
                print json_encode($profileEditingState);
            }
        }
    } else {
        die("NON PUOI MODIFICARE IL PROFILO DI UN ALTRO UTENTE!");

    }

} else {
    die("DEVI PRIMA ESEGUIRE L'ACCESSO PER MODIFICARE IL PROFILO!");
    
}
?>