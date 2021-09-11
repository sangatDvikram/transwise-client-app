<?php $Operator = new Operator; ?>
<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="/operator"><span class="glyphicon glyphicon-th">
                    </span>Dashboard</a>
            </h4>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span
                        class="glyphicon glyphicon-folder-close">
                    </span>Master</a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse ">
            <!--            //<div id="collapseOne" class="panel-collapse collapse">  -->
            <ul class="list-group">
                <li class="list-group-item"><span class="glyphicon glyphicon-tag text-info"></span>Package
                    <ul class="list-group">
                        <li class="list-group-item"><span class="glyphicon glyphicon-th-large text-primary"></span><a
                                href="/operator/packagegroup<?php echo ($Operator->getpackagegroupcount() == 0) ? "?add" : "?all"; ?>">
                                Package Groups </a></li>
                        <li class="list-group-item"><span class="glyphicon glyphicon-briefcase text-success"></span><a
                                href="/operator/<?php echo ($Operator->getpackagegroupcount() == 0) ? "packagegroup" : "package"; ?><?php echo ($Operator->getpackagecount() == 0) ? "?add" : "?all"; ?>">
                                Package </a></li>
                        <li class="list-group-item"><span class="glyphicon glyphicon-asterisk text-primary"></span><a
                                href="/operator/services<?php echo ($Operator->getservicecount() == 0) ? "?add" : "?all"; ?>">
                                Extra Services </a></li>
                    </ul>
                </li>
                <li class="list-group-item"><span class="glyphicon glyphicon-bookmark text-primary"></span>Bookings
                    <ul class="list-group">
                        <li class="list-group-item "><span class="glyphicon glyphicon-list-alt text-primary"></span><a
                                href="/operator/newbookings">New Bookings <?php $count = Bookings::getPendingCount();
                                echo "<span class='badge pull-right' title='There are $count Pending Bookings'>$count</span>"; ?></a>
                        </li>

                        <li class="list-group-item"><span class="glyphicon glyphicon-list text-warning"></span><a
                                href="/operator/confirm?operation=new">New Company Booking</a></li>
                        <li class="list-group-item"><span class="glyphicon glyphicon-list text-warning"></span><a
                                href="/operator/bookings">All Bookings </a></li>


                    </ul>
                </li>
                <li class="list-group-item"><span class="glyphicon glyphicon-send text-success"></span>Duty Slip
                    <ul class="list-group">
                        <li class="list-group-item"><span class="glyphicon glyphicon-plus text-warning"></span><a
                                href="/operator/slip?new">Pending duty slip</a></li>
                        <li class="list-group-item"><span class="glyphicon glyphicon-list text-warning"></span><a
                                href="/operator/slip?all">View all duty slip</a></li>
                    </ul>
                </li>

                <li class="list-group-item"><span class="glyphicon glyphicon-send text-success"></span>Cars
                    <ul class="list-group">
                        <li class="list-group-item"><span class="glyphicon glyphicon-plus text-primary"></span><a
                                href="/operator/cargroup">Add Car Group </a></li>

                        <li class="list-group-item"><span class="glyphicon glyphicon-pencil text-success"></span><a
                                href="/operator/groups">Modify Car group details </a></li>

                        <li class="list-group-item"><span class="glyphicon glyphicon-plus text-danger"></span><a
                                href="/operator/addcar">Add Car </a></li>

                        <li class="list-group-item"><span class="glyphicon glyphicon-pencil text-success"></span><a
                                href="/operator/cars">Modify Car details </a></li>

                    </ul>
                </li>

                <li class="list-group-item"><span class="glyphicon glyphicon-road text-info"></span>Drivers
                    <ul class="list-group">
                        <li class="list-group-item"><span class="glyphicon glyphicon-plus-sign text-primary"></span><a
                                href="/operator/adddriver">Add Chauffeur </a></li>
                        <li class="list-group-item"><span class="glyphicon glyphicon-pencil text-success"></span><a
                                href="/operator/editdriver">Modify Chauffeur details </a></li>
                    </ul>
                </li>


            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseBank"><span
                        class="glyphicon glyphicon-folder-close">
                    </span>Billing</a>
            </h4>
        </div>
        <div class="panel-collapse ">
            <ul class="list-group">
                <li class="list-group-item"><span class="glyphicon glyphicon-tag text-info"></span><a
                        href="/operator/GenerateInvoice?all">Generate new Invoice</a></li>
                <li class="list-group-item"><span class="glyphicon glyphicon-tag text-info"></span><a
                        href="/operator/invoice?all">All Invoices</a></li>
                <li class="list-group-item"><span class="glyphicon glyphicon-tag text-info"></span><a href="#">Print
                        Invoice</a></li>
            </ul>
        </div>


    </div>
    <!--
           <div class="panel panel-default">
             <div class="panel-heading">
               <h4 class="panel-title">
                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><span class="glyphicon glyphicon-file">
                   </span>Reports</a>
               </h4>
             </div>
             <div id="collapseFour" class="panel-collapse collapse">
               <div class="list-group">
                 <a href="#" class="list-group-item">
                   Cras justo odio
                 </a>
                 <div class="list-group">
                   <a href="#" class="list-group-item">
                     Cras justo odio
                   </a>
                   <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
                   <a href="#" class="list-group-item">Morbi leo risus</a>
                   <a href="#" class="list-group-item">Porta ac consectetur ac</a>
                   <a href="#" class="list-group-item">Vestibulum at eros</a>
                 </div>
                 <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
                 <a href="#" class="list-group-item">Morbi leo risus</a>
                 <a href="#" class="list-group-item">Porta ac consectetur ac</a>
                 <a href="#" class="list-group-item">Vestibulum at eros</a>
               </div>
             </div>
           </div>
           <div class="panel panel-default">
             <div class="panel-heading">
               <h4 class="panel-title">
                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive"><span class="glyphicon glyphicon-heart">
                   </span>Reports</a>
               </h4>
             </div>
             <div id="collapseFive" class="panel-collapse collapse">
               <div class="list-group">
                 <a href="#" class="list-group-item">
                   <h4 class="list-group-item-heading">List group item heading</h4>
                   <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                 </a>
               </div>
               <div class="list-group">
                 <a href="#" class="list-group-item active">
                   <h4 class="list-group-item-heading">List group item heading</h4>
                   <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                 </a>
               </div>
               <div class="list-group">
                 <a href="#" class="list-group-item">
                   <h4 class="list-group-item-heading">List group item heading</h4>
                   <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                 </a>
               </div>
             </div>
           </div>-->
</div>