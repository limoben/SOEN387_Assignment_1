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
</head>
<body>
  <?php
    extract( $_POST );
    $courseID = $_POST['courseID']; // courseID array stored all the courses the student prepare to enroll

    // get the date of the day the student register for the courses
    // for test, we need to input a date before 2022-09-09
    $currentDate = date("2022-09-01");

    $queryCoursesStartDate = "SELECT ID, title, startDate 
							FROM course";

    $enrolledCourses = "SELECT ID, courseID 
						FROM registration 
						WHERE studentID = $stdID ";

    $queryNumOfCourse = "SELECT count(courseID)
                        FROM registration
                        WHERE studentID = '$stdID'";

    // Connect to database
    if ( !( $database = mysqli_connect( "localhost",
    "root", "" ) ) )                      
    die( "Could not connect to database </body></html>" );

    // open database
    if ( !mysqli_select_db( $database, "course_management") )
        die( "Could not open products database </body></html>" );

    // query Products database
    if ( !( $result = mysqli_query( $database, $queryCoursesStartDate) ) ) 
    {
      print( "Could not execute query! <br />" );
      die( mysqli_error() . "</body></html>" );
    } // end if

    if ( !( $enrolledCoursesResult = mysqli_query( $database, $enrolledCourses) ) ) 
    {
      print( "Could not execute query! <br />" );
      die( mysqli_error() . "</body></html>" );
    } // end if

    // First: we check if the courses are still allowed to register
    // if the student add a course over one week after the start of the semester
    // then the course is not allowed to register
    // we delete it from the courseID array
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        if(in_array($row["ID"], $courseID)){
          $allowEnrollBefore = date('Y-m-d', strtotime($row["startDate"].'+8 day'));
          print( "Allow enroll before - " . $allowEnrollBefore );
          if(strtotime($currentDate) >= strtotime($allowEnrollBefore)) {
            print("It's too late to enroll the course - ". $row["title"]);
            $courseID = array_diff($courseID, [$row["ID"]]);
          } else {
            print("You can enroll this course.");
          }
        }
      }
    } else {
      echo "No result.";
    }
    
    // build SELECT query
    $ID = $enrolledCoursesResult->num_rows;
    foreach( $courseID as $key => $element){ // 有几个 input 就创建几个 insert query，-1 是减去studentID的input
      $ID++;
      $queryRegisterCourse="INSERT INTO registration (ID, studentID, courseID)
      VALUES (NULL,'$stdID','$courseID[$key]')";

      // get number of registered course
      if ( !( $resultNumOfCourse = mysqli_query( $database, $queryNumOfCourse) ) ) 
      {
        print( "Could not execute query! <br />" );
        die( mysqli_error() . "</body></html>" );
      } // end if

      $row = mysqli_fetch_row( $resultNumOfCourse );
      if ($row[0] < 5) {
        // query Products database
        if ( !( $result = mysqli_query( $database,$queryRegisterCourse) ) ) 
        {
            print( "Could not execute query! <br />" );
            die( mysqli_error() . "</body></html>" );
        } // end if
        else
        {
          print("Course was inserted into the Database correctly");
        }
      }
    }

    $studentCurrentCoursesList = "SELECT c.ID, c.title, c.semester, r.id 
    							FROM course c, registration r
								WHERE r.courseID = c.ID
								AND r.studentID = '$stdID'";

    // query Products database
    if ( !( $stuCoursesListResult = mysqli_query( $database, $studentCurrentCoursesList) ) ) 
    {
      print( "Could not execute query! <br />" );
      die( mysqli_error() . "</body></html>" );
    } // end if

    mysqli_close( $database );
  ?><!-- end PHP script -->

  <section class="intro">
    <div class="bg-image h-100" style="background-image: url('https://mdbootstrap.com/img/Photos/new-templates/tables/img3.jpg');">
      <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0,0,0,.25);">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="card bg-dark shadow-2-strong">
                <div class="card-body">
                  <div class="table-responsive">
                    <h3 class="text-center mb-5" style="color: white">Your current courses list for this semester: </strong></p>
                    <table id="studentCourseTable" class="table">
                      <?php
                        // fetch each record in result set
                        for ( $counter = 0; $row = mysqli_fetch_row( $stuCoursesListResult );
                            $counter++ )
                        {
                          // build table to display results
                          print( "<tr>" );
                          print( "<td>" );
                          print( '<input type="checkbox" name="selectCourse" onclick="isSelect(this)" disabled></input>' );
                          print( "</td>" );
                          foreach ( $row as $key => $value ) 
                            print( "<td>$value</td>" );
                          print( "</tr>" );
                        } // end for
                      ?><!-- end PHP script -->
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</body>
</html>