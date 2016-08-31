<?php 

  if (isset($_GET['p_id'])){
    $the_post_id = escape($_GET['p_id']);
    $query = "SELECT * FROM posts WHERE post_id=$the_post_id";
    $select_posts_by_id = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_posts_by_id)){
      $post_title = $row['post_title'];
      $post_user = $row['post_user'];
      $post_category_id = $row['post_category_id'];
      $post_status = $row['post_status'];
      $post_image = $row['post_image'];
      $post_content = $row['post_content'];
      $post_tags = $row['post_tags'];
      $post_comment_count = $row['post_comment_count'];
      $post_date = $row['post_date'];
    }
    
  }
  if(isset($_POST['update_post'])){
    $post_title = escape( $_POST['post_title']);
    $post_user = escape( $_POST['post_user']);
    $post_category_id = escape($_POST['post_category']);
    $post_status = escape( $_POST['post_status']);
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_content = escape( $_POST['post_content']);
    $post_tags = escape( $_POST['post_tags']);
    
    move_uploaded_file($post_image_temp, "../images/$post_image");
    if(strlen(trim($post_image)) == 0){
      $query = "SELECT * FROM posts WHERE post_id=$the_post_id";
      $select_image = mysqli_query($connection, $query);
      
      while ($row = mysqli_fetch_assoc($select_image)){
        $post_image = $row['post_image'];
      }
    }
    
    $query = 'UPDATE posts SET ';
    $query .= "post_title = '$post_title', "; 
    $query .= "post_category_id = $post_category_id, "; 
    $query .= "post_date = now(), ";
    $query .= "post_user = '$post_user', "; 
    $query .= "post_status = '$post_status', "; 
    $query .= "post_tags = '$post_tags', "; 
    $query .= "post_content = '$post_content', "; 
    $query .= "post_image = '$post_image' "; 
    $query .= "WHERE post_id = $the_post_id";
    
    $update_post = mysqli_query($connection, $query);
    confirmQuery($update_post, $query);
    
    echo "<p class='bg-success'>The post has been updated " . "<a href='../post.php?p_id=$the_post_id'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";
  }
?>
<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Post Title</label>
    <input type="text" value="<?php echo $post_title ?>" name="post_title" class="form-control" />
  </div>
  <div class="form-group">
    <label for="post_category">Categories</label>
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
        echo "<option value='$post_user'>$post_user</option>";
        while($row = mysqli_fetch_assoc($select_users)){
          $user_id = $row['user_id'];
          $username = $row['username'];
          echo "<option value='$username'>$username</option>";
        };
      ?>
    </select>
  </div>
  <div class="form-group">
    <select name="post_status" id="">
      <option value="<?php echo $post_status ?>"><?php echo $post_status ?></option>
      <?php if ($post_status =='published'){ ?>
        <option value="draft">Draft</option>
      <?php } else { ?>
        <option value="published">Published</option>
      <?php } ?>  
    </select>
  </div>  
  <div class="form-group">
    <img width="100" src="../images/<?php echo $post_image?>" alt=""/>
    <input type="file" name="post_image"/>
  </div>
  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" value="<?php echo $post_tags ?>" class="form-control" name="post_tags"/>
  </div>
  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea name="post_content" id="" cols="30" rows="10" class="form-control"><?php echo $post_content ?>
    </textarea>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="update_post" value="Update Post" />
  </div>
</form>