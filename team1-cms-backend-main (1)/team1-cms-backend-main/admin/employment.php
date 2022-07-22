<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM employment
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'Employment has been deleted' );
  
  header( 'Location: employment.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT *
  FROM employment
  ORDER BY title DESC';
$result = mysqli_query( $connect, $query );

?>

<h2>Manage Employment</h2>

<table>
  <tr>
    <th></th>
    <th align="center">ID</th>
    <th align="left">Title</th>
    <th align="left">Employer</th>
    <th align="center">Description</th>
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
        <img src="image.php?type=employment&id=<?php echo $record['id']; ?>&width=300&height=300&format=inside">
      </td>
      <td align="center"><?php echo $record['id']; ?></td>
      <td align="left">
        <?php echo htmlentities( $record['title'] ); ?>
      </td>
      <td align="center"><?php echo htmlentities( $record['employer'] ); ?></td>
      <td align="center"><?php echo htmlentities( $record['description']); ?></td>
      <td align="center"><?php echo htmlentities( $record['start_month']); ?></td>
      <td align="center"><?php echo htmlentities( $record['start_year']); ?></td>
      <td align="center"><?php echo htmlentities( $record['end_month']); ?></td>
      <td align="center"><?php echo htmlentities( $record['end_year']); ?></td>
      <td align="center"><a href="employment_photo.php?id=<?php echo $record['id']; ?>">Photo</i></a></td>
      <td align="center"><a href="employment_edit.php?id=<?php echo $record['id']; ?>">Edit</i></a></td>
      <td align="center">
        <a href="employment.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this employment?');">Delete</i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="employment_add.php"><i class="fas fa-plus-square"></i> Add Employment</a></p>


<?php

include( 'includes/footer.php' );

?>