<?php
if (! defined('BASEPATH'))
    exit ('No direct script access allowed');

if (! Login::is_operator() && ! Login::is_admin())
{
    Login::redirect();
}

//$groups = new Cars ();
//$Operator = new Operator ();
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

    <title>Manage Company - Admin panel</title>

    <?php include 'css.php'; ?>
    <style type="text/css">
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

        .service table, .service th, .service td {
            border: 1px solid #cdcdcd;
        }

        .input-group-btn select {
            border-color: #ccc;
            margin-top: 0px;
            margin-bottom: 0px;
            padding-top: 7px;
            padding-bottom: 7px;
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

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas hidden-print"
             id="sidebar" role="navigation">
            <?php include 'adminsidebar.php'; ?>
        </div>
        <!--/span-->
        <div class="col-xs-12 col-sm-9">
            <div class="page-header">
                <h1>
                    Manage Company
                    <small>Add , Modify or Delete Company</small>
                </h1>
                <p class="pull-right visible-xs">
                    <button type="button" class="btn btn-primary btn-xs"
                            data-toggle="offcanvas">Toggle nav
                    </button>
                </p>
            </div>

            <div id="info">
                <?php
                if (isset ($_POST ['addCompany']))
                {

                    // print_r($_POST);
                    $companyObj = new custCompany();
                    $success = $companyObj->InsertNewCompany($_POST);
                    if ($success)
                    {
                        echo "<div class='alert alert-success'> New Company  has been successfully Added.</div>";
                    } else
                    {
                        echo "<div class='alert alert-success'> Something went wrong </div>";
                    }
                    // $Operator->getData($_POST);

                    // echo "<pre>"; print_r($_POST); echo "</pre>";

                    // $page = $Operator->insert_package();
                    //echo $page;
                }
                if (isset ($_POST ['EditCompany']))
                {

                    //update company details
                    //echo( Input::get('companyID'));
                    $updateCompany = myDB::getInstance()->update('transwise_companies', "company_id='" . Input::get('companyID') . "'", array(
                        'name'    => Input::get('name'),
                        'address' => Input::get('address')
                    ));

                    if ($updateCompany)
                    {

                        //update contact person details
                        $updateContactPerson =
                            myDB::getInstance()->update('transwise_user', "company_id='" . Input::get('companyID') . "' AND project_Name='AllProject'", array(
                                'name'    => Input::get('contactPerson'),
                                'email'   => Input::get('email'),
                                'contact' => Input::get('contact'),
                                'address' => Input::get('address')
                            ));
                        if ($updateContactPerson)
                        {

                            $companyObj = new custCompany();
                            $success = $companyObj->UpdateProjects($_POST);
                            if ($success)
                            {
                                echo "<div class='alert alert-success'> Company has been successfully Updated.</div>";
                            } else
                            {
                                echo "<div class='alert alert-success'>Something went wrong.</div>";
                            }
                        }
                    }
                    //delete all project
                    // insert new projects

                }
                if (isset ($_POST ['delete']))
                {

                    $sql1 = "DELETE FROM transwise_companies WHERE company_id='" . Input::get('company_id') . "'";
                    $sql2 = "DELETE FROM transwise_user WHERE company_id='" . Input::get('company_id') . "'";
//echo($sql1);
                    $CompanyDelete = myDB::getInstance()->Transactions(array($sql1, $sql2));
                    if ($CompanyDelete)
                    {
                        echo "<div class='alert alert-success'> Company has been successfully Deleted.</div>";
                    } else
                    {
                        echo "<div class='alert alert-success'> Something went Wrong!!.</div>";

                    }

                }

                if (isset ($_request ['delete']))
                {

                    $delCompany = myDB::getInstance()->get('transwise_companies', array('company_id', '=', $_request ['delete']))->first();
                    ?>
                    <div class="bs-callout bs-callout-warning">
                        You Realy want to delete Company <b><?php echo $delCompany->name; ?></b>
                        ? <br>

                        <p class='text-danger'>Note: You cannot retrive any package
                            information once it is deleted.</p>

                        <form class="form-inline" role="form"
                              action='/admin/NewCompany?all' method='post'
                              id="<?php echo $delCompany->company_id; ?>">
                            <input type="hidden" name='company_id'
                                <?php echo "value=$delCompany->company_id"; ?>>
                            <button type='submit' class='btn btn-danger yes' name="delete"
                                    id="<?php echo "$delCompany->company_id"; ?>">
                                Yes
                            </button>
                            <a class="btn btn-default" href="./admin/NewCompany?all" role="button"><span
                                    class="glyphicon glyphicon-remove"></span> No</a>
                        </form>
                    </div>
                <?php } ?>


            </div>

            <?php

            if (isset ($_request ['new']) || isset ($_request ['edit']))
            {
                $data = '';
                $companyEdit=null;
                $proCount=0;
                $companyContactPerson=null;
                if (isset ($_request ['edit']))
                {
                    // $data = $Operator->getpackagedetails($_request ['edit']);
                    $companyEdit = myDB::getInstance()->get('transwise_companies', array('company_id', '=', $_request ['edit']))->first();
                    if (count($companyEdit))
                    {
                        $contactsEdit = myDB::getInstance()->get('transwise_user', array('company_id', '=', $_request ['edit']))->results();
                        if (count($contactsEdit))
                        {
                            $proCount = count($contactsEdit) - 1;
                            $companyContactPerson = $contactsEdit[0];
                            // print_r($contactsEdit);
                        }
                    }
                }
                include_once('company/CompanyForm.php'); // include UI for company form details
            }
            ?>


            <?php
            if (isset ($_request ['all']) || isset ($_request ['delete']))
            {
                include('company/companyTable.php'); //include UI for company Details table
            } ?>
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
<script src="./assets/js/bootstrap.min.js"></script>
<script src=".//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>

    $(document).ready(function () {
        $('[data-toggle=offcanvas]').click(function () {
            $('.row-offcanvas').toggleClass('active')
        });


        var cnt = 1;
        $("#company_add").click(function () {
            $("#projectCount").val(cnt);
            var services = "<div class='col-sm-12'><input type='text'  class='form-control' name=ProjectName" + cnt + "   placeholder='Project Name'></div>";
            var rate = "<div class='col-sm-12'><input type='text'  class='form-control' name=ContactPerson" + cnt + "  placeholder='Conatact Person'></div>";
            var type = "<div class='col-sm-12'><input type='text'  class='form-control' name=contactNo" + cnt + "   placeholder='Contact No'></div>";
            var button = " <button type='button'  class='btn btn-default btnDel' ><span class='glyphicon glyphicon-remove'></span></button>";

            $('#projects tr').last().after('<tr style="padding:10px"><td style="text-align:center;padding:10px">' + button + '</td><td>' + services + '</td><td>' + rate + '</td><td>' + type + '</td></tr>');
            cnt++;

        });

        $("body").on("click", ".btnDel", function () {
            if ($('#projects tr').size() > 1) {
                $(this).parent().parent().remove();
                $("#projectCount").val(($("#projectCount").val() - 1));

            }
        });


    });
</script>

</body>
</html>

