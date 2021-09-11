<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!Login::is_admin())
{
  Login::redirect();
}
 $admin=new Admin;
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/favicon.ico">

    <title> Manage Taxes - Operator panel</title>

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
          <h1>Manage Taxes <small> Applicable to the invoice created at the time of billing.  <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p></small></h1>
          </div>
         
         <div id="info">
            <?php if(isset($_POST['addtax']))
            {
             
              $admin->getData($_POST);
              $page=$admin->insert_tax();
              echo $page;
            }
             if(isset($_POST['edittax']))
            {
              
              $admin->getData($_POST);
              $page=$admin->update_tax();
              echo $page;

            }
            if(isset($_POST['delete']))
            {
              
             $admin->getData($_POST);
              $page=$admin->delete_tax();
              echo $page;

            }
            
        if(isset($_request['delete'])){
           $data=$admin->get_tax_details($_request['delete']);
            ?>

            <div class="bs-callout bs-callout-warning" >
      You Really want to delete tax <b><?php echo "$data[name]";?></b> ? <br> <p class='text-danger'> Note: You cannot retrive any tax information once it is deleted.</p>
      <form  class="form-inline" role="form" action='/admin/taxes?all ' method='post' id="<?php echo "$data[tax_id]";?>">
      <input type="hidden" name='tax_id' <?php echo "value=$data[tax_id]";?>>
      <button type='submit' class='btn btn-danger yes'  name="delete" id="<?php echo "$data[tax_id]";?>">Yes</button> <a class="btn btn-default" href="/admin/taxes?all" role="button" ><span class="glyphicon glyphicon-remove"></span> No</a></form></div>
      <?php } ?>
           
          </div>
            <?php if(isset($_request['edit'])){
                
                
                $data=$admin->get_tax_details($_request['edit']);
                ?>
          <form class="form-horizontal" role="form" action="/admin/taxes?all" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tax ID:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="inputEmail3" name="tax_id" placeholder="Tax ID" <?php echo "value='$data[tax_id]' readonly" ;  ?>>
    </div>
  </div>
   <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="Tax Name" value='<?php echo "$data[name]";?>'>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Rate</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="inputEmail3" name="rate" placeholder="Rate in %" value='<?php echo "$data[rate]";?>'>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Status : </label>
    <div class="col-sm-5">
     <label class="radio-inline">
  <input type="radio" name="status" id="inlineRadio1"  value="1"  <?php echo  ($data['status']=='1')?"checked":"";?>> Enabled
</label>
<label class="radio-inline">
  <input type="radio" name="status" id="inlineRadio2" value="0" <?php echo  ($data['status']=='0')?"checked":"";?>> Disabled
</label>
    </div>
  </div>            
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-warning" name='edittax'>Update Tax</button>
    </div>
  </div>
</form>
    
            <?php } ?>
 <?php if(isset($_request['all'])){ ?>
  <a type="button" class="btn btn-success btn-lg" href="/admin/addtaxes">
  <span class="glyphicon glyphicon-plus"></span> Add New Tax
</a>
            <div class="table-responsive">
  <table class="table">
   <thead>
     <th>Sr.</th>
     <th>Name</th>
     <th>Rate</th>
     <th>Status</th>
     <th>Operations</th>
   </thead>
   <tbody>
     <?php $data=$admin->get_tax_details();

$i=1;
     foreach ($data as  $data) {
       echo "<tr>";
       echo "<td>$i</td>";
       echo "<td>$data[name]</td>";
       $status=($data['status']==1)?'Enabled':'Disabled';
       echo "<td><b>$data[rate] % </b></td>";
       echo "<td><b> $status </b></td>";
       echo "<td><a href='/admin/taxes?edit=$data[tax_id]'> <span class='glyphicon glyphicon-pencil text-success'></span>Edit</a> | <span class='glyphicon glyphicon-trash text-danger'></span> <a href='/admin/taxes?delete=$data[tax_id]' >Delete</a> </td></td>";
       echo "</tr>";
       $i++;
     }
     ?>
   </tbody>
  </table>
  
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
    <script src="/assets/js/jquery.js"></script>
    <script src="/assets//js/bootstrap.min.js"></script>
    <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
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

