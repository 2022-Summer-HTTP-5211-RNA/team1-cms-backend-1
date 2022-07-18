<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'])
  {
    
    $query = 'INSERT INTO employment (
        title,
        employer,
        description,
        start_month,
        start_year,
        end_month,
        end_year
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['employer'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['description'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['start_month'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['start_year'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['end_month'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['end_year'] ).'"
      )';
    mysqli_query( $connect, $query );
    
    set_message( 'Employment has been added' );
    
  }
  
  header( 'Location: employment.php' );
  die();
  
}

include( 'includes/header.php' );

?>

<h2>Add Employment</h2>

<form method="post">
  
  <label for="title">Title:</label>
  <input type="text" name="title" id="title">
  
  <br>

  <label for="employer">Employer:</label>
  <input type="text" name="employer" id="employer">

  <br>
  
  <label for="description">Description:</label>
  <textarea name="description" id="description"></textarea>
  
  <br>

  <?php
    $months = array("January","February","March","April","May","June","July","August","September","October","November","December");
  ?>
  <label for="start_month">Start Month:</label>
  <select name="start_month" id="start_month">
    <?php foreach($months as $month): ?>
      <option valu="<?= strtolower($month) ?>"><?= $month ?></option>
    <?php endforeach ?>
  </select>

  <br>

  <label for="start_year">Start Year:</label>
  <input type="text" name="start_year" id="start_year" pattern="\d{4}">

  <br>

  <label for="end_month">End Month:</label>
  <select name="end_month" id="end_month">
    <?php foreach($months as $month): ?>
      <option valu="<?= strtolower($month) ?>"><?= $month ?></option>
    <?php endforeach ?>
  </select>

  <br>

  <label for="end_year">End Year:</label>
  <input type="text" name="end_year" id="end_year" pattern="\d{4}">

  <br>
  
  <input type="submit" value="Add Employment">
  
</form>

<p><a href="employment.php"><i class="fas fa-arrow-circle-left"></i> Return to Employment List</a></p>


<?php

include( 'includes/footer.php' );

?>