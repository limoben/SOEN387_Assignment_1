<!DOCTYPE html>
<html>

  <body>
    <?php
      extract( $_POST );
    ?><!-- end PHP script -->
    
    <p> Registration in <strong><?php print( "$course " ); ?></strong> is confirmed. </p>
    <p><strong>The following information has been received:</strong></p>
    <table>
      <tr>
        <td>First Name </td>
        <td>Last Name </td>
        <td>Email</td>
        <td>Student ID</td>
        <td>Semester</td>
      <td>Course</td>
      </tr>
      <tr>
        <?php
          // print each form field’s value
          print( "<td>$fname</td>
                  <td>$lname</td>
                  <td>$email</td>
                  <td>$stdID</td>
                  <td>$semester</td>
                  <td>$course</td>" );
        ?><!-- end PHP script -->
      </tr>
    </table>
    <br /><br /><br />
    <div>This is only a sample form no data is saved in the database.</div>
  </body>
</html>
