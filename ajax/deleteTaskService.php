<?php
//error_reporting(E_ALL);ini_set('display_errors',1);;
include __DIR__.'/../connection.php';
include __DIR__.'/../taskClass.php';

$taskId = (int) $_POST['taskDeleteId'];
$task = new Task($taskId);
$json = $task->deleteTask();
die(json_encode($json));
?>