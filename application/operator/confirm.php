<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

if (! Login::is_operator() && ! Login::is_admin())
{
    Login::redirect();
}

$groups = new Cars;
$booking = new Bookings;
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="./favicon.ico">

    <title>Bookings details - Operator panel</title>

    <?php include 'css.php'; ?>
    <style type="text/css">

        @media print {
            body {
                padding: 0;
                margin: 0;
                line-height: 1.3;
            }

            hr, h4, h3 {
                padding: 0;
                margin: 5px;
                line-height: 1.3;
            }

            br {
                margin: 3px;
            }

            footer {
                display: none;
            }
        }

        table {
            width: 100%;
            margin-top: 10px
        }

        tbody {
            border-top: none;
        }

        .main tr {
            border-bottom: 1px solid #e5e5e5;
            padding: 5px
        }

        .other tr {
            border-bottom: 0px solid #e5e5e5;
            padding: 5px
        }

        .sub tr {
            border-bottom: none
        }

        .main tr:last-child {
            border-bottom: none
        }

        td {
            border-top: none;
        }

        td:before, td:after {
            border: none;
        }

        .omb_loginOr {
            position: relative;
            font-size: 18px;
            color: #aaa;
            margin-top: 1em;
            margin-bottom: 1em;
            padding-top: 0.5em;
            padding-bottom: 0.5em;
        }

        .omb_loginOr .omb_hrOr {
            background-color: #cdcdcd;
            height: 1px;
            margin-top: 0px !important;
            margin-bottom: 0px !important;
        }

        .omb_loginOr .omb_spanOr {
            display: block;
            position: absolute;
            left: 40%;
            top: -0.6em;
            margin-left: -1.5em;
            background-color: white;
            width: 11em;
            text-align: center;
        }
    </style>

</head>

<body>
<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
        <?php include APPPATH . 'menu.php'; ?>
    </div>
    <!-- /.container -->
</div>
<!-- /.navbar -->

<div class="container">

<div class="row row-offcanvas row-offcanvas-right">

<div class="col-xs-6 col-sm-3 sidebar-offcanvas hidden-print" id="sidebar" role="navigation">
    <?php include 'sidebar.php'; ?>
</div>
<!--/span-->
<div class="col-xs-12 col-sm-9">
<div class="page-header hidden-print ">
    <h1>Booking Details
        <small></small>
    </h1>
</div>
<p class="pull-right visible-xs hidden-print">
    <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
</p>


