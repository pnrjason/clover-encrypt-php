<?php

    use Core\App;
    use Core\Database;

    $errors = [];

    $db = App::resolve(Database::class);
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    if ($id) {
        $db->query("delete from contacts where id = :id", [
            ':id' => $id
        ]);
        $_SESSION['success_message'] = "Message was deleted!";
    } else {
        $_SESSION['error_messages'][] = "Message ID is required for deletion.";
    }

    header('Location: /admin-panel/messages');
    exit;