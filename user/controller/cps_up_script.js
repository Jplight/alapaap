$(document).ready(function(){

    var i = 2;
    $("#add_row_cps_up").click(function(){
        if ($(".cps_disk_req"+(i-1)).val() == '' || $(".cps_disk_info"+(i-1)).val() == '' || $(".cps_disk_remarks"+(i-1)).val() == '') {
            alert("Please Fill up the fields!"+(i-1));
        }else{
            $('#cps_tab_logic_up').append("<tr id='addr_up_cps"+i+"'><td></td><td><input class='form-control text-dark input-md cps_disk_req"+i+"' type='text' name='others_1[]'  /></td><td><input class='form-control text-dark input-md cps_disk_info"+i+"' type='text' name='others_2[]'  /></td><td><input class='form-control text-dark cps_disk_remarks"+i+"' type='text' name='others_3[]' ></td></tr>");
            i++;                
        }
    });

});




    $(document).ready(function(){

	    function get_data(){
	        $.ajax({
	            url: 'model/cps_up_model/search_model.php',
	            method: 'POST',
	            data: $("#frm_cps_up_id").serialize(),
	            dataType: 'JSON',
	            success: function(data){
	                if (data.status === '200') {
	                	$("input[name=cps_new_control_num]").val(data.cps_new_control_num);
	                	$("#cps_up_system_name").val(data.system_name);
	                	$("#cps_up_instance_name").val(data.instance_name);
	                    $("#cps_up_location").val(data.location);
	                    $("#cps_up_env_profile").val(data.env_profile)
	                    $("#cps_up_pattern").val(data.pattern);
	                    $("#cps_up_ip_add").val(data.ip_add);
	                    $("#cps_up_ip_group").val(data.ip_group);
	                    $("#cps_up_vcpu_size").val(data.vcpu_size);
	                    $("#cps_up_ram_size").val(data.ram_size);
	                    $("#cps_up_ue_enroll_size").val(data.ue_enroll_size);

	                    // alert("Jquery Testing Alert"+data.cluster);
	                    $("#btn_save_cps_up, #btn_submit_cps_up").removeAttr('disabled');
         				
         				$("#cps_up_disk").remove(); // this code will remove the DISK GB, if theres data tobe fetch
	                }
	                if (data.status === 'invalid') {
	                    $("#frm_cps_up_id").trigger('reset');
	                    $("#btn_save_cps_up, #btn_submit_cps_up").prop('disabled',true);
	                    alert(data.message);
	                    $("#cps_up_disk").remove();
	                }
	                if (data.status === 'failed') {
	                	alert(data.message);
	                    $("#frm_cps_up_id").trigger('reset');                   
	                    $("#cps_up_disk").remove(); // this code will remove the DISK GB, if theres data tobe fetch

	                }
	            }
	        });

	        $.ajax({
	            url: 'model/cps_up_model/get_others.php',
	            method: 'POST',
	            data: $("#frm_cps_up_id").serialize(),
	            success: function(data){
	                if (data) {
	                    $("#cps_up_load_others").html(data);
	                }
	            }
	        });
	    }

        $("#btn_cps_up_search").click(function(){
        	get_data();
        });

        $.ajaxSetup({
            cache: false
        });

        function ajax_loadcontent() {

            var searchField = $('#cps_up_search_txt').val();
            var expression = new RegExp(searchField, "i");
            $.ajax({
                url: "model/cps_up_model/get_id.php",
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#cps_up_search_result').empty();
                    $.each(data, function (key, value) {
                        if (value.hostname.search(expression) != -1) {
                            $('#cps_up_search_result').append('<li class="list-group-item list-group-item-action" id="' + value.hostname + '" style="cursor: pointer;"><span class="font-weight-bold sp_destination" id="' + value.hostname + '">' + value.hostname + '</span></li>');
                        }
                    });
                }
            });
        }
        

        $('#cps_up_search_txt').keyup(function () {
            ajax_loadcontent(); // load content while typing in your keyboard. this is the effect of using KeyUp
        }).keydown(function (e){
          if (e.which == 9) {
            $("#cps_up_search_result").html('');   // It means when you click Tab Button, the auto suggested word will be automatically clear.
          }
          if (e.which == 13) {
            return false; // It means the enter button of the keyboard is disabled within the Searchbox when click
          }
        }).focusin(function(){
            ajax_loadcontent(); // When the search has blinking cursor inside, It will load all of the data of database.
        });

        $('#cps_up_search_result').on('click', 'li', function () {
            var click_text = $(this).find("span.sp_destination").text(); //get text
            var id = $(this).attr('id'); //get id
            $("#cps_up_search_result").html(''); // it will clear all the recent value in the textbox
            $('#cps_up_search_txt').val($.trim(click_text)); //assign text
            get_data();
        });  
    });

   	// When autosuggest is appear and you accidentally click outside of the browser, the auto suggest will automatically hide.
	$(document).on('click', function (divclose) {
	    if ($(divclose.target).closest("#cps_up_search_txt").length == 0) {
	        $("#cps_up_search_result").hide();
	    } else {
	        $("#cps_up_search_result").show();
	    }
	});