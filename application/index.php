<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="/favicon.ico">

<title>Welcome to <?php echo Company::getdetails('Name');?> - <?php $tag=Company::getdetails('Tagline'); echo ( $tag);?></title>



<!-- Bootstrap core CSS -->
<link href="/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="/assets/css/half-slider.css" rel="stylesheet">
<link href="/assets/css/datepicker.css" rel="stylesheet">
<link href="/assets/css/docs.min.css" rel="stylesheet">
<!-- Just for debugging purposes. Don't actually copy this line! -->
<!--[if lt IE 9]><script src="/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


<!-- Favicons -->
<link rel="apple-touch-icon-precomposed"
	href="/assets/ico/apple-touch-icon-precomposed.png">
<link rel="icon" href="/favicon.ico">





</head>
<!-- NAVBAR
================================================== -->
<body>
	<div class="navbar-wrapper">
		<div class="container">

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<div class="container">
       <?php include 'menu.php';?>
      </div>

			</div>
		</div>
<!--header image slider -->

<!--/header image slider -->
    </div>
    <?php include 'headerSlider.php' ?>
		<!-- Marketing messaging and featurettes
    ================================================== -->
		<!-- Wrap the rest of the page in another container to center all the content. -->

		<div class="container marketing">
			<div class="page-header">
				<h1>
					Plan Your Journey<small></small>
				</h1>
			</div>
			<form role="form" action="/booking" method="post">
				<div class="row ">
					<div class="col-lg-4">
						<div class="form-group form-group-lg">
							<label for="exampleInputEmail1">From</label>
							<div class='input-group date' id='fromdate'
								data-date-format="YYYY/MM/DD">
								<input type='text' autocomplete="off" tabindex="1"
									class="form-control fromdate " placeholder="dd/mm/yyyy"
									name="fromdate" required /> <span class="input-group-addon"><span
									class="glyphicon glyphicon-calendar"></span> </span>
							</div>
						</div>
						<div class="checkbox">
							<label> <input type="checkbox" name="single" class="single"
								tabindex="3"> Single Day
							</label>
						</div>
						<button type="submit" class=" btn btn-warning btn-lg plan"
							name="planning" tabindex="4">Plan it</button>
					</div>
					<div class="col-lg-4">
						<div class="form-group form-group-lg">
							<label for="exampleInputPassword1">To</label>
							<div class='input-group date' id='todate'
								data-date-format="YYYY/MM/DD">
								<input type='text' autocomplete="off" tabindex="2"
									class="form-control todate" name="todate"
									placeholder="dd/mm/yyyy" required /> <span
									class="input-group-addon"><span
									class="glyphicon glyphicon-calendar"></span> </span>
							</div>
						</div>
					</div>
				</div>
			</form>

			<hr class="featurette-divider">
			<div class="row">
				<div class="col-lg-4">
					<img class="img-circle" src="assets/img/customer_satisfaction.png"
						alt="Generic placeholder image">
					<h3>Customer Satisfaction</h3>
					<p>Your Service satisfaction gives Transwise the core happiness of
						goal’s achievement.</p>
					<p>
						<a class="btn btn-default" href="/register" role="button">Sign up
							today &raquo;</a>
					</p>
				</div>
				<div class="col-lg-4">
					<img class="img-circle" src="assets/img/24x7.png"
						alt="Generic placeholder image">
					<h3>24x7 Service</h3>
					<p>Transwise Provides 24x7 Day/Night service to its valuable
						customers.</p>
					<p>
						<a class="btn btn-default" href="#" role="button">View details
							&raquo;</a>
					</p>
				</div>
				<div class="col-lg-4">
					<img class="img-circle" src="assets/img/value_for_money.png"
						alt="Generic placeholder image">
					<h2>Value for money</h2>
					<p>Transwise services will offer best value for money.</p>
					<p>
						<a class="btn btn-default" href="#" role="button">View details
							&raquo;</a>
					</p>
				</div>
			</div>
