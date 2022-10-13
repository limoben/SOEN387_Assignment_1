<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Assignment 1</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
	<link rel="stylesheet" href="./course.css" />
  <style type="text/css">
    body{
      color: white;
      font-size: 48px;
    }
  </style>
</head>
<body>
  <div class="bg-image h-100" style="background-image: url('https://mdbootstrap.com/img/Photos/new-templates/tables/img3.jpg');">
      <div class="mask d-flex flex-column justify-content-center align-items-center h-100" style="background-color: rgba(0,0,0,.25);">
        <?php
          extract( $_POST );
          print( "$stdID" );
          $registrationID = $_POST['registrationID']; // registrationID array stored all the courses the student prepare to enroll

          // Connect to MySQL
          if ( !( $database = mysqli_connect( "localhost",
          "root", "" ) ) )                      
          die( "<div>Could not connect to database<div> </body></html>" );

          // open Products database
          if ( !mysqli_select_db( $database, "course_management") )
              die( "<div>Could not open products database<div> </body></html>" );

          // build SELECT query
          foreach( $registrationID as $key => $element){
            $deleteCourseQuery="DELETE FROM registration WHERE ID=$element";

            // query Products database
            if ( !( $result = mysqli_query( $database,$deleteCourseQuery) ) ) 
            {
                print( "<div>Could not execute query!<div> <br />" );
                die( mysqli_error() . "</body></html>" );
            } // end if
            else
            {
            print("<div>Course was delete from the Database correctly</div>");
            }
          }
          

          mysqli_close( $database );
        ?><!-- end PHP script -->
    </div>
  </div>
</body>
</html>