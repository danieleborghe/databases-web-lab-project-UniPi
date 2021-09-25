<?php
    require "includes/db-connection.php";
    if (isset($_SESSION["userCode"])){
        $userCode = $_SESSION["userCode"];
    }

    $blogCode = $_COOKIE["blogCode"];
?>

<div class="container-fluid p-0" id="blogSection">

    <div class="blog-section ">

        <div class="blog-section-head">

            <div class="blog-section-cover">
                <div class="blog-section-cover-img bgColorBlack rounded-top">
                    <img class="h-100 w-100 cover-img" src="/progetto-sito/assets/img/default_wide.jpg" id="blogCoverImg" >
                </div>
                <div class="blog-section-cover-info text-center rounded-bottom">
                    <div class="blog-section-cover-avatar avatar-xl mb-3">
                        <img class="rounded-circle cover-img" src="" alt="Immagine profilo" id="blogProfileImg"/>
                    </div>

                    <div>
                        <a href="#" title="Blog Owner" id="blogOwner"></a>
                    </div>
                    <div class="row justify-content-end">
                        <div class="d-flex col-6 justify-content-center">
                            <h1 class="h3 d-inline-block mx-auto mb-3" id="blogName"></h1>
                        </div>

                        <div class="d-flex col-3 justify-content-center">
                        <?php
                        if (isset($_SESSION["userCode"]) && checkBlogOwner($conn, $userCode, $blogCode)){
                            echo '<button type="button" class="btn btn-primary" id="editBlogBtn">Modifica blog</a>';
                        }
                        ?>
                        </div>
                    </div>
                                      
                    <p id="blogDescription" class="mb-3 px-5"></p>
                    
                    <div class="row justify-content-center">
                        <div class="d-flex col justify-content-center">
                            <p class="mx-2" id="blogFollowers">55 follower</p>
                            
                            <?php
                            if (isset($_SESSION["userCode"]) && !checkBlogOwner($conn, $userCode, $blogCode)){
                                if (checkFollow($conn, $userCode, $blogCode) !== false){
                                    echo '<button type="button" class="btn btn-primary btn-sm mx-2 display-none" id="followBlog">Segui</a>';
                                    echo '<button type="button" class="btn btn-primary btn-sm mx-2" id="unfollowBlog">Non seguire</a>';
                                } else {
                                    echo '<button type="button" class="btn btn-primary btn-sm mx-2" id="followBlog">Segui</a>';
                                    echo '<button type="button" class="btn btn-primary btn-sm mx-2 display-none" id="unfollowBlog">Non seguire</a>';
                                }
                            }
                            ?>
                        </div>
                    </div>   
                </div>
            </div>

            <ul class="nav nav-tabs justify-content-center nav-fill">
                <li class="nav-item ">
                    <a class="nav-link active" id="blogPostsBtn">Post<span class="badge bg-secondary ms-2" id="nPosts">0</span></a>

                </li>

                <li class="nav-item">
                    <a class="nav-link" id="blogArticlesBtn">Articoli<span class="badge bg-secondary ms-2" id="nArticles">0</span></a>
                </li>
            </ul>

        </div>


        <div class="blog-section-content container-fluid p-4" id="blogFeedSection">
            <?php 
                //Includo il partial feed container e gli passo tutti i dati estratti riguardo a post del feed, utente corrente ecc..
                includiComponente("feed-container", $args['posts_settings'] );
            ?>
        </div>


        <div class="blog-section-content container-fluid p-4 display-none" id="blogArticlesList">
            
        <?php 
        if (isset($userCode) && (checkBlogOwner($conn, $userCode, $blogCode) || checkCollaboration($conn, $blogCode, $_SESSION["userID"]))){?>
            <div class="row px-5 pt-3 justify-content-center">
                <h3 class="col-5">Ti senti ispirato?</h3>
                <a href="/progetto-sito/create-article.php" class="col-3">
                    <button type="button" class="btn btn-primary">Crea un nuovo articolo!</button>
                </a>
            </div>
        <?php 
        } 
        ?>

            <?php
            $articles = getBlogArticles($conn, $blogCode);

            includiComponente("article-home-section", array(
                "titolo" => "",
                "articoli" => $articles,
                "tema" => "bgColorWhite",
                "textColor" => "text-black") 
                );
            ?>
        </div>


    </div>

</div>