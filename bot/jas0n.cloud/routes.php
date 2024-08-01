<?php

    global $router;

    $router->get('/', 'controllers/index.php');

    $router->get('/projects', 'controllers/projects/index.php');
    $router->get('/projects/{slug}', 'controllers/projects/show.php');

    $router->get('/posts', 'controllers/posts/index.php');
    $router->get('/posts/{slug}', 'controllers/posts/show.php');

    $router->get('/contact', 'controllers/contact.php');
    $router->post('/contact', 'controllers/contact.php');

    $router->get('/admin-panel', 'controllers/admin-panel/login.php');
    $router->post('/admin-panel', 'controllers/admin-panel/login.php');

    $router->get('/logout', 'controllers/admin-panel/logout.php')->only('admin');

    $router->get('/admin-panel/home', 'controllers/admin-panel/home.php')->only('admin');
    $router->post('/admin-panel/home', 'controllers/admin-panel/home.php')->only('admin');

    $router->get('/admin-panel/posts', 'controllers/admin-panel/posts/index.php')->only('admin');
    $router->get('/admin-panel/new-post', 'controllers/admin-panel/posts/new.php')->only('admin');
    $router->post('/admin-panel/new-post', 'controllers/admin-panel/posts/new.php')->only('admin');
    $router->get('/admin-panel/posts@{slug}', 'controllers/admin-panel/posts/show.php')->only('admin');
    $router->post('/admin-panel/posts@{slug}', 'controllers/admin-panel/posts/show.php')->only('admin');
    $router->post('/admin-panel/delete-post', 'controllers/admin-panel/posts/delete.php')->only('admin');

    $router->get('/admin-panel/messages', 'controllers/admin-panel/messages/index.php')->only('admin');
    $router->get('/admin-panel/messages@{slug}', 'controllers/admin-panel/messages/show.php')->only('admin');
    $router->post('/admin-panel/messages@{slug}', 'controllers/admin-panel/messages/show.php')->only('admin');
    $router->post('/admin-panel/delete-message', 'controllers/admin-panel/messages/delete.php')->only('admin');