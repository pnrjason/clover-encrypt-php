<?php

    use Core\App;
    use Core\Database;

    $db = App::resolve(Database::class);

    $slug = $_GET['slug'];

    if (! $slug) { (new Core\Router)->abort(); }

    $query = "select * from posts where url_slug = ?";
    $post = $db->query($query, [$slug])->fetch();

    if (! $post) { (new Core\Router)->abort(); }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
        $body = htmlspecialchars($_POST['body'], ENT_QUOTES, 'UTF-8');

        $errors = [];

        if (strlen($title) > 100) {
            $errors[] = 'Title must be 100 characters or less.';
        }

        if (strlen($body) > 5000) {
            $errors[] = 'Body must be 5000 characters or less.';
        }

        if (count($errors) === 0) {

            $sql = "UPDATE posts
            SET title = :title,
                body = :body
            WHERE id = :id";
            $params = [
                ':title' => $title,
                ':body' => $body,
                ':id' => $post['id']
            ];

            $db->query($sql, $params);

            $_SESSION['new_post_success_message'] = "Post was successfully updated!";
            header('Location: /admin-panel/posts');
        } else {
            $_SESSION['error_messages'] = $errors;
            header("Location: /admin-panel/posts@$slug");
        }
        exit;
    }

    view("admin-panel/posts/show.view", [
        'title' => $post['title'],
        'post' => $post
    ]);