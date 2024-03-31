$(document).ready(function() {
    console.log("jquery workinggg...");
    var current_row=null;
    $('#add_record').click(function(){
        $('#action').val('insert');
        $('#uid').val(0);
        $('#create_modal').modal('show');
    });

    $('#frm').submit(function(e){
        e.preventDefault();
        $.ajax({
            url:'ajax_action.php',
            method:'POST',
            data:$(this).serialize(),
            beforeSend:function(){
                $(this).find("input[type='submit']").val('Loading...');
            },
            success:function(res){
                var response=JSON.parse(res);
                console.log(response);
                if(response.status==="success"){
                    if($('#uid').val()=='0'){
                        $('tbody').append(response.data);
                    }
                    else{
                        $(current_row).html(response.data);
                    }
                    // $('#tbody').append(res);
                }else{
                    alert("Failed try Again...");
                }
                $('frm').find("input[type='submit']").val('Submit');
                clear_input();
                $('#create_modal').modal('hide');
            }
        });
    });

    function clear_input(){
        $('#frm').find('.form-control').val('');
    }

    $('body').on('click','.edit',function(){
        console.log("edit clicked...");
        current_row=$(this).closest('tr');
        $('#create_modal').modal('show');
        var id=$(this).closest('tr').attr('uid');
        var name=$(this).closest('tr').find('td:eq(1)').text();
        var gender=$(this).closest('tr').find('td:eq(2)').text();
        var contact=$(this).closest('tr').find('td:eq(3)').text();

        $('#action').val("update");
        $('#uid').val(id);
        $('#name').val(name);
        $('#gender').val(gender);
        $('#contact').val(contact);
    });

    $('body').on('click','.delete',function(){
        var id=$(this).closest('tr').attr('uid');
        var cls=$(this);
        if (confirm("Are you sure you want to delete this record?")) {
        $.ajax({
            url:'ajax_action.php',
            method:'POST',
            data:{uid:id,action:'delete'},
            success:function(res){
                var response=JSON.parse(res);
                if(response.status==="success"){
                    cls.closest('tr').remove();
                }else{
                    alert("Failed try Again...");
                }
            } ,
            error:function(error){
                alert("Error: ".error);
            }
        })
    }
    });
});



// document.addEventListener("DOMContentLoaded", function() {
//     console.log("JavaScript workinggg...");
//     var addRecordBtn = document.getElementById("add_record");
//     addRecordBtn.addEventListener("click", function() {
//         var modal = new bootstrap.Modal(document.getElementById('create_modal'));
//         modal.show();
//     });
// });