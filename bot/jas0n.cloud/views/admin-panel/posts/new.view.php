<?php require('views/admin-panel/partials/head.php') ?>
<?php require('views/admin-panel/partials/nav.php') ?>
<?php require('views/admin-panel/partials/topnav.php') ?>
<style>
    h1 {
        text-align: center;
    }
</style>
<main>
    <h1>New Post</h1>
    <hr>
    <div class="posts">
        <form method="post">
            <h2>Add a new post</h2>
            <label for="title"></label>
            <textarea name="title" id="title" rows="1" placeholder="A very nice title" required></textarea>
            <label for="body"></label>
            <textarea name="body" id="body" rows="10" placeholder="Hello, world!" required></textarea>
            <label for="submit"></label><button class="btn" id="submit">Post</button>
            <?php if (isset($_SESSION['new_post_success_message'])): ?>
                <div class="alert alert-success">
                    <?= $_SESSION['new_post_success_message']; ?>
                </div>
                <?php unset($_SESSION['new_post_success_message']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['error_messages'])): ?>
                <div class="alert alert-danger">
                    <?php foreach ($_SESSION['error_messages'] as $message): ?>
                        <p><?= $message; ?></p>
                    <?php endforeach; ?>
                    <?php unset($_SESSION['error_messages']); ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
</main>
<?php require('views/admin-panel/partials/footer.php') ?>