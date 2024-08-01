<?php

    use Core\App;
    use Core\Database;

    $errors = [];

    $db = App::resolve(Database::class);
    $posts = $db->query("select * from posts order by id desc")->fetchAll();

    view('admin-panel/posts/index.view', [
        'title' => "Posts",
        'posts' => $posts
    ]);