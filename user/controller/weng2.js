
$(document).ready(function(){

    function group_select(){
        var crrf_department = $("input[name=crrf_department]").is(":checked");
        var crrf_form_factor = $("input[name=crrf_form_factor]").is(":checked");
        var crrf_operating_system = $(".crrf_operating_system").is(":checked");
        if (crrf_department) {
            $("input[name=crrf_department]").removeAttr('required');
        }

        if (crrf_form_factor) {
            $("input[name=crrf_form_factor]").removeAttr('required');
        }

        if (crrf_operating_system) {
            $(".crrf_operating_system").removeAttr('required');
        }
    }  

    group_select();

    $("input[name=crrf_department]").click(function(){
        var crrf_department = $("input[name=crrf_department]").is(":checked");
        if (crrf_department) {
            $('input[name="crrf_department"]').removeAttr('required');
        }else{
            $('input[name="crrf_department"]').attr('required',true);
        }
        $('input[name="crrf_department"]').not(this).prop('checked',false);
        $('#crrf_txt_others').val('').addClass('invisible');

    });


    $("input[name=crrf_form_factor]").click(function(){
        var crrf_form_factor = $('input[name="crrf_form_factor"]').is(":checked");
        if (crrf_form_factor) {
             $('input[name="crrf_form_factor"]').removeAttr('required');
         }else{
             $('input[name="crrf_form_factor"]').attr('required',true);
         }
        $('input[name="crrf_form_factor"]').not(this).prop('checked',false);  
    });


    $(".crrf_operating_system").click(function(){
        $('.crrf_operating_system').not(this).prop('checked',false).prop('required',false); // if the user select one checkbox from operating system, the others selection will automatically change the attrubutes to disabled.
        $('#crrf_ios_ver, #crrf_oel_ver, #crrf_rhel_ver, #crrf_aix_ver, #crrf_windows_ver').not(this).prop('disabled',true).prop('required',false).val('');
    });
    // from operating system AIX, RHEL, Windows, IOS and RHEL it will only choose one per checkbox for operating system.
    
//=============================================================================
    $("#crrf_os_aix").click(function(){
        var crrf_os_aix = $(this).is(":checked");
        if (crrf_os_aix) {
            $(this).removeAttr('required');
            $("#crrf_aix_ver").removeAttr('disabled');
            $("#crrf_aix_ver").prop('required',true);
        }else{
            $(this).prop('required',true);
            $("#crrf_aix_ver").removeAttr('required').prop('disabled',true);
        }
    });
    // if OS AIX is Select
//=============================================================================

    $("#crrf_os_rhel").click(function(){
        var crrf_os_rhel = $(this).is(":checked");
        if (crrf_os_rhel) {
            $(this).removeAttr('required');
            $("#crrf_rhel_ver").removeAttr('disabled');
            $("#crrf_rhel_ver").prop('required',true);
        }else{
            $(this).prop('required',true);
            $("#crrf_rhel_ver").removeAttr('required').prop('disabled',true).val('');
        }
    });
    // if OS Rhel is select
//=============================================================================

    $("#crrf_os_windows").click(function(){
        var crrf_os_windows = $(this).is(":checked");
        if (crrf_os_windows) {
            $(this).removeAttr('required');
            $("#crrf_windows_ver").removeAttr('disabled');
            $("#crrf_windows_ver").prop('required',true);
        }else{
            $(this).prop('required',true);
            $("#crrf_windows_ver").removeAttr('required').prop('disabled',true);
        }
    });
    // If OS Windows is select
    
//=============================================================================

    $("#crrf_os_ios").click(function(){
        var crrf_os_ios = $(this).is(":checked");
        if (crrf_os_ios) {
            $(this).removeAttr('required');
            $("#crrf_ios_ver").removeAttr('disabled');
            $("#crrf_ios_ver").prop('required',true);
        }else{
            $(this).prop('required',true);
            $("#crrf_ios_ver").removeAttr('required').prop('disabled',true).val('');
        }
    });
    // if IOS is Select

// =============================================================================

    $("#crrf_os_oel").click(function(){
        var crrf_os_oel = $(this).is(":checked");
        if (crrf_os_oel) {
            $(this).removeAttr('required');
            $("#crrf_oel_ver").removeAttr('disabled');
            $("#crrf_oel_ver").prop('required',true);
        }else{
            $(this).prop('required',true);
            $("#crrf_oel_ver").removeAttr('required').prop('disabled',true).val('');
        }
    });
    // If OS OEL is select 

//=============================================================================



    $("#crrf_chk_dcou").click(function(){
        var crrf_chk_dcou = $(this).is(":checked");
        if (crrf_chk_dcou) {
            $("#crrf_txt_others").removeClass('invisible').prop('required',true);
        }else{
            $("#crrf_txt_others").addClass('invisible').removeAttr('required');
        }
    });
    // If DCOU is Select, the txt others will automatically appeard!
//=============================================================================

    $(".crrf_db_action").click(function(){
        $('.crrf_db_action').not(this).prop('checked',false).prop('required',false);
        $('.crrf_backup_archive').not(this).prop('checked',false).prop('required',false);
        $('input[name=specify_selection]').not(this).prop('checked',false).prop('required',false);
        $("#lalabas, #orig_warn_text").prop('hidden',true);
        $("input[name=crrf_host_vm_lvl], input[name=crrf_path_file_lvl]").removeAttr('disabled').val(''); 
    });
    // It only choose 1 checkbox only! between BMR or FIle level or VM level

    $(".crrf_backup_archive").click(function(){
        $('.crrf_backup_archive, input[name=specify_selection], #orig_warn_text').not(this).prop('checked',false).prop('required',false); 
        // The lines inside indicates that the backup selection or specify selection or original checbox.
    });
    // It only choose 1 checkbox only between whole drive or specific drive

    $("#crrf_act_bmr, input[name=crrf_act_vm_lvl] ").click(function(){
        var crrf_specific_direct = $(this).is(":checked");
        
        if (crrf_specific_direct == false) {
            $("#lalabas").removeAttr('hidden');
            $("input[name=specify_selection], input[name=crrf_backup_method]").prop('checked',false).prop('required',false);
            $("#lalabas, #orig_warn_text").prop('hidden',true);
        }


    });    
    // if bmr, or file level is uncheck the specift selection and it's checkbox below will be automatically hide and unchecked

    $("input[name=crrf_act_file_lvl]").click(function(){
        var crrf_act_file_lvl = $(this).is(":checked");

        if (crrf_act_file_lvl == true) {
            $("input[name=crrf_host_vm_lvl]").prop('disabled',true);
        }else{
            $("input[name=crrf_host_vm_lvl]").removeAttr('disabled');
        }        
    }); // if FIle Level Checkbos is Checked the Destination Host Server will automatically disabled

    $("input[name=crrf_act_vm_lvl]").click(function(){
        var crrf_act_vm_lvl = $(this).is(":checked");

        if (crrf_act_vm_lvl == true) {
            $("input[name=crrf_path_file_lvl]").prop('disabled',true);
        }else{
            $("input[name=crrf_path_file_lvl]").removeAttr('disabled');
        }     
    }); // It the Vm Level CHeckbox is Checked the Destination PATH FOLDER will automatically disabled 


    $("#crrf_specific_direct").click(function(){
        var crrf_specific_direct = $(this).is(":checked");
        if (crrf_specific_direct) {
            $("#lalabas").removeAttr('hidden');
        }else{
            $("#lalabas, #orig_warn_text").prop('hidden',true);
            $("input[name=specify_selection]").not(this).prop('checked',false).prop('required',false);
        }
    });
    // if specific directory is checked the hidden checkbox below will be automatically appeared.

    $("input[name=specify_selection]").click(function(){
        $("input[name=specify_selection]").not(this).prop('checked',false).prop('required',false);
        $("#orig_warn_text").prop('hidden',true);
    });
    // only 1 checkbox will be checked from its specify_selection

    $("#crrf_chk_orig").click(function(){
        var crrf_chk_orig = $(this).is(":checked");
        if (crrf_chk_orig) {
            $("#orig_warn_text").removeAttr('hidden');
        }else{
            $("#orig_warn_text").prop('hidden',true);
        }
    });
    // If the user select the Name Original Checkbox, It will appear the hidden context 
    
});