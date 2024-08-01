<?php

    use Core\App;
    use Core\Database;

    $errors = [];

    $db = App::resolve(Database::class);
    $messages = $db->query("select * from contacts order by id desc")->fetchAll();

    $messages_count = 0;
    foreach ($messages as $message) { if ($message['is_new'] == 1) { $messages_count++; } }

    view('admin-panel/messages/index.view', [
        'title' => $messages_count > 0 ? "Messages ($messages_count new)" : "Messages",
        'messages' => $messages
    ]);