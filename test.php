<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <style>
.modal:nth-of-type(even) {
    z-index: 1052 !important;
}
.modal-backdrop.show:nth-of-type(even) {
    z-index: 1051 !important;
}
    </style>
<script>
    $(document).ready(function(){
        $("#second_modal").click(function(){
            $('#myModal').css('display','block').attr('aria-modal','true')
        })
    });
</script>
</head>
<body>
    

<a data-bs-toggle="modal" href="#myModal" class="btn btn-primary" >Launch modal</a>

<div class="modal" id="myModal" data-bs-backdrop="static">
	<div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modal title</h4>    
          <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">×</button>
        </div><div class="container"></div>
        <div class="modal-body">
          Content for the dialog / modal goes here.
          <button data-bs-toggle="modal" href="#myModal2" class="btn btn-primary" id="second_modal" type="button">Launch modal</button>
        </div>
        <div class="modal-footer">
          <a href="#" data-bs-dismiss="modal" class="btn">Close</a>
        </div>
      </div>
    </div>
</div>
<div class="modal" id="myModal2" data-bs-backdrop="static" style="z-index: 9999 !important;">
	<div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">2nd Modal title</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">×</button>
        </div><div class="container"></div>
        <div class="modal-body">
          Content for the dialog / modal goes here.
          Content for the dialog / modal goes here.
          Content for the dialog / modal goes here.
          Content for the dialog / modal goes here.
          Content for the dialog / modal goes here.
        </div>
        <div class="modal-footer">
          <a href="#" data-bs-dismiss="modal" class="btn">Close</a>
          <a href="#" class="btn btn-primary">Save changes</a>
        </div>
      </div>
    </div>
</div>

</body>
</html>