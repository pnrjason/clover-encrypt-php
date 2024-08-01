<?php require('views/partials/head.php') ?>
<?php require('views/partials/nav.php') ?>
<?php if (! isset($_SESSION['_csrf'])) { $_SESSION['_csrf'] = bin2hex(random_bytes(32)); } ?>
<main>
    <div class="container content">
        <form method="POST">
            <div class="input">
                <input type="hidden" name="_csrf" value="<?= $_SESSION['_csrf'] ?>">
                <label for="u"></label><input type="text" id="u" name="u" placeholder="Username" required>
                <label for="p"></label><input type="password" id="p" name="p" placeholder="Password" required>
            </div>
            <label for="submit"></label><button class="btn" id="submit" style="display: block; margin: 0 auto;">Login</button>
            <label for="response"></label>
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success">
                    <?= $_SESSION['success_message']; ?>
                </div>
                <?php unset($_SESSION['success_message']); ?>
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
<?php require('views/partials/footer.php') ?>