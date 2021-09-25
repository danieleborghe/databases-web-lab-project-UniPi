//AVVIO DEL DOCUMENTO
$(document).ready(function(){
    //FASE DI RICERCA

    //avvio della chiamata Ajax
    $("#headerSearchForm").validate({
        //definizione del posizionamento dei messaggi di errore
        errorPlacement: function (error, element) {
            (element.parent()).after(error);
        },

        //definizione delle regole del form
        rules: {
            headerSearchInput: {
                required: true
            }
        },

        //definizione dei messaggi di errore per ogni regola
        messages: {
            headerSearchInput: {
                required: "Inserisci un ID valido per accedere"
            }
        },

        //definizione dell'invio del form
        submitHandler: function (form) {
            //formattazione dei dati di accesso
            var data = $("headerSearchForm").serialize();

            //avvio della chiamata Ajax
            $.ajax({
                type: "POST",
                url: 'includes/contents-research.php',
                data: data,
                success: function (response) {
                    console.log(response);
                }
            });
        }
    });
});