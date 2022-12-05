$(document).ready(function () {
	let today = new Date().toLocaleString().bold()
	let minDate, maxDate

	// Custom filtering function which will search data in column four between two values
	$.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
		let min = minDate.val()
		let max = maxDate.val()
		let date = new Date(data[9])

		if (
			(min === null && max === null) ||
			(min === null && date <= max) ||
			(min <= date && max === null) ||
			(min <= date && date <= max)
		) {
			return true
		}
		return false
	})
	// Create date inputs
	minDate = new DateTime($("#min"), {
		format: "YYYY-MM-DD",
	})
	maxDate = new DateTime($("#max"), {
		format: "YYYY-MM-DD",
	})

	var buttonCommon = {
		exportOptions: {
			format: {
				body: function (data, row, column, node) {
					// Strip $ from salary column to make it numeric
					return column === 5 ? data.replace(/[$,]/g, "") : data
				},
			},
		},
	}

	let table = $("#report_datatables").DataTable({
		language: {
			emptyTable: "There is no data to be showed!🤗",
			zeroRecords: "No data found!🤗",
		},
		ajax: "model/reports/data-bsp-final.php",
		columns: [
			{ data: 0 },
			{ data: 1 },
			{ data: 2 },
			{ data: 3 },
			{ data: 4 },
			{ data: 5 },
		],
		dom: "Bfrtip",
		buttons: [
			{
				extend: "excelHtml5",
				messageTop:
					"Reported By: " +
					$("#my_fullname").html() +
					"<br> Date Printed: " +
					today,
			},
			{
				extend: "pdfHtml5",
				exportOptions: {
					columns: [0, 1, 2, 3, 4, 5, 6],
				},
				messageTop:
					"Reported By: " +
					$("#my_fullname").html().bold() +
					"<br> Date Printed: " +
					today,
			},
			{
				extend: "print",
				messageTop:
					"Reported By: " +
					$("#my_fullname").html().bold() +
					"<br> Date Printed: " +
					today,
			},
			{
				extend: "colvis",
				text: "Filter By",
			},
		],
		initComplete: function () {
			this.api()
				.columns() // remove number 2 to display all dropdown
				.every(function () {
					var column = this
					var select = $(
						'<select class="form-select form-select-sm"><option value="">All</option></select>'
					)
						.appendTo($(column.footer()).empty())
						.on("change", function () {
							var val = $.fn.dataTable.util.escapeRegex($(this).val())

							column.search(val ? "^" + val + "$" : "", true, false).draw()
						})
					column
						.data()
						.unique()
						.sort()
						.each(function (d, j) {
							select.append('<option value="' + d + '">' + d + "</option>")
						})
				})
		},
	})

	$("#min, #max").on("change", function () {
		table.draw()
	})
})
