<?php

    use Core\App;
    use Core\Database;

    $db = App::resolve(Database::class);
    $projects = $db->query("select * from projects order by id desc")->fetchAll();

    view("projects/index.view", [
        'title' => "Projects",
        'projects' => $projects
    ]);