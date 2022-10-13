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
    
    $studentCurrentCoursesList = "SELECT course.ID, course.title, course.semester, registration.id 
    							FROM course, registration
								WHERE registration.courseID = course.ID
								AND registration.studentID = '$stdID'";

	// Connect to database
	if ( !( $database = mysqli_connect( "localhost",
	"root", "" ) ) )                      
	die( "Could not connect to database </body></html>" );

	// open database
	if ( !mysqli_select_db( $database, "course_management") )
		die( "Could not open products database </body></html>" );

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
          if ($stuCoursesListResult->num_rows != 0 ){
            print("<tr>
                    <td>ID</td>
                    <td>Title</td>
                    <td>Semester</td>
                    <td>registration ID</td>
                  </tr>");
          } 
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
      <input id="dropButton" type="submit" value="Drop" disabled/>
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
        dropButton.removeAttribute("disabled");
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