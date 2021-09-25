
<!-- form modifica blog-->
<div class="container p-5">
    <h2 class="mb-5">Modifica blog</h2>

    <form method="POST" action="includes/ajax/ajax-blog-creation.php" enctype="multipart/form-data">

        <!-- Dettagli blog-->   
        <p class="fs-3 mb-3">Dettagli blog<p> 

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="editBlogTitle" placeholder="Titolo blog" name="blogTitle">
                    <label for="editBlogTitle">Titolo</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <textarea class="form-control height-small" placeholder="Scrivi un commento qui" id="editBlogTextArea" name="blogBio"></textarea>
                    <label for="editBlogTextArea">Descrizione</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <select class="form-select" id="editBlogTemeSelect" aria-label="Seleziona argomento" name="blogTheme">
                        <option selected value="0" disabled name="blogTheme">Seleziona argomento</option>
                        <option value="1" name="blogTheme">Argomento 1</option>
                        <option value="2" name="blogTheme">Argomento 2</option>
                        <option value="3" name="blogTheme">Altro</option>
                    </select>

                    <label for="editBlogTemeSelect">Argomento</label>
                </div>
            </div>
        </div>

        <p class="mb-3">Seleziona i sottotemi</p>

        <div class="row mb-3">

            <div class="col-6">

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="sottoTema1" name="blogSubTheme">
                    <label class="form-check-label" for="sottoTema1">
                        Sottotema 1
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="sottoTema2" name="blogSubTheme">
                    <label class="form-check-label" for="sottoTema2">
                        Sottotema 2
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="sottoTema3" name="blogSubTheme">
                    <label class="form-check-label" for="sottoTema3">
                        Sottotema 3
                    </label>
                </div>
            </div>

            <div class="col-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="sottoTema4" name="blogSubTheme">
                        <label class="form-check-label" for="sottoTema4">
                            Sottotema 4
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="sottoTema5" name="blogSubTheme">
                        <label class="form-check-label" for="sottoTema5">
                            Sottotema 5
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="sottoTema6" name="blogSubTheme">
                        <label class="form-check-label" for="sottotema6">
                            Sottotema 6
                        </label>
                    </div>
                </div>
        </div>

        <!-- Fine informazioni blog-->


        <!-- Immagini blog-->
        <p class="fs-3 mb-3">Immagini<p> 

        <div class="row">
            <div class="col">
                <label for="editBlogFormFile1" class="form-label">Immagine del profilo</label>
                <input name="blogProfileImg" class="form-control mb-3" type="file" id="editBlogFormFile1">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="editBlogFormFile2" class="form-label">Immagine di copertina</label>
                <input name="blogCoverImg" class="form-control mb-3" type="file" id="editBlogFormFile2">
            </div>
        </div>

        <!--fine immagini blog-->


        <!-- Tema blog-->
        <p class="fs-3 mb-3">Grafica<p> 

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <select class="form-select" id="editBlogGraphicSelect" aria-label="Seleziona design" name="blogStyle">
                        <option selected value="0" disabled>Seleziona design</option>
                        <option value="1" name="blogStyle">Light</option>
                        <option value="2" name="blogStyle">Dark</option>
                        <option value="3" name="blogStyle">Altro</option>
                    </select>

                    <label for="editBlogGraphicSelect">Design</label>
                </div>
            </div>
        </div>
        <!-- Fine tema blog-->

        <div class="row">
            <!-- Bottone salva modifiche blog-->
            <div class="d-flex justify-content-end py-3 col-6">
                <button type="submit" class="edit-button btn btn-primary" name="blogSave">Crea blog</button>
            </div>
            <!-- Fine bottone salva modifiche blog-->    
        </div>
    </form>
    <!-- Fine form modifica blog-->

</div>
