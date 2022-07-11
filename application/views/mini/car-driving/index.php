<h1 class="d-none"><?php echo $onePage->meta_title; ?></h1>
<?php if (!empty($one_item)) : ?>
    <?php echo returnLink('', getUrlContent($one_item->slug), $one_item->title); ?>
    <section style="background: url(<?php echo $one_item->img; ?>) repeat top center fixed;background-repeat: round;">
        <div class="container">
            <div class="col grid12 textcenter">
                <h2 style="margin:1em;"><span class="highlight"><?php echo $one_item->title; ?></span></h2>
            </div>
        </div>
    </section>
    </a>
<?php endif; ?>