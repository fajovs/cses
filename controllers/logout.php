<?php

$_SESSION = [];
session_unset();
session_destroy();

header("Location: ". base_url('/'));