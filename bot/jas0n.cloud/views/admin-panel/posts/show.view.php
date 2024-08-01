<?php require('views/admin-panel/partials/head.php') ?>
<?php require('views/admin-panel/partials/nav.php') ?>
<?php require('views/admin-panel/partials/topnav.php') ?>
<style>
    h1 {
        text-align: center;
    }
    .btn:hover {
        background-color: #555;
    }
    .btn-delete {
        padding: 10px 20px;
        background-color: red;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }
    .btn-delete:hover {
        background-color: darkred;
    }
</style>
<main>
    <h1><?= $post['title'] ?></h1>
    <hr>
    <div class="posts">
        <form method="post">
            <h2>Edit Post</h2>
            <label for="title"></label>
            <textarea name="title" id="title" rows="1" required><?= $post['title'] ?></textarea>
            <label for="body"></label>
            <textarea name="body" id="body" rows="10" required><?= $post['body'] ?></textarea>
            <div class="form-buttons">
                <button class="btn" id="submit">Update</button>
                <button class="btn-delete" type="button" onclick="confirmDelete()" style="float: right">Delete</button>
            </div>
            <?php if (isset($_SESSION['error_messages'])): ?>
                <div class="alert alert-danger">
                    <?php foreach ($_SESSION['error_messages'] as $message): ?>
                        <p><?= $message ?></p>
                    <?php endforeach; ?>
                    <?php unset($_SESSION['error_messages']); ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
</main>
<script>
    function confirmDelete() {
        if (confirm('Are you sure you want to delete this post?')) {
            const form = document.createElement('form');
            form.method = 'post';
            form.action = '/admin-panel/delete-post';
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'id';
            input.value = <?= json_encode($post['id']) ?>;
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
<?php require('views/admin-panel/partials/footer.php') ?>