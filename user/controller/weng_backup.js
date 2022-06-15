
$(document).ready(function(){
    // alert("Jquery has been activated");
    $("input[name=csrf_department]").click(function(){
        var csrf_department = $("input[name=csrf_department]").is(":checked");
        if (csrf_department) {
            $('input[name="csrf_department"]').removeAttr('required');
        }else{
            $('input[name="csrf_department"]').attr('required',true);
        }
        $('input[name="csrf_department"]').not(this).prop('checked',false);
        $('#csrf_txt_others').val('').addClass('invisible');
    });

    // Check if the Group Checkbox is already checked.
    function group_sect(){
        var csrf_department = $("input[name=csrf_department]").is(":checked");
        if (csrf_department) {
            $("input[name=csrf_department]").removeAttr('required');

        }       
    }    

    function group_form_factor(){
        var csrf_form_factor = $('input[name="csrf_form_factor"]').is(":checked");
        if (csrf_form_factor) {
             $('input[name="csrf_form_factor"]').removeAttr('required');
        }       
    }

    function group_operating_system(){
        var csrf_operating_system = $('.csrf_operating_system').is(":checked");
        if (csrf_operating_system) {
             $('.csrf_operating_system').removeAttr('required');
        }        
    }

    function checkbox_aix(){
        var csrf_os_aix = $("#csrf_os_aix").is(":checked");
        if (csrf_os_aix) {
            $("#csrf_os_aix").removeAttr('required');
            $("#csrf_aix_ver").removeAttr('disabled');
            $("#csrf_aix_ver").prop('required',true);
        }else{
            $("#csrf_os_aix").prop('required',true);
            $("#csrf_aix_ver").removeAttr('required').prop('disabled',true);
        }        
    }

    function checkbox_rhel(){
        var csrf_os_rhel = $("#csrf_os_rhel").is(":checked");
        if (csrf_os_rhel) {
            $("#csrf_os_rhel").removeAttr('required');
            $("#csrf_ver_rhel").removeAttr('disabled');
            $("#csrf_ver_rhel").prop('required',true);
        }else{
            $("#csrf_os_rhel").prop('required',true);
            $("#csrf_ver_rhel").removeAttr('required').prop('disabled',true).val('');
        }        
    }

    function checkbox_windows(){
        var csrf_os_windows = $("#csrf_os_windows").is(":checked");
        if (csrf_os_windows) {
            $("#csrf_os_windows").removeAttr('required');
            $("#csrf_windows_ver").removeAttr('disabled');
            $("#csrf_windows_ver").prop('required',true);
        }else{
            $("#csrf_os_windows").prop('required',true);
            $("#csrf_windows_ver").removeAttr('required').prop('disabled',true);
        }        
    }

    function checkbox_ios(){
        var csrf_os_ios = $("#csrf_os_ios").is(":checked");
        if (csrf_os_ios) {
            $("#csrf_os_ios").removeAttr('required');
            $("#csrf_ios_ver").removeAttr('disabled');
            $("#csrf_ios_ver").prop('required',true);
        }else{
            $("#csrf_os_ios").prop('required',true);
            $("#csrf_ios_ver").removeAttr('required').prop('disabled',true).val('');
        }        
    }

    function checkbox_oel(){
        var csrf_os_oel = $("#csrf_os_oel").is(":checked");
        if (csrf_os_oel) {
            $("#csrf_os_oel").removeAttr('required');
            $("#csrf_ver_oel").removeAttr('disabled');
            $("#csrf_ver_oel").prop('required',true);
        }else{
            $("#csrf_os_oel").prop('required',true);
            $("#csrf_ver_oel").removeAttr('required').prop('disabled',true).val('');
        }
    }

    function checkbox_db2(){
        var csrf_act_vm_lvl = $("input[name=csrf_act_vm_lvl]");
        var csrf_db_db2 = $("#csrf_db_db2, #csrf_db_mssql, #csrf_db_others");

        if (csrf_db_db2.is(':checked')) {
            $(csrf_act_vm_lvl).click(function(){
                if (csrf_db_db2.is(':checked') && csrf_act_vm_lvl.is(':checked')) {
                    $('input[name=csrf_act_backup], input[name=csrf_act_archive], input[name=csrf_act_bmr], input[name=csrf_act_file_lvl]').prop('disabled',true).prop('checked',false);
                    $(".csrf_backup_archive").prop('disabled',true);
                    $(".backup_archive_text").prop('disabled',true).val('');
                } 
                if (csrf_act_vm_lvl.is(':checked') == false) {
                    $("input[name=csrf_act_file_lvl], .csrf_backup_archive").removeAttr('disabled');
                    $(".backup_archive_text").removeAttr('disabled').val('');
                    $('input[name=csrf_act_backup], input[name=csrf_act_archive], input[name=csrf_act_bmr]').prop('disabled',true).prop('checked',false);
                }    
            });
            $("input[name=csrf_act_backup], input[name=csrf_act_archive], input[name=csrf_act_bmr]").prop('disabled',true).prop('checked',false);
        } 
        if (csrf_db_db2.is(':checked') == false) {
            $("input[name=csrf_act_backup], input[name=csrf_act_archive], input[name=csrf_act_bmr], input[name=csrf_act_file_lvl]").removeAttr('disabled').prop('checked',false);
            $(csrf_act_vm_lvl).prop('checked',false);
        }
    }
    
    function checkbox_oracle(){
        var csrf_act_vm_lvl = $("input[name=csrf_act_vm_lvl]");
        var csrf_db_oracle = $("#csrf_db_oracle");
        if (csrf_db_oracle.is(':checked')) {
            $(csrf_act_vm_lvl).click(function(){
                if (csrf_db_oracle.is(':checked') && csrf_act_vm_lvl.is(':checked')) {
                    $('input[name=csrf_act_backup], input[name=csrf_act_archive], input[name=csrf_act_bmr], input[name=csrf_act_file_lvl]').prop('disabled',true).prop('checked',false);
                    $(".csrf_backup_archive").prop('disabled',true);
                    $(".backup_archive_text").prop('disabled',true).val('');
                } 
                if (csrf_act_vm_lvl.is(':checked') == false) {
                    $(".backup_archive_text").removeAttr('disabled').val('');
                    $("input[name=csrf_act_backup], input[name=csrf_act_archive], .csrf_backup_archive").removeAttr('disabled');
                    $("input[name=csrf_act_bmr], input[name=csrf_act_file_lvl]").prop('disabled',true);
                }    
            });
            $('input[name=csrf_act_bmr], input[name=csrf_act_file_lvl]').prop('disabled',true).prop('checked',false);
        } 
        if (csrf_db_oracle.is(':checked') == false) {
            $("input[name=csrf_act_backup], input[name=csrf_act_archive], input[name=csrf_act_bmr], input[name=csrf_act_file_lvl]").removeAttr('disabled').prop('checked',false);
            $(csrf_act_vm_lvl).prop('checked',false)
        }    
    }

    function checkbox_file_level(){
        var csrf_chk_file_lvl = $("#csrf_chk_file_lvl").is(":checked");
        if (csrf_chk_file_lvl) {
            $('.b_a').prop('disabled',false);
        } else {
            $('.b_a, input[name=csrf_act_bmr]').prop('disabled',true).prop('checked',false);
        }         
    }

    group_sect();
    group_form_factor();
    group_operating_system();
    checkbox_aix();
    checkbox_rhel();
    checkbox_windows();
    checkbox_ios();
    checkbox_oel();
    checkbox_db2();
    checkbox_oracle();
    checkbox_file_level();
    checkbox_db_type();



    $("#csrf_chk_dcou").click(function(){
        var csrf_chk_dcou = $(this).is(":checked");
        if (csrf_chk_dcou) {
            $("#csrf_txt_others").removeClass('invisible').prop('required',true);
        }else{
            $("#csrf_txt_others").addClass('invisible').prop('required',false);
        }
    });
    // if Checkbox Others is checked It will appear the textbox beside of others checkbox


    $("input[name=csrf_form_factor]").click(function(){
        var csrf_form_factor = $('input[name="csrf_form_factor"]').is(":checked");
        if (csrf_form_factor) {
             $('input[name="csrf_form_factor"]').removeAttr('required');
         }else{
             $('input[name="csrf_form_factor"]').attr('required',true);
         }
        $('input[name="csrf_form_factor"]').not(this).prop('checked',false);  
    });
    // Validation for Checkbox Form Factors

    $(".csrf_operating_system").click(function(){
        $('.csrf_operating_system').not(this).prop('checked',false).prop('required',false);
        $('#csrf_ios_ver, #csrf_ver_oel, #csrf_ver_rhel, #csrf_aix_ver, #csrf_windows_ver').not(this).prop('disabled',true).prop('required',false).val('');
    });

//=============================================================================
    $("#csrf_os_aix").click(function(){
        checkbox_aix();
    });

//=============================================================================

    $("#csrf_os_rhel").click(function(){
        checkbox_rhel();
    });
//=============================================================================

    $("#csrf_os_windows").click(function(){
        checkbox_windows();
    });
//=============================================================================

    $("#csrf_os_ios").click(function(){
        checkbox_ios();
    });

//=============================================================================

    $("#csrf_os_oel").click(function(){
        checkbox_oel();
    });

//=============================================================================

    function checkbox_db_type(){
        var csrf_db_db2 = $("#csrf_db_db2").is(":checked");
        var csrf_db_oracle = $("#csrf_db_oracle").is(":checked");
        var csrf_db_mssql = $("#csrf_db_mssql").is(":checked");
        var csrf_db_others = $("#csrf_db_others").is(":checked");

        if (csrf_db_db2) {
           $("#csrf_db2_ver").removeAttr('disabled');
        }
        if (csrf_db_oracle) {
            $("#csrf_oracle_ver").removeAttr('disabled');
        }
        if (csrf_db_mssql) {
            $("#csrf_mssql_ver").removeAttr('disabled');
        }
        if (csrf_db_others) {
            $("#csrf_others_ver").removeAttr('disabled');
        }        
    }
    
    

    $(".csrf_db_type").click(function(){

        $('.csrf_db_type').not(this).prop('checked',false);
        $(".db_action, .action_lvl").prop('disabled',false).prop('checked',false);
        $(".csrf_backup_archive").removeAttr('disabled');
        $(".backup_archive_text").removeAttr('disabled').val('');

        if ($("#csrf_db_db2").is(":checked")) {
           $("#csrf_db2_ver").removeAttr('disabled');
           $("#csrf_oracle_ver, #csrf_mssql_ver, #csrf_others_ver").prop('disabled',true).val('');
        }
        if ($("#csrf_db_oracle").is(":checked")) {
            $("#csrf_oracle_ver").removeAttr('disabled');
            $("#csrf_db2_ver, #csrf_mssql_ver, #csrf_others_ver").prop('disabled',true).val('');
        }
        if ($("#csrf_db_mssql").is(":checked")) {
            $("#csrf_mssql_ver").removeAttr('disabled');
            $("#csrf_db2_ver, #csrf_oracle_ver, #csrf_others_ver").prop('disabled',true).val('');
        }
        if ($("#csrf_db_others").is(":checked")) {
            $("#csrf_others_ver").removeAttr('disabled');
            $("#csrf_db2_ver, #csrf_oracle_ver, #csrf_mssql_ver").prop('disabled',true).val('');
        }
    });



    $("#csrf_db_db2, #csrf_db_mssql, #csrf_db_others").click(function (event) {
        checkbox_db2();
    });


    $("#csrf_db_oracle").click(function (event) {
        checkbox_oracle();
    });

//=============================================================================
    


    $("#csrf_chk_file_lvl").click(function(){
        checkbox_file_level();
    });
    

    $(".b_a").click(function(){
        var csrf_act_file_lvl = $("input[name=csrf_act_file_lvl]").is(":checked");
        var b_a = $(".b_a").is(":checked");

        if (csrf_act_file_lvl && b_a) {
            $('input[name=csrf_act_bmr]').prop('disabled',false);
        }else{
            $('input[name=csrf_act_bmr]').prop('disabled',true).prop('checked',false);
        }
    });



    $('.csrf_backup_archive').click(function(){
        $('.csrf_backup_archive').not(this).prop('checked',false);
    });

    $('.csrf_sched_backup').click(function(){
        $('.csrf_sched_backup').not(this).prop('checked',false);
    });

    $('.csrf_retention').click(function(){
        $('.csrf_retention').not(this).prop('checked',false);
    });


});