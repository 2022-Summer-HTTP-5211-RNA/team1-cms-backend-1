<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM education
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'Education has been deleted' );
  
  header( 'Location: education.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT *
  FROM education
  ORDER BY start_year ASC';
$result = mysqli_query( $connect, $query );

?>

<h2>Manage Education</h2>

<table>
  <tr>
    <th></th>
    <th align="center">ID</th>
    <th align="left">Institution</th>
    <th align="left">Degree Type</th>
    <th align="center">Degree</th>
    <th align="center">Start Month</th>
    <th align="center">Start Year</th>
    <th align="center">End Month</th>
    <th align="center">End Year</th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td align="center">
        <img src="image.php?type=education&id=<?php echo $record['id']; ?>&width=300&height=300&format=inside">
      </td>
      <td align="center"><?php echo $record['id']; ?></td>
      <td align="left">
        <?php echo htmlentities( $record['institution_name'] ); ?>
      </td>
      <td align="center"><?php echo htmlentities( $record['degree_type'] ); ?></td>
      <td align="center"><?php echo htmlentities( $record['degree'] ); ?></td>
      <td align="center"><?php echo htmlentities( $record['start_month'] ); ?></td>
      <td align="center"><?php echo htmlentities( $record['start_year'] ); ?></td>
      <td align="center"><?php echo htmlentities( $record['end_month'] ); ?></td>
      <td align="center"><?php echo htmlentities( $record['end_year'] ); ?></td>
      <td align="center"><a href="education_photo.php?id=<?php echo $record['id']; ?>">Photo</i></a></td>
      <td align="center"><a href="education_edit.php?id=<?php echo $record['id']; ?>">Edit</i></a></td>
      <td align="center">
        <a href="education.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this education?');">Delete</i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="education_add.php"><i class="fas fa-plus-square"></i> Add Education</a></p>


<?php

include( 'includes/footer.php' );

?>