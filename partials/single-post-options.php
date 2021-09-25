<?php if( $args['can_delete'] == true ){ ?>
    <?php $dropdown_css_id = generateRandomString(5); ?>
    <div class="d-flex justify-content-end single-post-options">
        <div class="dropdown">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton-<?php echo $dropdown_css_id; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Opzioni post
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-<?php echo $dropdown_css_id; ?>">
                <button data-action="delete-post" class="dropdown-item" type="button">Elimina</button>
            </div>
        </div>
    </div>
<?php } ?>