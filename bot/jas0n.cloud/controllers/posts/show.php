<?php

    use Core\App;
    use Core\Database;

    $db = App::resolve(Database::class);

    $slug = $_GET['slug'];

    if (! $slug) { (new Core\Router)->abort(); }

    $query = "select * from posts where url_slug = ?";
    $post = $db->query($query, [$slug])->fetch();

    if (! $post) { (new Core\Router)->abort(); }

    view("posts/show.view", [
        'title' => $post['title'],
        'post' => $post
    ]);