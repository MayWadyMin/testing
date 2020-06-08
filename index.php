<?php include('server.php')?>
<?php include('session.php')?>
<!-- <?php 
  require_once("perpage.php");  
  require_once("dbcontroller.php");
  $db_handle = new DBController();
  
  if (!empty($_POST["search"])){
    $search = $_POST['search'];
    $orderby = " ORDER BY id desc"; 
    $sql = "SELECT * FROM add_user WHERE CONCAT(id, name, birthday, education, it_skill, gender, department, address) LIKE '%".$_POST["search"]."%'";
    $href = 'index.php';
    $perPage = 2; 
    $page = 1;
    if(isset($_POST['page'])){
      $page = $_POST['page'];
    }
    $start = ($page-1)*$perPage;
    if($start < 0) $start = 0;
    
    $query =  $sql . $orderby .  " limit " . $start . "," . $perPage; 
    $result = mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($result)) {
      $resultset[] = $row;
    }   
    if(!empty($resultset))
     $resultset[] = $resultset;
  
    if(!empty($result)) {
      $result["perpage"] = showperpage($sql, $perPage, $href);
    }
   
  }
  

?> -->

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

<!-- 
         <?php $result = mysqli_query($conn,"SELECT * FROM add_user");?> 

     
          <div style="width: 132%">
            <label> Search </label><input type="text" name="search_text" class="form-control" id="search_text" placeholder="Search By Name">
          <button type="submit" name="search"><i class="fa fa-search"></i></button>
          </div>
          <table id="result" class="index-table"></table>

        <br> -->
        

        <label> Search </label><input type="text" name="value" placeholder="Search">
        <button type="submit" name="search" class="btnSearch"><i class="fa fa-search"></i></button><br><br>

  
     
       <!--  <?php if (mysqli_num_rows($result) > 0) { ?> -->
          <table class="index-table" >
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
            <?php while($row = mysqli_fetch_array($search_result)) :?>
              <tr class="index-tr" >
                <td class="index-td" style="text-align: right;"><?php echo $row["id"]; ?></td>
                <td class="index-td"><?php echo $row["name"]; ?></td>
                <td class="index-td"><?php echo $row["birthday"]; ?></td>
                <td class="index-td"><?php echo $row["education"]; ?></td>
                <td class="index-td"><?php echo $row["it_skill"]; ?></td>
                <td class="index-td"><?php echo $row["gender"]; ?></td>
                <td class="index-td"><?php echo $row["department"]; ?></td>
                <td class="index-td"><?php echo $row["address"]; ?></td>
                <td class="index-td"> <a href="edit.php?edit_id=<?php echo $row["id"]; ?>" onclick="editFunction()"> Edit </a> </td>
                <td class="index-td"> <a href="index.php?del_id=<?php echo $row["id"];?>" onclick="deleteFunction()"> Delete </a> </td>
              </tr>
        <?php endwhile; ?>
          <tr>
          
          </tr>
           
          </table>
        <!-- <?php } else{
          echo "No result found";
        } ?> -->
</div>

<br>
      
     <table class="index-table" id="pagination_data"></table>

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
            url:"pagination.php",
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

   <script>
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
    


  </script>



	  </body>

  </html>


  