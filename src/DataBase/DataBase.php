<?php
$host = '192.168.200.79';
$db = '2024';
$user = 'user';
$pass = 'user';
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    //PDO::ATTR_EMULATE_PREPARES => false,
];
$this->pdo = new PDO($dsn, $user, $pass, $opt);
$this->setTable('articles');