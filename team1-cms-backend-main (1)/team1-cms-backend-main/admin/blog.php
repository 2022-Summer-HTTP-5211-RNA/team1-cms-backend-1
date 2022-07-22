<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM blog
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'blog has been deleted' );
  
  header( 'Location: blog.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT *
  FROM blog
  ORDER BY start_year ASC';
$result = mysqli_query( $connect, $query );

?>

<h2>Manage Blog</h2>

<table>
  <tr>
    <th></th>
    <th align="center">ID</th>
    <th align="left">Title</th>
    <th align="left">Author Name</th>
    <th align="center">Description</th>
    <th align="center">Release Date</th>
    <th align="center">Topic</th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td align="center">
        <img src="image.php?type=blog&id=<?php echo $record['id']; ?>&width=300&height=300&format=inside">
      </td>
      <td align="center"><?php echo $record['id']; ?></td>
      <td align="left">
        <?php echo htmlentities( $record['title'] ); ?>
      </td>
      <td align="center"><?php echo htmlentities( $record['author_name'] ); ?></td>
      <td align="center"><?php echo htmlentities( $record['description'] ); ?></td>
      <td align="center"><?php echo htmlentities( $record['release_date'] ); ?></td>
      <td align="center"><?php echo htmlentities( $record['topic'] ); ?></td>
      <td align="center"><a href="education_photo.php?id=<?php echo $record['id']; ?>">Photo</i></a></td>
      <td align="center"><a href="education_edit.php?id=<?php echo $record['id']; ?>">Edit</i></a></td>
      <td align="center">
        <a href="blog.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this blog?');">Delete</i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="blog_add.php"><i class="fas fa-plus-square"></i> Add Blog</a></p>


<?php

include( 'includes/footer.php' );

?>