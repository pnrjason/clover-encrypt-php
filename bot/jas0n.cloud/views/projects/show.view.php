<?php require('views/partials/head.php') ?>
<?php require('views/partials/nav.php') ?>
<main>
    <div class="container">
        <div class="content blog-post-preview">
            <h2>
                <?= $project['name'] ?>
            </h2>
            <div><?= $project['description'] ?></div>
        </div>
    </div>
</main>
<?php require('views/partials/footer.php') ?>