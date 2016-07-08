<?php
include("/var/www/html/cloud/config/connect.php");

$sql1=$db_c->query("  select * from  user_info where check_admin='client' ");

$sql1 = "select * from  user_info where check_admin='client';";
$sql2 = " select * from upload_file  ";
$sql3 = " select * from oc_community  ";

$numbre_client=mysqli_num_rows($db_c->query($sql1));
$numbre_file=mysqli_num_rows($db_c->query($sql2));
$numbre_feeds=mysqli_num_rows($db_c->query($sql3));









?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	

 <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-green green">
                          
                            <div class="panel-right pull-right">
								<h3><?php  echo $numbre_client; ?></h3>
                               <strong>Client</strong>
                            </div>
                        </div>
                    </div>


 <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-green blue">
                           
                            <div class="panel-right pull-right">
								<h3><?php echo $numbre_file; ?></h3>
                               <strong>all uploaded files</strong>
                            </div>
                        </div>
                    </div>


 <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-green brown">
                           
                            <div class="panel-right pull-right">
                                <h3>UP</h3>
                               <strong>Servers state</strong>
                            </div>
                        </div>
                    </div>


 <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-green red">
                           
                            <div class="panel-right pull-right">
                                <h3><?php echo $numbre_feeds; ?></h3>
                               <strong>all feeds community</strong>
                            </div>
                        </div>
                    </div>


</div>