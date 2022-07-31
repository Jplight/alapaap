$(document).ready(function () {
	let isConfirmed = false
	let global_message = ""
	let global_button = ""

	const data = [
		{
			form: "form_update",
			buttons: [
				{ name: "#btn_save_hci_up", msg: "Save as draft?" },
				{ name: "#btn_submit_hci_up", msg: "Do you want to submit?" },
				{ name: "#btn_hci_up_update", msg: "Do you want to update?" },
				{ name: "#btn_hci_up_submit_draft", msg: "Submit draft?" },
				{ name: "#btn_hci_up_resubmit", msg: "Resubmit this form?" },
				{ name: "#btn_hci_up_cancel", msg: "Do you wish to cancel this form?" },
				{ name: "#btn_approver", msg: "Approve this form?" },
				{ name: "#app_disapproved", msg: "Disapprove this form?" },
				{ name: "#approver_returned", msg: "Return this form?" },
				{ name: "#btn_reciever", msg: "Acknowledge the request?" },
				{
					name: "#btn_performer",
					msg: "Are you sure you performed the request?",
				},
				{ name: "#btn_confirmer", msg: "Request Confirmed?" },
				{ name: "#btn_verifier", msg: "Request Verified?" },
			],
		},
		{
			form: "form_new",
			buttons: [
				{ name: "#btn_savehci", msg: "Save as draft?" },
				{ name: "#btn_submit_hci", msg: "Do you want to submit?" },
				{ name: "#btn_update", msg: "Do you want to update?" },
				{ name: "#btn_submit_draft", msg: "Submit draft?" },
				{ name: "#btn_resubmit", msg: "Resubmit this form?" },
				{ name: "#hci_cancel_1", msg: "Do you wish to cancel this form?" },
				{ name: "#btn_approver", msg: "Approve this form?" },
				{ name: "#app_disapproved", msg: "Disapprove this form?" },
				{ name: "#approver_returned", msg: "Return this form?" },
				{ name: "#btn_reciever", msg: "Acknowledge the request?" },
				{
					name: "#btn_performer",
					msg: "Are you sure you performed the request?",
				},
				{ name: "#btn_confirmer", msg: "Request Confirmed?" },
				{ name: "#btn_verifier", msg: "Request Verified?" },
			],
		},
		{
			form: "form_delete",
			buttons: [
				{ name: "#btn_save_hci_del", msg: "Save as draft?" },
				{ name: "#btn_submit_hci_del", msg: "Do you want to submit?" },
				{ name: "#btn_hci_del_update", msg: "Do you want to update?" },
				{ name: "#btn_hci_del_submit_draft", msg: "Submit draft?" },
				{ name: "#btn_hci_del_resubmit", msg: "Resubmit this form?" },
				{
					name: "#btn_hci_del_cancel",
					msg: "Do you wish to cancel this form?",
				},
				{ name: "#btn_approver", msg: "Approve this form?" },
				{ name: "#app_disapproved", msg: "Disapprove this form?" },
				{ name: "#approver_returned", msg: "Return this form?" },
				{ name: "#btn_reciever", msg: "Acknowledge the request?" },
				{
					name: "#btn_performer",
					msg: "Are you sure you performed the request?",
				},
				{ name: "#btn_confirmer", msg: "Request Confirmed?" },
				{ name: "#btn_verifier", msg: "Request Verified?" },
			],
		},
		{
			form: "frm_cps_del_id",
			buttons: [
				{ name: "#btn_save_cps_del", msg: "Save as draft?" },
				{ name: "#btn_submit_cps_del", msg: "Do you want to submit?" },
				{
					name: "#btn_cancel_cps_del",
					msg: "Do you wish to cancel this form?",
				},
				{ name: "#btn_resubmit_cps_del", msg: "Resubmit this form?" },
				{ name: "#btn_submit_draft_cps_del", msg: "Submit draft" },
				{ name: "#btn_update_cps_del", msg: "Do you want to update?" },
				{ name: "#btn_approver", msg: "Approve this form?" },
				{ name: "#app_disapproved", msg: "Disapprove this form?" },
				{ name: "#approver_returned", msg: "Return this form?" },
				{ name: "#btn_reciever", msg: "Acknowledge the request?" },
				{
					name: "#btn_performer",
					msg: "Are you sure you performed the request?",
				},
				{ name: "#btn_confirmer", msg: "Request Confirmed?" },
				{ name: "#btn_verifier", msg: "Request Verified?" },
			],
		},
		{
			form: "frm_cps_up_id",
			buttons: [
				{ name: "#btn_submit_cps_up", msg: "Do you want to submit?" },
				{ name: "#btn_save_cps_up", msg: "Save as draft?" },
				{ name: "#btn_cancel_cps_up", msg: "Do you wish to cancel this form?" },
				{ name: "#btn_resubmit_cps_up", msg: "Resubmit this form?" },
				{ name: "#btn_submit_draft_cps_up", msg: "Submit draft?" },
				{ name: "#btn_update_cps_up", msg: "Do you want to update?" },
				{ name: "#btn_approver", msg: "Approve this form?" },
				{ name: "#app_disapproved", msg: "Disapprove this form?" },
				{ name: "#approver_returned", msg: "Return this form?" },
				{ name: "#btn_reciever", msg: "Acknowledge the request?" },
				{
					name: "#btn_performer",
					msg: "Are you sure you performed the request?",
				},
				{ name: "#btn_confirmer", msg: "Request Confirmed?" },
				{ name: "#btn_verifier", msg: "Request Verified?" },
			],
		},
		{
			form: "frm_cps_new_id",
			buttons: [
				{ name: "#btn_submit_cps", msg: "Save as draft?" },
				{ name: "#btn_save_cps", msg: "Do you want to submit?" },
				{ name: "#btn_cancel_cps", msg: "Submit draft?" },
				{ name: "#btn_resubmit_cps", msg: "Resubmit this form?" },
				{ name: "#btn_submit_draft_cps", msg: "btn_submit_draft_cps" },
				{ name: "#btn_update_cps", msg: "btn_update_cps" },
				{ name: "#btn_approver", msg: "Approve this form?" },
				{ name: "#app_disapproved", msg: "Disapprove this form?" },
				{ name: "#approver_returned", msg: "Return this form?" },
				{ name: "#btn_reciever", msg: "Acknowledge the request?" },
				{
					name: "#btn_performer",
					msg: "Are you sure you performed the request?",
				},
				{ name: "#btn_confirmer", msg: "Request Confirmed?" },
				{ name: "#btn_verifier", msg: "Request Verified?" },
			],
		},
		{
			form: "frm_baas_1",
			buttons: [
				{ name: "#btn_up_baas_csrf", msg: "Do you want to update?" },
				{ name: "#btn_sub_draft_csrf", msg: "Submit draft?" },
				{ name: "#btn_resub_baas_csrf", msg: "Resubmit this form?" },
				{ name: "#btn_cancel_csrf", msg: "Do you wish to cancel this form?" },
				{ name: "#btn_baas_save_csrf", msg: "Save as draft?" },
				{ name: "#btn_baas_csrf_submit", msg: "Do you want to submit?" },
				{ name: "#btn_approver", msg: "Approve this form?" },
				{ name: "#app_disapproved", msg: "Disapprove this form?" },
				{ name: "#approver_returned", msg: "Return this form?" },
				{ name: "#btn_reciever", msg: "Acknowledge the request?" },
				{
					name: "#btn_performer",
					msg: "Are you sure you performed the request?",
				},
				{ name: "#btn_confirmer", msg: "Request Confirmed?" },
				{ name: "#btn_verifier", msg: "Request Verified?" },
			],
		},
		{
			form: "frm_baas_2",
			buttons: [
				{ name: "#btn_baas_crrf_submit", msg: "Do you want to submit?" },
				{ name: "#btn_baas_save_crrf", msg: "Save as draft?" },
				{ name: "#btn_cancel_crrf", msg: "Do you wish to cancel this form?" },
				{ name: "#btn_resub_baas_crrf", msg: "Resubmit this form?" },
				{ name: "#btn_sub_draft_crrf", msg: "Do you want to submit?" },
				{ name: "#btn_up_baas_crrf", msg: "Do you want to update?" },
				{ name: "#btn_approver", msg: "Approve this form?" },
				{ name: "#app_disapproved", msg: "Disapprove this form?" },
				{ name: "#approver_returned", msg: "Return this form?" },
				{ name: "#btn_reciever", msg: "Acknowledge the request?" },
				{
					name: "#btn_performer",
					msg: "Are you sure you performed the request?",
				},
				{ name: "#btn_confirmer", msg: "Request Confirmed?" },
				{ name: "#btn_verifier", msg: "Request Verified?" },
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
				confirmButtonText: "Yes",
				denyButtonText: `No`,
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
				title: "Do you want to cancel this form?",
				showDenyButton: true,
				confirmButtonText: "Yes",
				denyButtonText: `No`,
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
