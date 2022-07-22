<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_POST['institution_name'] ) )
{
  
  if( $_POST['institution_name'])
  {
    
    $query = 'INSERT INTO blog (
        id,
        title,
        author,
        description as 'description',
        release_date,
        topic
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['author'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['description'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['release_date'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['topic'] ).'"
      )';
    mysqli_query( $connect, $query );
    
    set_message( 'blog has been added' );
    
  }
  
  header( 'Location: blog.php' );
  die();
  
}

include( 'includes/header.php' );

?>

<h2>Add Education</h2>

<form method="post">
  
  <label for="institution_name">title:</label>
  <input type="text" name="institution_name" id="institution_name">
  
  <br>

  <label for="author">Author::</label>
  <input type="text" name="author" id="author">


  <label for="description">Description</label>
  <input type="textarea" name="description" id="start_year" pattern="\d{4}">

  <br>
  
  <label for="release_date">Release Date:</label>
  <input type="date" name="release_date" id="release_date">
  
  <br>

  <label for="topic">Topic:</label>
  <input type="text" name="topic" id="topic">
  
  <br>
  
  <input type="submit" value="Add Education">
  
</form>

<p><a href="blog.php"><i class="fas fa-arrow-circle-left"></i> Return to Blog List</a></p>


<?php

include( 'includes/footer.php' );

?>