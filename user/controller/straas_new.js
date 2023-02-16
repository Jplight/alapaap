$(document).ready(function () {
	var i = 2

	$("#add_row_straas").click(function () {
		if ($(".volume_id" + (i - 1)).val() == "") {
			alert("Volume fields shouldn't leave empty!")
			$(".volume_id" + (i - 1)).focus()
		} else {
			// $('#straas_addr'+(i-1)).find('input').attr('disabled',true);
			// $('#straas_addr'+(i-1)).find('input');

			$("#straas_tab_logic").append(
				"<tr id='straas_addr" +
					i +
					"'><td></td><td><input class='form-control text-dark input-md volume_id" +
					i +
					"' type='text' name='others_1[]'  /></td><td><input class='form-control text-dark input-md uname" +
					i +
					"' type='text' name='others_2[]'  /></td></tr>"
			)
			i++
		}
	})
})