<?php
$dbhost = '10.34.46.6';
$dbname = 'iteamsco_udayan_db';
$dbuser = 'iteamsco_udayan';
$dbpass = 'ud@yan123';

try {
    $db = new PDO("mysql:host={$dbhost};dbname={$dbname}",$dbuser,$dbpass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $e) {
    echo "Connection error: ".$e->getMessage();
}
?>