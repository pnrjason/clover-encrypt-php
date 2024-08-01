<?php

    use Core\App;
    use Core\Database;

    $db = App::resolve(Database::class);
    $home_messages = $db->query("select * from home")->fetchAll();
    $social_media = $db->query("select * from social_media")->fetchAll();

    view("index.view", [
        'title' => "Home",
        'home_messages' => $home_messages,
        'social_media' => $social_media
    ]);