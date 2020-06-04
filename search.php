<?php include('server.php') ?>
<?php include('session.php')?>
<?php
	$output ='';
	$sql = "SELECT * FROM add_user WHERE name LIKE '%".$_POST["search"]."%'";
	$result = mysqli_query($conn,$sql);
	
	if(mysqli_num_rows($result)>0){
		$output .= '<h4 class="header-align"> Search Result </4>';
		$output .= '
            			<tr class="index-tr">
              				<td class="index-th">ID  </td>
              				<td class="index-th">Name</td>
              				<td class="index-th">Birthday</td>
              				<td class="index-th">Education</td>
              				<td class="index-th">IT Skill</td>
              				<td class="index-th">Gender</td>
              				<td class="index-th">Department</td>
              				<td class="index-th">Address</td>
              				<td class="index-th" colspan="2">Action</td>
            			</tr>';
              
              	while($row = mysqli_fetch_array($result)) {
        $output .= '<tr class="index-tr">
                		<td class="index-td" style="text-align: right;"> '.$row["id"].' </td>
                		<td class="index-td"> '.$row["name"].' </td>
                		<td class="index-td"> '.$row["birthday"].' </td>
                		<td class="index-td"> '.$row["education"].' </td>
                		<td class="index-td"> '.$row["it_skill"].' </td>
                		<td class="index-td"> '.$row["gender"].' </td>
                		<td class="index-td"> '.$row["department"].' </td>
                		<td class="index-td"> '.$row["address"].' </td>
                		<td class="index-td"> <a href="edit.php?edit_id='.$row['id'].'" onclick="editFunction()"> Edit </a> </td>
                		<td class="index-td"> <a href="index.php?del_id='.$row['id'].'" onclick="deleteFunction()"> Delete </a> </td>
              		</tr>';
              	}
           echo $output;
	}else{
		echo 'Data Not Found';
	}
?>