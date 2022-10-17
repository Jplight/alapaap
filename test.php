<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="assets/js/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <style>
      .modal:nth-of-type(even) {
          z-index: 1062 !important;
      }
      .modal-backdrop.show:nth-of-type(even) {
          z-index: 1061 !important;
      }
    </style>
    <script>
        $(document).ready(function(){
            $(".launchModal").click(function(){
                $('.myModal').css('display','block').attr('aria-modal','true').addClass('show');              
                $("body").append('<div class="modal-backdrop show"></div>');
            })
            $(".modalClose").click(function(){
              $(".modal-backdrop").remove();
              $(".myModal").modal("show");
            });
        });
    </script>
</head>
<body>
    
<a data-bs-toggle="modal" href="#myModal" class="btn btn-primary">Launch modal</a>

<div class="modal myModal" id="myModal" data-bs-keyboard="false" data-bs-backdrop="static">  
	<div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modal title</h4>    
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
        </div><div class="container"></div>
        <div class="modal-body">
          Content for the dialog / modal goes here.
          <a data-bs-toggle="modal" href="#myModal2" class="btn btn-primary launchModal">Launch modal</a>
        </div>
        <div class="modal-footer">
          <a href="#" data-bs-dismiss="modal" class="btn btn-outline-dark">Close</a>
        </div>
      </div>
    </div>
</div>

<div class="modal" id="myModal2" data-bs-backdrop="static">
	<div class="modal-dialog modal-dialog-centered" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">2nd Modal title</h4>
          <button type="button" class="btn-close modalClose" data-bs-dismiss="modal" id="btn_close_2nd" aria-hidden="true"></button>
        </div><div class="container"></div>
        <div class="modal-body">
          Content for the dialog / modal goes here.
          Content for the dialog / modal goes here.
          Content for the dialog / modal goes here.
          Content for the dialog / modal goes here.
          Content for the dialog / modal goes here.
        </div>
        <div class="modal-footer">
          <a href="#" data-bs-dismiss="modal"  class="btn btn-outline-dark modalClose">Close</a>
          <a href="#" class="btn btn-primary">Save changes</a>
        </div>
      </div>
    </div>
</div>


</body>
</html>