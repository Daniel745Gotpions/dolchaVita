<?php 
//error_reporting(E_ALL);  ini_set('display_errors',1); 
include __DIR__.'/../connection.php';
include __DIR__.'/../taskClass.php';

$task = new Task();
$json = $task->getResult();
die(json_encode($json));
?>