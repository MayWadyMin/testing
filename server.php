<?php
session_start();
$username = "";
$email    = "";
$errors = array(); 

$conn = mysqli_connect('localhost', 'root', '', 'testing');

if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  if (empty($email)) {
    array_push($errors, "Please fill the Email");
  }
  if (empty($password)) {
    array_push($errors, "Please fill the Password");
  }
  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $results = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($results);
    $username = $row['username'];
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['email'] = $email;
      $_SESSION['username'] = $username;
     /* $_SESSION['success'] = "Sucessfully!";*/
      header('location: index.php');
    }else {
      array_push($errors, "Email and Password are wrong!");
    }
  }
}


if (isset($_POST['reg_user'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $confirmpassword = mysqli_real_escape_string($conn, $_POST['confirmpassword']);
 if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  if ($password != $confirmpassword) { array_push($errors, "Password and Confirm Password do not match"); } 

  $sql_username = "SELECT * FROM users WHERE username='$username'";
  $sql_email = "SELECT * FROM users WHERE email='$email'";
  $res_username = mysqli_query($conn, $sql_username);
  $res_email = mysqli_query($conn, $sql_email);

    if (mysqli_num_rows($res_username) > 0) {
      $name_error = "Username already exists";  
    }if(mysqli_num_rows($res_email) > 0){
      $email_error = "Email already exists";  
    }else if (count($errors) == 0){
      $password = md5($password);
      $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
      mysqli_query($conn, $query);
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "Sucessfully!";
      header('location: login.php');
    }
}

  if(isset($_POST['add'])){
    $name =  mysqli_real_escape_string($conn, $_POST['name']);
    $birthday =  mysqli_real_escape_string($conn, $_POST['birthday']);
    $education =  mysqli_real_escape_string($conn, $_POST['education']);
   
    $gender =  mysqli_real_escape_string($conn, $_POST['gender']);
    $department =  mysqli_real_escape_string($conn, $_POST['department']);
    $address =  mysqli_real_escape_string($conn, $_POST['address']);
    $skills =  $_POST['skill'];
    $check="";  
    foreach($skills as $skill)  {  $check .= $skill." ";  }  
    $sql = mysqli_query($conn,"INSERT INTO add_user (name,birthday,education,it_skill,gender,department,address) 
      VALUES ('$name','$birthday','$education','$check','$gender','$department','$address')");  
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "Sucessfully!";
      header('location: index.php');
}  

  if(isset($_GET['edit_id'])){
    $edit_id = $_GET['edit_id'];
    $sql = "SELECT * FROM add_user WHERE id=$edit_id";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $birthday = $row['birthday'];
    $education = $row['education'];
    $skill = $row['it_skill'];
    $gender = $row['gender'];
    $department = $row['department'];
    $address = $row['address'];

    if(isset($_POST['update'])){
     $name =  mysqli_real_escape_string($conn, $_POST['name']);
    $birthday =  mysqli_real_escape_string($conn, $_POST['birthday']);
    $education =  mysqli_real_escape_string($conn, $_POST['education']);
   
    $gender =  mysqli_real_escape_string($conn, $_POST['gender']);
    $department =  mysqli_real_escape_string($conn, $_POST['department']);
    $address =  mysqli_real_escape_string($conn, $_POST['address']);
      $skills =  $_POST['skill'];
      $check="";  
      foreach($skills as $skill)  {  $check .= $skill." ";  }  

      $sql = "UPDATE add_user SET name='$name',birthday='$birthday', education='$education', it_skill='$check',gender='$gender',department='$department', address='$address' WHERE id=$edit_id";
      mysqli_query($conn,$sql);
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "Sucessfully!";
      header('location: index.php');                
    }
  }

 if(isset($_GET['del_id'])){
            $del_id = $_GET['del_id'];
            $sql = "DELETE FROM add_user WHERE id=$del_id";
            mysqli_query($conn,$sql);
            
            echo "<script>alert('Successfully!')</script>";
  }

  if (isset($_POST['search'])){
    $value = $_POST['value'];
    $query = "SELECT * FROM add_user WHERE CONCAT(id, name, birthday, education, it_skill, gender, department, address) LIKE '%".$_POST["value"]."%'";
    $search_result = mysqli_query($conn,$query);
   
  }else{
    $query = "SELECT * FROM add_user";
    $search_result = mysqli_query($conn,$query);

  }

/*
  if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
  } else {
    $pageno = 1;
  }
    $no_of_records_per_page = 10;
    $offset = ($pageno-1) * $no_of_records_per_page;
    $total_pages_sql = "SELECT COUNT(*) FROM add_user";
    $result = mysqli_query($conn,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    $sql = "SELECT * FROM add_user LIMIT $offset, $no_of_records_per_page";
    $res_data = mysqli_query($conn,$sql);
*/

  /*if (isset($_GET['search'])) {
    $query = $_GET['search'];  
       $query = htmlspecialchars($query); 
        $query = mysql_real_escape_string($query);
        $raw_results = mysql_query("SELECT * FROM add_user
            WHERE ('name' LIKE '%".$query."%') OR ('birthay' LIKE '%".$query."%') OR ('education' LIKE '%".$query."%') OR ('it_skill' LIKE '%".$query."%') OR ('gender' LIKE '%".$query."%') OR ('department' LIKE '%".$query."%') OR ('address' LIKE '%".$query."%') or die(mysql_error())");
        if(mysql_num_rows($raw_results) > 0){ 
            while($results = mysql_fetch_array($raw_results)){
                $name = $results['name'];
                $birthday = $results['birthday'];
                $education =  $results['education'];
                $skill = $results['it_skill'];
                $gender = $results['gender'];
                $department = $results['department'];
                $address = $results['address'];
            }    
        }
        else{ 
            echo "No results";
        }  
  }
*/
?>