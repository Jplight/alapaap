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
		// ajax: "model/reports/data-bsp-final.php",
		//  ajax: "model/reports/data-bsp-revised.php",
		// // ajax: "model/reports/data-bsp-report.php",
		// columns: [
		// 	{ data: 0 },
		// 	{ data: 1},
		// 	{ data: 2 },
		// 	{ data: 3 },
		// 	{ data: 4 },
		// 	{ data: 5 },
		// 	{ data: 6 },
		// 	{ data: 7 },
		// 	{ data: 8 },
		// 	{ data: 9 },
		// 	{ data: 10 },
		// ],
		
		language: {
			emptyTable: "There is no data to be showed!🤗",
			zeroRecords: "No data found!🤗",
		},
		"columnDefs": [
            { "orderDataType": "date-eu", "targets": 4 },
        ],
		"order": [[ 4, "desc" ]],
		"lengthChange": true,
		dom: "Bfrtip",
		buttons: [
			{
				extend: "excelHtml5",
				messageTop:
					"Reported By: " +
					$("#my_fullname").html() +
					"\n Date Printed: " +
					today,
				// customize: function (xlsx) {
				// 	addCustomFormat(xlsx)
				// 	formatTargetColumn(xlsx, "D") // Excel column A
				// 	formatTargetColumn(xlsx, "G") // Excel column A
				// 	formatTargetColumn(xlsx, "H") // Excel column A
				// 	var style = xlsx.xl["styles.xml"]
				// 	$("xf", style)
				// 		.find("alignment[horizontal='left'] ")
				// 		.attr("wrapText", "1")
				// },
				exportOptions: {
					format: {
						footer: function ( data, row, column, node ) {
									// `column` contains the footer node, apply the concat function and char(10) if its newline class
							   if ($(column).hasClass('newline')) {
									//need to change double quotes to single
									data = data.replace( /"/g, "'" );
									//split at each new line
									splitData = data.split('<br>');
									data = '';
									for (i=0; i < splitData.length; i++) {
										//add escaped double quotes around each line
										data += '\"' + splitData[i] + '\"';
										//if its not the last line add CHAR(13)
										if (i + 1 < splitData.length) {
											data += ', CHAR(10), ';
										}
									}
									//Add concat function
									data = 'CONCATENATE(' + data + ')';
									return data;
								}
								return data;
							}
						}
					
				},
				customize: function( xlsx ) {
					var sheet = xlsx.xl.worksheets['sheet1.xml'];
					var col = $('col', sheet);
					//set the column width otherwise it will be the length of the line without the newlines
					$(col[3]).attr('width', 50);
					
					// Apply cell styling for wrap text and to make the cell a function
					// For the last row column E and F
					$('row:last c[r^="E"], row:last c[r^="F"]', sheet).each(function() {
						if ($('is t', this).text()) {
							//wrap text
							$(this).attr('s', '55');
							//change the type to `str` which is a formula
							$(this).attr('t', 'str');
							//append the concat formula
							$(this).append('<f>' + $('is t', this).text() + '</f>');
							//remove the inlineStr
							$('is', this).remove();
						}
					})
					
					// Set the row hieght of the last ro(footer)
						$('row:last', sheet).each(function(index) {
						$(this).attr('ht', 90);
						$(this).attr('customHeight', 1);
						});
				
				}
			},
			{
				extend: "pdfHtml5",
				text: "Pdf",
				download: "open",
				orientation: "landscape",
				pageSize: 'TABLOID',
				// customize: function (doc) {
				// 	doc.defaultStyle.fontSize = 8 //<-- set fontsize to 16 instead of 10
				// },
				messageTop: "Reported By: " + $("#my_fullname").html(),
				messageBottom: "Date Printed:" + today,
				exportOptions: {
					stripNewlines: false
				} // this will used to enabled html line break when generating report
				
			},
			{
				extend: "print",
				pageSize: 'TABLOID',
				orientation: "landscape",
				messageTop: "Reported By: " + $("#my_fullname").html(),
				messageBottom: "Date Printed:" + today,
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
						.prepend(
                            '<img src="https://www.bsp.gov.ph/Pages/AboutTheBank/SealCharterAndHistory/bsp-logonew.png" style="position:absolute; opacity: 0.5; width: 80px; top:0; right:0;" />'
                        );
						// .prepend(
                        //     '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                        // );
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                },
				exportOptions: {
					stripHtml: false
				} // this will used to enabled html line break when generating report
			},
			// {
			// 	extend: "colvis",
			// 	text: "Filter By",
			// },
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
