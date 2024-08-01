<?php require('views/admin-panel/partials/head.php') ?>
<?php require('views/admin-panel/partials/nav.php') ?>
<?php require('views/admin-panel/partials/topnav.php') ?>
<style>
    h1 {
        text-align: center;
        margin-bottom: 20px;
    }
    .messages-container {
        padding: 20px;
        max-width: 800px;
        margin: 0 auto;
    }
    .messages {
        background-color: hsl(var(--hue), 37%, 20%);
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease;
        position: relative;
    }
    .messages h3 {
        margin: 0;
        font-size: 1.2em;
        color: var(--gray-800);
    }
    .messages p {
        margin: 10px 0;
        color: silver;
    }
    .messages .date {
        color: var(--gray-600);
        font-size: 0.9em;
    }
    .messages .new-label {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: limegreen;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.8em;
        font-weight: bold;
        text-transform: uppercase;
    }
    a {
        text-decoration: none;
        color: inherit;
    }
    .alert-success {
        background-color: hsl(var(--hue), 45%, 15%);
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        text-align: center;
    }
</style>
<main>
    <h1>Messages</h1>
    <?php if (empty($messages)): ?>
        <div class="content blog-post-preview">
            <p>Sorry. No messages found.</p>
        </div>
    <?php else: ?>
        <div class="messages-container">
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success"><?= $_SESSION['success_message']; ?></div>
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>
            <?php foreach ($messages as $message): ?>
                <div class="messages">
                    <?php if ($message['is_new'] == 1): ?>
                        <span class="new-label">NEW</span>
                    <?php endif; ?>
                    <a href="/admin-panel/messages@<?= urlencode($message['id']) ?>">
                        <h3><?= ucwords($message['name']) ?> (<?= $message['email'] ?>)</h3>
                        <p class="date"><?= date('M d, Y, h:i A', strtotime($message['created_at'])) ?></p>
                        <p>
                            <?php
                            $truncatedMessage = substr($message['message'], 0, 250);
                            $singleLineMessage = str_replace(["\r", "\n"], ' ', $truncatedMessage);
                            echo $singleLineMessage;
                            ?>
                            <?php if (strlen($message['message']) > 250): ?>...<?php endif; ?>
                        </p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>
<?php require('views/admin-panel/partials/footer.php') ?>