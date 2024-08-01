<?php

    error_reporting(0);

    require "Database.php";
    $config = require('../config.php');

    $conn = new mysqli($config['host'], $config['username'], $config['password']);
    if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

    $sql = "
    DROP DATABASE IF EXISTS portfolio;
    CREATE DATABASE portfolio;
    USE portfolio;

    CREATE TABLE users (
        username TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL
    );

    CREATE TABLE social_media (
        facebook TEXT NOT NULL,
        instagram TEXT NOT NULL,
        twitter TEXT NOT NULL,
        discord TEXT NOT NULL
    );

    CREATE TABLE home (
        profile_picture TEXT,
        bio TEXT NOT NULL,
        description TEXT NOT NULL,
        whoami TEXT NOT NULL
    );

    CREATE TABLE projects (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        name TEXT NOT NULL,
        description TEXT NOT NULL,
        url_slug TEXT NOT NULL UNIQUE
    );

    CREATE TABLE posts (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        title TEXT NOT NULL,
        body TEXT NOT NULL,
        url_slug TEXT NOT NULL UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    CREATE TABLE contacts (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        name TEXT NOT NULL,
        email TEXT NOT NULL,
        phone TEXT,
        message TEXT NOT NULL,
        is_new INTEGER NOT NULL DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ";

    if ($conn->multi_query($sql) === TRUE) {
        echo "Database and tables created successfully<br>";
        do {
            if ($result = $conn->store_result()) { $result->free(); }
        } while ($conn->next_result());
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();

    $db = new Database($config['database'], $config['username'], $config['password']);

    $username = 'pnrjason';
    $plain_password = 'Hanasakura1@';
    $hashedPassword = password_hash($plain_password, PASSWORD_BCRYPT);

    $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $db->query($query, [
        'username' => $username,
        'password' => $hashedPassword
    ]);

    echo "Admin account was successfully created! ✅<br>";

    $query = "INSERT INTO home (bio, description, whoami) VALUES (:bio, :description, :whoami)";
    $db->query($query, [
        'bio' => "Raizo",
        'description' => "a passionate full-stack developer from somewhere.",
        'whoami' => "a backend dev focused on web automation. also into coffee, cats, guitars, and maps. hmu i'm always up for new challenges!"
    ]);

    echo "Bio, Description, and whoami were successfully added! ✅<br>";

    $query = "INSERT INTO social_media (facebook, instagram, twitter, discord) VALUES (:facebook, :instagram, :twitter, :discord)";
    $db->query($query, [
        'facebook' => "https://www.facebook.com/badmonkeyjason",
        'instagram' => "https://www.instagram.com/pnrjason",
        'twitter' => "https://twitter.com/pnrjason",
        'discord' => "Raizo666"
    ]);

    echo "Social media links were successfully added! ✅<br>";