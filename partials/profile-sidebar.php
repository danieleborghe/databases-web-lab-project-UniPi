<?php
if (isset($_SESSION["userCode"])){
    $userCode = $_SESSION["userCode"];
    $userName = $_SESSION["userID"];
}
?>

<div class="d-flex flex-column flex-shrink-0 p-5 text-white bg-dark sticky-top profile-sidebar profile-sidebar-container">
    <?php
    if (isset($_SESSION["userCode"])){ ?>
        <a href="/progetto-sito/profile.php?userCode=<?php echo $userCode; ?>" class="d-flex align-items-center text-white text-decoration-none" id="dropdownUser1" aria-expanded="false">
            <?php if( !empty( $args['user']['posizioneImgProfilo'] ) ){ ?>
                <img id="myImg" src="/progetto-sito/<?php echo $args['user']['posizioneImgProfilo']; ?>" alt="<?php echo $userName; ?>" width="32" height="32" class="avatar-img rounded-circle me-2">
            <?php }else{ ?>
                <img id="myImg" src="/progetto-sito/assets/img/default.jpg" alt="<?php echo $userName; ?>" width="32" height="32" class="avatar-img rounded-circle me-2">
            <?php } ?>
            <strong id="myUsername"><?php echo $userName; ?></strong>
        </a>
        <hr>
        <h5 class="pb-3">I miei blog</h5>
        <ul class="nav nav-pills flex-column mb-auto" id="myBlogs">
           <li class="py-2">
                <a href="/progetto-sito/create-blog.php" class="d-flex align-items-center text-white text-decoration-none" aria-expanded="false">
                   <img src="/progetto-sito/assets/img/addBlog.svg" alt="" width="32" height="32" class="rounded-circle me-2">
                   <strong>Crea un blog</strong>
                </a>
           </li>
        </ul>

        <hr>

       <h5 class="pb-3">I blog con cui collaboro</h5>

        <ul class="nav nav-pills flex-column mb-auto" id="myCollabs">
        </ul>

        <hr>
    <?php } else { ?>
        <p>Per visualizzare la tua sidebar personale devi prima eseguire l'accesso!</p>
    <?php } ?>
</div>