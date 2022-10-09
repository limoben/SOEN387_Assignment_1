<!DOCTYPE html>
<html lang="en">
  <style>
    input{
      display: block;
    }
  </style>

  <body>
    <?php
      extract( $_POST );

      // build SELECT query
      $query = "SELECT firstName FROM student WHERE ID='$stdID'";

      $queryCourse = "SELECT * FROM course WHERE semester='$semester'";

      // Connect to MySQL
      if ( !( $database = mysqli_connect( "localhost",
      "root", "" ) ) )                      
      die( "Could not connect to database </body></html>" );

      // open Products database
      if ( !mysqli_select_db( $database, "course_management") )
          die( "Could not open products database </body></html>" );

      // query Products database
      if ( !( $result = mysqli_query( $database, $query) ) ) 
      {
        print( "Could not execute query! <br />" );
        die( mysqli_error() . "</body></html>" );
      } // end if

      if ( !( $resultCourse = mysqli_query( $database, $queryCourse) ) ) 
      {
        print( "Could not execute query! <br />" );
        die( mysqli_error() . "</body></html>" );
      } // end if

      mysqli_close( $database );
    ?><!-- end PHP script -->
    
    <p> <strong>
      <?php 
        $row=mysqli_fetch_row($result);
        print("$row[0]"); 
      ?>
    </strong>, Welcome to Courses page! </p>
    <p>All courses for this <strong><?php print( "$semester " ); ?></strong> semester are displayed on this page.</p>
    <p><strong>You can select at most 5 courses from the following list:</strong></p>
    <table id="courseTable">
        <?php
          // fetch each record in result set
          for ( $counter = 0; $row = mysqli_fetch_row( $resultCourse );
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
      <h3>Course Cart:</h3>
      <form id="registerForm" method="post" action="register.php">
        <input id="studentID" name="stdID" type="text" value="<?=$stdID?>" readonly />
        <input id="registerButton" type="submit" value="Register" />
      </form>
    </div>

    
    <script>
      let courseArray = [];
      let i = 0;
      let registerForm = document.getElementById('registerForm');
      let registerButton = document.getElementById('registerButton');
      function isSelect(obj){
        let rowFirstTd = obj.parentNode; // get first td node (which include <input> element)
        let row = rowFirstTd.parentNode; // get tr node
        let courseID = row.children[1].innerHTML; // get course ID
        if(obj.checked) {
          if(courseArray.length < 5){
            if(!courseArray.includes(courseID)){
              courseArray[i] = courseID;
              i++;
              let input = document.createElement("input");
              input.setAttribute("id",courseID);
              input.setAttribute("type","text");
              input.setAttribute("name","courseID[]");
              input.setAttribute('value',courseID);
              input.setAttribute('readonly', 'true');
              registerForm.insertBefore(input, registerButton);
            } else{
              console.log("already added!");
            }
            console.log(courseArray);
          } else {
            console.log("Already have 5 courses.");
          }
        } else {
          if(courseArray.includes(courseID)){
            i--;
            courseArray = courseArray.filter(element => element!==courseID);
            console.log(courseArray);
            let cancelInput = document.getElementById(courseID.toString());
            registerForm.removeChild(cancelInput);
          }
          console.log("canceled.");
        }
      }
    </script>
  </body>
</html>
