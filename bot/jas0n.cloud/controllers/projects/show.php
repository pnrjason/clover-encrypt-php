<?php

    use Core\App;
    use Core\Database;

    $db = App::resolve(Database::class);

    $slug = $_GET['slug'];

    if (! $slug) { (new Core\Router)->abort(); }

    $query = "select * from projects where url_slug = ?";
    $project = $db->query($query, [$slug])->fetch();

    if (! $project) { (new Core\Router)->abort(); }

    view("projects/show.view", [
        'title' => $project['name'],
        'project' => $project
    ]);
