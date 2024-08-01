<?php require('views/partials/head.php') ?>
<?php require('views/partials/nav.php') ?>
<main>
    <div class="container">
        <div class="content blog-post-preview">
            <h2>
                <?= $post['title'] ?>
                <div class="meta">
                    <p><?= date('M d, Y, h:i A', strtotime($post['created_at'])) ?></p>
                </div>
            </h2>
            <div><?= nl2br($post['body']) ?></div>
        </div>
    </div>
</main>
<?php require('views/partials/footer.php') ?>