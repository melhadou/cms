<?php
ob_start();

$db_username = 'mohamed';
$db_password = 'mohamed';

// developement
$connection = mysqli_connect('localhost', $db_username, $db_password, 'cms');
// online
// $connection = mysqli_connect('remotemysql.com', '9XA86yznmI', 'lTllpceGiy', '9XA86yznmI');
