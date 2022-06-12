<ul class="listCategory list-group rounded">
    <?php if (!empty($listCategory)) foreach ($listCategory as $key => $value) : ?>
        <li class="list-group-item d-flex justify-content-between align-items-center order-<?php echo ($oneCategory->id == $value->id) ? 'first' : ($key + 6); ?> <?php echo ($oneCategory->id == $value->id) ? 'active' : ''; ?>">
            <?php echo returnLink('', getCatUrl($value->slug), $value->title); ?>
            <h2><?php echo $value->title; ?></h2>
            </a>
            <span class="badge bg-primary rounded-pill"><?php echo $value->recipes; ?></span>
            <?php if ($oneCategory->id == $value->id) : ?>
                <script type="application/ld+json">
                    {
                        "@context": "https://schema.org/",
                        "@type": "CategoryCodeSet",
                        "@id": "<?php echo $value->id; ?>",
                        "name": "<?php echo $value->title; ?>",
                        "hasCategoryCode": {
                            "@type": "CategoryCode",
                            "name": "<?php echo $value->title; ?>",
                            "description": "<?php echo $value->content; ?>",
                            "inCodeSet": "<?php echo $value->id; ?>"
                        }
                    }
                </script>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            <?php if (!empty($listCategory)) foreach ($listCategory as $key => $value) : ?> {
                    "@type": "ListItem",
                    "position": <?php echo $key + 1; ?>,
                    "name": "<?php echo $value->title; ?>",
                    "item": "<?php echo getCatUrl($value->slug); ?>"
                },
            <?php endforeach; ?>
            {
                "@type": "ListItem",
                "position": 26,
                "name": "Category",
                "item": "<?php echo base_url(); ?>"
            }
        ]
    }
</script>