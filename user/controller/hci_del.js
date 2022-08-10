$(document).ready(function () {
	function get_data() {
		$.ajax({
			url: "model/hci_del_model/search_model.php",
			method: "POST",
			data: $("#frm_id_del").serialize(),
			dataType: "JSON",
			success: function (data) {
				if (data.status === "200") {
					$("#hci_new_control_num").val(data.hci_new_control_num)
					$("#hci_up_control_num").val(data.hci_up_control_num)

					// Data of New HCI
					$("#hci_del_department").val(data.department)
					$("#hci_del_location").val(data.location)
					$("#hci_del_cluster").val(data.cluster)
					$("#hci_del_vcpu").val(data.vcpu)
					$("#hci_del_ram").val(data.ram)
					$("#hci_del_os_old").val(data.os)
					$("#hci_del_os_desc_old").val(data.txt_os_descript)
					$("#hci_del_ipaddress").val(data.ip_add_vlan)
					$("#hci_del_ip_vlan").val(data.txt_ip_vlan)
					$("#hci_del_users").val(data.hci_users)

					// DATA of Update HCI form
					$("#hci_del_req_vcpu").val(data.hci_del_req_vcpu)
					$("#hci_del_req_ram").val(data.hci_del_req_ram)
					$("#hci_del_req_os_new").val(data.hci_del_req_os_new)
					$("#hci_del_req_desc").val(data.hci_del_req_desc)
					$("#hci_del_req_ipadd").val(data.hci_del_req_ipadd)
					$("#hci_del_req_vlan").val(data.hci_del_req_vlan)
					$("#hci_del_req_users").val(data.hci_del_req_users)

					$("#hci_del_vcpu_comment").val(data.hci_del_vcpu_comment)
					$("#hci_del_ram_comment").val(data.hci_del_ram_comment)
					$("#hci_del_os_comment").val(data.hci_del_os_comment)
					$("#hci_del_req_parti").val(data.hci_del_req_parti)
					$("#hci_del_ipadd_comment").val(data.hci_del_ipadd_comment)
					$("#hci_del_vlan_comment").val(data.hci_del_vlan_comment)
					$("#hci_del_users_comment").val(data.hci_del_users_comment)
					// alert("Jquery Testing Alert"+data.cluster);
					$("#btn_save_hci_del, #btn_submit_hci_del").removeAttr("disabled")

					$("#hci_del_disk").remove() // this code will remove the DISK GB, if theres data tobe fetch
				}
				if (data.status === "invalid") {
					alert(data.message)
					$("#frm_id_del").trigger("reset")
					$("#btn_save_hci_del, #btn_submit_hci_del").prop("disabled", true)
					$("#hci_del_disk").remove() // this code will remove the DISK GB, if theres data tobe fetch
				}
				if (data.status === "failed") {
					alert(data.message)
					$("#frm_id_del").trigger("reset")
					$("#hci_del_disk").remove() // this code will remove the DISK GB, if theres data tobe fetch
				}
			},
		})

		$.ajax({
			url: "model/hci_del_model/get_others.php",
			method: "POST",
			data: $("#frm_id_del").serialize(),
			success: function (data) {
				if (data) {
					$("#del_load_others").html(data)
				}
			},
		})
	}

	$("#btn_hci_del_search").click(function () {
		get_data()
	})

	$.ajaxSetup({
		cache: false,
	})

	function ajax_loadcontent() {
		var searchField = $("#hci_del_search_txt").val()
		var expression = new RegExp(searchField, "i")

		$.ajax({
			url: "model/hci_del_model/get_id.php",
			type: "GET",
			dataType: "JSON",
			success: function (data) {
				$("#hci_del_search_result").empty()
				$.each(data, function (key, value) {
					if (value.hostname.search(expression) != -1) {
						$("#hci_del_search_result").append(
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

	$("#hci_del_search_txt")
		.keyup(function () {
			ajax_loadcontent() // load content while typing in your keyboard. this is the effect of using KeyUp
		})
		.keydown(function (e) {
			if (e.which == 9) {
				$("#hci_del_search_result").html("") // It means when you click Tab Button, the auto suggested word will be automatically clear.
			}
			if (e.which == 13) {
				return false // It means the enter button of the keyboard is disabled within the Searchbox when click
			}
		})
		.focusin(function () {
			ajax_loadcontent() // When the search has blinking cursor inside, It will load all of the data of database.
		})

	$("#hci_del_search_result").on("click", "li", function () {
		var click_text = $(this).find("span.sp_destination").text() //get text
		var id = $(this).attr("id") //get id
		$("#hci_del_search_result").html("") // it will clear all the recent value in the textbox
		$("#hci_del_search_txt").val($.trim(click_text)) //assign text
		get_data()
	})
})

// When autosuggest is appear and you accidentally click outside of the browser, the auto suggest will automatically hide.
$(document).on("click", function (divclose) {
	if ($(divclose.target).closest("#hci_del_search_txt").length == 0) {
		$("#hci_del_search_result").hide()
	} else {
		$("#hci_del_search_result").show()
	}
})
