<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$program_id = $params['id'];

$program =  $db->query("SELECT * FROM programs WHERE program_id =" .$program_id)->fetch();



if(!$program){
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

view('/admin/programs/edit.view.php', [
    'heading' => $program['program_name'],
    'program' => $program,
]);
