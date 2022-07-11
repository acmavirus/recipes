<h1 class="d-none"><?php echo $onePage->meta_title; ?></h1>
<?php if (!empty($oneSkill)) : ?>
    <section style="background: url(<?php echo $oneSkill->thumbnail; ?>) repeat top center fixed;background-size: cover;">
        <div class="container">
            <div class="col grid12 textcenter">
                <h1 style="margin:1em;font-size: 22px;"><?php echo $oneSkill->content; ?></h1>
            </div>
        </div>
    </section>
<?php endif; ?>