<?php if (isset($_request['id']) && isset($_request['operation']) && $_request['operation'] == 'confirm')
{
    echo "<script type='text/javascript'>document.title ='Confirm ' + document.title;</script>";

    $groups = new Cars;
    $grp = $booking->booking($_request['id']);
    $car = $groups->get_car_details($grp['car']);
    $cargroup = $groups->get_cargroups_details($car['group_id']);
    ?>
    <table class="main">
        <tbody>

        <tr>
            <td width="50%" colspan="2">
                <p class="text-left">
                <h4><b>Booking id: <?php echo $grp['booking_id']; ?></b></h4>
                <br>
                From : <b><?php echo date("l , jS F Y", $grp['from_date']); ?></b> To :
                <b><?php echo date("l , jS F Y", $grp['to_date']); ?> </b></p>
            </td>
        </tr>

        <tr class="last">
            <td width="50%">
                <table class="sub">
                    <tbody>
                    <tr>
                        <td width="50%">
                            <p class="text-left"><b><?php echo User::info($grp['user'], 'name'); ?></b></p>

                            <p class="text-left text-muted" style="font-size:12px"> Name</p>
                        </td>
                        <td width="50%">
                            <p class="text-left"><b><?php echo User::info($grp['user'], 'contact'); ?></b></p>

                            <p class="text-left text-muted" style="font-size:12px"> Contact </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td width="50%">
                <table class="sub">
                    <tbody>
                    <tr>
                        <td width="50%">
                            <p class="text-left"><b><?php echo $grp['persons']; ?></b></p>

                            <p class="text-left text-muted" style="font-size:12px"> No of Persons</p>
                        </td>
                        <td width="50%">
                            <p class="text-left"><b><?php echo User::info($grp['user'], 'address'); ?></b></p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>

    <form class="form" action="/operator/bookings" method="post">
    <input type="hidden" name='id' <?php echo "value='" . $_request['id'] . "'"; ?>>
    <input type="hidden" name='to' <?php echo "value='" . $grp['to_date'] . "'"; ?>>
    <table class="other">
    <tbody>
    <tr>
        <td colspan="2">
            <div class="row omb_row-sm-offset-3 omb_loginOr">
                <div class="col-xs-12 col-sm-12">
                    <hr class="omb_hrOr">
                    <span class="omb_spanOr">Select Package</span>
                </div>

            </div>
        </td>
    </tr>
    <tr>
        <td width="50%">
            <div class="form-group ">
                <label for="inputEmail3" class="col-sm-5 control-label">Select Package Group</label>

                <div class="col-sm-7">
                    <select class="form-control driver" name='cat_id' required>

                        <?php
                        $groups = new Cars;
                        $data = $Operator->getpackagedetails($grp['package_id']);
                        $groupinfo = $Operator->getpackagegroupdetails($data['cat_id']);

                        echo "<option value='$groupinfo[cat_id]'>$groupinfo[name]</option>";



                        ?>


                    </select>
                </div>
            </div>
        </td>
        <td width="50%">
            <div class="driverinfo">
                <div class="form-group ">
                    <label for="inputEmail3" class="col-sm-5 control-label">Select Package </label>

                    <div class="col-sm-7">

                        <select class="form-control driver" name='package_id' required>

                            <?php
                            $groups = new Cars;

                            $data = $Operator->getpackagedetails($grp['package_id']);

                            echo "<option value='$data[package_id]' selected> $data[name] </option>";



                            ?>


                        </select>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div class="row omb_row-sm-offset-3 omb_loginOr">
                <div class="col-xs-12 col-sm-12">
                    <hr class="omb_hrOr">
                    <span class="omb_spanOr">Select Car</span>

                </div>

            </div>
        </td>
    </tr>
    <tr>
        <td width="50%" colspan="">

            <div class="form-group ">
                <label for="inputEmail3" class="col-sm-5 control-label">Car Group</label>

                <div class="col-sm-7">
                    <select class="form-control group" name='group' required>
                        <option value="<?php echo $cargroup['name']; ?>"><?php echo $cargroup['name']; ?></option>
                    </select>
                </div>
            </div>
        </td>
        <td>
            <div class="form-group ">
                <label for="inputEmail3" class="col-sm-5 control-label">Car</label>

                <div class="col-sm-7">
                    <select class="form-control car" name='car' required>
                        <option value="<?php echo $car['name']; ?>"> <?php echo $car['name']; ?> </option>

                    </select>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div class="row omb_row-sm-offset-3 omb_loginOr">
                <div class="col-xs-12 col-sm-12">
                    <hr class="omb_hrOr">
                    <span class="omb_spanOr">Select Driver</span>
                </div>

            </div>
        </td>
    </tr>

    <tr>
        <td width="50%">
            <div class="form-group ">
                <label for="inputEmail3" class="col-sm-5 control-label">Select Driver</label>

                <div class="col-sm-7">
                    <select class="form-control driver" name='driver' required>

                        <?php
                        $groups = new Cars;
                        $drivers = User::get_drivers();
                        foreach ($drivers as $value)
                        {
                            echo "<option value='$value[user_id]'>" . User::info($value['user_id'], 'name') . "</option>";
                        }


                        ?>


                    </select>
                </div>
            </div>
        </td>
        <td width="50%">
            <div class="driverinfo"></div>
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <div class="row omb_row-sm-offset-3 omb_loginOr">
                <div class="col-xs-12 col-sm-12">
                    <hr class="omb_hrOr">
                    <span class="omb_spanOr">Select Time</span>
                </div>

            </div>
        </td>
    </tr>
    <td colspan="2">
        <div class="form-group ">
            <label for="inputEmail3" class="col-sm-2 control-label">Select Time</label>

            <div class="col-sm-7">
                <div class="form-inline">

                    <select name="time_to_hrs" class="form-control col-sm-1">
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>

                    <select name="time_to_min" class="form-control col-sm-1">
                        <option value="00">00</option>
                        <option value="05">05</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                        <option value="30">30</option>
                        <option value="35">35</option>
                        <option value="40">40</option>
                        <option value="45">45</option>
                        <option value="50">50</option>
                        <option value="55">55</option>

                    </select>
                    <select name="time_to_type" class="form-control col-sm-1">
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>
                </div>
            </div>
        </div>
    </td>
    </tr>
    <tr>
        <td colspan="2">

        </td>
    </tr>
    <tr>
        <td><br>

            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-7">
                    <button type="submit" class="btn btn-success btn-block btn-lg " tabindex="11" name='confirmB'>
                        Confirm Booking
                    </button>
                </div>
            </div>
        </td>
    </tr>
    </tbody>
    </table>
    </form>

<?php } ?>
<?php if ($_request['operation'] == 'new')
{
    echo "<script type='text/javascript'>document.title ='New Company Booking ' + document.title;</script>";

    ?>
    <form class="form-horizontal" action="" method="post">
    <fieldset class="form-inline">

        <!-- Form Name -->
        <legend>Journey Date</legend>

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

        <div class="row ">


            <?php
            }
            ?>


    </fieldset>
    <br>
    <fieldset class="form-inline">
        <legend>Package Details</legend>
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
        <legend>Car Details</legend>
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
            <legend>Company Details</legend>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
                <?php $mycompanies = myDB::getInstance()->get('transwise_companies', array('company_id', '!=', '1'))->results() ?>
                <div class="col-sm-5">
                    <select class="form-control companyNames" id="compnayNames" name='companyNames' required>
                        <option value='x' selected="selected">Select Company</option>
                        <?php
                        foreach ($mycompanies as $company)
                            echo "<option value='{$company->company_id}'> {$company->name}</option>";
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Contact Person</label>

                <div class="col-sm-5">
                    <input type="text" class="form-control companyPerson" id="companyPerson" placeholder="Contact Person"
                           name='companyPerson'
                           value="">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Project Name</label>

                <div class="col-sm-5">
                    <select class="form-control ProjectNames" name='projectNames' id="projectNames" required>

                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Email</label>

                <div class="col-sm-5">
                    <input type="email" class="form-control companyEmail" id="inputEmail3" placeholder="Email" name='email'
                           value=""
                           required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Contact No.</label>

                <div class="col-sm-5">
                    <input type="tel" pattern="\d{10}" class="form-control companyContact" id="inputEmail3" name='contact'
                           placeholder="Contact No"
                           value=""
                           required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Address</label>

                <div class="col-sm-5">
                    <textarea class="form-control" rows="3" cols="7" placeholder="Address" name='address'
                              required></textarea>
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

