<?php 
error_reporting(E_ALL);ini_set('display_errors',1);;
    include __DIR__.'/../connection.php';
    include __DIR__.'/../taskClass.php';
    include __DIR__.'/../statusClass.php';
    $taskId = (int) $_POST['taskId'];
    $status = new Status();
    $statuses = $status->getList($taskId);
    $task = new Task($taskId);
    $taskDetails = $task->getResult(true);
    $date = date('d-m-Y',strtotime($taskDetails['data'][0]->dateAdd));
?>
<form id="FormEdit">
    <input type="hidden" name="taskId" value="<?php echo $taskId?>">
<div class="form-group">
    <h3>Edit Task Number <?php echo $_POST['taskId']?></h3>
</div>
<hr>
<div class="form-group">
    <label for="taskDesc">Satatus</label>
    <select class="form-control" id="editStatusOption">
        <?php foreach( $statuses AS $key => $item ){
            $selected =($taskDetails['data'][0]->statusId ==  $item->id)? 'selected':'';    
        ?>
            <option <?php echo $selected?> value="<?php echo $item->id?>"><?php echo $item->title?></option>
        <?php }?>
    </select>
</div>

<div class="form-group">
    <label for="dateInput">Date</label>
    <input type="text" class="form-control" id="dateInput" value="<?php echo $date?>">
    <div class="text-danger"></div>
</div>
<div class="form-group">
    <label for="taskDesc">Task Description</label>
    <input type="text" class="form-control" id="taskDesc" value="<?php echo $taskDetails['data'][0]->name?>">
    <div class="text-danger"></div>
</div>

<div class="form-group">
    <button type="submit" class=" btn btn-success">Edit</button>
</div>
</form>