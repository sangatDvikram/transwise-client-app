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
    <link rel="shortcut icon" href="./favicon.ico">

    <title> Add Chauffeur - Operator panel</title>

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
          <h1>Add Chauffeur <small>Add new chauffeur to your crew</small></h1>
          </div>
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
         <div id="info">
            <?php if(isset($_POST['adddriver']))
            {
              
              $groups->getData($_POST);
              $page=$groups->RegisterDriver();
              echo $page;
            }
            ?>
          </div>
          <form class="form-horizontal" role="form" action="" method="post">
  
  <table class="table " style="text-align:left;">
    <tr>
    <td width="50%">
    <div class="form-group">
    <label  class="  col-sm-5 control-label">Name :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="1" name="name" placeholder="Chauffeur Name" required>
    </div>
  </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">Mobile Number :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="2" name="contact" placeholder="Mobile Number" required>
    </div>
  </div>
    </td>
    </tr>
    <tr>
    <td width="50%">
    <div class="form-group">
    <label  class="  col-sm-5 control-label">Licence Number :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="3" name="licence" placeholder="Licence Number" required>
    </div>
  </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">PAN Card Number :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="4" name="pan" placeholder="PAN Number" required>
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
                    <input type='text' autocomplete="off" tabindex="5" class="form-control Ldate " placeholder="dd/mm/yyyy" name="Ldate" required/>
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
                    <input type='text' autocomplete="off" tabindex="6" class="form-control Vdate " placeholder="dd/mm/yyyy" name="Vdate" required/>
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
      <input type="text" class="form-control"  tabindex="7" name="address" placeholder="Present Address" required>
    </div>
  </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">Permanent Address :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="8" name="perAdd" placeholder="Permanent Address" required>
    </div>
  </div>
    </td>
    </tr>
    <tr>
    <td width="50%">
    <div class="form-group">
    <label  class="  col-sm-5 control-label">Email Address :</label>
    <div class="col-sm-7">
      <input type="email" class="form-control"  tabindex="9" name="email" placeholder="Email Address" >
    </div>
  </div>
    </td>
    <td width="50%">
    <div class="form-group ">
    <label  class="col-sm-5 control-label">Referance off :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control"  tabindex="10" name="reff" placeholder="Referance Name" >
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
                    <input type='text' autocomplete="off" tabindex="5" class="form-control dob " placeholder="dd/mm/yyyy" name="dob" required/>
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
                    <input type='text' autocomplete="off" tabindex="6" class="form-control doj " placeholder="dd/mm/yyyy" name="doj" required/>
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
      <button type="submit" class="btn btn-success btn-block btn-lg "  tabindex="11" name='adddriver'>Register Chauffeur</button>
    </div>
  </div></td>
      <td></td>
    </tr>
  </table>
 
 
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
     <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/docs.min.js"></script>
    <script src="./assets/js/bootstrap-datepicker.js"></script>
     <script type="text/javascript">
            // When the document is ready
            $(function () {
              
                
  $('[data-toggle=offcanvas]').click(function () {
    $('.row-offcanvas').toggleClass('active')
  });
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
              });
            </script>
  </body>
</html>

