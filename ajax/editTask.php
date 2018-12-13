<?php 
    error_reporting(E_ALL);ini_set('display_errors',1);;
    include __DIR__.'/../connection.php';
    include __DIR__.'/../taskClass.php';

    $allowedFields = ['taskId','statusId','date','desc','statusTitle'];
    $json = ['status'=>true,'data'=>[]];
    for($i = 0 ; $i<count($allowedFields);$i++  ){
        if( empty($_POST[$allowedFields[$i]])){
            $json['status'] = false;
            die(json_encode($json));   
            break;
        }
    }
    
    $taskId = (int) $_POST['taskId'];
    $task = new Task($taskId);
    $task->setStatusId((int)$_POST['statusId']);
    $task->setDateAdd($_POST['date']);
    $task->setName($_POST['desc']);
    $isSuccess = $task->edit();
    $json['status'] = $isSuccess;
    $other = $task->getResult();
    $json['data'] = ['statusTitle'=>$_POST['statusTitle'],'date'=>$_POST['date'],'desc'=>$_POST['desc'],'taskId'=>$taskId,'other'=>$other];
    die(json_encode($json));
?>