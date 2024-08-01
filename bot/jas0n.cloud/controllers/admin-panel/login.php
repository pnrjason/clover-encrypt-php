<?php

    use Core\App;
    use Core\Database;

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        header("Location: /admin-panel/home");
        exit;
    }

    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['_csrf']) && $_POST['_csrf'] === $_SESSION['_csrf']) {
        $username = htmlspecialchars($_POST['u'], ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($_POST['p'], ENT_QUOTES, 'UTF-8');

        try {
            $db = App::resolve(Database::class);
            $query = "select * from users where username = ?";
            $user = $db->query($query, [$username])->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['logged_in'] = true;
                header("Location: /admin-panel/home");
                exit;
            }
        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }

    if (! isset($_SESSION['_csrf'])) {
        $_SESSION['_csrf'] = bin2hex(random_bytes(32));
    }

    view("admin-panel/authentication/login.view", [
        'title' => "Admin Panel Login",
        'errors' => $errors
    ]);
