<?php
require_once 'helpers.php';
unset($_SESSION['user']);
redirect('/page_login.php');