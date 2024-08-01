<?php

    use Core\App;
    use Core\Database;

    $db = App::resolve(Database::class);
    $posts = $db->query("select * from posts order by id desc")->fetchAll();

    view("posts/index.view", [
        'title' => "Posts",
        'posts' => $posts
    ]);