<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

if (! Login::is_admin())
{
    Login::redirect();
}
$message = '';
$updateOp = false;
$userEdit = null;
$passwordChange = false;
if (isset($_request['passChange'])) // detect that its in password change mode
{
    if (Input::exists()) // if in password change mode and update button is pressed
    {
        $temppass = Input::get('password');

        $userUpdate = myDB::getInstance()->update('transwise_user', "user_id= '" . $_request['passChange'] . "'", array(

            'password' => crypt($temppass, '$2a$12$' . substr(str_replace('+', '.', base64_encode(sha1(microtime(true), true))), 0, 22))
        ));

        if ($userUpdate)
        {
            $message = "<div class='alert alert-success'> Password Update successfuly. <a href='/admin/manageuser?all'>Back to Manage User</a> </div>";
        } else
        {
            $message = "<div class='alert alert-success'>Some thing went wrong!!</div>";
        }
    }
    //do fill controls here
    $userEdit = myDB::getInstance()->get('transwise_user', array('user_id', '=', $_request['passChange']))->first(); //retrieve data of 1st matching record
    if ($userEdit)
    {
        $passwordChange = true;

    } else
    {
        header('Location: index');
    }
    // echo("<script>alert('{$_request['edit']}');</script>");
}
if (isset($_request['edit'])) // detect that its in edit mode
{
    if (Input::exists()) // if in edit mode and update button is pressed
    {
        $userUpdate = myDB::getInstance()->update('transwise_user', "user_id= '" . $_request['edit'] . "'", array(

            'name'       => Input::get('name'),

            'email'      => Input::get('email'),
            'contact'    => Input::get('contact'),
            'address'    => Input::get('address'),
            'timestamp'  => time(),
            'type'       => Input::get('UserType'),
            'company_id' => 1
        ));

        if ($userUpdate)
        {
            $message = "<div class='alert alert-success'> User Update successfuly. <a href='/admin/manageuser?all'>Back to Manage User</a> </div>";
        } else
        {
            $message = "<div class='alert alert-success'>Some thing went wrong!!</div>";
        }
    }
    //do fill controls here
    $userEdit = myDB::getInstance()->get('transwise_user', array('user_id', '=', $_request['edit']))->first(); //retrieve data of 1st matching record
    if ($userEdit)
    {
        $updateOp = true;

    } else
    {
        header('Location: index');
    }
    // echo("<script>alert('{$_request['edit']}');</script>");
}
if (isset($_request['new'])) //if we are creating new user
{
    // die('im in  pre new ');
    $updateOp = false;
    if (Input::exists())
    {
        $tempnewpass = Input::get('password');
        $userInsert = myDB::getInstance()->insert('transwise_user', array(
            'user_id'    => ProcessForm::generate_id('transwise_user', 'user-'),
            'name'       => Input::get('name'),
            'password'   => crypt($tempnewpass, '$2a$12$' . substr(str_replace('+', '.', base64_encode(sha1(microtime(true), true))), 0, 22)),
            'email'      => Input::get('email'),
            'contact'    => Input::get('contact'),
            'address'    => Input::get('address'),
            'timestamp'  => time(),
            'type'       => Input::get('UserType'),
            'company_id' => 1
        ));

        if ($userInsert)
        {
            $message = "<div class='alert alert-success'> New User Added successfuly.</div>";

        } else
        {
            $message = "<div class='alert alert-success'>Something went wrong Please try again.</div>";
        }
    }
}


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/favicon.ico">

    <title><?php echo $updateOp === false ? "Add New" : "Update"; ?> User - Admin panel</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/docs.min.css" rel="stylesheet">
    <link href="/assets/css/offcanvas.css" rel="stylesheet">
    <link href="/assets/css/datepicker.css" rel="stylesheet">
    <style type="text/css">
        body {
            padding-top: 70px;
        }

        #accordion .glyphicon {
            margin-right: 10px;
        }

        .panel-collapse > .list-group .list-group-item:first-child {
            border-top-right-radius: 0;
            border-top-left-radius: 0;
        }

        .panel-collapse > .list-group .list-group-item {
            border-width: 1px 0;
        }

        .panel-collapse > .list-group {
            margin-bottom: 0;
        }

        .panel-collapse .list-group-item {
            border-radius: 0;
        }

        .panel-collapse .list-group .list-group {
            margin: 0;
            margin-top: 10px;
        }

        .panel-collapse .list-group-item li.list-group-item {
            margin: 0 -15px;
            border-top: 1px solid #ddd;
            border-bottom: 0;
            padding-left: 30px;
        }

        .panel-collapse .list-group-item li.list-group-item:last-child {
            padding-bottom: 0;
        }

        .panel-collapse div.list-group div.list-group {
            margin: 0;
        }

        .panel-collapse div.list-group .list-group a.list-group-item {
            border-top: 1px solid #ddd;
            border-bottom: 0;
            padding-left: 30px;
        }

        .panel-body .btn:not(.btn-block) {
            width: 120px;
            margin-bottom: 10px;
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
<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
        <?php include APPPATH . 'menu.php'; ?>
    </div>
    <!-- /.container -->
</div>
<!-- /.navbar -->

<div class="container">

    <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
            <?php include 'adminsidebar.php'; ?>
        </div>
        <!--/span-->
        <div class="col-xs-12 col-sm-6">

            <div class="page-header">
                <h1><?php echo $updateOp === false ? "Add New" : "Update"; ?> User
                    <small>
                        <p class="pull-right visible-xs">
                            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav
                            </button>
                        </p>
                    </small>
                </h1>
            </div>

            <!--  form-->

            <form method="post" action="" class="form-horizontal form-signin " id="registerForm"
                  role="form">
                <div class="form-group">
                    <div class="col-sm-12">
                        <div id="info"> <?php echo $message; ?>
                        </div>
                    </div>
                </div>

                <?php if (! $passwordChange)
                { ?>
                    <div class="form-group username">
                        <label for="username" class="col-sm-4 control-label ">Full Name <span
                                class="text-danger">*</span>
                        </label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control first" id="username" tabindex="1" autocomplete="off"
                                   name="name" data-container="body" rel="popover" data-content='Enter Your Full Name '
                                   data-original-title="<center><b>Username</b></center>" placeholder="Full Name"
                                   value="<?php echo $userEdit != null ? $userEdit->name : ""; ?>" required>
                        </div>
                    </div>
                    <div class="form-group email">
                        <label for="email" class="col-sm-4 control-label ">Email <span
                                class="text-danger">*</span></label>

                        <div class="col-sm-8">
                            <input type="email" class="form-control middle" id="email" autocomplete="off" tabindex="2"
                                   name="email" placeholder="something@host.com" data-container="body" rel="popover"
                                   data-content='Active email address only <br> All Booking Related information will be sent here.'
                                   data-original-title="<center><b>Email</b></center>"
                                   value="<?php echo $userEdit != null ? $userEdit->email : ""; ?>" required>
                        </div>
                    </div>
                    <div class="form-group contact">
                        <label for="contact" class="col-sm-4 control-label ">Contact Number <span
                                class="text-danger">*</span> </label>

                        <div class="col-sm-8">
                            <input type="tel" pattern="\d{10}" class="form-control middle" id="contact" tabindex="3"
                                   autocomplete="off" name="contact" placeholder="Eg:0123456789" data-container="body"
                                   rel="popover" data-content='Current contact number to confirm your bookings.'
                                   data-original-title="<center><b>Contact Number</b></center>"
                                   value="<?php echo $userEdit != null ? $userEdit->contact : ""; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact" class="col-sm-4 control-label ">Address <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-8">
                            <textarea class="form-control middle" tabindex="4" rows="3" cols="7" placeholder="Address"
                                      name='address'
                                      required><?php echo $userEdit != null ? $userEdit->address : ""; ?></textarea>
                        </div>
                    </div>

                <?php
                }
                if (isset($_request['new']) || ($passwordChange))
                {
                    ?>
                    <div class="form-group password">
                        <label for="password" class="col-sm-4 control-label ">Password <span
                                class="text-danger">*</span>
                        </label>

                        <div class="col-sm-8">
                            <input type="password" class="form-control middle" id="password" tabindex="5"
                                   autocomplete="off"
                                   name="password" placeholder="Password" data-container="body" rel="popover"
                                   data-content='Use minimum 6 Be Tricky!!'
                                   data-original-title="<center><b>Password</b></center>" required>
                        </div>
                    </div>
                    <div class="form-group cfmpassword">
                        <label for="cfmpassword" class="col-sm-4 control-label ">Confirm Passoword <span
                                class="text-danger">*</span> </label>

                        <div class="col-sm-8">
                            <input type="password" class="form-control last" id="cfmpassword" tabindex="6"
                                   autocomplete="off" name="cfmpassword" placeholder="Confirm Password"
                                   data-container="body" rel="popover" data-content='Use Same as above :) !!'
                                   data-original-title="<center><b>Confirm Password</b></center>" required>
                        </div>
                    </div>
                <?php } ?>


                <?php if (isset($_request['new']) || $updateOp == true)
                {  ?>

                    <div class="form-group UserType">
                        <label for="UserType" class="col-sm-4 control-label ">User Type <span
                                class="text-danger">*</span>
                        </label>

                        <div class="col-sm-8">
                            <select class="form-control" name='UserType' required>
                                <?php if ($userEdit != null)
                                {
                                    ?>
                                    <option value=2 <?php echo $userEdit->type === '2' ? "Selected" : ""; ?>>Admin
                                    </option>

                                    <option value=4 <?php echo $userEdit->type === '4' ? "Selected" : ""; ?>>Operator
                                    </option>
                                <?php
                                } else
                                {
                                    ?>
                                    <option value=2 Selected>Admin</option>

                                    <option value=4>Operator
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                <?php } ?>


                <div class="form-group">
                    <div class="col-sm-offset-4 ">
                        <button class="btn btn-lg btn-primary btn-block" tabindex="8" name="RegisterME" id="register"
                                type="submit"><?php echo $userEdit != null ? "Update Information" : "Register"; ?>
                        </button>
                    </div>
                </div>
            </form>
            <!-- /form end-->
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
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script> $(document).ready(function () {
        $('[data-toggle=offcanvas]').click(function () {
            $('.row-offcanvas').toggleClass('active')
        });
    }); </script>
<script type="text/javascript">
    // When the document is ready
    $(function () {

        $("[rel=popover]").popover({
            placement: 'right', //placement of the popover. also can use top, bottom, left or right
            html: 'true',
            trigger: "focus"
        });


        $("#register").click(function () {
            $("#register").html("<img src='/assets/images/setting_loader_fast.gif'>");
            $("#register").attr("disabled", "disabled");

            $("#registerForm").submit(function (e) {
                $("#info").html("<center><h5>Processing.. </h5></center>");
                var postData = $(this).serializeArray();
                var formURL = $(this).attr("action");

                // e.preventDefault(); //STOP default action

            });

            if ($('#required').prop('checked')) {
                $('.required').removeClass('has-error');
                $("#registerForm").submit(); //SUBMIT FORM
            }
            else {
                // showRecaptcha();
                $('.required').addClass('has-error');
                $('#required').focus();
                $("#register").html("Register");
                $("#register").removeAttr("disabled");
            }

        });

        $("#required").click(function () {

            if ($('#required').prop('checked')) {
                $('.required').removeClass('has-error');

            }
            else {
                $('.required').addClass('has-error');
                $('#required').focus();

            }
        }).change();
        $("#username").on('keyup', function () {
            if ($('#username').val().length >= 5) {
                var username = document.getElementById('username');

                var filter = /^[A-Za-z ]*$/;
                if (username.value != null) {
                    if (filter.test(username.value)) {
                        $('.username').removeClass('has-error');
                    } else {
                        $('.username').addClass('has-error');
                        $('#username').focus();
                    }
                }
            }
            else {
                $('.username').addClass('has-error');
                $('#username').focus();
            }
        });
        $("#email").on('keyup', function () {
            if ($('#email').val().length >= 5) {
                var username = document.getElementById('email');

                var filter = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if (username.value != null) {
                    if (filter.test(username.value)) {
                        $('.email').removeClass('has-error');
                    } else {
                        $('.email').addClass('has-error');
                        $('#email').focus();
                    }
                }
            }
            else {
                $('.email').addClass('has-error');
                //$('#email').focus();
            }
        });
        $("#contact").on('keyup', function () {
            if ($('#contact').val().length >= 5) {
                var username = document.getElementById('contact');

                var filter = /^[0-9]{10}$/;
                if (username.value != null) {
                    if (filter.test(username.value)) {
                        $('.contact').removeClass('has-error');
                    } else {
                        $('.contact').addClass('has-error');
                        $('#contact').focus();
                    }
                }
            }
            else {
                $('.contact').addClass('has-error');
                $('#contact').focus();
            }
        });
        $("#password").on('keyup', function () {
            if ($('#password').val().length >= 5) {
                $('.password').removeClass('has-error');
            }
            else {
                $('.password').addClass('has-error');
                $('#password').focus();
            }
        });
        $("#cfmpassword").on('keyup', function () {
            if ($.trim($('#cfmpassword').val()) == $.trim($('#password').val())) {

                $('.cfmpassword').removeClass('has-error');

            }
            else {
                $('.cfmpassword').addClass('has-error');
                $('#cfmpassword').focus();
            }
        });
    });
</script>
</body>
</html>

