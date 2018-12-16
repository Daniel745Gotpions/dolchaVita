<?php 
$categories = ["Total Task","Task Completed","Task Remaining"];

?>
<html>
    <head>
        <title>Task</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="/script.js"></script>
    </head>
    <body>
        <div class="container bodyContainer" >
            <div class="taskContainerWidget">
                <div class="row">
                    <?php for( $i = 0; $i < count($categories); $i++ ){ 
                        switch($i){
                            case 0:
                            $color = '#3087af';
                            break;
                            case 1:
                            $color = '#2ba569';
                            break;
                            case 2:
                            $color = '#af3030';
                            break;
                        }    
                    ?>
                    <div class="col-md-4">
                        <div class="widget">
                            <div class="leftSide">
                                <?php echo $categories[$i]?>
                            </div>
                            <div style="color:<?php echo $color?>" class="rightSide" widget="<?php echo $i+1?>">
                                0
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
            <table class="table" id="dataTable">
                <tr>
                    <th>#</th>
                    <th>Task Name</th>
                    <th>Date</th>
                    <th>Edit Task</th>
                    <th>Delete Task</th>
                    <th><button class="btn addTaskButton">Add New Task <i class="fa fa-plus" aria-hidden="true"></i></button></th>
                </tr>
            </table>
        </div>   

        <div class="overlay">
            <div class="popUp">
                <div class="close">X</div>
                <div class="details">

                </div>
            </div>
        </div>
    </body>
</html>