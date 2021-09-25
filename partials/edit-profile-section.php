<?php
    require "includes/db-connection.php";
    $userCode = $_SESSION['profileCode'];
    $profileInfo = getUser($conn, $userCode);
?>

<!-- form modifica profilo-->
<div class="container p-5" id="editProfileSection">
    <h2 class="mb-5">Modifica profilo</h2>

    <!-- Imformazioni personali-->
    <p class="mb-3 fs-3"> Informazioni personali</p> 

    <form method="POST" id="profileEditingForm" enctype="multipart/form-data">

        <div class="row">
            <div class="col-6">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Nome</span>
                    <input value="<?php print $profileInfo['nome']; ?>" type="text" class="form-control" id="editProfileName" placeholder="Mario" name="profileName">
                </div>
            </div>
            <div class="col-6">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Cognome</span>
                    <input value="<?php print $profileInfo['cognome']; ?>" type="text" class="form-control" id="editProfileSurname" placeholder="Rossi" name="profileSurname">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Data di nascita</span>
                    <input value="<?php print $profileInfo['dataNascita']; ?>" type="date" class="form-control" id="editProfileBDate" placeholder="Data di nascita in formato 00/00/0000" name="profileBDate">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Genere</span>
                    <select class="form-select" id="profileGenderSelect" aria-label="Seleziona genere" name="profileGender">
                        <option selected disabled>Seleziona un genere</option>
                        <option value="Maschio">Maschio</option>
                        <option value="Femmina">Femmina</option>
                        <option value="Altro">Altro</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Telefono</span>
                    <input value="<?php print $profileInfo['telefono']; ?>" type="tel" class="form-control" id="editProfilePhone" placeholder="Numero di telefono" name="profilePhone">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Documento</span>
                    <input value="<?php print $profileInfo['estremiDocumento']; ?>" type="text" class="form-control" id="editProfileDocument" placeholder="Estremi documento" name="profileDocument">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Email</span>
                    <input value="<?php print $profileInfo['email']; ?>" type="email" class="form-control" id="editProfileEmail" placeholder="name@example.com" name="profileEmail">
                </div>
            </div>
        </div>

        <!--Fine di informazioni personali-->

        <!-- Dettagli utente-->
        <p class="fs-3 mb-3">Dettagli utente<p> 

        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Nome utente</span>
                    <input value="<?php print $profileInfo['nomeUtente']; ?>" type="text" class="form-control" id="editProfileUser" placeholder="Username" name="profileUsername">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="profileImgForm" class="form-label">Immagine del profilo</label>

                <div class="input-group mb-3">
                    <input type="file" class="form-control mb-3" id="profileImgForm" name="profileImgForm" />
                </div>
            </div>  
        </div>


        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Biografia</span>
                    <input type="text" value="<?php print $profileInfo['biografia']; ?>" class="form-control height-small edit-profile-bio" id="editProfileTextArea" name="profileBio" ></textarea>
                </div>
            </div>
        </div>
        <!--Fine di contenuti profilo-->

        <div class="alert alert-success" role="alert" id="profileEdited">
            Profilo modificato con successo!
        </div>

        <!-- Bottoni -->
        <div class="row mt-2">
            <!-- Bottone elimina profilo-->
            <div class="d-flex justify-content-start py-3 col-8">
                <button type="button" class="edit-button btn btn-danger" name="deleteProfile" id="deleteProfile">Elimina profilo</button>
            </div>
            <!-- Fine bottone elimina profilo-->    

            <div class="d-flex justify-content-end py-3 col-2">
                <a href="/progetto-sito/profile.php">
                    <button type="button" class="btn btn-primary" data-toggle="modal" id="returnToProfile">
                        Torna al Profilo
                    </button>
                </a>
            </div>
            <!-- Bottone salva modifiche-->
            <div class="d-flex justify-content-end py-3 col-2">
                <button type="submit" class="edit-button btn btn-primary" name="saveProfile">Salva modifiche</button>
            </div>
            <!-- Fine bottone salva modifiche-->
        </div>
        <!-- Fine di bottoni-->
    </form>

    <form method="POST" id="passwordEditingForm" enctype="multipart/form-data">
        <!--Password-->
        <p class="fs-3 mb-3">Password<p> 

        <div class="row">
            <div class="col-6">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Vecchia password</span>
                    <input type="password" class="form-control" id="editProfileOldPassword" placeholder="Password" name="oldPassword">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Nuova password</span>
                    <input type="password" class="form-control" id="editProfilePassword" placeholder="Password" name="newPassword">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Conferma password</span>
                    <input type="password" class="form-control" id="editProfileCheckPassword" placeholder="Password" name="checkNewPassword">
                </div>
            </div>

            <div class="col-6">
                <p class="mb-2">Requisiti per la password</p> 
                <p class="small mb-2">Per creare una nuova password, devi soddisfare i seguenti requisiti:</p>
                <ul class="small pl-4 mb-0">
                    <li>Minimo 12 caratteri</li>
                    <li>Almeno una lettera maiuscola</li>
                    <li>Almeno un carattere speciale</li>
                    <li>Almeno un numero</li>
                    <li>Non può essere uguale a quella precedente</li>
                </ul>
            </div>
        </div>
        <!-- Fine di password -->

        <div class="alert alert-success" role="alert" id="passwordChanged">
            Password modificata con successo!
        </div>

        <!-- Bottoni -->
        <div class="row mt-2">
            <!-- Bottone cambia password-->
            <div class="d-flex justify-content-end py-3 col-12">
                <button type="submit" class="edit-button btn btn-primary" name="changePassword">Cambia</button>
            </div>
            <!-- Fine bottone cambia password-->
        </div>
        <!-- Fine di bottoni-->
    </form>
</div>

