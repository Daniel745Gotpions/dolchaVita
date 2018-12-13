
$(document).on("click",".fa-trash",function(){
    var taskId  = parseInt($(this).parent().parent().attr('taskid'));
    $.ajax({
        url:'/templete/deleteTemplate.php',
        dataType:'html',
        type:'post',
        data:{taskId:taskId},
        success:function(data){
            $(".popUp .details").html('');
            $(".popUp .details").append(data);
            $(".overlay").show();
        }
    })
});

$(document).on("submit","#FormAddTask",function(){
    let formInputs = $(this).find("input,select");
    let statusId = parseInt(formInputs[0].value);
    let date = formInputs[1].value;
    let desc = formInputs[2].value;
    $(".text-danger").html('');
    if( formInputs[1].value == ''){
        $($(formInputs[1]).siblings()[1]).html('* Date Is Required Field');
        return false;
    }else if( formInputs[2].value == ''){
        $($(formInputs[2]).siblings()[1]).html('* Name Is Required Field');
        return false;
    }
    
    $.ajax({
        url:'/ajax/addTask.php',
        dataType:'json',
        type:'post',
        data:{
                statusId:statusId,
                date:date,
                desc:desc,
                statusTitle:$("#statusOption option:selected").text()
            },
        success:function(data){
            
            $table = $("#dataTable");
            $('#dataTable').append('<tr taskId="'+data.data.taskId+'"><td>'+data.data.taskId+'</td><td>'+data.data.desc+'</td><td>'+data.data.date+'</td><td><i class="fa fa-pencil-square-o" aria-hidden="true"></i></td> <td> <i class="fa fa-trash" aria-hidden="true"></i></td><td></td></tr>');
            $($(".rightSide")[0]).html(data.data.other.length);
            $($(".rightSide")[1]).html(data.data.other.completed);
            $($(".rightSide")[2]).html(data.data.other.remaining);
            $(".popUp .details").html('');
            $(".overlay").hide();
        }
    })
    return false;
});

$(document).on("submit","#FormEdit",function(){
    let formInputs = $(this).find("input,select");
    let taskId = parseInt($($(this).find("input,select")[0]).val());
    let statusId = parseInt(formInputs[1].value);
    let date = formInputs[2].value;
    let desc = formInputs[3].value;
    
    $(".text-danger").html('');
    if( formInputs[2].value == ''){
        $($(formInputs[2]).siblings()[1]).html('* Date Is Required Field');
        return false;
    }else if( formInputs[3].value == ''){
        $($(formInputs[3]).siblings()[1]).html('* Name Is Required Field');
        return false;
    }
    
    $.ajax({
        url:'/ajax/editTask.php',
        dataType:'json',
        type:'post',
        data:{taskId:taskId,
                statusId:statusId,
                date:date,
                desc:desc,
                statusTitle:$("#editStatusOption option:selected").text()
            },
        success:function(data){
            
            let tr = $("tr[taskId='"+data.data.taskId+"']");
            
            $(tr.children()[1]).html(data.data.desc);
            $(tr.children()[2]).html(data.data.date);
            $($(".rightSide")[0]).html(data.data.other.length);
            $($(".rightSide")[1]).html(data.data.other.completed);
            $($(".rightSide")[2]).html(data.data.other.remaining);
            $(".popUp .details").html('');
            $(".overlay").hide();
        }
    })
    return false;
});

// Get Edit content 
$(document).on("click",".addTaskButton",function(){
    
    $.ajax({
        url:'/templete/addTaskTemplate.php',
        dataType:'html',
        type:'post',
        success:function(data){
            $(".popUp .details").html('');
            $(".popUp .details").append(data);
            $(".overlay").show();
            $( "#dateInput" ).datepicker({ dateFormat: 'yy-mm-dd' });
        }
    })
});

// Get Edit content 
$(document).on("click",".fa-pencil-square-o",function(){
    var taskId  = parseInt($(this).parent().parent().attr('taskid'));
    $.ajax({
        url:'/templete/editTemplate.php',
        dataType:'html',
        type:'post',
        data:{taskId:taskId},
        success:function(data){
            $(".popUp .details").html('');
            $(".popUp .details").append(data);
            $(".overlay").show();
            $( "#dateInput" ).datepicker({ dateFormat: 'yy-mm-dd' });
        }
    })
});

 // Cancel Delete function
$(document).on("click",".cancelDeleteBt",function(){
    $(".overlay").hide();
    $(".popUp .details").html('');   
});


$(document).on("click",".DeleteBt",function(){
    var taskDeleteId = parseInt($("#taskDeleteId").val());
    $.ajax({
        url:'/ajax/deleteTaskService.php',
        dataType:'json',
        type:'post',
        data:{taskDeleteId:taskDeleteId},
        success:function(data){
            if( data.status){
                $($(".rightSide")[1]).html(data.completed);
                $($(".rightSide")[2]).html(data.remaining);
                $($(".rightSide")[0]).html(data.length);
                $("tr[taskId='"+data.taskId+"']").remove();
                $(".overlay").hide();
            }else{
                $(".popUp .details").html("<p style='font-weight: bold;'>"+data.message+"</p>");
            }
        }
    })
});

$(document).ready(function(){
    $(".close").on('click',function(){
        $(".overlay").hide();
    });

    // Get Data
    $.ajax({
        url:'/ajax/getTask.php',
        dataType:'json',
        type:'post',
        success:function(data){
            $($(".rightSide")[0]).html(data.length);
            if(data.length){
                $($(".rightSide")[1]).html(data.completed);
                $($(".rightSide")[2]).html(data.remaining);
                $table = $("#dataTable");
                $(data.data).each(function(){                   
                    $('#dataTable').append('<tr taskId="'+this.id+'"><td>'+this.id+'</td><td>'+this.name+'</td><td>'+this.dateAdd+'</td><td><i class="fa fa-pencil-square-o" aria-hidden="true"></i></td><td><i class="fa fa-trash" aria-hidden="true"></i></td><td></td></tr>');
                })
            }
        }
    })
});