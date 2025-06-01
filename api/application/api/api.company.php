<?php
/**
 * Created by PhpStorm.
 * User: The Samir
 * Date: 9/9/14
 * Time: 9:42 PM
 */

//if (isset($_POST['companyinfo']))
//{
//
//    //$info = $groupinfo->getpackagedetails($_POST['package_id']);
//    $companyID = $_POST['company_id'];
//    if ($companyID != 'x')
//    {
//        $allProjects = myDB::getInstance()->get('transwise_user', array('company_id', '=', $companyID))->results();
//        $contactPersonName = "";
//        $contactPersonEmail = "";
//        $contactPersonContact = "";
//        foreach ($allProjects as $allProject)
//        {
//            if ($allProject->project_Name === 'AllProject')
//            {
//                $contactPersonName = $allProject->name;
//                $contactPersonEmail = $allProject->email;
//                $contactPersonContact = $allProject->contact;
//
//            } else
//            {
//                $projects .= "<option value=" . $allProject->user_id . " >" . $allProject->project_Name . "</option>";
//            }
//        }
//        echo json_encode(array("contactPersonName" => $contactPersonName, "contactPersonEmail" => $contactPersonEmail, "contactPersonContact" => $contactPersonContact, "projects" => $projects));
//    }
//    exit(0);
//}

if (isset($_POST['id']))
{
    $id = $_POST['id'];
    $datas = "";
    $projects = myDB::getInstance()->get('transwise_user', array('company_id', '=', $id))->results();
    //  while($row=mysql_fetch_array($sql))
    foreach ($projects as $project)
    {
        if ($project->project_Name=="AllProject")
        {
            $datas.="$project->name*$project->email*$project->contact*";
        } else
        {
            $id = $project->user_id;
            $data = $project->project_Name;
            $datas .= '<option value="' . $id . '">' . $data . '</option>';
        }
    }

    echo $datas;

}
?>