<header>
    <div class="container">
        <div class="row bg-dark m-0">
            <div class="col-8">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <?php echo returnLink('navbar-brand', base_url(), ''); ?>ACMATVIRUS</a>
                    <div class="collapse navbar-collapse" id="navbarColor01">
                        <ul class="navbar-nav mr-auto">
                            <?php echo main_menu(); ?>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-4">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="collapse navbar-collapse" id="navbarColor01">
                        <form class="form-inline d-flex flex-nowrap">
                            <input class="form-control mr-sm-2 me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>