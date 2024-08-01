<?php

    use Core\App;
    use Core\Database;

    $errors = [];

    $db = App::resolve(Database::class);
    $home_messages = $db->query("select * from home")->fetchAll();
    $social_media = $db->query("select * from social_media")->fetchAll();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_FILES['profile_picture'])) {

            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($_FILES["profile_picture"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $errors[] = "File is not an image.";
                $uploadOk = 0;
            }

            if (file_exists($targetFile)) {
                $errors[] = "Sorry, file already exists.";
                $uploadOk = 0;
            }

            if ($_FILES["profile_picture"]["size"] > 500000) {
                $errors[] = "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                $errors[] = "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile)) {
                    $sql = "update home set profile_picture = :profile_picture";
                    $params = [
                        ':profile_picture' => $targetFile
                    ];

                    $db->query($sql, $params);

                    $_SESSION['profile_picture_success_message'] = "The file " . htmlspecialchars(basename($_FILES["profile_picture"]["name"])) . " has been uploaded.";
                } else {
                    $errors[] = "Sorry, there was an error uploading your file.";
                }
            }
        }

        if (isset($_POST['bio'])) {
            $sql = "update home set bio = :bio";
            $params = [
                ':bio' => htmlspecialchars($_POST['bio'], ENT_QUOTES, 'UTF-8')
            ];

            $db->query($sql, $params);

            $_SESSION['bio_success_message'] = "Successfully updated!";
        }

        if (isset($_POST['description'])) {
            $sql = "update home set description = :description";
            $params = [
                ':description' => htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8')
            ];

            $db->query($sql, $params);

            $_SESSION['description_success_message'] = "Successfully updated!";
        }

        if (isset($_POST['whoami'])) {
            $sql = "update home set whoami = :whoami";
            $params = [
                ':whoami' => htmlspecialchars($_POST['whoami'], ENT_QUOTES, 'UTF-8')
            ];

            $db->query($sql, $params);

            $_SESSION['whoami_success_message'] = "Successfully updated!";
        }

        if (isset($_POST['facebook']) || isset($_POST['instagram']) || isset($_POST['twitter']) || isset($_POST['discord'])) {
            $sql = "update social_media
            set facebook = :facebook,
                instagram = :instagram,
                twitter = :twitter,
                discord = :discord";
            $params = [
                ':facebook' => htmlspecialchars($_POST['facebook'], ENT_QUOTES, 'UTF-8'),
                ':instagram' => htmlspecialchars($_POST['instagram'], ENT_QUOTES, 'UTF-8'),
                ':twitter' => htmlspecialchars($_POST['twitter'], ENT_QUOTES, 'UTF-8'),
                ':discord' => htmlspecialchars($_POST['discord'], ENT_QUOTES, 'UTF-8')
            ];

            $db->query($sql, $params);

            $_SESSION['social_links_success_message'] = "Social Links were successfully updated!";
        }

        if (! empty($errors)) {
            $_SESSION['error_messages'] = $errors;
        }

        header('Location: /admin-panel/home');
        exit;
    }

    view('admin-panel/home.view', [
        'title' => "Home",
        'home_messages' => $home_messages,
        'social_media' => $social_media
    ]);