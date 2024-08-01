<?php require('views/partials/head.php') ?>
<?php require('views/partials/nav.php') ?>
<main>
    <div class="container">
        <?php if (empty($posts)): ?>
            <div class="content blog-post-preview">
                <p>Sorry. No posts found.</p>
            </div>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <div class="content blog-post-preview">
                    <h2>
                        <a href="/posts/<?= urlencode($post['url_slug']) ?>"><?= $post['title'] ?></a>
                        <div class="meta">
                            <p><?= date('M d, Y, h:i A', strtotime($post['created_at'])) ?></p>
                        </div>
                    </h2>
                    <div>
                        <?= substr($post['body'], 0, 500) ?>
                        <?php if (strlen($post['body']) > 500): ?>...
                            <div class="blog-post-continue">
                                <a href="/posts/<?= urlencode($post['url_slug']) ?>">Continue Reading...</a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <hr>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>
<?php require('views/partials/footer.php') ?>