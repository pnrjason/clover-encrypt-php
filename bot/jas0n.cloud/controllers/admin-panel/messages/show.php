<?php

    use Core\App;
    use Core\Database;

    $db = App::resolve(Database::class);

    $slug = $_GET['slug'];

    if (! $slug) { (new Core\Router)->abort(); }

    $query = "select * from contacts where id = ?";
    $message = $db->query($query, [$slug])->fetch();

    if (! $message) { (new Core\Router)->abort(); }

    if ($message['is_new'] == 1) {
        $sql = "update contacts set is_new = :is_new where id = :id";
        $params = [
            ':is_new' => 0,
            ':id' => $message['id']
        ];
        $db->query($sql, $params);
    }

    view("admin-panel/messages/show.view", [
        'title' => 'New Message',
        'message' => $message
    ]);