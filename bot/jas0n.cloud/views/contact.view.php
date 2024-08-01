<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php if (! isset($_SESSION['_csrf'])) { $_SESSION['_csrf'] = bin2hex(random_bytes(32)); } ?>
<main>
    <div class="content blog-post-preview">
        <div class="home-hero">
            <div class="container container--spaced-1">
                <h2>Get in touch!</h2>
                <div class="home-hero__bio content">
                    <p>I'm available for freelance projects and full-time employment. If you're looking for a dedicated and skilled full-stack developer, let's connect!</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container content">
        <form method="POST">
            <div class="input">
                <input type="hidden" name="_csrf" value="<?= $_SESSION['_csrf'] ?>">
                <label for="name"></label><input type="text" id="name" name="name" placeholder="Your Name" required>
                <label for="email"></label><input type="email" id="email" name="email" placeholder="Email" required>
                <label for="phone"></label><input type="tel" id="phone" name="phone" placeholder="Phone" required>
                <label for="message"></label><textarea id="message" name="message" rows="5" placeholder="Message" required></textarea>
            </div>
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
            <label for="submit"></label><button class="btn" id="submit">Submit</button>
            <label for="response"></label>
        </form>
    </div>
</main>
<?php require('partials/footer.php') ?>