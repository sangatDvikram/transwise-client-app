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
    <link rel="shortcut icon" href="/favicon.ico">

    <title> Add Vehicle - Operator panel</title>

    <!-- Bootstrap core CSS -->
   <?php include 'css.php';?>
   <style type="text/css">
   table {width: 100%;margin-top: 10px}
tbody{border-top: none;}
.noborder table, .noborder tr, .noborder td{border-top:none }
.sub tr{border-bottom: none}
td{border-top: none;}
td:before , td:after{border:none;}
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
          <h1>Add Vehicle  <small>Add Vehicle to the stock.</small></h1>
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
  
  <table class="noborder noborder" style="text-align:left;" cellpadding="5" cellspacing="5">
    <tr>
    <td width="50%">
    <div class="form-group">
    <label  class="  col-sm-5 control-label">Name :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="1" name="name" placeholder="Car Name" required>
    </div>
  </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">Owner Name :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="2" name="owner" placeholder="Owner Name" required>
    </div>
  </div>
    </td>
    </tr>
    <tr>
    <td width="50%">
    <div class="form-group ">
  <label for="inputEmail3" class="col-sm-5 control-label">Vehicle Group</label>
    <div class="col-sm-7">
      <select class="form-control" name='group' tabindex="3" required>
      <?php 

        $data=$groups->cargroups();
        foreach ($data as $value) {
         echo "<option value='$value[name]'>$value[name]</option>";
        }


      ?>
  
  
