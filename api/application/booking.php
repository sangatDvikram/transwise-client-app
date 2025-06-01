<?php if (! defined('BASEPATH')) exit('No direct script access allowed');


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

    <title>Book your car now !!</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/datepicker.css" rel="stylesheet">
    <link href="./assets/css/docs.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            padding-top: 70px;
        }

        textarea {
            resize: none;
        }
    </style>


    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <?php include 'menu.php'; ?>
    </div>
</div>

<div class="container">
<div class="row ">
<div class="col-sm-8">
    <?php
    if (isset($_POST['book']))
    {

        $book = new Bookings;
        $book->getData($_POST);
        echo $book->bookit();
    }

    ?>
    <form class="form-horizontal" action="" method="post">
        <fieldset class="form-inline">

            <!-- Form Name -->
            <legend>Book your journey now</legend>

            <!-- Text input-->
            <?php if (isset($_POST['planning']))
            {

                $date = DateTime::createFromFormat('!d-m-Y', $_POST['fromdate']);

                list($day, $month, $year) = explode('/', $_POST['fromdate']);

                list($day, $month, $year) = explode('/', $_POST['todate']); ?>

                <div class="form-group">
                    <label class="col-md-6 control-label" for="fromdate">From</label>

                    <div class="col-md-4">
                        <input id="fromdate" name="fromdate" type="text" placeholder="dd/mm/yyyy"
                               class="form-control input-md" required="" value="<?php echo "$_POST[fromdate]"; ?>"
                               readonly="">

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-6 control-label" for="fromdate">To</label>

                    <div class="col-md-4">
                        <input id="todate" name="todate" type="text" placeholder="dd/mm/yyyy"
                               class="form-control input-md" value="<?php echo "$_POST[todate]"; ?>" required=""
                               readonly="">
                    </div>
                </div>
            <?php
            }
            else
            {
            ?>
            <div class="row form-inline">

                <div class="col-sm-6 form-group">
                    <label class="col-sm-5 control-label">From : </label>

                    <div class="col-sm-7">
                        <div class=' input-group date' id='fromdate' data-date-format="YYYY/MM/DD">
                            <input type='text' autocomplete="off" tabindex="1" class="form-control fromdate "
                                   placeholder="dd/mm/yyyy" name="fromdate" required/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 form-group">
                    <label class=" col-sm-5 control-label">To : </label>

                    <div class="col-sm-7">
                        <div class=' input-group date' id='todate' data-date-format="YYYY/MM/DD">
                            <input type='text' autocomplete="off" tabindex="2" class="form-control todate" name="todate"
                                   placeholder="dd/mm/yyyy" required/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-inline">

                <div class="col-sm-6 form-group ">
                    <label class="col-sm-5 control-label checkbox"> Single Day <input type="checkbox" name="single"
                                                                                      class="single"
                                                                                      tabindex="3"></label>


                </div>
                <div class="col-sm-6 form-group">

                </div>
            </div>
            <div class="row ">


                <?php
                }
                ?>


        </fieldset>
        <br>
        <fieldset class="form-inline">
            <legend>Pick Your Package</legend>
            <div class="row form-inline">
                <div class="col-sm-6 form-group">
                    <label class="col-sm-5 control-label">Package Group : </label>

                    <div class="col-sm-7">
                        <select class="form-control packagegroup" name='package_group' required>
                            <option value="x">Select Package Group</option>
                            <?php
                            $groups = new Operator();
                            $data = $groups->getpackagegroupdetails();
                            foreach ($data as $value)
                            {
                                echo "<option value='$value[cat_id]'>$value[name]</option>";
                            }


                            ?>


                        </select>
                    </div>
                </div>
                <div class="col-sm-6 form-group">
                    <label class=" col-sm-5 control-label">Package : </label>

                    <div class="col-sm-7">
                        <select class="form-control package" name='package_id' required>
                            <option value="x"> Select Package</option>
                        </select>
                    </div>
                </div>
            </div>
        </fieldset>
        <br>
        <fieldset class="form-inline">
            <legend>Pick Your Car</legend>
            <div class="row form-inline">
                <div class="col-sm-6 form-group">
                    <label class="col-sm-5 control-label">Car Group : </label>

                    <div class="col-sm-7">
                        <select class="form-control group" name='group' required>
                            <option value="x">Select Car Group</option>
                            <?php
                            $groups = new Cars;
                            $data = $groups->cargroups();
                            foreach ($data as $value)
                            {
                                echo "<option value='$value[id]'>$value[name]</option>";
                            }


                            ?>


                        </select>
                    </div>
                </div>
                <div class="col-sm-6 form-group">
                    <label class=" col-sm-5 control-label">Car : </label>

                    <div class="col-sm-7">
                        <select class="form-control car" name='car' required>
                            <option value="x"> Select Car</option>
                        </select>
                    </div>
                </div>
            </div>
        </fieldset>
        <div id='main'>
            <fieldset class="form-horizontal">
                <legend>Your Details</legend>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Name</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="Name" name='name'
                               value="<?php echo (Login::is_logged_in() && User::userinfo('name') != '') ? User::userinfo('name') : ""; ?>"
                               required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-5">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name='email'
                               value="<?php echo (Login::is_logged_in() && User::userinfo('email') != '') ? User::userinfo('email') : ""; ?>"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Contact No.</label>

                    <div class="col-sm-5">
                        <input type="tel" pattern="\d{10}" class="form-control" id="inputEmail3" name='contact'
                               placeholder="Contact No"
                               value="<?php echo (Login::is_logged_in() && User::userinfo('contact') != '') ? User::userinfo('contact') : ""; ?>"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-5">
                        <textarea class="form-control" rows="3" cols="7" placeholder="Address" name='address'
                                  required><?php echo (Login::is_logged_in() && User::userinfo('address') != '') ? User::userinfo('address') : ""; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">No of persons.</label>

                    <div class="col-sm-5">
                        <input type="number" min="1" class="form-control" id="inputEmail3" name='persons'
                               placeholder="No of persons." required>
                    </div>
                </div>
            </fieldset>
            <fieldset class="form-horizontal">
                <button type="submit" class="btn btn-primary btn-lg btn-block book" name='book' disabled>Book cab
                </button>

            </fieldset>
        </div>
    </form>

