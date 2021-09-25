<div class="container d-flex justify-content-center align-items-center flex-column search-section-container">
    <h1 class="p-2"><?php echo $args["h1"];?></h1>

    <h2 class="p-4 pb-5"><?php echo $args["h2"];?></h2>

    <form class="d-flex search-section-form" method="POST" id="mainSearchForm" name="mainSearchForm" action="search-results.php">
        <input class="form-control me-2 fs-4" type="search" placeholder="Cerca..." aria-label="Search" id="mainSearchInput" name="mainSearchInput">
        <button class="btn bgColorRed fs-4 px-4 button-max-content" type="submit" id="mainSearchBtn" name="mainSearchBtn">Cerca</button>
    </form>
</div>