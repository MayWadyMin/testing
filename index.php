<?php include('server.php')?>
<?php include('session.php')?>


<!DOCTYPE html>
  <html>
    <head>
	   <title> Testing </title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	   <link rel="stylesheet" type="text/css" href="style.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
      <form class="index-form" method="post" action="index.php" name="frmSearch">

        <?php  if (isset($_SESSION['email'])) : ?>
        <table style="width: 125%">
          <tr>
            <td style="color: black;"> Username : <?php echo $_SESSION['username']; ?> </td>
            <td><button style="background-color: pink; color: white; width: 100px; height: 30px;"><a href="insert.php" >Add New</a></button></td>
            <td><button style="background-color: pink; color: white; width: 100px; height: 30px;"><a href="index.php?logout='1'">Logout</a></button></td>
            
          </tr>
        </table>
        <br><br>
        <?php endif ?>

    <!--  <div id="pagination_data"></div>  -->   

<?php
$record_per_page = 5 ;
$page = '';
$orderby = " ORDER BY id DESC";
$output ='';   
if (isset($_POST["page"])) {
    $page = $_POST["page"];
}else{
    $page = 1;
}
$start_from = ($page - 1) * $record_per_page; ?>
<label> Search </label><input type="text" name="value" placeholder="Search" >
<button type="submit" name="search" class="btnSearch"><i class="fa fa-search"></i></button><br><br>

<?php
if (isset($_POST['search'])){
    $value = $_POST['value'];
    $sql = "SELECT * FROM add_user WHERE CONCAT(id, name, birthday, education, it_skill, gender, department, address) LIKE '%".$_POST["value"]."%'" ; 
    $query =  $sql . $orderby .  " LIMIT " . $start_from . "," . $record_per_page; 
    $search_result = mysqli_query($conn,$query);
}else{
    $query = "SELECT * FROM add_user ORDER BY id DESC LIMIT $start_from, $record_per_page";
    $search_result = mysqli_query($conn,$query);
} ?>

<table class="index-table">
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
  </tr>
              
<?php while($row = mysqli_fetch_array($search_result)) : ?>

  <tr class="index-tr">
  <td class="index-td" style="text-align: right;"> <?php echo $row["id"]; ?> </td>
  <td class="index-td"> <?php echo $row["name"]; ?> </td>
  <td class="index-td"> <?php echo $row["birthday"]; ?> </td>
  <td class="index-td"> <?php echo $row["education"]; ?> </td>
  <td class="index-td"> <?php echo $row["it_skill"]; ?> </td>
  <td class="index-td"> <?php echo $row["gender"]; ?> </td>
  <td class="index-td"> <?php echo $row["department"]; ?> </td>
  <td class="index-td"> <?php echo $row["address"]; ?> </td>
  <td class="index-td"> <a href="edit.php?edit_id=<?php echo $row["id"]; ?>" onclick="editFunction()"> Edit </a> </td>
  <td class="index-td"> <a href="index.php?del_id=<?php echo $row["id"]; ?>" onclick="deleteFunction()"> Delete </a> </td>
  </tr>
<?php endwhile ?>

</table><br/>

<div id="pagination_data"></div>

<!-- <?php
  $page_query = "SELECT * FROM add_user ORDER BY id DESC";
  $page_result = mysqli_query($conn, $page_query);
  $total_records = mysqli_num_rows($page_result);
  $total_pages = ceil($total_records / $record_per_page);
  for($i=1; $i<=$total_pages; $i++ ){ 
?>
  
  <span class='pagination_link' style='cursor:pointer; padding:6px; border: 1px solid blue;' id='<?php echo $i; ?>'><?php echo $i; ?></span>

<?php } ?> -->



  </form>
   <script>
      function editFunction() {
        return confirm("Are you sure you want to edit!");
      }
      function deleteFunction() {
        return confirm("Are you sure you want to delete!");
      }

  </script>


  <script>
    
    $(document).ready(function(){
        load_data();
        function load_data(page){
          $.ajax({
            url:"paginationOne.php",
              method: "POST",
              data: {page : page},
              success: function(data){
                $('#pagination_data').html(data);
              }
          });
        }

        $(document).on('click', '.pagination_link',function(){
            var page = $(this).attr("id");
            load_data(page);
        });
        
      });


  </script>

  <!--  <script>
    $(document).ready(function(){
      $('#search_text').keyup(function(){
          var txt = $(this).val();
          if (txt != '') {
            $.ajax({
              url:"search.php",
              method: "post",
              data: {search : txt},
              dataType: "text",
              success: function(data){
                $('#result').html(data);
              }

            });

          }else{
            $('#result').html('');
            $.ajax({
              url:"search.php",
              method: "post",
              data: {search : txt},
              dataType: "text",
              success: function(data){
                $('#result').html(data);
              }

            });
          }
      });
    });
    


  </script> -->



	  </body>

  </html>


  