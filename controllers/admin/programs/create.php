<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);


view('/admin/programs/create.view.php', [
    'heading' => 'Create Program'
]);
