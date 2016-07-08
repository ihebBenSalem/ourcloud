<?php 

include("/var/www/html/cloud/config/connect.php");

$sql=$db_c->query("  select * from  user_info where check_admin='client' order by user_id DESC ");
$sql2=$db_c->query("  select * from  user_file  ");

 ?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="panel panel-default">
		<div class="panel-body">
All users list<br>
<table class="table table-condensed table-hover">
	<thead>
		<tr>
			<th>#id</th>
			<th>#username</th>
			<th>#email</th>
			<th>#Join_time</th>
			<th>#operation</th>
			<th>#Admin</th>
		</tr>
	</thead>
	<tbody>

<?php

while ($row=$sql->fetch_array()) {

echo '<tr>';
echo '<td>'.$row["user_id"].'</td>';
echo '<td>'.$row["user_name"].'</td>';
echo '<td>'.$row["user_email"].'</td>';
echo '<td>'.$row["join_time"].'</td>';
echo '<td><form action="action.php" method="post"><button type="submit" name="del" class="btn btn-block  btn-danger" value="'.$row["user_id"].'">DELETE</button></form></td>';
echo '<td><form action="action.php" method="post"><button type="submit" name="admin" class="btn btn-block  btn-primary" value="'.$row["user_id"].'">Make it admin</button></form></td>';
echo '</tr>';

}



?>
	</tbody>
</table>

		</div>
	</div>
</div>














</div>