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
    }
  </style>
</head>
<body>
  <div class="bg-image h-100" style="background-image: url('https://mdbootstrap.com/img/Photos/new-templates/tables/img3.jpg');">
    <div class="mask d-flex flex-column justify-content-center align-items-center h-100" style="background-color: rgba(0,0,0,.25);">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card bg-dark shadow-2-strong">
              <div class="card-body">
                <div class="table-responsive d-flex flex-column justify-content-center align-items-center">
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

                    $currentDate = date("2022-10-14");

                    $queryCoursesEndDate = "SELECT registration.*, course.endDate, course.title
                                          FROM registration, course
                                          WHERE registration.courseID = course.ID";

                    // query Products database
                    if ( !( $result = mysqli_query( $database, $queryCoursesEndDate) ) ) 
                    {
                      print( "Could not execute query! <br />" );
                      die( mysqli_error() . "</body></html>" );
                    } // end if

                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                        if(in_array($row["id"], $registrationID)){
                          $allowDropBefore = date('Y-m-d', strtotime($row["endDate"]));
                          print( "Allow drop before - " . $allowDropBefore );
                          if(strtotime($currentDate) >= strtotime($allowDropBefore)) {
                            print("It's too late to drop the course - ". $row["title"]);
                            $registrationID = array_diff($registrationID, [$row["id"]]);
                          } else {
                            print("You can drop this course.");
                          }
                        }
                      }
                    } else {
                      echo "No result.";
                    }

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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>