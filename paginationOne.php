<?php include('server.php') ?>
<?php include('session.php')?>
<?php

$record_per_page = 5 ;
$page = '';
$orderby = " ORDER BY id DESC";
$output ='';   

if ($_POST['page'] > 1 ) {
    $start = ($_POST['page'] - 1) * $limit ;
    $page = $_POST['page'];
}else{
    $start = 0;;
}
    $start_from = ($page - 1) * $record_per_page;

/*    $output.= '<label> Search </label><input type="text" name="search_box" placeholder="Search" >
        <button type="submit" name="search" class="btnSearch"><i class="fa fa-search"></i></button><br><br>';*/

if (isset($_POST['query'])){
    
    $sql = "SELECT * FROM add_user WHERE CONCAT(id, name, birthday, education, it_skill, gender, department, address) LIKE '%".$_POST["query"]."%'" ; 
    $query =  $sql . $orderby .  " LIMIT " . $start_from . "," . $record_per_page; 
    $search_result = mysqli_query($conn,$query);
}else{
    $query = "SELECT * FROM add_user ORDER BY id DESC LIMIT $start_from, $record_per_page";
    $search_result = mysqli_query($conn,$query);
}

    $output.= '<table class="index-table">
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

while($row = mysqli_fetch_array($search_result)) :
    $output .= '
                <tr class="index-tr">
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
endwhile;

    $output.= '</table><br/>';

      $page_query = "SELECT * FROM add_user ORDER BY id DESC";
      $page_result = mysqli_query($conn, $page_query);
      $total_records = mysqli_num_rows($page_result);
      $total_pages = ceil($total_records / $record_per_page);
      for($i=1; $i<=$total_pages; $i++ ){ 
         $output.= "<span class='pagination_link' style='cursor:pointer; padding:6px; border: 1px solid blue;' id='".$i."'>".$i."</span>";
     }
      echo $output;

?>