<?php // phpinfo();?>

      <!-- START THE FEATURETTES -->

			<hr class="featurette-divider">

			<!-- /END THE FEATURETTES -->


			<!-- FOOTER -->
			<footer>
				<p class="pull-right">
					<a href="#">Back to top</a>
				</p>
				<p>
					&copy; 2014 Company, Inc. &middot; <a href="#">Privacy</a> &middot;
					<a href="#">Terms</a>
				</p>
			</footer>

		</div>
		<!-- /.container -->


		<!-- Bootstrap core JavaScript
    ================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
        <script src="/assets/js/jquery-1.11.0.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
		<script src="/assets/js/docs.min.js"></script>
		<script src="/assets/js/bootstrap-datepicker.js"></script>
		<script type="text/javascript">
            // When the document is ready

            $(function () {
                $('#fromdate').datepicker({
                    format: "dd/mm/yyyy",
                     startDate: "/",
                     todayBtn: "linked",
                     autoclose: true,
                    pickTime: false
                });
            $('#todate').datepicker({
                    format: "dd/mm/yyyy",
                     todayBtn: "linked",
                    autoclose: true,
                    pickTime: false
                });

            $('.fromdate').change(function(){
              var myDate=$('.fromdate').val();
            myDate=myDate.split("/");
           var from = new Date(parseInt(myDate[2], 10), parseInt(myDate[1], 10) - 1 , parseInt(myDate[0]), 10).getTime();

            myDate=$('.todate').val();
            myDate=myDate.split("/");
           var to = new Date(parseInt(myDate[2], 10), parseInt(myDate[1], 10) - 1 , parseInt(myDate[0]), 10).getTime();

            if(from>to)
            {
              $(".plan").attr("disabled", "disabled");
              alert("Please Pick proper date to begien your Journey!!");
            }
            else
            {
              $(".plan").removeAttr("disabled");
            }
            
               $('#todate').datepicker('setStartDate',$('.fromdate').val());
               $('#todate').datepicker('setDate',$('.fromdate').val());
               $('#todate').datepicker('update');
            });

           $('.todate').change(function(){

           var myDate=$('.fromdate').val();
            myDate=myDate.split("/");
           var from = new Date(parseInt(myDate[2], 10), parseInt(myDate[1], 10) - 1 , parseInt(myDate[0]), 10).getTime();

            myDate=$('.todate').val();
            myDate=myDate.split("/");
           var to = new Date(parseInt(myDate[2], 10), parseInt(myDate[1], 10) - 1 , parseInt(myDate[0]), 10).getTime();

            if(from>to)
            {
              $(".plan").attr("disabled", "disabled");
              alert("Please Pick proper date to begien your Journey!!");
            }
            else
            {
              $(".plan").removeAttr("disabled");
            }

            if($('.single').is(':checked'))
            {
               $('.todate').val($('.fromdate').val());
              $('.todate').attr("readonly", "readonly");

            }

           });

 $('.single').change(function(){
           var myDate=$('.fromdate').val();
            myDate=myDate.split("/");
           var from = new Date(parseInt(myDate[2], 10), parseInt(myDate[1], 10) - 1 , parseInt(myDate[0]), 10).getTime();

            myDate=$('.todate').val();
            myDate=myDate.split("/");
           var to = new Date(parseInt(myDate[2], 10), parseInt(myDate[1], 10) - 1 , parseInt(myDate[0]), 10).getTime();

            if(from>to)
            {
              $(".plan").attr("disabled", "disabled");
              alert("Please Pick proper date to begien your Journey!!");
            }
            else
            {
              $(".plan").removeAttr("disabled");
            }
            
      if($(this).is(':checked')&&$('.fromdate').val()!="") {
          $('.todate').val($('.fromdate').val());
              $('.todate').attr("readonly", "readonly");
      } else {
         $('.todate').removeAttr("readonly");
          $('.todate').val("");
      }
   });

   $('.single').each(function(){
      $(this).change();
   });

            });

        </script>
        <script>
            $('.carousel').carousel({
                interval: 5000 //changes the speed
            })
        </script>
	</div>


</body>
</html>
