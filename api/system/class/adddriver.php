<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!Login::is_operator()&&!Login::is_admin())
{
  Login::redirect();
}
$groups=new Cars;

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="./favicon.ico">

    <title> Add Driver - Operator panel</title>

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
         <?php include'sidebar.php';?>
        </div><!--/span-->
        <div class="col-xs-12 col-sm-9">
         <div class="page-header">
          <h1>Add Driver  <small>Add new driver to your crew.</small></h1>
          </div>
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
         <div id="info">
            <?php if(isset($_POST['addcar']))
            {
              
              $groups->getData($_POST);
              $page=$groups->insert_car();
              echo $page;
            }
            ?>
          </div>
          <form class="form-horizontal" role="form" action="" method="post">
  
  <div class="form-group ">
    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="inputEmail3" tabindex="1" name="name" placeholder="Car Name" required>
    </div>
    
  </div>
 
<div class="form-group ">
  <label for="inputEmail3" class="col-sm-2 control-label">Car Group</label>
    <div class="col-sm-4">
      <select class="form-control" name='group' required>
      <?php 

        $data=$groups->cargroups();
        foreach ($data as $value) {
         echo "<option value='$value[name]'>$value[name]</option>";
        }


      ?>
  
  
</select>
    </div>
    </div>
   
  <div class="form-group ">
  <label for="inputEmail3" class="col-sm-2 control-label">Approximate Fair</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="inputEmail3" tabindex="4" name="fair" placeholder="Fair ex : 1000" required>
      <span class="help-block">Its Approximate fair will be charged for this perticular car / day.</span>
    </div>
    </div>
    <div class="form-group ">
  <label for="inputEmail3" class="col-sm-2 control-label">In Stock</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="inputEmail3" tabindex="5" name="stock" placeholder="In stock value " required>
      <span class="help-block">How many cars of this type are currently available ?</span>
    </div>
    </div>
    <div class="form-group">
              <label for="disabledTextInput">Car Description</label>
              <textarea name = "desc" cols='30' rows='5' tabindex="6" required> </textarea>
          </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success"  tabindex="7" name='addcar'>Add Car</button>
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

