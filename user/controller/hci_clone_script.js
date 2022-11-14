$(document).ready(function () {
	var i = 2

	$("#add_row").click(function () {
		if ($(".uid" + (i - 1)).val() == "") {
			alert("Disk Gb is required!")
			$(".uid" + (i - 1)).focus()
		} else {
			// $('#addr'+(i-1)).find('input').attr('disabled',true);
			// $('#addr'+(i-1)).find('input');

			$("#hci_clon_tab_logic").append(
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
			url: "model/hci_clone_model/search_model.php",
			method: "POST",
			data: $("#form_clone").serialize(),
			dataType: "JSON",
			success: function (data) {
				if (data.status === "200") {
					// site information
					$("#hci_clon_department").val(data.hci_clon_department)
					$("#hci_clon_location").val(data.hci_clon_location)
					$("#hci_clon_cluster").val(data.hci_clon_cluster)

					// request
					$("#hci_clon_vcpu").val(data.hci_clon_vcpu)
					$("#hci_clon_ram").val(data.hci_clon_ram)
					$("#hci_clon_os").val(data.hci_clon_os)
					$("#hci_clon_txt_os_descript").val(data.hci_clon_txt_os_descript)
					$("#hci_clon_ip_add_vlan").val(data.hci_clon_ip_add_vlan)
					$("#hci_clon_txt_ip_vlan").val(data.hci_clon_txt_ip_vlan)
					$("#hci_clon_vm_deployment").val(data.hci_clon_vm_deployment)
					$("#hci_clon_comm").val(data.hci_clon_comm)
					$("#hci_clon_users").val(data.hci_clon_users)

					// comment
					$("#hci_clon_vcpu_comment").val(data.hci_clon_vcpu_comment)
					$("#hci_clon_ram_comment").val(data.hci_clon_ram_comment)
					$("#hci_clon_os_comment").val(data.hci_clon_os_comment)
					$("#hci_clon_txt_define_parti").val(data.hci_clon_txt_define_parti)
					$("#hci_clon_os_comment").val(data.hci_clon_os_comment)
					$("#hci_clon_txt_define_parti").val(data.hci_clon_txt_define_parti)
					$("#hci_clon_ip_comment").val(data.hci_clon_ip_comment)
					$("#hci_clon_vlan_comment").val(data.hci_clon_vlan_comment)
					$("#hci_clon_txt_users").val(data.hci_clon_txt_users)
					$("#hci_clon_vm_deployment_comment").val(
						data.hci_clon_vm_deployment_comment
					)
					$("#hci_clon_comm_comment").val(data.hci_clon_comm_comment)

					$("#hci_clon_date_accomplished").val(data.date_accomplished)
					// 2022-08-16 19:36:55
					var options = {
						year: "numeric",
						month: "long",
						day: "numeric",
						time: "",
					}

					const nDate = new Date(data.date_accomplished)
					$("#hci_clon_date_accomplished").text(
						`${nDate.toLocaleDateString(
							"en-US",
							options
						)} ${nDate.toLocaleTimeString()}`
					)

					$("#hci_up_disk").remove() // this code will remove the DISK GB, if theres data tobe fetch
				}
				if (data.status === "invalid") {
					$("#form_clone").trigger("reset")
					$("#btn_savehci_up, #btn_submit_hci_up").prop("disabled", true)
					alert(data.message)
					$("#hci_up_disk").remove()
				}
				if (data.status === "failed") {
					alert(data.message)
					$("#form_clone").trigger("reset")
					$("#hci_up_disk").remove() // this code will remove the DISK GB, if theres data tobe fetch
				}
			},
		})

		$.ajax({
			url: "model/hci_clone_model/get_others.php",
			method: "POST",
			data: $("#form_clone").serialize(),
			success: function (data) {
				if (data) {
					$("#load_others_hci_clon").html(data)
				}
			},
		})
	}

	$("#btn_cloni_up_search").click(function () {
		get_data()
	})

	$.ajaxSetup({
		cache: false,
	})

	function ajax_loadcontent() {
		var searchField = $("#hci_clon_hostname").val()
		var expression = new RegExp(searchField, "i")
		$.ajax({
			url: "model/hci_clone_model/get_id.php",
			type: "GET",
			dataType: "JSON",
			success: function (data) {
				$("#hci_clon_search_result").empty()
				$.each(data, function (key, value) {
					if (value.hostname.search(expression) != -1) {
						$("#hci_clon_search_result").append(
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

	$("#hci_clon_hostname")
		.keyup(function () {
			ajax_loadcontent() // load content while typing in your keyboard. this is the effect of using KeyUp
		})
		.keydown(function (e) {
			if (e.which == 9) {
				$("#hci_clon_search_result").html("") // It means when you click Tab Button, the auto suggested word will be automatically clear.
			}
			if (e.which == 13) {
				return false // It means the enter button of the keyboard is disabled within the Searchbox when click
			}
		})
		.focusin(function () {
			ajax_loadcontent() // When the search has blinking cursor inside, It will load all of the data of database.
		})

	$("#hci_clon_search_result").on("click", "li", function () {
		var click_text = $(this).find("span.sp_destination").text() //get text
		var id = $(this).attr("id") //get id
		$("#hci_clon_search_result").html("") // it will clear all the recent value in the textbox
		$("#hci_clon_hostname").val($.trim(click_text)) //assign text
		get_data()
	})
})

// When autosuggest is appear and you accidentally click outside of the browser, the auto suggest will automatically hide.
$(document).on("click", function (divclose) {
	if ($(divclose.target).closest("#hci_clon_hostname").length == 0) {
		$("#hci_clon_search_result").hide()
	} else {
		$("#hci_clon_search_result").show()
	}
})