<?php } ?>

</div>
<!--/span-->

</div>
<!--/row-->


<hr>

<footer>
    <p>&copy; Company 2014</p>
</footer>

</div>
<!--/.container-->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="./assets/js/jquery.js"></script>
<script src="./assets//js/bootstrap.min.js"></script>

<script type="text/javascript">

    $(document).ready(function () {
        $('[data-toggle=offcanvas]').click(function () {
            $('.row-offcanvas').toggleClass('active')
        });

        <?php if(isset($_request['print'])) echo "window.print(); window.close();";?>
    });
    function prints() {
        child = window.open('http://localhost/', 'Home', 'width=600, height=500');
        window.focus();

    }

</script>
<script src="./assets/js/docs.min.js"></script>
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

});


$(".packagegroup").change(function () {
   // $("#main").hide();
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
    //$("#main").hide();
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
   // $("#main").hide();
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
   //    $("#main").hide();
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
              //  $("#main").show(500);
            }
        }
    });

});




//$(".companyNames").change(function () {
//    // $("#main").hide();
//   $(".package").fadeTo(250, 0.33);
//   $(".packagegroup").attr("disabled", "disabled");
//   $(".package").attr("disabled", "disabled");
//   $(".book").attr("disabled", "disabled");
//   $(".itemoptions").html('');
//    $(".loader").show();
//    var id = $(this).val();
//    alert(id);
//    var dataString = 'company_id=' + id + '&companyinfo=1';
//    $.ajax
//    ({
//        type: "POST",
//        url: "/api/api.company",
//        data: dataString,
//        cache: false,
//        dataType: 'json',
//        success: function (html) {
//           // $(".package").fadeTo(250, 1);
//            //alert(html.contactPersonName);
//            $(".projectNames").html(html.projects);
//            $(".ContactPerson").val(html.contactPersonName);
//            $(".loader").hide();
//            $(".package").removeAttr("disabled");
//            $(".packagegroup").removeAttr("disabled");
//        }
//    });
//
//});


$(".companyNames").change(function()
{
    var id=$(this).val();
    var dataString = 'id='+ id;

    $.ajax
    ({
        type: "POST",
        url: "/api/api.company",
        data: dataString,
       cache: false,
        //dataType: 'json',
        success: function(html)
        {
            var temp=html.substring(0,html.indexOf("<div"));
            // echo substr($projects[0]->name,0,$temp);
                    var res = temp.split('*');
            $(".companyPerson").val(res[0]);
            $(".companyEmail").val(res[1]);
            $(".companyContact").val(res[2]);
            $(".ProjectNames").html(res[3]);
        }
    });

});

</script>
</body>
</html>

