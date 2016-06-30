<?php 
  include "db.php";
  session_start();
?>
<?php
  if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    
    $query = "SELECT * FROM users WHERE username = '$username'";
    $select_user_query = mysqli_query($connection, $query);
    if(!$select_user_query){
      die("Query failed" . mysqli_error($connection));
    }
    while($row = mysqli_fetch_assoc($select_user_query)){
      $db_user_id = $row['user_id'];
      $db_username = $row['username'];
      $db_user_password = $row['user_password'];
      $db_user_firstname = $row['user_firstname'];
      $db_user_lastname = $row['user_lastname'];
      $db_user_role = $row['user_role'];
      $db_user_salt = $row['randSalt'];
    }
    
    if ($username === $db_username && hash_equals($db_user_password, crypt($password, $db_user_password))){
      $_SESSION['username'] = $db_username;
      $_SESSION['firstname'] = $db_user_firstname;
      $_SESSION['lastname'] = $db_user_lastname;
      $_SESSION['role'] = $db_user_role;
      
      header("Location: ../admin");
    } else {
      header("Location: ../index.php");
    }  
  }
?>