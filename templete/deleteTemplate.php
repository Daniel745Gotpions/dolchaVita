<?php echo  "<p style='font-weight: bold;'>Are You Sure You Want To Deleate Task Number ". $_POST['taskId']. " ?</p>" ?>
<hr>
<input type="hidden" value="<?php echo $_POST['taskId']?>" id="taskDeleteId">
<button class=" btn btn-danger cancelDeleteBt">Cancel</button>
<button class=" btn btn-success DeleteBt">Delete</button>