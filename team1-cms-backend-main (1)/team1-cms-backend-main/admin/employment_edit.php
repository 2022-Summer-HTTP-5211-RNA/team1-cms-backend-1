<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: employment.php' );
  die();
  
}

if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'] )
  {
    
    $query = 'UPDATE employment SET
      title = "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
      employer = "'.mysqli_real_escape_string( $connect, $_POST['employer'] ).'",
      description = "'.mysqli_real_escape_string( $connect, $_POST['description'] ).'",
      start_month = "'.mysqli_real_escape_string( $connect, $_POST['start_month'] ).'",
      start_year = "'.mysqli_real_escape_string( $connect, $_POST['start_year'] ).'",
      end_month = "'.mysqli_real_escape_string( $connect, $_POST['end_month'] ).'",
      end_year = "'.mysqli_real_escape_string( $connect, $_POST['end_year'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'Employment has been updated' );
    
  }

  header( 'Location: employment.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM employment
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location:  employment.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit Employment</h2>

<form method="post">
  
  <label for="title">Title:</label>
  <input type="text" name="title" id="title" value="<?= $record['title'] ?>">
  
  <br>

  <label for="employer">Employer:</label>
  <input type="text" name="employer" id="employer" value="<?= $record['employer'] ?>">

  <br>
  
  <label for="description">Description:</label>
  <textarea name="description" id="description"><?= $record['description'] ?></textarea>
  
  <br>

  <?php
    $months = array("January","February","March","April","May","June","July","August","September","October","November","December");
  ?>
  <label for="start_month">Start Month:</label>
  <select name="start_month" id="start_month">
    <?php foreach($months as $month): ?>
      <?php if(strtolower($month) == $record['start_month']): ?>
        <option valu="<?= strtolower($month) ?>" selected><?= $month ?></option>
      <?php else: ?>
        <option valu="<?= strtolower($month) ?>"><?= $month ?></option>
      <?php endif ?>
    <?php endforeach ?>
  </select>

  <br>

  <label for="start_year">Start Year:</label>
  <input type="text" name="start_year" id="start_year" pattern="\d{4}">

  <br>

  <label for="end_month">End Month:</label>
  <select name="end_month" id="end_month">
    <?php foreach($months as $month): ?>
      <?php if(strtolower($month) == $record['end_month']): ?>
        <option valu="<?= strtolower($month) ?>" selected><?= $month ?></option>
      <?php else: ?>
        <option valu="<?= strtolower($month) ?>"><?= $month ?></option>
      <?php endif ?>
    <?php endforeach ?>
  </select>

  <br>

  <label for="end_year">End Year:</label>
  <input type="text" name="end_year" id="end_year" pattern="\d{4}" value="<?= $record['end_year'] ?>">

  <br>

  <input type="submit" value="Edit Employment">
  
</form>

<p><a href="employment.php"><i class="fas fa-arrow-circle-left"></i> Return to Employment List</a></p>


<?php

include( 'includes/footer.php' );

?>