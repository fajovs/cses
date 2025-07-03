<?php

$router->get(base_url('/'), 'controllers/auth.php', []);
$router->post(base_url('/'), 'controllers/auth.php', []);
$router->get(base_url('/logout'), 'controllers/logout.php', []);

$router->get(base_url('/admin/programs'), 'controllers/programs/index.php', ['admin']);
$router->post(base_url('/admin/program/create') , 'controllers/programs/store.php', ['admin']);
$router->patch(base_url('/admin/program/update') , 'controllers/programs/update.php', ['admin']);
$router->delete(base_url('/admin/program/delete') , 'controllers/programs/destroy.php', ['admin']);


$router->get(base_url('/admin/subjects') , 'controllers/subjects/index.php', ['admin']);
$router->post(base_url('/admin/subject/create') , 'controllers/subjects/store.php', ['admin']);
$router->patch(base_url('/admin/subject/update') , 'controllers/subjects/update.php', ['admin']);
$router->delete(base_url('/admin/subject/delete') , 'controllers/subjects/destroy.php', ['admin']);

$router->get(base_url('/admin/users') , 'controllers/users/index.php', ['admin']);
$router->post(base_url('/admin/user/create') , 'controllers/users/store.php', ['admin']);
$router->patch(base_url('/admin/user/update') , 'controllers/users/update.php', ['admin']);
$router->delete(base_url('/admin/user/delete') , 'controllers/users/destroy.php', ['admin']);



$router->get(base_url('/admin/dashboard') , 'controllers/dashboard.php', ['admin']);


$router->get(base_url('/faculty/dashboard') , 'controllers/dashboard.php', ['faculty']);
$router->get(base_url('/faculty/subjects') ,'controllers/subjects/index.faculty.php', ['faculty']);
$router->get(base_url('/faculty/students') ,'controllers/students/index.faculty.php', ['faculty']);


$router->get(base_url('/student/dashboard') , 'controllers/dashboard.php', ['student']);
$router->get(base_url('/student/activities') , 'controllers/activities/index.php', ['student']);

$router->get(base_url('/parent/dashboard') , 'controllers/dashboard.php', ['parent']);
$router->get(base_url('/parent/students') , 'controllers/students/index.parent.php', ['parent']);
