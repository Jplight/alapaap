$(document).ready(function(){




    $("input[name=cps_action]").click(function(){
        var cps_action = $("input[name=cps_action]").is(":checked");
        if (cps_action) {
            $("input[name=cps_action]").removeAttr('required');
        }else{
            $("input[name=cps_action]").prop('required',true);
        }
        $('input[name=cps_action]').not(this).prop('checked',false);    
    });    



    $("input[name=location]").click(function(){
        var location = $("input[name=location]").is(":checked");
        if (location) {
            $("input[name=location]").removeAttr('required');
        }else{
            $("input[name=location]").prop('required',true);
        }
        $('input[name=location]').not(this).prop('checked',false);  
    });
    $("input[name=env_profile]").click(function(){
        var env_profile = $("input[name=env_profile]").is(":checked");
        if (env_profile) {
            $("input[name=env_profile]").removeAttr('required');
        }else{
            $("input[name=env_profile]").prop('required',true);
        }
        $('input[name=env_profile]').not(this).prop('checked',false);
    });

    var i = 2;
    $("#add_row_cps").click(function(){
        if ($(".cps_disk_req"+(i-1)).val() == '' || $(".cps_disk_info"+(i-1)).val() == '' || $(".cps_disk_remarks"+(i-1)).val() == '') {
            alert("Please Fill up the fields!"+(i-1));
        }else{
            $('#cps_tab_logic').append("<tr id='addr_cps"+i+"'><td></td><td><input class='form-control text-dark input-md cps_disk_req"+i+"' type='text' name='others_1[]'  /></td><td><input class='form-control text-dark input-md cps_disk_info"+i+"' type='text' name='others_2[]'  /></td><td><input class='form-control text-dark cps_disk_remarks"+i+"' type='text' name='others_3[]' ></td></tr>");
            i++;                
        }
    });
    	
});