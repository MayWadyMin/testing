<?php include('server.php') ?>
<?php include('session.php')?>
<?php
    if (isset($_POST['search'])){
    $value = $_POST['value'];
    $orderby = " ORDER BY id DESC"; 
    $sql = "SELECT * FROM add_user WHERE CONCAT(id, name, birthday, education, it_skill, gender, department, address) LIKE '%".$_POST["value"]."%'";
    $href = 'index.php';
    $perPage = 2; 
    $page = 1;
    if(isset($_POST['page'])){
      $page = $_POST['page'];
    }
    $start = ($page-1)*$perPage;
    if($start < 0) $start = 0;
    $query =  $sql . $orderby .  " LIMIT " . $start . "," . $perPage; 
    $result = mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($result)) {
      $resultset[] = $row;
    }   
    if(!empty($resultset))
      return $resultset;

     if(!empty($result)) {
      $page_query = "SELECT * FROM add_user ORDER BY id DESC";
        $page_result = mysqli_query($conn, $page_query);
        $total_records = mysqli_num_rows($page_result);
        $total_pages = ceil($total_records / $perPage);
        for($i=1; $i<=$total_pages; $i++ ){
            $output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border: 1px solid blue;' id='".$i."'>".$i."</span>";
        }
         echo $output;
    }
   
   
  }else{
    $query = "SELECT * FROM add_user";
    $result = mysqli_query($conn,$query);

  }

?>