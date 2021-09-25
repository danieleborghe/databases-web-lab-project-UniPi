<?php $carousel_css_id = generateRandomString(10); ?>

<div id="carousel-<?php echo $carousel_css_id; ?>" class="carousel slide" data-bs-ride="carousel">
    <?php if( count( $args['imgs'] ) > 1 ){ ?>
        <div class="carousel-indicators">
            <?php $i=0; foreach( $args['imgs'] as $img ){ ?>
                <button type="button" data-bs-target="#carousel-<?php echo $carousel_css_id; ?>" data-bs-slide-to="<?php echo $i; ?>" 
                    <?php if( $i==0 ){ ?> class="active" <?php } ?> aria-current="true" aria-label="Slide <?php echo $i; ?>"></button>
            <?php $i++; } ?>
        </div>
    <?php } ?>

    <div class="carousel-inner">
        <?php $i=0; foreach( $args['imgs'] as $img ){ ?>
            <div class="carousel-item <?php if( $i==0){ echo "active"; } ?>">
                <img src="<?php echo $img; ?>" class="d-block w-100" alt="<?php echo $args['post']['codicePost'] . " " . $i; ?>">
            </div>
        <?php $i++; } ?>
    </div>

    <?php if( count( $args['imgs'] ) > 1 ){ ?>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?php echo $carousel_css_id; ?>"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?php echo $carousel_css_id; ?>"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    <?php } ?>
</div>