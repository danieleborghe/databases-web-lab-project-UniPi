<div class="col-lg-3 col-md-6">
    <div class="article-card card h-100 mh-100 ombra">
        <div class="article-image bg-image hover-overlay">
            <a href="<?php echo $args['url']; ?>" title="<?php echo $args['title']; ?>">
                <img src="<?php echo $args['image']; ?>" alt="<?php echo $args['title']; ?>" class="img-fluid"/>
            </a>
        </div>
        
        <div class="card-body">
            <h5 class="card-title"><?php echo $args['title']; ?></h5>
            <a href="<?php echo $args['url']; ?>" class="btn btn-primary">Leggi l'articolo</a>
        </div>
    </div>
</div>