</div>
<div class="col-sm-4">

    <div class="info"></div>
</div>
</div>

<hr>
<!-- FOOTER -->
<footer>
    <p class="pull-right"><a href="#">Back to top</a></p>

    <p>&copy; 2014 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
</footer>

</div>
<!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="./assets/js/jquery.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/bootstrap-datepicker.js"></script>
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
        startDate: "/",
        todayBtn: "linked",
        autoclose: true,
        pickTime: false
    });
    $('.fromdate').change(function () {
        var myDate = $('.fromdate').val();
        myDate = myDate.split("/");
        var from = new Date(parseInt(myDate[2], 10), parseInt(myDate[1], 10) - 1, parseInt(myDate[0]), 10).getTime();

        myDate = $('.todate').val();
        myDate = myDate.split("/");
        var to = new Date(parseInt(myDate[2], 10), parseInt(myDate[1], 10) - 1, parseInt(myDate[0]), 10).getTime();

        if (from > to) {
            $(".plan").attr("disabled", "disabled");
            alert("Please Pick proper date to begien your Journey!!");
        }
        else {
            $(".plan").removeAttr("disabled");
        }

        $('#todate').datepicker('setStartDate', $('.fromdate').val());
        $('#todate').datepicker('setDate', $('.fromdate').val());
        $('#todate').datepicker('update');
    });

    $('.todate').change(function () {

        var myDate = $('.fromdate').val();
        myDate = myDate.split("/");
        var from = new Date(parseInt(myDate[2], 10), parseInt(myDate[1], 10) - 1, parseInt(myDate[0]), 10).getTime();

        myDate = $('.todate').val();
        myDate = myDate.split("/");
        var to = new Date(parseInt(myDate[2], 10), parseInt(myDate[1], 10) - 1, parseInt(myDate[0]), 10).getTime();

        if (from > to) {
            $(".plan").attr("disabled", "disabled");
            alert("Please Pick proper date to begien your Journey!!");
        }
        else {
            $(".plan").removeAttr("disabled");
        }

        if ($('.single').is(':checked')) {
            $('.todate').val($('.fromdate').val());
            $('.todate').attr("readonly", "readonly");

        }

    });

    $('.single').change(function () {
        var myDate = $('.fromdate').val();
        myDate = myDate.split("/");
        var from = new Date(parseInt(myDate[2], 10), parseInt(myDate[1], 10) - 1, parseInt(myDate[0]), 10).getTime();

        myDate = $('.todate').val();
        myDate = myDate.split("/");
        var to = new Date(parseInt(myDate[2], 10), parseInt(myDate[1], 10) - 1, parseInt(myDate[0]), 10).getTime();

        if (from > to) {
            $(".plan").attr("disabled", "disabled");
            alert("Please Pick proper date to begien your Journey!!");
        }
        else {
            $(".plan").removeAttr("disabled");
        }

        if ($(this).is(':checked') && $('.fromdate').val() != "") {
            $('.todate').val($('.fromdate').val());
            $('.todate').attr("readonly", "readonly");
        } else {
            $('.todate').removeAttr("readonly");
            $('.todate').val("");
        }
    });
    $('.single').each(function () {
        $(this).change();
    });

    $(".loader").hide();
    $("#main").hide();

    $(".book").attr("disabled", "disabled");
    $(".packagegroup").change(function () {
        $("#main").hide();
        $(".package").fadeTo(250, 0.33);
        $(".packagegroup").attr("disabled", "disabled");
        $(".package").attr("disabled", "disabled");
        $(".book").attr("disabled", "disabled");
        $(".itemoptions").html('');
        $(".loader").show();
        var id = $(this).val();
        var dataString = 'package_group=' + id + '&groupinfo=1';
        $.ajax
        ({
            type: "POST",
            url: "/api/api.packageinfo",
            data: dataString,
            cache: false,
            dataType: 'json',
            success: function (html) {
                $(".package").fadeTo(250, 1);
                $(".package").html(html.Packages);
                $(".info").html(html.Data);
                $(".loader").hide();
                $(".package").removeAttr("disabled");
                $(".packagegroup").removeAttr("disabled");
            }
        });

    });

    $(".package").change(function () {
        $("#main").hide();
        $(".package").fadeTo(250, 0.33);
        $(".packagegroup").fadeTo(250, 0.33);
        $(".packagegroup").attr("disabled", "disabled");
        $(".package").attr("disabled", "disabled");
        $(".book").attr("disabled", "disabled");
        $(".itemoptions").html('');
        $(".loader").show();
        var id = $(this).val();
        var dataString = 'package_id=' + id + '&packageinfo=1';
        $.ajax
        ({
            type: "POST",
            url: "/api/api.packageinfo",
            data: dataString,
            cache: false,
            dataType: 'json',
            success: function (html) {

                $(".package").fadeTo(250, 1);
                $(".packagegroup").fadeTo(250, 1);
                $(".info").html(html.Data);
                $(".loader").hide();
                $(".package").removeAttr("disabled");
                $(".packagegroup").removeAttr("disabled");
                $(".book").removeAttr("disabled");

            }
        });

    });
    $(".group").change(function () {
        $("#main").hide();
        $(".car").fadeTo(250, 0.33);
        $(".group").attr("disabled", "disabled");
        $(".car").attr("disabled", "disabled");
        $(".itemoptions").html('');
        $(".loader").show();
        var id = $(this).val();
        var dataString = 'group=' + id + '&groupinfo=1';
        $.ajax
        ({
            type: "POST",
            url: "/api/api.groupinfo",
            data: dataString,
            cache: false,
            dataType: 'json',
            success: function (html) {
                $(".car").fadeTo(250, 1);
                $(".car").html(html.Cars);
                $(".info").html(html.Data);
                $(".loader").hide();
                $(".car").removeAttr("disabled");
                $(".group").removeAttr("disabled");
            }
        });

    });

    $(".car").change(function () {
        $("#main").hide();
        $(".car").fadeTo(250, 0.33);
        $(".group").fadeTo(250, 0.33);
        $(".group").attr("disabled", "disabled");
        $(".car").attr("disabled", "disabled");
        $(".book").attr("disabled", "disabled");
        $(".itemoptions").html('');
        $(".loader").show();
        var id = $(this).val();
        var dataString = 'car=' + id + '&carinfo=1';
        $.ajax
        ({
            type: "POST",
            url: "/api/api.groupinfo",
            data: dataString,
            cache: false,
            dataType: 'json',
            success: function (html) {

                $(".car").fadeTo(250, 1);
                $(".group").fadeTo(250, 1);
                $(".info").html(html.Data);
                $(".loader").hide();
                $(".car").removeAttr("disabled");
                $(".group").removeAttr("disabled");
                $(".book").removeAttr("disabled");
                if (html.Data == "") {
                }
                else {
                    $("#main").show(500);
                }
            }
        });

    });
});
</script>

</body>
</html>
