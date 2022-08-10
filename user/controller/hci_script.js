$(document).ready(function () {
	var i = 2

	$("#add_row").click(function () {
		if ($(".uid" + (i - 1)).val() == "" || $(".uname" + (i - 1)).val() == "") {
			alert("Please Fill up the fields!" + (i - 1))
		} else {
			// $('#addr'+(i-1)).find('input').attr('disabled',true);
			// $('#addr'+(i-1)).find('input');

			$("#hci_tab_logic").append(
				"<tr id='addr" +
					i +
					"'><td></td><td><input class='form-control text-dark input-md uid" +
					i +
					"' type='text' name='others_1[]'  /></td><td><input class='form-control text-dark input-md uname" +
					i +
					"' type='text' name='others_2[]'  /></td></tr>"
			)
			i++
		}
	})
})

$(document).ready(function () {
	function get_data() {
		$.ajax({
			url: "model/hci_up_model/search_model.php",
			method: "POST",
			data: $("#form_update").serialize(),
			dataType: "JSON",
			success: function (data) {
				if (data.status === "200") {
					$("input[name=hci_new_control_num]").val(data.hci_new_control_num)
					$("#hci_up_department").val(data.department)
					$("#hci_up_location").val(data.location)
					$("#hci_up_cluster").val(data.cluster)
					$("#hci_up_vcpu").val(data.vcpu)
					$("#hci_up_ram").val(data.ram)
					$("#hci_up_os_old").val(data.os)
					$("#hci_up_os_desc_old").val(data.txt_os_descript)
					$("#hci_up_ipaddress").val(data.ip_add_vlan)
					$("#hci_up_ip_vlan").val(data.txt_ip_vlan)
					$("#hci_up_users").val(data.hci_users)
					// alert("Jquery Testing Alert"+data.cluster);
					$("#btn_savehci_up, #btn_submit_hci_up").removeAttr("disabled")

					$("#hci_up_disk").remove() // this code will remove the DISK GB, if theres data tobe fetch
				}
				if (data.status === "invalid") {
					$("#form_update").trigger("reset")
					$("#btn_savehci_up, #btn_submit_hci_up").prop("disabled", true)
					alert(data.message)
					$("#hci_up_disk").remove()
				}
				if (data.status === "failed") {
					alert(data.message)
					$("#form_update").trigger("reset")
					$("#hci_up_disk").remove() // this code will remove the DISK GB, if theres data tobe fetch
				}
			},
		})

		$.ajax({
			url: "model/hci_up_model/get_others.php",
			method: "POST",
			data: $("#form_update").serialize(),
			success: function (data) {
				if (data) {
					$("#load_others").html(data)
				}
			},
		})
	}

	$("#btn_hci_up_search").click(function () {
		get_data()
	})

	$.ajaxSetup({
		cache: false,
	})

	function ajax_loadcontent() {
		var searchField = $("#hci_up_search_txt").val()
		var expression = new RegExp(searchField, "i")
		$.ajax({
			url: "model/hci_up_model/get_id.php",
			type: "GET",
			dataType: "JSON",
			success: function (data) {
				$("#hci_up_search_result").empty()
				$.each(data, function (key, value) {
					if (value.hostname.search(expression) != -1) {
						$("#hci_up_search_result").append(
							'<li class="list-group-item list-group-item-action" id="' +
								value.hostname +
								'" style="cursor: pointer;"><span class="font-weight-bold sp_destination" id="' +
								value.hostname +
								'">' +
								value.hostname +
								"</span></li>"
						)
					}
				})
			},
		})
	}

	$("#hci_up_search_txt")
		.keyup(function () {
			ajax_loadcontent() // load content while typing in your keyboard. this is the effect of using KeyUp
		})
		.keydown(function (e) {
			if (e.which == 9) {
				$("#hci_up_search_result").html("") // It means when you click Tab Button, the auto suggested word will be automatically clear.
			}
			if (e.which == 13) {
				return false // It means the enter button of the keyboard is disabled within the Searchbox when click
			}
		})
		.focusin(function () {
			ajax_loadcontent() // When the search has blinking cursor inside, It will load all of the data of database.
		})

	$("#hci_up_search_result").on("click", "li", function () {
		var click_text = $(this).find("span.sp_destination").text() //get text
		var id = $(this).attr("id") //get id
		$("#hci_up_search_result").html("") // it will clear all the recent value in the textbox
		$("#hci_up_search_txt").val($.trim(click_text)) //assign text
		get_data()
	})
})

// When autosuggest is appear and you accidentally click outside of the browser, the auto suggest will automatically hide.
$(document).on("click", function (divclose) {
	if ($(divclose.target).closest("#hci_up_search_txt").length == 0) {
		$("#hci_up_search_result").hide()
	} else {
		$("#hci_up_search_result").show()
	}
})
