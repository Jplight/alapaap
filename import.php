<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>
<body>
  

<form id="import-form" method="post" enctype="multipart/form-data">
  <input type="file" name="file" id="file" accept=".csv, .xlsx, .xls">
  <input type="button" id="submit-btn" value="Import">
  <input type="button" id="preview-btn" value="Preview">
</form>
<div id="rendered-table"></div>

<script>
$(document).ready(function() {
  $('#preview-btn').click(function() {
    var file_data = $('input[name="file"]').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);

    $.ajax({
      url: 'import-preview.php', // the endpoint
      dataType: 'text',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(data) {
        $('#rendered-table').html(data);
      }
    })
  })


})
</script>
<script>
$(document).ready(function() {
  $("#submit-btn").click(function() {

    const file = $("input[name='file']").val();
    if (!file) {
      alert("Please select a file to import");
      return;
    }

    const formData = new FormData($("#import-form")[0]);
    $.ajax({
      url: 'import-submit.php',
      type: 'POST',
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      success: function(data) {
        alert(data);
      }
    });
  });
});
</script>
</body>
</html>



