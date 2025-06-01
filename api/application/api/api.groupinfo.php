<?php
//require_once '../include/system/config.php';
$groupinfo = new Cars;
if (isset($_POST['groupinfo']))
{

    $info = $groupinfo->get_cargroups_details($_POST['group']);
    $data = "<div class='page-header'>
  <h4>Car Group information<small></small></h4>
</div>";
    $data .= "Name : $info[name]";
    $data .= "<br>Info : $info[details]";
    $carslist = $groupinfo->car_details('*', 'group_id', $_POST['group']);
    $cars = '';
    foreach ($carslist as $value1)
    {

        $cars .= '<option value="' . $value1['id'] . '" Selected>' . $value1['name'] . '</option>';

    }
    if ($_POST['group'] == 'x')
    {

        $data = "";
    }

    echo json_encode(array("Data" => $data, "Cars" => $cars));
    exit(0);
}
if (isset($_POST['carinfo']))
{

    $info = $groupinfo->get_car_details($_POST['car']);
    $data = "<div class='page-header'>
  <h4>Car Group information<small></small></h4>
</div>Name : $info[name]";
    $grp = $groupinfo->get_cargroups_details($info['group_id']);
    $data .= "<br>Group : $grp[name]";
    $data .= "<br>Amount : $info[amount]";
    $data .= "<br>Stock : $info[quantity]";
    $data .= "<br>Info : $info[details]";
    if ($_POST['car'] == 'x')
    {

        $data = "";
    }
    echo json_encode(array("Data" => $data));
    exit(0);
}
?>