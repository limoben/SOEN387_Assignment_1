<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    input{
      display: block;
    }
  </style>
</head>
<body>
  <?php
    extract( $_POST );
    print( "$stdID" );
    $courseID = $_POST['courseID']; // courseID array stored all the courses the student prepare to enroll

    // get the date of the day the student register for the courses
    // for test, we need to input a date before 2022-09-09
    $currentDate = date("2022-09-01");

    $queryCoursesStartDate = "SELECT ID, title, startDate FROM course";

    $enrolledCourses = "SELECT ID, courseID FROM registration WHERE studentID = $stdID ";

    // Connect to MySQL
    if ( !( $database = mysqli_connect( "localhost",
    "root", "" ) ) )                      
    die( "Could not connect to database </body></html>" );

    // open Products database
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

    // First: here we checked if the courses already register once
    // if so, we delete the enrolled course from the courseID array
    if ($enrolledCoursesResult->num_rows > 0) {
      while($row = $enrolledCoursesResult->fetch_assoc()) {
        if(in_array($row["courseID"], $courseID)){
          $courseID = array_diff($courseID, [$row["courseID"]]);
        }
        // echo "id: " . $row["ID"]. " - Name: " . $row["title"]. " " . $row["startDate"]. "<br>";
      }
    } else {
      echo "No result.";
    }
    var_dump($courseID);

    // Second: we check if the courses are still allowed to register
    // if the student add a course over one week after the start of the semester
    // then the course is not allowed to register
    // we delete it from the courseID array
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        if(in_array($row["ID"], $courseID)){
          $allowEnrollBefore = date('Y-m-d', strtotime($row["startDate"].'+8 day'));
          print( $allowEnrollBefore );
          if(strtotime($currentDate) >= strtotime($allowEnrollBefore)) {
            print("It's too late to enroll the course.");
            print($row["title"]);
            $courseID = array_diff($courseID, [$row["ID"]]);
          } else {
            print("You can enroll this course.");
          }
        }
      }
    } else {
      echo "No result.";
    }
    var_dump($courseID);

    // build SELECT query
    $ID = $enrolledCoursesResult->num_rows;
    foreach( $courseID as $key => $element){ // 有几个 input 就创建几个 insert query，-1 是减去studentID的input
      $ID++;
      $queryRegisterCourse="INSERT INTO registration (ID, studentID, courseID)
      VALUES ('$ID','$stdID','$courseID[$key]')";

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

    $studentCurrentCoursesList = "SELECT course.ID cid, course.title, course.semester, registration.id rid FROM course, registration WHERE registration.courseID=course.ID";

    // query Products database
    if ( !( $stuCoursesListResult = mysqli_query( $database, $studentCurrentCoursesList) ) ) 
    {
      print( "Could not execute query! <br />" );
      die( mysqli_error() . "</body></html>" );
    } // end if

    mysqli_close( $database );
  ?><!-- end PHP script -->

  <p><strong>Your current courses list for this semester: </strong></p>
    <table id="studentCourseTable">
        <?php
          // fetch each record in result set
          for ( $counter = 0; $row = mysqli_fetch_row( $stuCoursesListResult );
              $counter++ )
          {
            // build table to display results
            print( "<tr>" );
            print( "<td>" );
            print( '<input type="checkbox" name="selectCourse" onclick="isSelect(this)"></input>' );
            print( "</td>" );
            foreach ( $row as $key => $value ) 
              print( "<td>$value</td>" );
            print( "</tr>" );
          } // end for
        ?><!-- end PHP script -->
    </table>

  <br /><br /><br />
  <div>
    <h3>Drop Course:</h3>
    <form id="dropForm" method="post" action="drop.php">
      <input id="studentID" name="stdID" type="text" value="<?=$stdID?>" readonly />
      <input id="dropButton" type="submit" value="Drop" />
    </form>
  </div>
  
  <script>
    let registrationIDArray = [];
    let i = 0;
    let dropForm = document.getElementById('dropForm');
    let dropButton = document.getElementById('dropButton');
    function isSelect(obj){
      let rowFirstTd = obj.parentNode; // get first td node (which include <input> element)
      let row = rowFirstTd.parentNode; // get tr node
      let courseID = row.children[1].innerHTML; // get course ID
      let registrationID = row.children[4].innerHTML;
      if(obj.checked) {
        if(registrationIDArray.length < 5){
          if(!registrationIDArray.includes(registrationID)){
            registrationIDArray[i] = registrationID;
            i++;
            let input = document.createElement("input");
            input.setAttribute("id",registrationID);
            input.setAttribute("type","text");
            input.setAttribute("name","registrationID[]");
            input.setAttribute('value',registrationID);
            input.setAttribute('readonly', 'true');
            dropForm.insertBefore(input, dropButton);
          } else{
            console.log("already added!");
          }
          console.log(registrationIDArray);
        } else {
          console.log("Already have 5 courses.");
        }
      } else {
        if(registrationIDArray.includes(registrationID)){
          i--;
          registrationIDArray = registrationIDArray.filter(element => element!==registrationID);
          console.log(registrationIDArray);
          let cancelInput = document.getElementById(registrationID.toString());
          dropForm.removeChild(cancelInput);
        }
        console.log("canceled.");
      }
    }
  </script>
</body>
</html>