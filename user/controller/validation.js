$(document).ready(function () {
	let isConfirmed = false
	let form_new = $("#form_new")
	let form_update = $("#form_update")
	let form_delete = $("#form_delete")
	let currentButton_new = ""
	let currentButton_update = ""
	let currentButton_delete = ""
	let messageStr = ""

	form_new.on("submit", (event) => {
		DialogBoxAlert(messageStr, currentButton_new, event)
	})
	form_update.on("submit", (event) => {
		DialogBoxAlert(messageStr, currentButton_update, event)
	})
	form_delete.on("submit", (event) => {
		DialogBoxAlert(messageStr, currentButton_delete, event)
	})

	const DialogBoxAlert = (message, button, event) => {
		console.log(message)
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
					$(button).click()
				}
			})
		}
	}

	const preventEvent = (e) => {
		e.preventDefault()
		e.stopPropagation()
	}

	$("#btn_savehci").click(function () {
		currentButton_new = "#btn_savehci"
		messageStr = "Save as draft?"
	})

	$("#btn_submit_hci").click(function () {
		currentButton_new = "#btn_submit_hci"
		messageStr = "Do you want to submit this?"
	})

	$("#btn_save_hci_up").click(function () {
		currentButton_update = "#btn_save_hci_up"
		messageStr = "Save as draft?"
	})

	$("#btn_submit_hci_up").click(function () {
		currentButton_update = "#btn_submit_hci_up"
		messageStr = "Do you want to submit this?"
	})

	$("#btn_save_hci_del").click(function () {
		currentButton_delete = "#btn_save_hci_del"
		messageStr = "Save as draft?"
	})

	$("#btn_submit_hci_del").click(function () {
		currentButton_delete = "#btn_submit_hci_del"
		messageStr = "Do you want to submit this?"
	})
})
