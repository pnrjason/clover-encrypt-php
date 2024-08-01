<?php

    use Core\App;
    use Core\Database;

    $errors = [];

    $db = App::resolve(Database::class);
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    if ($id) {
        $db->query("delete from posts where id = :id", [
            ':id' => $id
        ]);
        $_SESSION['new_post_success_message'] = "Post was deleted!";
    } else {
        $_SESSION['error_messages'][] = "Post ID is required for deletion.";
    }

    header('Location: /admin-panel/posts');
    exit;