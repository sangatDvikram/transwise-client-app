<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="./">
        <?php echo Company::getdetails( 'Name');?>
    </a>
</div>
<div class="collapse navbar-collapse">

    <ul class="nav navbar-nav">
        <li <?php echo ($_SERVER[ 'QUERY_STRING']=='' ) ? "class='active'": ''; ?>><a href="./"><span class="glyphicon glyphicon-home"></span> Home </a>
        </li>
        <li <?php echo (strpos($_SERVER[ 'QUERY_STRING'], 'booking') !==false) ? "class='active'": ''; ?>><a href="./booking"><span class="glyphicon glyphicon-flag ">  </span> Book with us</a>
        </li>

        <li <?php echo (strpos($_SERVER[ 'QUERY_STRING'], 'fleet') !==false) ? "class='active'": ''; ?>><a href="./fleet"><span class="glyphicon glyphicon-road">  </span> TRANSWISE Fleet</a>
        </li>

        <li <?php echo (strpos($_SERVER[ 'QUERY_STRING'], 'what_we_do') !==false) ? "class='active'": ''; ?>><a href="./what_we_do"><span class="glyphicon glyphicon-bullhorn">  </span> What we do</a>
        </li>


        <li <?php echo (strpos($_SERVER[ 'QUERY_STRING'], 'about') !==false) ? "class='active'": ''; ?>>
            <a href="./about"> <span class="glyphicon glyphicon-copyright-mark"></span> About us</a>
        </li>
        <li <?php echo (strpos($_SERVER[ 'QUERY_STRING'], 'contact') !==false) ? "class='active'": ''; ?>><a href="./contact"><span class="glyphicon glyphicon-earphone"></span> Get to us</a>
        </li>
        <!--            <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="glyphicon glyphicon-circle-arrow-down"></span> Dropdown <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Nav header</li>
                    <li><a href="#">Separated link</a></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </li> -->
    </ul>
    <ul class="nav navbar-nav navbar-right">


        <?php if (Login::is_logged_in()) { ?>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">  Hi <?php $name=explode(' ', User::userinfo('name'));echo $name[0];?>

                   <?php

                   if (Login::is_admin())
                   {
                    $total=(Notification::getNotificationCount(2))+(Notification::getNotificationCount(3))+(Notification::getNotificationCount(4));
                    if($total>0){ echo "<kbd>$total</kbd>"; }
                   }
                    else
                    {
                      if(Notification::getNotificationCount($_SESSION['type'])>0) echo "<kbd>".Notification::getNotificationCount($_SESSION['type'])."</kbd>";
                    }
                     ?> 

                    <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <?php if (Login::is_admin()){ echo '<li><a href="./admin"> <span class="glyphicon glyphicon-cog ">  </span> Admin Panel '; if(Notification::getNotificationCount(2)>0) echo "<kbd>".Notification::getNotificationCount(2)."</kbd>"; echo '</a>
        </li>'; }?>
        <?php if (Login::is_moderator()||Login::is_admin()){ echo '<li><a href="./moderator"> <span class="glyphicon glyphicon-eye-open ">  </span> Moderator Panel '; if(Notification::getNotificationCount(3)>0) echo "<kbd>".Notification::getNotificationCount(4)."</kbd>"; echo '</a>
        </li>'; }?>
        <?php if (Login::is_operator()||Login::is_admin()){ echo '<li><a href="./operator"> <span class="glyphicon glyphicon-tasks ">  </span> Operator Panel '; if(Notification::getNotificationCount(4)>0) echo "<kbd>".Notification::getNotificationCount(4)."</kbd>"; echo '</a>
        </li>'; }?>
        <!--                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li> -->

        </ul>
        </li>
        <li>
            <a href="./logout"> <span class="glyphicon glyphicon-off ">  </span> Logout</a>
        </li>
        <?php } else { ?>
        <li <?php echo (strpos($_SERVER[ 'QUERY_STRING'], 'register') !==false) ? "class='active'": ''; ?>><a href="./register"><span class="glyphicon glyphicon-pencil ">  </span> Register</a>
        </li>
        <li <?php echo (strpos($_SERVER[ 'QUERY_STRING'], 'logins') !==false) ? "class='active'": ''; ?>>
            <a href="./logins"> <span class="glyphicon glyphicon-lock ">  </span> Login</a>
        </li>
        <?php } ?>

    </ul>
</div>