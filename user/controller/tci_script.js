$(document).ready(function(){
    // alert("weng weng!");
    // $("input[name=email_report], input[name=call_report], input[name=personal_report]").click(function(){
    //     var email_report = $(this).is(":checked");
    //     if (email_report) {
    //         $('input[name=email_report]').removeAttr('required');
    //     }else{
    //         $('input[name=email_report]').prop('required',true);
    //     }
        
    // });
    $(".tci_cluster").click(function(){
        $('.tci_cluster').not(this).prop('checked',false).prop('required',false);
    });
    $(".tci_location").click(function(){
        $('.tci_location').not(this).prop('checked',false).prop('required',false);
    });			
});