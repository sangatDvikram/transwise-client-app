<?php

Login::logout();
header('Location: logins?logout='.md5(time())); 

?>