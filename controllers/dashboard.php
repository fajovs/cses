<?php

use Core\Database;


$config = require(base_path('config.php'));
$db = new Database($config['database']);

view('dashboard.view.php', ['heading' => 'Dashboard']);

