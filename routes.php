<?php

$router->get('/' , 'controllers/auth.php');

$router->get('/admin/dashboard' , 'controllers/dashboard.php');
$router->get('/admin/departments' , 'controllers/departments/index.php');
$router->get('/admin/programs', 'controllers/programs/index.php');
$router->get('/admin/users' , 'controllers/users/index.php');
$router->get('/admin/subjects' , 'controllers/subjects/index.php');

$router->get('/faculty/dashboard' , 'controllers/dashboard.php');
$router->get('/faculty/subjects' ,'controllers/subjects/index.faculty.php');
$router->get('/faculty/students' ,'controllers/students/index.faculty.php');


$router->get('/student/dashboard' , 'controllers/dashboard.php');
$router->get('/student/activities' , 'controllers/activities/index.php');

$router->get('/parent/dashboard' , 'controllers/dashboard.php');
$router->get('/parent/students' , 'controllers/students/index.parent.php');