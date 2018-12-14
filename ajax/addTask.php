<?php 
    //error_reporting(E_ALL);ini_set('display_errors',1);;
    include __DIR__.'/../connection.php';
    include __DIR__.'/../taskClass.php';

    $allowedFields = ['statusId','date','desc','statusTitle'];
    $json = ['status'=>true,'data'=>[]];
    for($i = 0 ; $i<count($allowedFields);$i++  ){
        if( empty($_POST[$allowedFields[$i]])){
            $json['status'] = false;
            die(json_encode($json));   
            break;
        }
    }

    $task = new Task(null,$_POST['date'],$_POST['desc'],(int)$_POST['statusId']);
    $taskId = $isSuccess = $task->insert();
    $json['status'] = $isSuccess;
    $other = $task->getResult();
    $json['data'] = ['taskId'=>$taskId,'statusTitle'=>$_POST['statusTitle'],'date'=>$_POST['date'],'desc'=>$_POST['desc'],'other'=>$other];
    die(json_encode($json));
?>