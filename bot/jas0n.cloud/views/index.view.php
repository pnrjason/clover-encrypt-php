<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<main>
    <div class="container container--spaced-2">
        <div class="home-hero">
            <div class="home-hero__avatar">
                <img src="../assets/img/photo.jpg" alt="icon" />
            </div>
            <div class="home-hero__bio content">
                <h1><?= $home_messages[0]['bio'] ?></h1>
                <p><?= $home_messages[0]['description'] ?></p>
            </div>
        </div>
    </div>
    <div class="container container--spaced-1">
        <h2>whoami</h2>
        <div class="home-hero__bio content">
            <p><?= $home_messages[0]['whoami'] ?></p>
        </div>
    </div>
    <div class="container container--spaced-1">
        <h2>tech stack</h2>
        <div class="home-hero__bio content">
            <img src="../assets/img/php.png" alt="php">
            <img src="../assets/img/laravel.png" alt="laravel">
            <img src="../assets/img/javascript.png" alt="javascript">
            <img src="../assets/img/nodejs.png" alt="nodejs">
            <img src="../assets/img/playwright.svg" alt="playwright">
            <img src="../assets/img/puppeteer.png" alt="puppeteer">
            <img src="../assets/img/selenium.png" alt="selenium">
            <img src="../assets/img/mysql.png" alt="mysql">
            <img src="../assets/img/postman.png" alt="postman">
            <img src="../assets/img/aws.png" alt="aws">
            <img src="../assets/img/azure.png" alt="azure">
            <img src="../assets/img/cloudflare.png" alt="cloudflare">
            <img src="../assets/img/digitalocean.png" alt="digitalocean">
            <img src="../assets/img/docker.png" alt="docker">
        </div>
    </div>
    <div class="container container--spaced-1">
        <h2>stay connected</h2>
        <div class="home-hero__bio content">
            <ul>
                <li><a href="<?= $social_media[0]['facebook'] ?>" target="_blank">Facebook</a></li>
                <li><a href="<?= $social_media[0]['instagram'] ?>" target="_blank">Instagram</a></li>
                <li><a href="<?= $social_media[0]['twitter'] ?>" target="_blank">Twitter</a></li>
                <li><a href="https://discord.gg" target="_blank">Discord: @<?= $social_media[0]['discord'] ?></a></li>
            </ul>
        </div>
    </div>
</main>
<?php require('partials/footer.php') ?>