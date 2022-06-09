<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark pl-4">
            <button class="navbar-toggler" style="margin-left: 10px;" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php echo returnLink('navbar-brand d-block d-md-none', base_url(), ''); ?>ACMATVIRUS</a>
            
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <div class="container p-0">
                    <div class="row bg-dark m-0">
                        <div class="col-12 col-md-8">
                            <nav class="navbar navbar-expand-lg navbar-dark">
                                <?php echo returnLink('navbar-brand d-none d-md-block', base_url(), ''); ?>ACMATVIRUS</a>
                                <div class="navbar-collapse" id="navbarColor01">
                                    <ul class="navbar-nav mr-auto">
                                        <?php echo main_menu(); ?>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="col-12 col-md-4">
                            <nav class="navbar navbar-expand-lg navbar-dark">
                                <div class="navbar-collapse" id="navbarColor01">
                                    <form class="form-inline d-flex flex-nowrap">
                                        <input class="form-control mr-sm-2 me-2" type="search" placeholder="Search" aria-label="Search">
                                        <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
                                    </form>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>