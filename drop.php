<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
  <?php
    extract( $_POST );
    print( "$stdID" );
    $registrationID = $_POST['registrationID']; // registrationID array stored all the courses the student prepare to enroll

    // Connect to MySQL
    if ( !( $database = mysqli_connect( "localhost",
    "root", "" ) ) )                      
    die( "Could not connect to database </body></html>" );

    // open Products database
    if ( !mysqli_select_db( $database, "course_management") )
        die( "Could not open products database </body></html>" );

    // build SELECT query
    foreach( $registrationID as $key => $element){
      $deleteCourseQuery="DELETE FROM registration WHERE ID=$element";

      // query Products database
      if ( !( $result = mysqli_query( $database,$deleteCourseQuery) ) ) 
      {
          print( "Could not execute query! <br />" );
          die( mysqli_error() . "</body></html>" );
      } // end if
      else
      {
      print("Course was delete from the Database correctly");
      }
    }
    

    mysqli_close( $database );
  ?><!-- end PHP script -->

</body>
</html>