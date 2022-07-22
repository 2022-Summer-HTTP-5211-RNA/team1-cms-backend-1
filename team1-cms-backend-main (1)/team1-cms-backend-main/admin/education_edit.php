<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: education.php' );
  die();
  
}

if( isset( $_POST['institution_name'] ) )
{
  
  if( $_POST['institution_name'] )
  {
    
    $query = 'UPDATE education SET
      institution_name = "'.mysqli_real_escape_string( $connect, $_POST['institution_name'] ).'",
      degree_type = "'.mysqli_real_escape_string( $connect, $_POST['degree_type'] ).'",
      degree = "'.mysqli_real_escape_string( $connect, $_POST['degree'] ).'",
      start_month = "'.mysqli_real_escape_string( $connect, $_POST['start_month'] ).'",
      start_year = "'.mysqli_real_escape_string( $connect, $_POST['start_year'] ).'",
      end_month = "'.mysqli_real_escape_string( $connect, $_POST['end_month'] ).'",
      end_year = "'.mysqli_real_escape_string( $connect, $_POST['end_year'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'Education has been updated' );
    
  }

  header( 'Location: education.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM education
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location:  education.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit Education</h2>

<form method="post">
  
  <label for="institution_name">Institution Name:</label>
  <input type="text" name="institution_name" id="institution_name" value="<?php echo htmlentities( $record['institution_name'] ); ?>">
  
  <br>.
    
  <?php
    $degree_types = array("Undergraduate","Masters","Post Graduate Certificate","Doctorate");
  ?>
  <label for="url">Degree Type:</label>
  <select name="degree_type" id="degree_type">
    <option value="" disabled>--Select--</option>
    <?php foreach($degree_types as $degree_type): ?>
        <?php if ($record['degree_type'] == $degree_type): ?>
          <option value="<?= $degree_type ?>" selected><?= $degree_type ?></option>
        <?php else: ?>
          <option value="<?= $degree_type ?>"><?= $degree_type ?></option>
        <?php endif ?>
      } 
    <?php endforeach ?>
  </select>

  <br>
  
  <label for="degree">Degree:</label>
  <input type="text" name="degree" id="degree" value="<?= htmlentities( $record['degree'] ) ?>">
    
  <br>

  <label for="start_month">Start Month:</label>
    
  <?php
    $months = array("January","February","March","April","May","June","July","August","September","October","November","December");
  ?>
  <select type="text" name="start_month" id="start_month">
    <?php foreach($months as $month): ?>
      <?php if(strtolower($month) == $record['month']): ?>
        <option value="<?= strtolower($month) ?>" selected><?= $month ?></option>
      <?php else: ?>
        <option value="<?= strtolower($month) ?>"><?= $month ?></option>
      <?php endif ?>
    <?php endforeach ?>
  </select>

  <br>
  
  <label for="start_year">Start Year:</label>
  <input type="text" name="start_year" id="start_year" value="<?php echo htmlentities( $record['start_year'] ); ?>" pattern="\d{4}">
    
  <br>

  <label for="end_month">End Month:</label>
  <select type="text" name="end_month" id="end_month">
    <?php foreach($months as $month): ?>
      <?php if(strtolower($month) == $record['end_month']): ?>
        <option value="<?= strtolower($month) ?>" selected><?= $month ?></option>
      <?php else: ?>
        <option value="<?= strtolower($month) ?>"><?= $month ?></option>
      <?php endif ?>
    <?php endforeach ?>
  </select>
  
  <br>
  
  <label for="end_year">End Year:</label>
  <input type="text" name="end_year" id="end_year" value="<?= htmlentities( $record['end_year'] ); ?>" pattern="\d{4}">
    
  <br>
  
  <input type="submit" value="Edit Education">
  
</form>

<p><a href="education.php"><i class="fas fa-arrow-circle-left"></i> Return to Education List</a></p>


<?php

include( 'includes/footer.php' );

?>