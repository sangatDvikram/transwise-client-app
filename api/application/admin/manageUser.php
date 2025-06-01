<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

if (! Login::is_admin())
{
    Login::redirect();
}
$message = '';

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

    <title> Manage Users - Admin panel</title>

    <?php include 'css.php'; ?>

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
            <?php include 'adminsidebar.php'; ?>
        </div>
        <!--/span-->
        <div class="col-xs-12 col-sm-9">
            <div class="page-header">
                <h1>Manage User
                    <small>Add , Modify or Delete User</small>
                </h1>
                <p class="pull-right visible-xs">
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                </p>
            </div>

            <div id="info">
                <?php
                if (isset($_POST['addPgroup']))
                {

                    $Operator->getData($_POST);
                    $page = $Operator->insert_package_group();
                    echo $page;
                }
                if (isset($_POST['EditPgroup']))
                {

                    $Operator->getData($_POST);
                    $page = $Operator->update_package_group();
                    echo $page;

                }
                if (isset($_POST['delete']))
                {

                    // $Operator->getData($_POST);
                    // $page = $Operator->delete_package_group();
                    $deleteUser = myDB::getInstance()->delete('transwise_user', array('user_id', '=', Input::get('user_id')));
                    if ($deleteUser)
                    {
                        echo "<div class='alert alert-success'>User has been successfully Deleted.</div>";
                    } else
                    {
                        echo "<div class='alert alert-success'> Something went wrong .</div>";
                    }
                }

                if (isset($_request['delete']))
                {
                    //  $data = $Operator->getpackagegroupdetails($_request['delete']);
                    $userDelete = myDB::getInstance()->get('transwise_user', array('user_id', '=', $_request['delete']))->first();
                    ?>

                    <div class="bs-callout bs-callout-warning">
                        You Realy want to delete group <b><?php echo "$userDelete->name"; ?></b> ? <br>

                        <p class='text-danger'> Note: You cannot retrive any group information once it is deleted.</p>

                        <form class="form-inline" role="form" action='/admin/manageUser?all ' method='post'
                              id="<?php echo "$userDelete->user_id"; ?>">
                            <input type="hidden" name='user_id' <?php echo "value=$userDelete->user_id"; ?>>
                            <button type='submit' class='btn btn-danger yes' name="delete"
                                    id="<?php echo "$userDelete->user_id"; ?>">Yes
                            </button>
                            <a class="btn btn-default" href="./admin/manageUser?all" role="button"><span
                                    class="glyphicon glyphicon-remove"></span> No</a></form>
                    </div>
                <?php } ?>

            </div>


            <?php
            if (isset($_request['all']) || isset($_request['delete']))
            {
                ?>


                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <th>Sr.</th>
                        <th>Name</th>
                        <th>Email ID</th>
                        <th>Options</th>
                        </thead>
                        <tbody>
                        <?php $users = myDB::getInstance()->get('transwise_user', array('sr', '!=', 0))->results();

                        $i = 1;
                        foreach ($users as $user)
                        {
                            echo "<tr>";
                            echo "<td>$i</td>";
                            echo "<td>$user->name</td>";
                            echo "<td>$user->email</td>";
                            if ($user->type == 2)
                            {
                                echo "<td><a href='/admin/newuser?edit=$user->user_id'> <span class='glyphicon glyphicon-pencil text-success'></span>Edit</a> | <a href='/admin/newuser?passChange=$user->user_id'> <span class='glyphicon glyphicon-pencil text-success'></span>Change password</a> </td></td>";
                            } else
                            {
                                echo "<td><a href='/admin/newuser?edit=$user->user_id'> <span class='glyphicon glyphicon-pencil text-success'></span>Edit</a> | <a href='/admin/newuser?passChange=$user->user_id'> <span class='glyphicon glyphicon-pencil text-success'></span>Change password</a> |<span class='glyphicon glyphicon-trash text-danger'></span> <a href='/admin/manageUser?delete=$user->user_id' >Delete</a> </td></td>";
                            }
                            echo "</tr>";
                            $i ++;
                        }
                        ?>
                        </tbody>
                    </table>
                    <a type="button" class="btn btn-success btn-lg" href="./admin/newuser?new">
                        <span class="glyphicon glyphicon-plus"></span> Add New User
                    </a>
                </div>

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
<script src="./assets/js/bootstrap.min.js"></script>
<!--<script src=".//tinymce.cachefly.net/4.0/tinymce.min.js"></script>-->
<script>

    $(document).ready(function () {
        $('[data-toggle=offcanvas]').click(function () {
            $('.row-offcanvas').toggleClass('active')
        });
    });
</script>
</body>
</html>

