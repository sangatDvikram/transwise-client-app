<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!Login::is_operator()&&!Login::is_admin())
{
  Login::redirect();
}

$groups=new Cars;
$Operator=new Operator;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="./favicon.ico">

    <title> Manage Package Groups - Operator panel</title>

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

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas hidden-print" id="sidebar" role="navigation">
         <?php include'sidebar.php';?>
        </div><!--/span-->
        <div class="col-xs-12 col-sm-9">
         <div class="page-header">
          <h1>Manage Package Groups <small>Add , Modify or Delete Package Groups</small></h1><p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          </div>
          
            <div id="info">
            <?php 
            if(isset($_POST['addPgroup']))
            {
              
              $Operator->getData($_POST);
              $page=$Operator->insert_package_group();
              echo $page;
            }
            if(isset($_POST['EditPgroup']))
            {
              
              $Operator->getData($_POST);
              $page=$Operator->update_package_group();
              echo $page;

            }
            if(isset($_POST['delete']))
            {
              
             $Operator->getData($_POST);
              $page=$Operator->delete_package_group();
              echo $page;

            }
            
        if(isset($_request['delete'])){
           $data=$Operator->getpackagegroupdetails($_request['delete']);
            ?>

            <div class="bs-callout bs-callout-warning" >
      You Realy want to delete group <b><?php echo "$data[name]";?></b> ? <br> <p class='text-danger'> Note: You cannot retrive any group information once it is deleted.</p>
      <form  class="form-inline" role="form" action='/operator/packagegroup?all ' method='post' id="<?php echo "$data[cat_id]";?>">
      <input type="hidden" name='cat_id' <?php echo "value=$data[cat_id]";?>>
      <button type='submit' class='btn btn-danger yes'  name="delete" id="<?php echo "$data[cat_id]";?>">Yes</button> <a class="btn btn-default" href="./operator/groups" role="button" ><span class="glyphicon glyphicon-remove"></span> No</a></form></div>
      <?php } ?>
          
          </div>

<?php if (isset($_request['add'])||isset($_request['edit'])) {
      $data='';
    if(isset($_request['edit'])) { 
      $data=$Operator->getpackagegroupdetails($_request['edit']);
     }

  ?>
<form class="form-horizontal" role="form" action="/operator/packagegroup?all" method="post">
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Cat ID</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="inputEmail3" name="cat_id" placeholder="Cat ID" <?php if(isset($_request['edit'])) { echo "value='$data[cat_id]' readonly";  } else { echo "value=". ProcessForm::generate_id('transwise_package_group','pkgroup-')."";} ?> >
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="inputEmail3" name="pgroup" placeholder="Group Name" <?php if(isset($_request['edit'])) { echo "value='$data[name]'";  } ?>>
    </div>
  </div>
   <div class="form-group">
              <label >Group Description</label>
              <textarea name = "desc" cols='60' rows='10' tabindex="3" ><?php if(isset($_request['edit'])) { echo $data['details'];  }?> </textarea>
          </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    <?php if(isset($_request['edit'])) { echo '<button type="submit" class="btn btn-warning" name="EditPgroup">Update Package Group Details</button>';  } else { echo '<button type="submit" class="btn btn-success" name="addPgroup">Add Package Group</button>';}?>
      
    </div>
  </div>
</form>

<?php }  

if (isset($_request['all'])||isset($_request['delete']))  { ?>


<div class="table-responsive">
  <table class="table">
   <thead>
     <th>Sr.</th>
     <th>Name</th>
     <th>Description</th>
     <th>Options</th>
   </thead>
   <tbody>
     <?php $data=$Operator->getpackagegroupdetails();

$i=1;
     foreach ($data as  $data) {
       echo "<tr>";
       echo "<td>$i</td>";
       echo "<td>$data[name]</td>";
       echo "<td>$data[details]</td>";
       echo "<td><a href='/operator/packagegroup?edit=$data[cat_id]'> <span class='glyphicon glyphicon-pencil text-success'></span>Edit</a> | <span class='glyphicon glyphicon-trash text-danger'></span> <a href='/operator/packagegroup?delete=$data[cat_id]' >Delete</a> </td></td>";
       echo "</tr>";
       $i++;
     }
     ?>
   </tbody>
  </table>
  <a type="button" class="btn btn-success btn-lg" href="./operator/packagegroup?add">
  <span class="glyphicon glyphicon-plus"></span> Add New Pacakge Group
</a>
</div>

<?php } ?>
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
    <script src="./assets/js/bootstrap.min.js"></script>
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

