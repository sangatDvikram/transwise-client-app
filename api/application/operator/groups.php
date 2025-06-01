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

    <title> Manage Vehicle Group - Operator panel</title>

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
          <h1>Manage Groups<small> Modify vehicle group information</small></h1>
          </div>
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
         <div id="info">
            <?php 
            if(isset($_POST['addgroup']))
            {
              
              $groups->getData($_POST);
              $page=$groups->insert_car_group();
              echo $page;
            }
            if(isset($_POST['modifygroup']))
            {
              
              $groups->getData($_POST);
              $page=$groups->updateCargroup($_POST['id']);
              echo $page;

            }
            if(isset($_POST['delete']))
            {
              
              $groups->getData($_POST);
              $page=$groups->deletecargroup($_POST['id']);
              echo $page;

            }
            
        if(isset($_request['delete'])){
           $data=$groups->get_cargroups_details($_request['delete']);
            ?>

            <div class="bs-callout bs-callout-warning" >
      You Realy want to delete group <?php echo "$data[name]";?> ? <br> <p class='text-danger'> Note: You cannot retrive any group information once it is deleted.</p>
      <form  class="form-inline" role="form" action='/operator/groups ' method='post' id="<?php echo "$data[id]";?>">
      <input type="hidden" name='id' <?php echo "value=$data[id]";?>>
      <button type='submit' class='btn btn-danger yes'  name="delete" id="<?php echo "$data[id]";?>">Yes</button> <a class="btn btn-default" href="./operator/groups" role="button" ><span class="glyphicon glyphicon-remove"></span> No</a></form></div>
      <?php } ?>
          
          </div>
          <?php if(isset($_request['id']))
          {
            $details=$groups->get_cargroups_details($_request['id']);

            ?>
            <form class="form-horizontal" role="form" action="/operator/groups" method="post">
            <input type="hidden" name='id' <?php echo "value=$_request[id]";?>>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="inputEmail3" name="group" placeholder="Group Name" <?php echo "value=$details[name]";?>>
    </div>
  </div>
   <div class="form-group">
              <label for="disabledTextInput">Group Description</label>
              <textarea name = "desc" cols='60' rows='10' tabindex="3"  > <?php echo $details['details'];?></textarea>
          </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success" name='modifygroup'>Update</button>
    </div>
  </div>
</form>

            <?php
          } 
          else
          {
            ?>
          
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Description</th>
          <th>Options</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $grp=$groups->cargroups();
      $i=1;
      foreach ($grp as $data) {
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>$data[name]</td>";
        echo "<td>". $data['details']."</td>";
         echo "<td><a href='/operator/groups?id=$data[id]'> <span class='glyphicon glyphicon-pencil text-success'></span> Edit</a> | <span class='glyphicon glyphicon-trash text-danger'></span> <a href='/operator/groups?delete=$data[id]' >Delete</a> </td>";
        # code...
         $i++;
      
      
}

      ?>
      
        
      

    </div>
      </tbody>
    </table>

<?php }?>

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

