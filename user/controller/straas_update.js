
$(document).ready(function () {
	function get_data() {
		$.ajax({
			url: "model/straas_up_model/search_model.php",
			method: "POST",
			data: $("#form_update_straas").serialize(),
			dataType: "JSON",
			success: function (data) {
				if (data.status === "200") {
					$("input[name=straas_new_control_num]").val(data.straas_new_control_num)
					$("#straas_up_department").val(data.department)
					$("#straas_up_location").val(data.location)
					
					$("#straas_up_host_port, #straas_up_req_host_port").val(data.host_port)
					

					// 2022-08-16 19:36:55
					var options = {
						year: "numeric",
						month: "long",
						day: "numeric",
						time: "",
					}

					const nDate = new Date(data.date_accomplished)
					$("#straas_date_accomplished").text(
						`${nDate.toLocaleDateString(
							"en-US",
							options
						)} ${nDate.toLocaleTimeString()}`
					)

					// alert("Jquery Testing Alert"+data.cluster);
					$("#btn_save_straas_up, #btn_submit_straas_up").removeAttr("disabled")

					$("#straas_up_disk").remove() // this code will remove the DISK GB, if theres data tobe fetch
				}
				if (data.status === "invalid") {
					$("#form_update_straas").trigger("reset")
					$("#btn_save_straas_up, #btn_submit_straas_up").prop("disabled", true)
					alert(data.message)
					$("#straas_up_disk").remove()
				}
				if (data.status === "failed") {
					alert(data.message)
					$("#form_update_straas").trigger("reset")
					$("#straas_up_disk").remove() // this code will remove the DISK GB, if theres data tobe fetch
				}
			},
		})

		$.ajax({
			url: "model/straas_up_model/get_others.php",
			method: "POST",
			data: $("#form_update_straas").serialize(),
			success: function (data) {
				if (data) {
					$("#straas_load_others").html(data)
					// console.log(data)
				}
			},
		})
	}

	$("#btn_straas_up_search").click(function () {
		get_data()
	})

	$.ajaxSetup({
		cache: false,
	})

	function ajax_loadcontent() {
		var searchField = $("#straas_up_search_txt").val()
		var expression = new RegExp(searchField, "i")
		$.ajax({
			url: "model/straas_up_model/get_id.php",
			type: "GET",
			dataType: "JSON",
			success: function (data) {
				$("#straas_up_search_result").empty()
				$.each(data, function (key, value) {
					if (value.hostname.search(expression) != -1) {
						$("#straas_up_search_result").append(
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

	$("#straas_up_search_txt")
		.keyup(function () {
			ajax_loadcontent() // load content while typing in your keyboard. this is the effect of using KeyUp
		})
		.keydown(function (e) {
			if (e.which == 9) {
				$("#straas_up_search_result").html("") // It means when you click Tab Button, the auto suggested word will be automatically clear.
			}
			if (e.which == 13) {
				return false // It means the enter button of the keyboard is disabled within the Searchbox when click
			}
		})
		.focusin(function () {
			ajax_loadcontent() // When the search has blinking cursor inside, It will load all of the data of database.
		})

	$("#straas_up_search_result").on("click", "li", function () {
		var click_text = $(this).find("span.sp_destination").text() //get text
		var id = $(this).attr("id") //get id
		$("#straas_up_search_result").html("") // it will clear all the recent value in the textbox
		$("#straas_up_search_txt").val($.trim(click_text)) //assign text
		get_data()
	})
})

// When autosuggest is appear and you accidentally click outside of the browser, the auto suggest will automatically hide.
$(document).on("click", function (divclose) {
	if ($(divclose.target).closest("#straas_up_search_txt").length == 0) {
		$("#straas_up_search_result").hide()
	} else {
		$("#straas_up_search_result").show()
	}
})
