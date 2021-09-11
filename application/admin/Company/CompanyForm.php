<form class="form-horizontal" role="form" action="/admin/NewCompany?all"
      method="post">

    <div class="form-group companyName">
        <label for="companyName" class="col-sm-4 control-label ">Company Name <span class="text-danger">*</span>
        </label>

        <div class="col-sm-8">
            <input type="text" class="form-control first" id="name" tabindex="1" autocomplete="off"
                   name="name" data-container="body" rel="popover" data-content='Enter Company Name '
                   data-original-title="<center><b>companyName</b></center>" placeholder="company Name"
                   value="<?php echo $companyEdit != null ? $companyEdit->name : ''; ?>" required>
        </div>
    </div>
    <div class="form-group">
        <label for="contact" class="col-sm-4 control-label ">Company Address <span class="text-danger">*</span>
        </label>

        <div class="col-sm-8">
            <textarea class="form-control middle" tabindex="4" rows="3" cols="7" placeholder="Address"
                      name='address'
                      required><?php echo $companyEdit != null ? $companyEdit->address : ''; ?> </textarea>
        </div>
    </div>
    <div class="form-group contactPerson">
        <label for="contactPerson" class="col-sm-4 control-label contactPerson">Contact Person Name<span class="text-danger">*</span>
        </label>

        <div class="col-sm-8">
            <input type="text" class="form-control first" id="contactPerson" tabindex="1" autocomplete="off"
                   name="contactPerson" data-container="body" rel="popover" data-content='Enter Contact Person Name '
                   data-original-title="<center><b>contactPerson</b></center>" placeholder="Conatct Person Name"
                   value="<?php echo $companyContactPerson != null ? $companyContactPerson->name : ''; ?>" required>
        </div>
    </div>

    <div class="form-group email">
        <label for="email" class="col-sm-4 control-label ">Email <span class="text-danger">*</span></label>

        <div class="col-sm-8">
            <input type="email" class="form-control middle" id="email" autocomplete="off" tabindex="2"
                   name="email" placeholder="something@host.com" data-container="body" rel="popover"
                   data-content='Active email address only <br> All Booking Related information will be sent here.'
                   data-original-title="<center><b>Email</b></center>"
                   value="<?php echo $companyContactPerson != null ? $companyContactPerson->email : ''; ?>" required>
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
                   value="<?php echo $companyContactPerson != null ? $companyContactPerson->contact : ''; ?>" required>
        </div>
    </div>

    <div class="row omb_row-sm-offset-3 omb_loginOr">
        <div class="col-xs-12 col-sm-12">
            <hr class="omb_hrOr">
            <span class="omb_spanOr">Project Details </span>
        </div>
        <input id="projectCount" name="projectCount" type="hidden"
               value="<?php echo $companyContactPerson != null ? $proCount : ''; ?>"/>
        <input id="companyID" name="companyID" type="hidden"
               value="<?php echo isset($_request['edit'])? $_request['edit']: ''; ?>"/>
    </div>
    <!--Project+ contact  table        -->

    <table class="projects" width="100%" id="projects"
           cellpadding="10" cellspacing="2">
        <thead>
        <tr>
            <th width="10%" style="text-align: center">
                <button type="button" id="company_add" class="btn btn-default">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </th>
            <th width="30%" style="text-align: center">Project Name</th>
            <th width="40%" style="text-align: center">Contact Person</th>
            <th width="30%" style="text-align: center">Contact No</th>
        </tr>
        </thead>
        <tbody>

        <?php

        if (isset ($_request ['edit']))
        {
            if ($proCount > 0)
            {

                $i = 1;
                foreach ($contactsEdit as $contact)
                {
                    if ($contact->project_Name != 'AllProject')
                    {

                        echo '<tr> ';

                        $services = "<div class='col-sm-12'><input type='text'  class='form-control' value=\"{$contact->project_Name}\" name=ProjectName$i placeholder='Project Name'/></div>";
                        $rate = "<div class='col-sm-12'><input type='text'  class='form-control' value=\"{$contact->name}\" name=ContactPerson$i placeholder='Conatact Person'></div>";
                        $type = "<div class='col-sm-12'><input type='text'  class='form-control' value={$contact->contact} name=contactNo$i placeholder='Contact No'></div>";
                        $button = " <button type='button'  class='btn btn-default btnDel' ><span class='glyphicon glyphicon-remove'></span></button>";

                        echo "<td style='text-align:center;padding:10px'>$button</td><td style='text-align:center;padding:10px'>{$services}</td><td>{$rate}</td><td>$type</td>";
                        echo '</tr>';
                        $i ++;
                    }
                }
            }
        }
        ?>
        </tbody>
    </table>

    <!--/Project+ contact  table        -->
    <br>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">

            <?php

            if (isset ($_request ['edit']))
            {
                echo '<button type="submit" class="btn btn-warning" name="EditCompany">Update Company Details</button>';
            } else
            {
                echo '<button type="submit" class="btn btn-success" name="addCompany">Add Company </button>';
            }
            ?>

        </div>
    </div>
</form>