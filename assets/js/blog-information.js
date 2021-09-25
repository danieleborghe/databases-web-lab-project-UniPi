//AVVIO DEL DOCUMENTO
$(document).ready(function() {
    //OPERAZIONI PRELIMINARI

    //nascondo la sezione di modifica del blog
    $("#editBlogSection").hide();

    //nascondo i sottotemi
    $(".sottotema").hide();

    //nascondo tutti gli alerts
    $("#blogEdited").hide();
    $("#alreadyCollab").hide();
    $("#userNotFound").hide();
    $("#tooManyUserCollabs").hide();
    $("#successCollab").hide();
    $("#collabError").hide();
    $("#collabDeleted").hide();

    //NAVIGAZIONE NELLA SEZIONE DI MODIFICA DEL BLOG

    //definisco un evento per mostrare la sezione di modifica del blog
    $("#editBlogBtn").click(function() {
        $("#blogSection").hide();
        $("#editBlogSection").show();
    });

    //NAVIGAZIONE FEED-ARTICOLI DEL BLOG

    //definisco un evento di navigazione per gli articoli
    $("#blogPostsBtn").click(function() {
        $("#blogArticlesBtn").removeClass("active");
        $("#blogPostsBtn").addClass("active");
        $("#blogArticlesList").hide();
        $("#blogFeedSection").show();
    });

    //definisco un evento di navigazione per gli articoli
    $("#blogArticlesBtn").click(function() {
        $("#blogPostsBtn").removeClass("active");
        $("#blogArticlesBtn").addClass("active");
        $("#blogFeedSection").hide();
        $("#blogArticlesList").show();
    });

    //ELIMINAZIONE DEL BLOG

    //definisco un evento per mostrare il modal di conferma per l'eliminazione del blog
    $("#deleteBlog").click(function() {
        $("#exampleModal").modal("toggle");
    });

    //definisco un evento per chiudere il modal
    $("#closeModal").click(function() {
        $("#exampleModal").modal("hide");
    });

    //definisco l'evento di cancellazione del blog
    $("#deleteBlog2").click(function() {
        $.ajax({
            url: 'includes/ajax/ajax-delete-blog.php',
            error: function(e) {
                console.log(e.message);
            },
            success: function(response) {
                $(window.location).attr('href', 'http://localhost/progetto-sito/profile.php');
            }
        });
    });

    //SOTTOTEMI PREDEFINITI

    //mostro i sottotemi sulla base del tema selezionato
    var tema = $("#editBlogTemeSelect").val();
    $("." + tema).show();

    $("#editBlogTemeSelect").change(function() {
        $(".sottotema").hide();
        $(".sottotemaCheck").prop("checked", false);
        var tema = $("#editBlogTemeSelect").val();
        $("." + tema).show();
    });

    //FOLLOW DI UN BLOG

    //definisco l'evento di follow del blog
    $("#followBlog").click(function() {
        $.ajax({
            url: 'includes/ajax/ajax-follow-blog.php',
            error: function(e) {
                console.log(e.message);
            },
            success: function(response) {
                $("#followBlog").hide();
                $("#unfollowBlog").show();
            }
        });
    });

    //definisco l'evento di unfollow del blog
    $("#unfollowBlog").click(function() {
        $.ajax({
            url: 'includes/ajax/ajax-follow-blog.php',
            error: function(e) {
                console.log(e.message);
            },
            success: function(response) {
                $("#unfollowBlog").hide();
                $("#followBlog").show();
            }
        });
    });

    //VISUALIZZAZIONE DI UN BLOG

    //chiamata Ajax per la visualizzazione del blog
    $.ajax({
        url: 'includes/ajax/ajax-blog-information.php',
        error: function(e) {
            console.log(e.message);
        },
        success: function(response) {

            //formatto la response di tipo Json
            var psdResponse = JSON.parse(response);

            //visualizzo le informazioni del blog
            $("#blogOwner").text("@" + psdResponse.nomeAutore);
            $("#blogOwner").attr("href", "profile.php?userCode=" + psdResponse.autore);
            $("#blogCoverImg").attr("src", psdResponse.posizioneImgCopertina);
            $("#blogProfileImg").attr("src", psdResponse.posizioneImgProfilo);
            $("#blogName").text(psdResponse.nomeBlog);
            $("#blogDescription").text(psdResponse.descrizione);
            $("#blogFollowers").text(psdResponse.numeroSeguaci + " seguaci");
            $("#nPosts").text(psdResponse.numeroPost);
            $("#nArticles").text(psdResponse.numeroArticoli);

            //imposto lo stile grafico del blog
            $(".blog-section-head").css("background-color", "#" + psdResponse.graficaBlog["coloreSfondo"]);
            $(".blog-section-head").css("color", "#" + psdResponse.graficaBlog["coloreTesto"]);

            if (psdResponse.follow == false) {
                $("#unfollowBlog").hide();
                $("#followBlog").show();
            } else {
                $("#followBlog").hide();
                $("#unfollowBlog").show();
            }
        }
    });

    //SIDEBAR PERSONALE

    //avvio una chiamata ajax
    $.ajax({
        url: 'includes/ajax/ajax-personal-sidebar.php',
        error: function(e) {
            console.log(e.message);
        },
        success: function(response) {

            //formatto la response di tipo JSON
            const psdResponse = JSON.parse(response);

            //inserisco l'immagine profilo e il mio nome utente nella sidebar
            //$("#myImg").attr("src", psdResponse.posizioneImgProfilo)
            //$("#myUsername").text("@" + psdResponse.nomeUtente);

            //inserisco i link ai miei blog nella sidebar
            for (nBlog in psdResponse.blog) {
                var sidebarBlogElem = '<li class="py-2"><a href="blog.php?blogCode=' + psdResponse.blog[nBlog][2] + '" class="d-flex align-items-center text-white text-decoration-none" aria-expanded="false"><img src="' + psdResponse.blog[nBlog][1] + '" alt="" width="32" height="32" class="rounded-circle me-2"><strong>' + psdResponse.blog[nBlog][0] + '</strong></a></li>';
                $("#myBlogs").append(sidebarBlogElem);
            };

            //inserisco i link ai blog con cui collaboro nella sidebar
            for (nCollab in psdResponse.collabs) {
                var sidebarCollabElem = '<li class="py-2"><a href="blog.php?blogCode=' + psdResponse.collabs[nCollab][2] + '" class="d-flex align-items-center text-white text-decoration-none" aria-expanded="false"><img src="' + psdResponse.collabs[nCollab][1] + '" alt="" width="32" height="32" class="rounded-circle me-2"><strong>' + psdResponse.collabs[nCollab][0] + '</strong></a></li>';
                $("#myCollabs").append(sidebarCollabElem);
            };
        }
    });

    //MODIFICA DEL BLOG

    //adefinisco la validazione del form di modifica del blog
    $("#blogEditingForm").validate({
        errorPlacement: function(error, element) {
            (element.parent()).after(error);
        },

        //scrittura delle regole del form
        rules: {
            blogTitle: {
                required: true,
                minlength: 3,
                maxlength: 50
            },

            blogBio: {
                maxlength: 1500
            },

            blogTheme: {
                required: true,
            },

            blogStyle: {
                required: true,
            }
        },

        //definizione dei messaggi di errore per ogni regola
        messages: {
            blogTitle: {
                required: "Inserisci un titolo per il tuo blog",
                minlength: "il titolo è troppo breve (minimo 3 caratteri)",
                maxlength: "Il titolo è troppo lungo (massimo 50 caratteri)"
            },

            blogBio: {
                maxlength: "La descrizione è troppo lunga (massimo 1500 caratteri)"
            },

            blogTheme: {
                required: "Scegli un tema per il tuo blog prima di proseguire"
            },

            blogStyle: {
                required: "Scegli uno stile grafico per il tuo blog prima di proseguire"
            }
        },

        //definizione dell'invio del form e delle regole
        submitHandler: function(form) {
            //formatto i dati con FormData e non Serialize per la presenza di input type="file"
            var formData = new FormData(form);

            //avvio della chiamata ajax
            $.ajax({
                type: "POST",
                //comunico di non voler processare i dati in stringa
                processData: false,
                //annullo la codifica dei dati con contentType false
                contentType: false,
                //associo data con formData
                data: formData,
                url: 'includes/ajax/ajax-blog-editing.php',
                success: function(response) {
                    //nascondo l'alert
                    $("#blogEdited").hide();

                    //ALERT DEFINITI IN ajax-blog-editing.php

                    //codice di errore 0
                    if (response.includes("0")) {
                        $("#editBlogTitle").addClass("is-invalid");
                    } else {
                        $("#editBlogTitle").removeClass("is-invalid");
                        $("#editBlogTitle").addClass("is-valid");
                    }

                    //codice di errore 1
                    if (response.includes("1")) {
                        $("#editBlogProfileImg").addClass("is-invalid");
                    } else {
                        $("#editBlogProfileImg").removeClass("is-invalid");
                        $("#editBlogProfileImg").addClass("is-valid");
                    }

                    //codice di errore 2
                    if (response.includes("2")) {
                        $("#editBlogProfileImg").addClass("is-invalid");
                    } else {
                        $("#editBlogProfileImg").removeClass("is-invalid");
                        $("#editBlogProfileImg").addClass("is-valid");
                    }

                    //codice di errore 3
                    if (response.includes("3")) {
                        $("#editBlogCoverImg").addClass("is-invalid");
                    } else {
                        $("#editBlogCoverImg").removeClass("is-invalid");
                        $("#editBlogCoverImg").addClass("is-valid");
                    }

                    //codice di errore 4
                    if (response.includes("4")) {
                        $("#editBlogCoverImg").addClass("is-invalid");
                    } else {
                        $("#editBlogCoverImg").removeClass("is-invalid");
                        $("#editBlogCoverImg").addClass("is-valid");
                    }

                    //modifica avvenuta con successo
                    if (response == "") {
                        //mostro l'alert di modifica avvenuta
                        $("#blogEdited").show();
                    }
                }
            });
        }
    });

    //AGGIUNTA DI UN COLLABORATORE AL BLOG

    //definisco l'evento di aggiunta di una collaborazione
    $("#addCollab").click(function(form) {
        //avvio la validazione del form di collaborazione
        $("#addCollabsForm").validate({
            errorPlacement: function(error, element) {
                (element.parent()).after(error);
            },

            //scrittura delle regole del form
            rules: {
                addCollabForm: {
                    required: true
                }
            },

            //definizione dei messaggi di errore per ogni regola
            messages: {
                addCollabForm: {
                    required: "inserisci un nome utente valido"
                }
            },

            //definizione dell'invio del form e delle regole
            submitHandler: function(form) {
                //formatto i dati del form con FormData
                var formData = new FormData(form);

                //avvio la chiamata ajax
                $.ajax({
                    type: "POST",
                    //comunico di non voler processare i dati in stringa
                    processData: false,
                    //annullo la codifica dei dati con contentType false
                    contentType: false,
                    //associo data con formData
                    data: formData,
                    url: 'includes/ajax/ajax-collabs-editing.php',
                    success: function(response) {

                        //nascondo gli alerts prima di ogni evento click
                        $("#alreadyCollab").hide();
                        $("#userNotFound").hide();
                        $("#tooManyUserCollabs").hide();
                        $("#successCollab").hide();
                        $("#collabError").hide();
                        $("#collabDeleted").hide();

                        //controllo la risposta del file PHP
                        if (response.includes("0")) {
                            //se l'utente è già collaboratore visualizzo l'alert
                            $("#alreadyCollab").show();
                        } else if (response.includes("1")) {
                            //se l'utente non esiste visualizzo l'alert
                            $("#userNotFound").show();
                        } else if (response.includes("2")) {
                            //se l'utente ha troppe collaborazioni visualizzo l'alert
                            $("#tooManyUserCollabs").show();
                        } else if (response.includes("3")) {
                            //se l'utente è corretto visualizzo il messaggio di successo
                            $("#successCollab").show();
                        } else {
                            //se la response non è corretta visualizzo l'alert
                            $("#collabError").show();
                        }
                    }
                });
            }
        });
    });

    //ELIMINAZIONE DI UN COLLABORATORE DAL BLOG

    //definisco l'evento di eliminazione di un collaboratore
    $("#deleteCollab").click(function(form) {
        //avvio la validazione del form
        $("#deleteCollabsForm").validate({
            errorPlacement: function(error, element) {
                (element.parent()).after(error);
            },

            //scrittura delle regole del form
            rules: {
                deleteCollabForm: {
                    required: true
                }
            },

            //definizione dei messaggi di errore per ogni regola
            messages: {
                deleteCollabForm: {
                    required: "seleziona uno dei collaboratori"
                }
            },

            //definizione dell'invio del form e delle regole
            submitHandler: function(form) {
                //formatto i dati del form
                var formData = new FormData(form);

                //avvio la chiamata ajax
                $.ajax({
                    type: "POST",
                    //comunico di non voler processare i dati in stringa
                    processData: false,
                    //annullo la codifica dei dati con contentType false
                    contentType: false,
                    //associo data con formData
                    data: formData,
                    url: 'includes/ajax/ajax-collabs-editing.php',
                    success: function(response) {

                        //nascondo gli alerts prima di ogni evento click
                        $("#alreadyCollab").hide();
                        $("#userNotFound").hide();
                        $("#successCollab").hide();
                        $("#collabError").hide();
                        $("#collabDeleted").hide();

                        //controllo la risposta del file PHP
                        if (response.includes("0")) {
                            //se l'utente è stato cancellato visualizzo l'alert
                            $("#collabDeleted").show();
                        } else {
                            //se la response non è corretta visualizzo l'alert
                            $("#collabError").show();
                        }
                    }
                });
            }
        });
    });
});