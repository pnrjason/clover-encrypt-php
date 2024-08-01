<?php require('views/admin-panel/partials/head.php') ?>
<?php require('views/admin-panel/partials/nav.php') ?>
<?php require('views/admin-panel/partials/topnav.php') ?>
<style>
    h1 { text-align: center; }
    .posts h2, h3, p { margin: 15px }
</style>
<main>
    <h1>Posts</h1>
    <hr>
    <div class="posts">
        <a href="/admin-panel/new-post" class="new-btn">New Post</a>
        <br>
        <br>
        <?php if (isset($_SESSION['new_post_success_message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['new_post_success_message']; ?>
            </div>
            <?php unset($_SESSION['new_post_success_message']); ?>
        <?php endif; ?>
        <?php if (empty($posts)): ?>
            <div class="content blog-post-preview">
                <p>Sorry. No posts found.</p>
            </div>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <div class="posts">
                    <h2>
                        <a href="/admin-panel/posts@<?= urlencode($post['url_slug']) ?>"><?= $post['title'] ?></a>
                    </h2>
                    <div>
                        <p><?= substr($post['body'], 0, 500) ?>
                            <?php if (strlen($post['body']) > 500): ?>...<?php endif; ?></p>
                    </div>
                    <div class="meta">
                        <p><?= date('M d, Y, h:i A', strtotime($post['created_at'])) ?></p>
                    </div>
                    <hr>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>
<?php require('views/admin-panel/partials/footer.php') ?>