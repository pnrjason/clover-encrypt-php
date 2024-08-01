<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/topnav.php') ?>
<style>
    h1 {
        text-align: center;
    }
</style>
<main>
    <h1>Home</h1>
    <hr>
    <form method="post">
        <h2>Name</h2>
        <label for="bio"></label>
        <textarea name="bio" id="bio" rows="1" required><?= $home_messages[0]['bio'] ?></textarea><br>
        <label for="submit"></label><button class="btn" id="submit">Update Bio</button>
        <?php if (isset($_SESSION['bio_success_message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['bio_success_message']; ?>
            </div>
            <?php unset($_SESSION['bio_success_message']); ?>
        <?php endif; ?>
    </form>
    <br>
    <form method="post">
        <h2>Bio</h2>
        <label for="description"></label>
        <textarea name="description" id="description" rows="1" required><?= $home_messages[0]['description'] ?></textarea><br>
        <label for="submit"></label><button class="btn" id="submit">Update Bio</button>
        <?php if (isset($_SESSION['description_success_message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['description_success_message']; ?>
            </div>
            <?php unset($_SESSION['description_success_message']); ?>
        <?php endif; ?>
    </form>
    <br>
    <form method="post">
        <h2>whoami</h2>
        <label for="whoami"></label>
        <textarea name="whoami" id="whoami" rows="3" required><?= $home_messages[0]['whoami'] ?></textarea><br>
        <label for="submit"></label><button class="btn" id="submit">Update whoami</button>
        <?php if (isset($_SESSION['whoami_success_message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['whoami_success_message']; ?>
            </div>
            <?php unset($_SESSION['whoami_success_message']); ?>
        <?php endif; ?>
    </form>
    <br>
    <form method="post">
        <h2>Social Links</h2>
        <label for="facebook"></label>
        <textarea name="facebook" id="facebook" rows="1" placeholder="Facebook" required><?= $social_media[0]['facebook'] ?></textarea><br>
        <label for="instagram"></label>
        <textarea name="instagram" id="instagram" rows="1" placeholder="Instagram" required><?= $social_media[0]['instagram'] ?></textarea><br>
        <label for="twitter"></label>
        <textarea name="twitter" id="twitter" rows="1" placeholder="Twitter" required><?= $social_media[0]['twitter'] ?></textarea><br>
        <label for="discord"></label>
        <textarea name="discord" id="discord" rows="1" placeholder="Discord" required><?= $social_media[0]['discord'] ?></textarea><br>
        <label for="submit"></label><button class="btn" id="submit">Update Social Links</button>
        <?php if (isset($_SESSION['social_links_success_message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['social_links_success_message']; ?>
            </div>
            <?php unset($_SESSION['social_links_success_message']); ?>
        <?php endif; ?>
    </form>
</main>
<?php require('partials/footer.php') ?>