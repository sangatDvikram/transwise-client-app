<?php $Operator = new Operator; ?>
<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="/"><span class="glyphicon glyphicon-th">
                    </span>Home</a>
            </h4>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span
                        class="glyphicon glyphicon-folder-close">
                    </span>Users</a>
            </h4>
        </div>
        <div class="panel-collapse  ">
            <ul class="list-group">
                <li class="list-group-item"><span class="glyphicon glyphicon-tag text-info"></span><a
                        href="/admin/newuser?new">Add User</a></li>
                <li class="list-group-item"><span class="glyphicon glyphicon-tag text-info"></span><a
                        href="/admin/manageUser?all">Manage User</a></li>
                <li class="list-group-item"><span class="glyphicon glyphicon-tag text-info"></span><a
                        href="/admin/NewCompany?new">Add Company</a></li>
                <li class="list-group-item"><span class="glyphicon glyphicon-tag text-info"></span><a
                        href="/admin/NewCompany?all">Manage Company</a></li>
            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseBank"><span
                        class="glyphicon glyphicon-folder-close">
                    </span>Billings</a>
            </h4>
        </div>
        <div class="panel-collapse ">
            <ul class="list-group">
                <li class="list-group-item"><span class="glyphicon glyphicon-tag text-info"></span><a
                        href="/admin/addtaxes">Add Taxes</a></li>
                <li class="list-group-item"><span class="glyphicon glyphicon-tag text-info"></span><a
                        href="/admin/taxes?all">Manage Taxes</a></li>
            </ul>
        </div>

    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseBank"><span
                        class="glyphicon glyphicon-folder-close">
                    </span>Bank</a>
            </h4>
        </div>
        <div class="panel-collapse ">
            <ul class="list-group">
                <li class="list-group-item"><span class="glyphicon glyphicon-tag text-info"></span><a href="#">My
                        Account</a></li>
                <li class="list-group-item"><span class="glyphicon glyphicon-tag text-info"></span><a href="#">View
                        Accounts</a></li>
                <li class="list-group-item"><span class="glyphicon glyphicon-tag text-info"></span><a href="#">View
                        Transactions</a></li>
            </ul>
        </div>

    </div>
</div>