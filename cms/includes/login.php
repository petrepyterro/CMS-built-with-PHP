<?php include "db.php"; ?>
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
      echo $db_id = $row['user_id'];
    }
    
  }
?>