</select>
    </div>
    </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">Registration No :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="4" name="Reg_num" placeholder="Registration Number" required>
    </div>
  </div>
    </td>
    </tr>
    <tr>
    <td width="50%">
    <div class="form-group">
    <label  class="  col-sm-5 control-label">Purchased From :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="5" name="pfrom" placeholder="Purchased From" required>
    </div>
  </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">Date of Purchase :</label>
    <div class="col-sm-7">
        <div class='input-group date' id='Ldate' data-date-format="YYYY/MM/DD">
        <input type='text' autocomplete="off" tabindex="6" class="form-control Ldate " placeholder="dd/mm/yyyy" name="Dop" required/>
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
    <label  class="  col-sm-5 control-label">Engine Number :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="7" name="Engine_number" placeholder="Engine Number" required>
    </div>
  </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">Chesis Number :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="8" name="Chesis_number" placeholder="Chesis Number" required>
    </div>
  </div>
    </td>
    </tr>
    <tr>
    <td width="50%">
    <div class="form-group">
    <label  class="  col-sm-5 control-label">RTO Tax From :</label>
    <div class="col-sm-7">
      <div class='input-group date' id='Ldate' data-date-format="YYYY/MM/DD">
        <input type='text' autocomplete="off" tabindex="9" class="form-control Ldate " placeholder="dd/mm/yyyy" name="RTO_from" required/>
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
        </span>
        </div>
    </div>
  </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">RTO Tax To :</label>
    <div class="col-sm-7">
      <div class='input-group date' id='Ldate' data-date-format="YYYY/MM/DD">
        <input type='text' autocomplete="off" tabindex="10" class="form-control Ldate " placeholder="dd/mm/yyyy" name="RTO_to" required/>
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
    <label  class="  col-sm-5 control-label">Inc. Dt. From :</label>
    <div class="col-sm-7">
      <div class='input-group date' id='Ldate' data-date-format="YYYY/MM/DD">
        <input type='text' autocomplete="off" tabindex="11" class="form-control Ldate " placeholder="dd/mm/yyyy" name="INC_from" required/>
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
        </span>
        </div>
    </div>
    </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">Inc. Dt. To :</label>
    <div class="col-sm-7">
      <div class='input-group date' id='Ldate' data-date-format="YYYY/MM/DD">
        <input type='text' autocomplete="off" tabindex="12" class="form-control Ldate " placeholder="dd/mm/yyyy" name="INC_to" required/>
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
    <label  class="  col-sm-5 control-label">Permit Dt. From :</label>
    <div class="col-sm-7">
      <div class='input-group date' id='Ldate' data-date-format="YYYY/MM/DD">
        <input type='text' autocomplete="off" tabindex="13" class="form-control Ldate " placeholder="dd/mm/yyyy" name="Per_from" required/>
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
        </span>
        </div>
    </div>
    </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">Permit Dt. To :</label>
    <div class="col-sm-7">
      <div class='input-group date' id='Ldate' data-date-format="YYYY/MM/DD">
        <input type='text' autocomplete="off" tabindex="14" class="form-control Ldate " placeholder="dd/mm/yyyy" name="Per_to" required/>
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
    <label  class="  col-sm-5 control-label">Auth. Dt. From :</label>
    <div class="col-sm-7">
      <div class='input-group date' id='Ldate' data-date-format="YYYY/MM/DD">
        <input type='text' autocomplete="off" tabindex="15" class="form-control Ldate " placeholder="dd/mm/yyyy" name="Auth_from" required/>
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
        </span>
        </div>
    </div>
    </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">Auth. Dt. To :</label>
    <div class="col-sm-7">
      <div class='input-group date' id='Ldate' data-date-format="YYYY/MM/DD">
        <input type='text' autocomplete="off" tabindex="16" class="form-control Ldate " placeholder="dd/mm/yyyy" name="Auth_to" required/>
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
    <label  class="  col-sm-5 control-label">Inc Number :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="17" name="INC_numb" placeholder="Inc Number" required>
    </div>
    </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">Permit Number :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="18" name="Per_numb" placeholder="Permit Number" required>
    </div>
    </div>
   </td>
    </tr>
    <tr>
      
    <td width="50%">
    <div class="form-group">
    <label  class="  col-sm-5 control-label">Auth. Number:</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="19" name="Auth_numb" placeholder="Auth. Number" required>
    </div>
    </div>
    </td>
    <td width="50%">
    
   </td>
    </tr>
    <tr>
    <td width="50%">
    <div class="form-group">
    <label  class="  col-sm-5 control-label">PUC. Dt. From :</label>
    <div class="col-sm-7">
      <div class='input-group date' id='Ldate' data-date-format="YYYY/MM/DD">
        <input type='text' autocomplete="off" tabindex="20" class="form-control Ldate " placeholder="dd/mm/yyyy" name="PUC_from" required/>
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
        </span>
        </div>
    </div>
  </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">PUC. Dt. to :</label>
    <div class="col-sm-7">
      <div class='input-group date' id='Ldate' data-date-format="YYYY/MM/DD">
        <input type='text' autocomplete="off" tabindex="21" class="form-control Ldate " placeholder="dd/mm/yyyy" name="PUC_to" required/>
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
    <label  class="  col-sm-5 control-label">Car Color:</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="22" name="color" placeholder="Car Color" required>
    </div>
  </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">Car Type :</label>
    <div class="col-sm-7">
  <select class="form-control" name="type" tabindex="23">
  <option>Diesel</option>
  <option>Petrol</option>
  <option>CNG</option>
  </select>
    </div>
  </div>
    </td>
    </tr>
    <tr>
    <td width="50%">
    <div class="form-group">
    <label  class="  col-sm-5 control-label">Approx Fair:</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="24" name="amount" placeholder="Approximate Fair" required>
    </div>
  </div>
    </td>
    <td width="50%">
    <div class="form-group">
    <label  class="  col-sm-5 control-label">Approx Persons:</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="25" name="persons" placeholder="Approximate Persons" required>
    </div>
  </div>
    </td>
    </tr>
    <tr>
    <td colspan="2">
   
    <div class="form-group ">
    <label  class="col-sm-2 control-label">Car Description:</label>
    <div class="col-sm-10">
  			<textarea name = "details" cols='10' rows='5' tabindex="26" required> </textarea>
    </div>
  </div>
    </td>
    </tr>
     <tr>
    <td colspan="2">
   
    <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success"  tabindex="27" name='addcar'>Add Vehicle</button>
    </div>
  </div>
    </td>
    </tr>
    </table>

</form>
    


       </div>
       </div>
    

      
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
    <script src="/assets/js/bootstrap-datepicker.js"></script>
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
   $('.date').datepicker({
                    format: "dd/mm/yyyy",
                     autoclose: true,
                    pickTime: false

                }); 
});
  </script>
  </body>
</html>

