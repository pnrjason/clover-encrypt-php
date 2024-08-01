<?php

    use Core\App;
    use Core\Database;
    use Core\Validator;

    $db = App::resolve(Database::class);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $errors = [];

        $fields = ['name', 'email', 'phone', 'message', '_csrf'];
        foreach ($fields as $field) {
            if (empty($_POST[$field])) {
                $errors[] = "Please fill in all fields.";
                break;
            }
            if (! Validator::string($_POST['message'], 1, 5000)) {
                $errors[] = "Message cannot be longer than 5000 characters.";
                break;
            }
            if (! Validator::email($_POST['email'])) {
                $errors[] = "Please enter a valid email address.";
                break;
            }
        }

        if ($_POST['_csrf'] !== $_SESSION['_csrf']) {
            $errors[] = "Session expired or invalid request.";
        }

        if (count($errors) === 0) {
            $sql = "insert into contacts (name, email, phone, message, is_new) values (:name, :email, :phone, :message, :is_new)";
            $params = [
                ':name' => htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8'),
                ':email' => htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8'),
                ':phone' => htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8'),
                ':message' => htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8'),
                ':is_new' => 1
            ];

            $db->query($sql, $params);

            $_SESSION['success_message'] = "Submitted successfully!";
        } else {
            $_SESSION['error_messages'] = $errors;
        }
        header('Location: /contact');
        exit;
    }

    view("contact.view", [
        'title' => "Contact"
    ]);