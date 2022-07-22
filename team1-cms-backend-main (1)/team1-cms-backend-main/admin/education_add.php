<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_POST['institution_name'] ) )
{
  
  if( $_POST['institution_name'])
  {
    
    $query = 'INSERT INTO education (
        institution_name,
        degree_type,
        degree,
        start_month,
        start_year,
        end_month,
        end_year
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['institution_name'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['degree_type'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['degree'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['start_month'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['start_year'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['end_month'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['end_year'] ).'"
      )';
    mysqli_query( $connect, $query );
    
    set_message( 'Education has been added' );
    
  }
  
  header( 'Location: education.php' );
  die();
  
}

include( 'includes/header.php' );

?>

<h2>Add Education</h2>

<form method="post">
  
  <label for="institution_name">Institution Name:</label>
  <input type="text" name="institution_name" id="institution_name">
  
  <br>

  <label for="degree_type">Degree Type:</label>

  <?php
    $degree_types = array("Undergraduate","Masters","Post Graduate Certificate","Doctorate");
  ?>
  <select name="degree_type" id="degree_type">
    <option value="" disabled>--Select--</option>
    <?php foreach($degree_types as $degree_type): ?>
      <option value="<?= $degree_type ?>"><?= $degree_type ?></option>
    <?php endforeach; ?>
  </select>

  <br>
  
  <label for="degree">Degree:</label>
  <input type="text" name="degree" id="degree">
  
  <br>

  <label for="start_month">Start Month:</label>
  <?php
    $months = array("January","February","March","April","May","June","July","August","September","October","November","December");
  ?>
  <select type="text" name="start_month" id="start_month">
    <?php foreach($months as $month): ?>
      <option value="<?= strtolower($month) ?>"><?= $month ?></option>
    <?php endforeach ?>
  </select>

  <br>

  <label for="start_year">Start Year:</label>
  <input type="number" name="start_year" id="start_year" pattern="\d{4}">
  
  <br>

  <label for="end_month">End Month:</label>
  <select type="text" name="end_month" id="end_month">
    <?php foreach($months as $month): ?>
      <option value="<?= strtolower($month) ?>"><?= $month ?></option>
    <?php endforeach ?>
  </select>
  
  <br>

  <label for="end_year">End Year:</label>
  <input type="number" name="end_year" id="end_year" pattern="\d{4}">
  
  <br>
  
  <input type="submit" value="Add Education">
  
</form>

<p><a href="education.php"><i class="fas fa-arrow-circle-left"></i> Return to Education List</a></p>


<?php

include( 'includes/footer.php' );

?>