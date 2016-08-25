<?php 
  if (isset($_POST['create_post'])){
    $post_title = mysqli_real_escape_string($connection, $_POST['post_title']);
    $post_user = mysqli_real_escape_string($connection, $_POST['post_user']);
    $post_category_id = $_POST['post_category'];
    $post_status = mysqli_real_escape_string($connection, $_POST['post_status']);
    
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    
    $post_tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
    $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
    $post_date = date('d-m-y');
    
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
    $query = "INSERT INTO posts(post_category_id,post_title,post_user,post_date,post_image,post_content,post_tags,post_status) ";
    $query .= "VALUES($post_category_id, '$post_title', '$post_user',now(), '$post_image', '$post_content', '$post_tags', '$post_status')";
    
    $create_post_query = mysqli_query($connection, $query);
    confirmQuery($create_post_query, $query);
    $the_last_post_id = mysqli_insert_id($connection);
    echo "<p class='bg-success'>Your post was added. <a href='posts.php'>View All Posts</a> or <a href='../post.php?p_id=$the_last_post_id'>View Post</a></p>";
  }
?>
<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Post Title</label>
    <input type="text" name="post_title" class="form-control" />
  </div>
  <div class="form-group">
    <label for="post_category">Category</label>
    <select name="post_category" id="">
      <?php
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);
        confirmQuery($select_categories, $query);
        while($row = mysqli_fetch_assoc($select_categories)){
          $cat_id = $row['cat_id'];
          $cat_title = $row['cat_title'];
          echo "<option value='$cat_id'>$cat_title</option>";
        };
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="post_user">Author</label>
    <select name="post_user" id="">
      <?php
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query);
        confirmQuery($select_users, $query);
        while($row = mysqli_fetch_assoc($select_users)){
          $user_id = $row['user_id'];
          $username = $row['username'];
          echo "<option value='$username'>$username</option>";
        };
      ?>
    </select>
  </div>
  <div class="form-group">
    <select name="post_status">
      <option value="draft">Post Status</option>
      <option value="published">Published</option>
      <option value="draft">Draft</option>  
    </select>
  </div>
  <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="post_image"/>
  </div>
  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags"/>
  </div>
  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea name="post_content" id="" cols="30" rows="10" class="form-control"></textarea>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post" />
  </div>
</form>
