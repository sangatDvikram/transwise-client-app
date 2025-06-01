

<div class="table-responsive">
    <table class="table">
        <thead>
        <th>Sr.</th>
        <th>Name</th>
        <th>Contact Person</th>
        <th>Contact No</th>
        <th>Options</th>
        </thead>
        <tbody>
        <?php

        $data = $Operator->getpackagedetails();
        $companies=myDB::getInstance()->get('transwise_companies',array('company_id','!=','1'))->results();

        $i = 1;
        foreach ($companies as $company)
        {
            echo "<tr>";
            echo "<td>$i</td>";
            echo "<td>$company->name</td>";
            //   $contactPerson=myDB::getInstance()->get('transwise_user', array('company_id', '=', '$company->company_id'))->first();
            $contactPerson=myDB::getInstance()->query('SELECT * FROM transwise_user WHERE company_id = ? AND project_name= ?',array($company->company_id,'AllProject'))->first();

            echo "<td>$contactPerson->name</td>";

            echo "<td>$contactPerson->contact</td>";
            echo "<td><a href='/admin/NewCompany?edit=$company->company_id'> <span class='glyphicon glyphicon-pencil text-success'></span>Edit</a> | <span class='glyphicon glyphicon-trash text-danger'></span> <a href='/admin/NewCompany?delete=$company->company_id' >Delete</a> </td></td>";
            echo "</tr>";
            $i ++;
        }
        ?>
        </tbody>
    </table>
    <a type="button" class="btn btn-success btn-lg"
       href="./admin/newCompany?new"> <span
            class="glyphicon glyphicon-plus"></span> Add New Company
    </a>
</div>