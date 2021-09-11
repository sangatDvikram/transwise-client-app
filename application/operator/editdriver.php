<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!Login::is_operator()&&!Login::is_admin())
{
  Login::redirect();
}
$groups=new Operator;

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/favicon.ico">

    <title> Modify Driver Details - Operator panel</title>

    <!-- Bootstrap core CSS -->
   <?php include 'css.php';?>
   <style type="text/css">
   tbody{border-top: none;}

   td:after , td:before,td{border: none;border-top: none; }
   tr:after , tr:before,tr{border: none;border-top: none; }
   </style>
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
          <h1>Modify Driver Details <small></small></h1>
          </div>
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
         <div id="info">
            <?php if(isset($_POST['updateD']))
            {
              
             $groups->getData($_POST);
              $page=$groups->updateDriver();
              echo $page;
            }
            if(isset($_POST['delete']))
            {
              
              $groups->getData($_POST);
              $page=$groups->deleteDriver();
              echo $page;
            }
           if(isset($_request['delete'])){
           
            ?>

            <div class="bs-callout bs-callout-warning" >
      You Realy want to delete driver <?php echo User::driverInfo($_request['delete'],'name');?> ? <br> <p class='text-danger'> Note: You cannot retrive any car information once it is deleted.</p>
      <form  class="form-inline" role="form" action='/operator/groups ' method='post' id="<?php echo "$data[id]";?>">
      <input type="hidden" name='id' <?php echo "value='".User::driverInfo($_request['delete'],'id')."'";?>>
      <button type='submit' class='btn btn-danger yes'  name="delete" id="<?php echo "$data[id]";?>"> <span class="glyphicon glyphicon-ok"></span> Yes</button> <a class="btn btn-default" href="/operator/editdriver" role="button" ><span class="glyphicon glyphicon-remove"></span> No</a></form></div>
      <?php } ?>
          
          </div>
          <?php
          if(isset($_request['id'])||isset($_request['info'])){?>
<ul class="pager">
  <li class="previous"><a href="/operator/editdriver">&larr; Back</a></li>
  
</ul>
 <form class="form-horizontal" role="form" action="" method="post">
 <?php  if(isset($_request['id'])){?>
  <input type="hidden" name='id' <?php echo "value='".User::driverInfo($_request['id'],'id')."'";?>>
  <?php } ?>
  <table class="table " style="text-align:left;">
    <tr>
    <td width="50%">
    <div class="form-group">
    <label  class="  col-sm-5 control-label">Name :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="1" name="name" placeholder="Driver Name" <?php  if(isset($_request['id'])){ echo "value='".User::driverInfo($_request['id'],'id')."'";} else{echo "value='".User::driverInfo($_request['info'],'name')."'"; echo "readonly";}?> required>
    </div>
  </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">Mobile Number :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="2" name="contact" placeholder="Mobile Number" <?php  if(isset($_request['id'])){ echo "value='".User::driverInfo($_request['id'],'contact')."'";} else{ echo "value='".User::driverInfo($_request['info'],'contact')."'";echo "readonly";}?> required>
    </div>
  </div>
    </td>
    </tr>
    <tr>
    <td width="50%">
    <div class="form-group">
    <label  class="  col-sm-5 control-label">Licence Number :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="3" name="licence" placeholder="Licence Number" <?php  if(isset($_request['id'])){ echo "value='".User::driverInfo($_request['id'],'licence')."'";} else{echo "value='".User::driverInfo($_request['info'],'licence')."'"; echo "readonly";}?> required>
    </div>
  </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">Pan Card Number :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="4" name="pan" placeholder="Pan Number" <?php  if(isset($_request['id'])){ echo "value='".User::driverInfo($_request['id'],'pan')."'";} else{ echo "value='".User::driverInfo($_request['info'],'pan')."'"; echo "readonly";}?> required>
    </div>
  </div>
    </td>
    </tr>
    <tr>
    <td width="50%">
    <div class="form-group">
    <label  class="  col-sm-5 control-label">Licence Date :</label>
    <div class="col-sm-7">
       <div class='input-group date' id='Ldate' data-date-format="YYYY/MM/DD">
                    <input type='text' autocomplete="off" tabindex="5" class="form-control Ldate " placeholder="dd/mm/yyyy" name="Ldate" <?php  if(isset($_request['id'])){ echo "value='".date('d/m/Y',User::driverInfo($_request['id'],'lissueD'))."'";} else{echo "value='".date('d/m/Y',User::driverInfo($_request['info'],'lissueD'))."'"; echo  "readonly";}?> required/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
    </div>
  </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">Valid Upto :</label>
    <div class="col-sm-7">
     <div class='input-group date' id='Vdate' data-date-format="YYYY/MM/DD">
                    <input type='text' autocomplete="off" tabindex="6" class="form-control Vdate " placeholder="dd/mm/yyyy" name="Vdate" <?php  if(isset($_request['id'])){ echo "value='".date('d/m/Y',User::driverInfo($_request['id'],'lvalidD'))."'";} else{ echo "value='".date('d/m/Y',User::driverInfo($_request['info'],'lvalidD'))."'"; echo "readonly";}?> required/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
    </div>
  </div>
    </td>
    </tr>
    <tr>
    <td width="50%">
    <div class="form-group">
    <label  class="  col-sm-5 control-label">Present Address :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="7" name="address" placeholder="Present Address" <?php  if(isset($_request['id'])){ echo "value='".User::driverInfo($_request['id'],'address')."'";} else{echo "value='".User::driverInfo($_request['info'],'address')."'"; echo "readonly";}?> required>
    </div>
  </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">Permanent Address :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="8" name="perAdd" placeholder="Permanent Address" <?php  if(isset($_request['id'])){ echo "value='".User::driverInfo($_request['id'],'pAdd')."'";} else{ echo "value='".User::driverInfo($_request['info'],'pAdd')."'";echo "readonly";}?> required>
    </div>
  </div>
    </td>
    </tr>
    <tr>
    <td width="50%">
    <div class="form-group">
    <label  class="  col-sm-5 control-label">Email Address :</label>
    <div class="col-sm-7">
      <input type="email" class="form-control"  tabindex="9" name="email" placeholder="Email Address" <?php  if(isset($_request['id'])){ echo "value='".User::driverInfo($_request['id'],'email')."'";} else{ echo "value='".User::driverInfo($_request['info'],'email')."'";echo "readonly";}?> >
    </div>
  </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">Referance off :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="10" name="reff" placeholder="Referance Name" <?php  if(isset($_request['id'])){ echo "value='".User::driverInfo($_request['id'],'referance')."'";} else{ echo "value='".User::driverInfo($_request['info'],'referance')."'";echo "readonly";}?> >
    </div>
  </div>
    </td>
    </tr>
    <tr>
    <td width="50%">
    <div class="form-group">
    <label  class="  col-sm-5 control-label">Date of Birth :</label>
    <div class="col-sm-7">
       <div class='input-group date' id='dob' data-date-format="YYYY/MM/DD">
                    <input type='text' autocomplete="off" tabindex="5" class="form-control dob " placeholder="dd/mm/yyyy" name="dob" <?php  if(isset($_request['id'])){ echo "value='".date('d/m/Y',User::driverInfo($_request['id'],'Dob'))."'";} else{echo "value='".date('d/m/Y',User::driverInfo($_request['info'],'Dob'))."'";echo "readonly";}?> required/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
    </div>
  </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">Date of Joining :</label>
    <div class="col-sm-7">
     <div class='input-group date' id='doj' data-date-format="YYYY/MM/DD">
                    <input type='text' autocomplete="off" tabindex="6" class="form-control doj " placeholder="dd/mm/yyyy" name="doj" <?php  if(isset($_request['id'])){ echo "value='".date('d/m/Y',User::driverInfo($_request['id'],'Doj'))."'";} else{ echo "value='".date('d/m/Y',User::driverInfo($_request['info'],'Doj'))."'"; echo "readonly";}?> required/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
    </div>
  </div>
    </td>
    </tr>
    <tr>
      <td> <div class="form-group">
    <div class="col-sm-offset-5 col-sm-7">
      <button type="submit" class="btn btn-info btn-block btn-lg "  tabindex="11" name='updateD' <?php  if(isset($_request['info'])){ echo "style='display:none'";}?>>Update Driver Info</button>
    </div>
  </div></td>
      <td></td>
    </tr>
  </table>
 
 
</form>

            <?php }else
            {?>

<table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Contact</th>
          <th>Licence</th>
          <th>Status</th>
          <th>Options</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $grp=User::getAllDrivers();
      $i=1;
      foreach ($grp as $data) {
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td><a href='/operator/editdriver?info=$data[id]'>$data[name]</a></td>";
        
        echo "<td>$data[contact]</td>";
        echo "<td>$data[licence]</td>";
        echo "<td>". User::getDriverStatus('$data[id]')."</td>";
         echo "<td><span class='glyphicon glyphicon-info-sign text-warning'></span> <a href='/operator/editdriver?info=$data[id]' >Info</a> | <a href='/operator/editdriver?id=$data[id]'> <span class='glyphicon glyphicon-question-sign text-success'></span>Edit</a> | <span class='glyphicon glyphicon-remove-sign text-danger'></span> <a href='/operator/editdriver?delete=$data[id]' >Delete</a> </td>";
        # code...
         $i++;
      
      
}

      ?>
      
        
      

   
      </tbody>
         </table>
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
     <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/docs.min.js"></script>
    <script src="/assets/js/bootstrap-datepicker.js"></script>
     <script type="text/javascript">
            // When the document is ready
            $(function () {
              
                
  $('[data-toggle=offcanvas]').click(function () {
    $('.row-offcanvas').toggleClass('active')
  });
  <?php if (isset($_request['id'])){ ?>
                $('#Ldate').datepicker({
                    format: "dd/mm/yyyy",
                     autoclose: true,
                    pickTime: false

                });  
                 $('#Vdate').datepicker({
                    format: "dd/mm/yyyy",
                     autoclose: true,
                    pickTime: false

                });  
                 $('#dob').datepicker({
                    format: "dd/mm/yyyy",
                     autoclose: true,
                    pickTime: false

                });  $('#doj').datepicker({
                    format: "dd/mm/yyyy",
                     autoclose: true,
                    pickTime: false

                });  
                <?php } ?>
              });
            </script>
  </body>
</html>


