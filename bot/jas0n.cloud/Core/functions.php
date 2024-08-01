<?php

    function dd($value) {
        echo "<pre>";
        print_r($value);
        echo "</pre>";
        die();
    }

    function view($path, $title = []) {
        extract($title);
        return require "views/{$path}.php";
    }