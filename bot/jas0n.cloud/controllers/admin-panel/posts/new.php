<?php

    use Core\App;
    use Core\Database;

    $errors = [];

    function slugify ($text, $divider = '-')
    {
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, $divider);
        $text = preg_replace('~-+~', $divider, $text);
        $text = strtolower($text) . "-" . mt_rand(1000, 9999);
        return $text ? $text : 'n-a';
    }

    $db = App::resolve(Database::class);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
        $body = htmlspecialchars($_POST['body'], ENT_QUOTES, 'UTF-8');

        if (strlen($title) > 40) {
            $errors[] = 'Title must be 40 characters or less.';
        }

        if (strlen($body) > 5000) {
            $errors[] = 'Body must be 5000 characters or less.';
        }

        if (count($errors) === 0) {

            $sql = "insert into posts (title, body, url_slug) values (:title, :body, :url_slug)";
            $params = [
                ':title' => $title,
                ':body' => $body,
                ':url_slug' => slugify($title)
            ];

            $db->query($sql, $params);

            $_SESSION['new_post_success_message'] = "Post added successfully!";
            header('Location: /admin-panel/posts');
        } else {
            $_SESSION['error_messages'] = $errors;
            header('Location: /admin-panel/new-post');
        }
        exit;
    }

    view('admin-panel/posts/new.view', [
        'title' => "New Post"
    ]);