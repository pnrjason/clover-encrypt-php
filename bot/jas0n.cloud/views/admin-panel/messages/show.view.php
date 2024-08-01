<?php require('views/admin-panel/partials/head.php') ?>
<?php require('views/admin-panel/partials/nav.php') ?>
<?php require('views/admin-panel/partials/topnav.php') ?>
<style>
    h1 {
        text-align: center;
        margin: 20px;
    }
    .message-container {
        padding: 20px;
        max-width: 800px;
        margin: 0 auto;
        background-color: hsl(var(--hue), 37%, 20%);
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .message-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 0;
        font-size: 1.2em;
        color: var(--gray-800);
    }
    .message-body {
        margin: 10px 0;
        color: silver;
    }
    .message-body .date, .message-body .phone, .message-body .email {
        color: var(--gray-600);
        font-size: 0.9em;
    }
    .btn {
        padding: 10px 20px;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
    .btn:hover {
        background-color: #555;
    }
    .btn-delete {
        background-color: red;
    }
    .btn-delete:hover {
        background-color: darkred;
    }
    .button-container {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
</style>
<main>
    <h1>Message Details</h1>
    <div class="message-container">
        <div class="message-header">
            <h3><?= ucwords($message['name']) ?></h3>
        </div>
        <div class="message-body">
            <p class="email"><?= $message['email'] ?></p>
            <p class="phone"><?= $message['phone'] ?></p>
            <p class="date"><?= date('M d, Y, h:i A', strtotime($message['created_at'])) ?></p>
            <br>
            <p><?= nl2br($message['message']) ?></p>
        </div>
        <div class="button-container">
            <a href="/admin-panel/messages"><button class="btn" type="button">⬅ Go Back</button></a>
            <button class="btn btn-delete" type="button" onclick="confirmDelete()">Delete</button>
        </div>
    </div>
</main>
<script>
    function confirmDelete() {
        if (confirm('Are you sure you want to delete this message?')) {
            const form = document.createElement('form');
            form.method = 'post';
            form.action = '/admin-panel/delete-message';
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'id';
            input.value = <?= json_encode($message['id']) ?>;
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
<?php require('views/admin-panel/partials/footer.php') ?>