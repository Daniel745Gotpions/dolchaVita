<?php 
//error_reporting(E_ALL);ini_set('display_errors',1);;
    include __DIR__.'/../connection.php';
    include __DIR__.'/../taskClass.php';
    include __DIR__.'/../statusClass.php';
    
    $status = new Status();
    $statuses = $status->getList();
    $task = new Task();
    $taskDetails = $task->getResult(true);
    
?>
<form id="FormAddTask">
    
<div class="form-group">
    <h3>Add New Task </h3>
</div>
<hr>
<div class="form-group">
    <label for="statusOption">Satatus</label>
    <select class="form-control" id="statusOption">
        <?php foreach( $statuses AS $key => $item ){?>
            <option value="<?php echo $item->id?>"><?php echo $item->title?></option>
        <?php }?>
    </select>
</div>

<div class="form-group">
    <label for="dateInput">Date</label>
    <input type="text" class="form-control" id="dateInput" value="">
    <div class="text-danger"></div>
</div>
<div class="form-group">
    <label for="taskDesc">Task Description</label>
    <input type="text" class="form-control" id="taskDesc" value="">
    <div class="text-danger"></div>
</div>

<div class="form-group">
    <button type="submit" class=" btn btn-success">Add</button>
</div>
</form>