
    $(document).ready(function(){

	    function get_data(){
	        $.ajax({
	            url: 'model/cps_del_model/search_model.php',
	            method: 'POST',
	            data: $("#frm_cps_del_id").serialize(),
	            dataType: 'JSON',
	            success: function(data){
	                if (data.status === '200') {
	                	$("input[name=cps_new_control_num]").val(data.cps_new_control_num);
						$("input[name=cps_up_control_num]").val(data.cps_up_control_num);


	                	$("#cps_del_system_name").val(data.system_name);
	                	$("#cps_del_instance_name").val(data.instance_name);
	                    $("#cps_del_location").val(data.location);
	                    $("#cps_del_env_profile").val(data.env_profile)
	                    $("#cps_del_pattern").val(data.pattern);
	                    $("#cps_del_ip_add").val(data.ip_add);
	                    $("#cps_del_ip_group").val(data.ip_group);
	                    $("#cps_del_vcpu_size").val(data.vcpu_size);
	                    $("#cps_del_ram_size").val(data.ram_size);
	                    $("#cps_del_ue_enroll_size").val(data.ue_enroll_size);

	                    $("#cps_del_vcpu_size_req").val(data.cps_del_vcpu_size_req);
	                    $("#cps_del_vcpu_filesystem").val(data.cps_del_vcpu_filesystem);
	                    $("#cps_del_vcpu_remarks").val(data.cps_del_vcpu_remarks);
	                    
	                    $("#cps_del_ram_size_req").val(data.cps_del_ram_size_req);
	                    $("#cps_del_ram_filesystem").val(data.cps_del_ram_filesystem);
	                    $("#cps_del_ram_remarks").val(data.cps_del_ram_remarks);
	                    $("#cps_del_ue_enroll_size_req").val(data.cps_del_ue_enroll_size_req);
	                    $("#cps_del_ue_filesystem").val(data.cps_del_ue_filesystem);
	                    $("#cps_del_ue_remarks").val(data.cps_del_ue_remarks);
	                    
	                    // alert("Jquery Testing Alert"+data.cluster);
	                    $("#btn_save_cps_del, #btn_submit_cps_del").removeAttr('disabled');
         				
         				$("#cps_del_disk").remove(); // this code will remove the DISK GB, if theres data tobe fetch
	                }
	                if (data.status === 'invalid') {
	                    $("#frm_cps_del_id").trigger('reset');
	                    $("#btn_save_cps_del, #btn_submit_cps_del").prop('disabled',true);
	                    alert(data.message);
	                    $("#cps_del_disk").remove();
	                }
	                if (data.status === 'failed') {
	                	alert(data.message);
	                    $("#frm_cps_del_id").trigger('reset');                   
	                    $("#cps_del_disk").remove(); // this code will remove the DISK GB, if theres data tobe fetch

	                }
	            }
	        });

	        $.ajax({
	            url: 'model/cps_del_model/get_others.php',
	            method: 'POST',
	            data: $("#frm_cps_del_id").serialize(),
	            success: function(data){
	                if (data) {
	                    $("#cps_del_load_others").html(data);
	                }
	            }
	        });
	    }

        $("#btn_cps_del_search").click(function(){
        	get_data();
        });

        $.ajaxSetup({
            cache: false
        });

        function ajax_loadcontent() {

            var searchField = $('#cps_del_search_txt').val();
            var expression = new RegExp(searchField, "i");
            $.ajax({
                url: "model/cps_del_model/get_id.php",
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#cps_del_search_result').empty();
                    $.each(data, function (key, value) {
                        if (value.hostname.search(expression) != -1) {
                            $('#cps_del_search_result').append('<li class="list-group-item list-group-item-action" id="' + value.hostname + '" style="cursor: pointer;"><span class="font-weight-bold sp_destination" id="' + value.hostname + '">' + value.hostname + '</span></li>');
                        }
                    });
                }
            });
        }
        

        $('#cps_del_search_txt').keyup(function () {
            ajax_loadcontent(); // load content while typing in your keyboard. this is the effect of using KeyUp
        }).keydown(function (e){
          if (e.which == 9) {
            $("#cps_del_search_result").html('');   // It means when you click Tab Button, the auto suggested word will be automatically clear.
          }
          if (e.which == 13) {
            return false; // It means the enter button of the keyboard is disabled within the Searchbox when click
          }
        }).focusin(function(){
            ajax_loadcontent(); // When the search has blinking cursor inside, It will load all of the data of database.
        });

        $('#cps_del_search_result').on('click', 'li', function () {
            var click_text = $(this).find("span.sp_destination").text(); //get text
            var id = $(this).attr('id'); //get id
            $("#cps_del_search_result").html(''); // it will clear all the recent value in the textbox
            $('#cps_del_search_txt').val($.trim(click_text)); //assign text
            get_data();
        });  
    });

   	// When autosuggest is appear and you accidentally click outside of the browser, the auto suggest will automatically hide.
	$(document).on('click', function (divclose) {
	    if ($(divclose.target).closest("#cps_del_search_txt").length == 0) {
	        $("#cps_del_search_result").hide();
	    } else {
	        $("#cps_del_search_result").show();
	    }
	});