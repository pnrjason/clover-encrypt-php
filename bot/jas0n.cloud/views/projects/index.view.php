<?php require('views/partials/head.php') ?>
<?php require('views/partials/nav.php') ?>
<main>
    <div class="container content">
        <h1>My works</h1>
        <p>I enjoy making things. Here's a list of the projects I've worked on or am currently managing.</p>
        <?php if (empty($projects)): ?>
            <p>Sorry. No projects found.</p>
        <?php else: ?>
            <?php foreach ($projects as $project): ?>
                <div class="project">
                    <h3>
                        <a href="<?= strpos($project['url_slug'], 'http') === 0 ? $project['url_slug'] : "/projects/" . $project['url_slug'] ?>" target="_blank">
                        <img src="../../assets/img/blank.png" alt="<?= $project['name'] ?>">
                            <?= $project['name'] ?>
                        </a>
                    </h3>
                    <p><?= $project['description'] ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>
<?php require('views/partials/footer.php'); ?>