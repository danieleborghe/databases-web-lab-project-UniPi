$(document).ready(function() {

    $(".js-create-post").each(function() {

        var curElement = $(this);
        //Immagazzino in createPostForm il form di creazione del post
        var createPostForm = curElement.find(".create-post-form");
        //Immagazzino in postTypeSelector la select che contiene le scelte della tipologia di post
        var postTypeSelector = curElement.find(".post-type-selector");
        //Immagazzino in postTypeSpecifics gli elementi di form appartenenti alle varie 
        //tipologie di post (es post video avrà il campo di caricamento file video ecc..)
        var postTypeSpecifics = curElement.find(".post-type-specifics");

        //Sto in ascolto sull'evento "change" che viene scatenato quando l'utente seleziona un opzione dal menù a tendina
        postTypeSelector.on("change", function() {
            //Memorizzo in type l'opzione scelta, ovvero la tipologia di post scelta
            var type = $(this).children("option:selected").attr("data-type");
            //Rimuovo la classe active dagli elementi di input che può essere rimasta da una precedente selezione
            postTypeSpecifics.find("[data-type]").removeClass("active");
            //Disabilito tutti gli elementi di input relativi ai tipi di post
            postTypeSpecifics.find(".form-control").attr("disabled", "true");

            //Una volta che li ho disabilitati tutti vado ad attivare soltanto quello selezionato
            //Nella riga sotto nello specifico controllo se l'elemento esiste e se sì eseguo la logica dell'if
            if (postTypeSpecifics.find("[data-type=" + type + "]").length > 0) {
                //Aggiungo al data-type (input relativo al tipo di post scelto) selezionato la classe active
                postTypeSpecifics.find("[data-type=" + type + "]").addClass("active");
                //Rimuovo dal data-type (input relativo al tipo di post scelto) selezionato l'attributo disabled
                postTypeSpecifics.find("[data-type=" + type + "]").find(".form-control").removeAttr("disabled");
            }
        });

        createPostForm.validate({
            submitHandler: function(form) {
                form.submit();
            }
        });

    });

});