<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: blog.php' );
  die();
  
}

if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'] )
  {
    
    $query = 'UPDATE blog SET
      title ="'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
      author = '.mysqli_real_escape_string( $connect, $_POST['author'] ).'",
      description = "'.mysqli_real_escape_string( $connect, $_POST['description'] ).'",
      release_date = "'.mysqli_real_escape_string( $connect, $_POST['release_date'] ).'",
      topic = "'.mysqli_real_escape_string( $connect, $_POST['topic'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'blog has been updated' );
    
  }

  header( 'Location: blog.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM blog
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location:  blog.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit Blog</h2>

<form method="post">
  
  <label for="blog">Title:</label>
  <input type="text" name="title" id="title" value="<?php echo htmlentities( $record['title'] ); ?>">
  
  <br>.
    
  <label for="author">Author:</label>
  <input type="text" name="author" id="author">

  <br>
  
  <label for="description">Description</label>
  <input type="textarea" name="description" id="start_year" pattern="\d{4}">

  <br>

  <label for="release_date">Release Date:</label>
  <input type="date" name="release_date" id="release_date">

  <br>
  
   <label for="topic">Topic:</label>
  <input type="text" name="topic" id="topic">

  
  <br>
  
  <input type="submit" value="Edit Blog">
  
</form>

<p><a href="blog.php"><i class="fas fa-arrow-circle-left"></i> Return to Blog List</a></p>


<?php

include( 'includes/footer.php' );

?>

