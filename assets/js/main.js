$(document).ready(function() {

    //Inizializzo tooltip bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    //Fix ancore con tooltip per evitare comportamento di default che ritorna a inizio pagina
    $("[data-bs-toggle=tooltip]").on("click", function(e) {
        e.preventDefault();
    });

    //Inizializzo i dropdown di bootstrap
    $('.dropdown-toggle').dropdown();

    //Per ogni elemento con classe ".js-comments-editor" inizializzo l'editor wysiwig
    $(".js-custom-editor").each(function() {
        $(this).summernote({
            toolbar: [
                ['style', ['style', 'code', 'bold', 'italic', 'underline', 'link']],
                ['font', ['strikethrough']],
                ['para', ['ul', 'ol']],
            ],
            styleTags: ['p', 'h2', 'h3', 'h4', 'h5'],
            height: 300
        });
    });

    //Per la sezione tag, inizializzo tutti gli input di tipo tag
    var input = document.querySelector('input.tag-selector');

    //Controllo che l'oggetto Tagify sia definito se sì inizializzo i campi dei tag ".tag-selector"
    if (typeof Tagify !== "undefined") {
        new Tagify(input, {
            maxTags: 6
        });
    }

});