<!DOCTYPE html>
<html>

  <body>
    <?php
      extract( $_POST );
    ?><!-- end PHP script -->
    
    <p> <strong><?php print( "$stdID " ); ?></strong>, Welcome to Courses page! </p>
    <p>All courses for this <strong><?php print( "$semester " ); ?></strong> semester are displayed on this page.</p>
    <p><strong>You can select at most 5 courses from the following list:</strong></p>
    <ul>
      <li>Courses List</li>
      <li>course1 from db </li>
      <li>course2 from db </li>
      <li>course3 from db</li>
      <li>course4 from db</li>
      <li>course5 from db</li>
    </ul>
    <br /><br /><br />
    <div>This is only a sample form no data is saved in the database.</div>
  </body>
</html>
