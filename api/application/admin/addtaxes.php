<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!Login::is_admin())
{
  Login::redirect();
}

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="./favicon.ico">

    <title> Add Tax - Operator panel</title>

    <!-- Bootstrap core CSS -->
    <?php include 'css.php';?>
   
    
  </head>

  <body>
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
         <?php include APPPATH.'menu.php';?>
      </div><!-- /.container -->
    </div><!-- /.navbar -->

    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
         <?php include'adminsidebar.php';?>
        </div><!--/span-->
        <div class="col-xs-12 col-sm-9">
         <div class="page-header">
          <h1>Add Tax <small> Applicable to the invoice created at the time of billing.  <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p></small></h1>
          </div>
         
         <div id="info">
            
            ?>
          </div>
          <form class="form-horizontal" role="form" action="/admin/taxes?all" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tax ID:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="inputEmail3" name="tax_id" placeholder="Tax ID" <?php echo "value=". ProcessForm::generate_id('transwise_taxes','tax-')."";  ?>>
    </div>
  </div>
   <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="Tax Name">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Rate</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="inputEmail3" name="rate" placeholder="Rate in %">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Status : </label>
    <div class="col-sm-5">
     <label class="radio-inline">
  <input type="radio" name="status" id="inlineRadio1"  value="1" checked> Enabled
</label>
<label class="radio-inline">
  <input type="radio" name="status" id="inlineRadio2" value="0"> Disabled
</label>
    </div>
  </div>            
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success" name='addtax'>Add Tax</button>
    </div>
  </div>
</form>
    


        </div><!--/span-->

      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Company 2014</p>
      </footer>

    </div><!--/.container-->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets//js/bootstrap.min.js"></script>
    <script src=".//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
    <script>
          tinymce.init({
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
          $(document).ready(function () {
  $('[data-toggle=offcanvas]').click(function () {
    $('.row-offcanvas').toggleClass('active')
  });
});
  </script>
  </body>
</html>

