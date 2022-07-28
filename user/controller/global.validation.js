$(document).ready(function () {
	let isConfirmed = false
	let global_message = ""
	let global_button = ""

	const data = [
		{
			form: "form_update",
			buttons: [
				{ name: "#btn_save_hci_up", msg: "Update_Draft" },
				{ name: "#btn_submit_hci_up", msg: "Update_Save" },
				{ name: "#btn_hci_up_update", msg: "btn_hci_up_update" },
				{ name: "#btn_hci_up_submit_draft", msg: "btn_hci_up_submit_draft" },
				{ name: "#btn_hci_up_resubmit", msg: "btn_hci_up_resubmit" },
				{ name: "#btn_hci_up_cancel", msg: "btn_hci_up_cancel" },
				{ name: "#btn_approver", msg: "btn_approver" },
				{ name: "#app_disapproved", msg: "app_disapproved" },
				{ name: "#approver_returned", msg: "approver_returned" },
				{ name: "#btn_reciever", msg: "btn_reciever" },
				{ name: "#btn_performer", msg: "btn_performer" },
				{ name: "#btn_confirmer", msg: "btn_confirmer" },
				{ name: "#btn_verifier", msg: "btn_verifier" },
			],
		},
		{
			form: "form_new",
			buttons: [
				{ name: "#btn_savehci", msg: "New_Draft" },
				{ name: "#btn_submit_hci", msg: "New_Save" },
				{ name: "#btn_update", msg: "btn_update" },
				{ name: "#btn_submit_draft", msg: "btn_submit_draft" },
				{ name: "#btn_resubmit", msg: "btn_resubmit" },
				{ name: "#hci_cancel_1", msg: "hci_cancel_1" },
				{ name: "#btn_approver", msg: "btn_approver" },
				{ name: "#app_disapproved", msg: "app_disapproved" },
				{ name: "#approver_returned", msg: "approver_returned" },
				{ name: "#btn_reciever", msg: "btn_reciever" },
				{ name: "#btn_performer", msg: "btn_performer" },
				{ name: "#btn_confirmer", msg: "btn_confirmer" },
				{ name: "#btn_verifier", msg: "btn_verifier" },
			],
		},
		{
			form: "form_delete",
			buttons: [
				{ name: "#btn_save_hci_del", msg: "Delete_Draft" },
				{ name: "#btn_submit_hci_del", msg: "Delete_Save" },
				{ name: "#btn_hci_del_update", msg: "btn_hci_del_update" },
				{ name: "#btn_hci_del_submit_draft", msg: "btn_hci_del_submit_draft" },
				{ name: "#btn_hci_del_resubmit", msg: "btn_hci_del_resubmit" },
				{ name: "#btn_hci_del_cancel", msg: "btn_hci_del_cancel" },
				{ name: "#btn_approver", msg: "btn_approver" },
				{ name: "#app_disapproved", msg: "app_disapproved" },
				{ name: "#approver_returned", msg: "approver_returned" },
				{ name: "#btn_reciever", msg: "btn_reciever" },
				{ name: "#btn_performer", msg: "btn_performer" },
				{ name: "#btn_confirmer", msg: "btn_confirmer" },
				{ name: "#btn_verifier", msg: "btn_verifier" },
			],
		},
		{
			form: "frm_cps_del_id",
			buttons: [
				{ name: "#btn_save_cps_del", msg: "btn_save_cps_del" },
				{ name: "#btn_submit_cps_del", msg: "btn_submit_cps_del" },
				{ name: "#btn_verifier", msg: "btn_verifier" },
				{ name: "#btn_confirmer", msg: "btn_confirmer" },
				{ name: "#btn_performer", msg: "btn_performer" },
				{ name: "#btn_reciever", msg: "btn_reciever" },
				{ name: "#approver_returned", msg: "approver_returned" },
				{ name: "#app_disapproved", msg: "app_disapproved" },
				{ name: "#btn_approver", msg: "btn_approver" },
				{ name: "#btn_cancel_cps_del", msg: "btn_cancel_cps_del" },
				{ name: "#btn_resubmit_cps_del", msg: "btn_resubmit_cps_del" },
				{ name: "#btn_submit_draft_cps_del", msg: "btn_submit_draft_cps_del" },
				{ name: "#btn_update_cps_del", msg: "btn_update_cps_del" },
			],
		},
		{
			form: "frm_cps_up_id",
			buttons: [
				{ name: "#btn_submit_cps_up", msg: "btn_submit_cps_up" },
				{ name: "#btn_save_cps_up", msg: "btn_save_cps_up" },
				{ name: "#btn_verifier", msg: "btn_verifier" },
				{ name: "#btn_confirmer", msg: "btn_confirmer" },
				{ name: "#btn_performer", msg: "btn_performer" },
				{ name: "#btn_reciever", msg: "btn_reciever" },
				{ name: "#approver_returned", msg: "approver_returned" },
				{ name: "#app_disapproved", msg: "app_disapproved" },
				{ name: "#btn_approver", msg: "btn_approver" },
				{ name: "#btn_cancel_cps_up", msg: "btn_cancel_cps_up" },
				{ name: "#btn_resubmit_cps_up", msg: "btn_resubmit_cps_up" },
				{ name: "#btn_submit_draft_cps_up", msg: "btn_submit_draft_cps_up" },
				{ name: "#btn_update_cps_up", msg: "btn_update_cps_up" },
			],
		},
		{
			form: "frm_cps_new_id",
			buttons: [
				{ name: "#btn_submit_cps", msg: "btn_submit_cps" },
				{ name: "#btn_save_cps", msg: "btn_save_cps" },
				{ name: "#btn_verifier", msg: "btn_verifier" },
				{ name: "#btn_confirmer", msg: "btn_confirmer" },
				{ name: "#btn_performer", msg: "btn_performer" },
				{ name: "#btn_reciever", msg: "btn_reciever" },
				{ name: "#approver_returned", msg: "approver_returned" },
				{ name: "#app_disapproved", msg: "app_disapproved" },
				{ name: "#btn_approver", msg: "btn_approver" },
				{ name: "#btn_cancel_cps", msg: "btn_cancel_cps" },
				{ name: "#btn_resubmit_cps", msg: "btn_resubmit_cps" },
				{ name: "#btn_submit_draft_cps", msg: "btn_submit_draft_cps" },
				{ name: "#btn_update_cps", msg: "btn_update_cps" },
			],
		},
		{
			form: "frm_baas_1",
			buttons: [
				{ name: "#btn_up_baas_csrf", msg: "btn_up_baas_csrf" },
				{ name: "#btn_sub_draft_csrf", msg: "btn_sub_draft_csrf" },
				{ name: "#btn_resub_baas_csrf", msg: "btn_resub_baas_csrf" },
				{ name: "#btn_cancel_csrf", msg: "btn_cancel_csrf" },
				{ name: "#btn_approver", msg: "btn_approver" },
				{ name: "#app_disapproved", msg: "app_disapproved" },
				{ name: "#approver_returned", msg: "approver_returned" },
				{ name: "#btn_reciever", msg: "btn_reciever" },
				{ name: "#btn_performer", msg: "btn_performer" },
				{ name: "#btn_confirmer", msg: "btn_confirmer" },
				{ name: "#btn_verifier", msg: "btn_verifier" },
				{ name: "#btn_baas_save_csrf", msg: "btn_baas_save_csrf" },
				{ name: "#btn_baas_csrf_submit", msg: "btn_baas_csrf_submit" },
			],
		},
		{
			form: "frm_baas_2",
			buttons: [
				{ name: "#btn_baas_crrf_submit", msg: "btn_baas_crrf_submit" },
				{ name: "#btn_baas_save_crrf", msg: "btn_baas_save_crrf" },
				{ name: "#btn_verifier", msg: "btn_verifier" },
				{ name: "#btn_confirmer", msg: "btn_confirmer" },
				{ name: "#btn_performer", msg: "btn_performer" },
				{ name: "#btn_reciever", msg: "btn_reciever" },
				{ name: "#approver_returned", msg: "approver_returned" },
				{ name: "#app_disapproved", msg: "app_disapproved" },
				{ name: "#btn_approver", msg: "btn_approver" },
				{ name: "#btn_cancel_crrf", msg: "btn_cancel_crrf" },
				{ name: "#btn_resub_baas_crrf", msg: "btn_resub_baas_crrf" },
				{ name: "#btn_sub_draft_crrf", msg: "btn_sub_draft_crrf" },
				{ name: "#btn_up_baas_crrf", msg: "btn_up_baas_crrf" },
			],
		},
	]

	const preventEvent = (e) => {
		e.preventDefault()
		e.stopPropagation()
	}

	const DialogBoxAlert = (event, message, button) => {
		// console.log(global_message)
		if (!isConfirmed) {
			preventEvent(event)
			Swal.fire({
				title: message,
				showDenyButton: true,
				confirmButtonText: "Submit",
				denyButtonText: `Cancel`,
			}).then((result) => {
				if (result.isConfirmed) {
					isConfirmed = true
					console.log("Sweet", global_button)
					$(button).click()
				}
			})
		}
	}

	for (let index = 0; index < data.length; index++) {
		const element = data[index]
		const form_name = element.form
		const buttons = element.buttons

		let form = $(`#${form_name}`)
		form.on("submit", (form_event) => {
			DialogBoxAlert(form_event, global_message, global_button)
		})

		for (let index = 0; index < buttons.length; index++) {
			const button = buttons[index]
			const button_name = button.name
			const message = button.msg
			$(button_name).click(function () {
				console.log(button_name, message)
				global_button = button_name
				global_message = message
			})
		}
	}

	$("#xxxx").click(() => {
		console.log("first")
	})

	let isConfirmDelete = false

	const r_cancel = $("#hci_r_cancel")
	r_cancel.on("click", (e) => {
		if (!isConfirmDelete) {
			e.preventDefault()
			Swal.fire({
				title: "You sure to delete",
				showDenyButton: true,
				confirmButtonText: "Submit",
				denyButtonText: `Cancel`,
			}).then((result) => {
				if (result.isConfirmed) {
					isConfirmDelete = true
					console.log(r_cancel.prop("href"))
					window.location.href = r_cancel.prop("href")
				}
			})
		}
	})
})
