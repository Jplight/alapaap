$(document).ready(function () {
	let today = new Date().toLocaleString()
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
	function addCustomFormat(xlsx) {
		// add a new "cellXfs" cell formatter, which uses the next available format index (numFmt 176):
		var celXfsElement = xlsx.xl["styles.xml"].getElementsByTagName("cellXfs")
		var cellStyle =
			'<xf numFmtId="176" fontId="0" fillId="0" borderId="0" xfId="0" applyAlignment="1"' +
			' applyFont="1" applyFill="1" applyBorder="1"><alignment horizontal="left"/></xf>'
		$(celXfsElement).append(cellStyle)
		$(celXfsElement).attr("count", "69") // increment the count
	}

	function formatTargetColumn(xlsx, col) {
		var sheet = xlsx.xl.worksheets["sheet1.xml"]
		// select all the cells whose addresses start with the letter prvoided
		// in 'col', and add a style (s) attribute for style number 68:
		$('row c[r^="' + col + '"]', sheet).attr("s", "68")
	}
	let table = $("#report_datatables").DataTable({
		language: {
			emptyTable: "There is no data to be showed!🤗",
			zeroRecords: "No data found!🤗",
		},
		ajax: "model/reports/data-bsp-report.php",
		columns: [
			{ data: "infra" },
			{ data: "system" },
			{ data: "server" },
			{ data: "baseline" },
			{ data: "date" },
			{ data: "req" },
			{ data: "change_req" },
			{ data: "final" },
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
				customize: function (xlsx) {
					addCustomFormat(xlsx)
					formatTargetColumn(xlsx, "D") // Excel column A
					formatTargetColumn(xlsx, "G") // Excel column A
					formatTargetColumn(xlsx, "H") // Excel column A
					var style = xlsx.xl["styles.xml"]
					$("xf", style)
						.find("alignment[horizontal='left'] ")
						.attr("wrapText", "1")
				},
			},

			// $.extend(true, {}, fixNewLine, {
			// 	extend: "excelHtml5",
			// }),
			{
				extend: "pdfHtml5",
				text: "Pdf",
				download: "open",

				orientation: "landscape",
				customize: function (doc) {
					doc.defaultStyle.fontSize = 12 //<-- set fontsize to 16 instead of 10
				},

				messageTop: "Reported By: " + $("#my_fullname").html(),
				messageBottom: "Date Printed:" + today,
			},
			{
				extend: "print",
				messageTop: "Reported By: " + $("#my_fullname").html(),
				messageBottom: "Date Printed:" + today,
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

	// axios.get("model/reports/data-bsp-report.php").then((res) => {
	// 	console.log(res.data)
	// })

	$("#min, #max").on("change", function () {
		table.draw()
	})
})
