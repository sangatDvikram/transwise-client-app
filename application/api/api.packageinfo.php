<?php
//require_once '../include/system/config.php';
$groupinfo = new Operator();
$car = new Cars();
if (isset($_POST['groupinfo']))
{

    $info = $groupinfo->getpackagegroupdetails($_POST['package_group']);
    $data = "<div class='page-header'>
  <h4>Pacakge Group information<small></small></h4>
</div>";
    $data .= "Name : $info[name]";
    $data .= "<br>Info : $info[details]";
    $carslist = $groupinfo->package_details('*', 'cat_id', $_POST['package_group']);
    $cars = "<option value='x'> Select Package </option>";
    foreach ($carslist as $value1)
    {

        $cars .= '<option value="' . $value1['package_id'] . '">' . $value1['name'] . '</option>';

    }
    if ($_POST['package_group'] == 'x')
    {

        $data = "";
    }

    echo json_encode(array("Data" => $data, "Packages" => $cars));
    exit(0);
}
if (isset($_POST['packageinfo']))
{

    $info = $groupinfo->getpackagedetails($_POST['package_id']);
    $data = "<div class='page-header'>
  <h4>Package information<small></small></h4>
</div>Name : $info[name]";
    $grp = $groupinfo->getpackagegroupdetails($info['cat_id']);
    $data .= "<br>Group : $grp[name]";
    $data .= "<br>Info : $info[details]";
    $cargroupinfo = $car->get_cargroups_details($info['car_group_id']);
    $cargroup = "<option value='$cargroupinfo[id]'>$cargroupinfo[name]</option>";
    $carinfo = $car->get_car_details($info['car_id']);
    $car = "<option value='$carinfo[id]'>$carinfo[name]</option>";
    if ($_POST['package_id'] == 'x')
    {

        $data = "";
    }
    echo json_encode(array("Data" => $data, "Car_Group" => $cargroup, "Car" => $car));
    exit(0);
}
?>