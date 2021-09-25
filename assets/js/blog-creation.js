//AVVIO DEL DOCUMENTO
$(document).ready(function() {
    //OPERAZIONI PRELIMINARI

    //nascondo i sottotemi
    $(".sottotema").hide();

    //nascondo tutti gli alerts
    $("#blogEdited").hide();
    $("#alreadyCollab").hide();
    $("#userNotFound").hide();
    $("#successCollab").hide();
    $("#collabError").hide();
    $("#collabDeleted").hide();

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

    //CREAZIONE DEL BLOG

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
                url: 'includes/ajax/ajax-blog-creation.php',
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
                        window.location.replace("http://localhost/progetto-sito/profile.php");
                    }
                }
            });
        }
    });
});