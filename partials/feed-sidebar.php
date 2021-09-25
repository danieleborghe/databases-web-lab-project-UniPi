<div class="feed-sidebar d-flex flex-column flex-shrink-0 p-5 text-white bg-dark sticky-top">
    <a href="/progetto-sito/profile.php?userCode=<?php echo $args['user']['codiceUtente']; ?>" class="d-flex align-items-center text-white text-decoration-none" id="currentUser" aria-expanded="false">
        <?php if( !empty( $args['current_user']['posizioneImgProfilo'] ) ){ ?>
            <img src="<?php echo "/progetto-sito/" . $args['current_user']['posizioneImgProfilo'] ?>" alt="<?php echo $args['username']; ?>" width="32" height="32" class="rounded-circle me-2">
        <?php }else{ ?>
            <img src="/progetto-sito/assets/img/default.jpg" alt="<?php echo $args['username']; ?>" width="32" height="32" class="rounded-circle me-2">
        <?php } ?>
        <strong><?php echo $args['username']; ?></strong>
    </a>
    <hr>
    <h5 class="pb-3">I blog che seguo</h5>
    <ul class="nav nav-pills flex-column mb-auto ">
        <?php if( !empty( $args['blog_seguiti'] ) ){ ?>
            <?php foreach( $args['blog_seguiti'] as $blog ){ ?>
                <li class="py-2">
                    <a href="<?php echo "/progetto-sito/blog.php?blogCode=" . $blog['codiceBlog']; ?>" class="d-flex align-items-center text-white text-decoration-none" aria-expanded="false">
                        <img src="<?php echo "/progetto-sito/" . $blog['posizioneImgProfilo'] ?>" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong><?php echo $blog['nomeBlog']; ?></strong>
                    </a>
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
    <hr>
</div>