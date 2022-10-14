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

      // build SELECT query
      $query = "SELECT firstName FROM student WHERE ID='$stdID'";

      $queryCourse = "SELECT c.* 
	  				FROM course c
	  				WHERE c.semester = '$semester'
	  				AND c.ID NOT IN (SELECT courseID FROM registration WHERE studentID = '$stdID');";

      $queryNumOfCourse = "SELECT count(courseID)
                    FROM registration
                    WHERE studentID = '$stdID'";

      // Connect to MySQL
      if ( !( $database = mysqli_connect( "localhost",
      "root", "" ) ) )                      
      die( "Could not connect to database </body></html>" );

      // open Products database
      if ( !mysqli_select_db( $database, "course_management") )
          die( "Could not open products database </body></html>" );

      // get student name
      if ( !( $result = mysqli_query( $database, $query) ) ) 
      {
        print( "Could not execute query! <br />" );
        die( mysqli_error() . "</body></html>" );
      } // end if

      // get all available course
      if ( !( $resultCourse = mysqli_query( $database, $queryCourse) ) ) 
      {
        print( "Could not execute query! <br />" );
        die( mysqli_error() . "</body></html>" );
      } // end if

      // get number of registered course
      if ( !( $resultNumOfCourse = mysqli_query( $database, $queryNumOfCourse) ) ) 
      {
        print( "Could not execute query! <br />" );
        die( mysqli_error() . "</body></html>" );
      } // end if

      mysqli_close( $database );
    ?><!-- end PHP script -->
    <section class="intro">
      <div class="bg-image h-100" style="background-image: url('https://mdbootstrap.com/img/Photos/new-templates/tables/img3.jpg');">
        <h1 class="justify-content-center d-flex" style="color: white"> <strong style="color: orange">
        <?php 
          $row=mysqli_fetch_row($result);
          print("$row[0]"); 
        ?>
        </strong>, Welcome to Courses page! </h1>
        <h3 class="justify-content-center d-flex" style="color: white">All courses for this &nbsp<strong style="color: orange"><?php print( "$semester " ); ?></strong>&nbsp semester are displayed on this page.</h3>
        <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0,0,0,.25);">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12">
                <div class="card bg-dark shadow-2-strong">
                  <div class="card-body">
                    <div class="table-responsive">
                      <?php
                        $row = mysqli_fetch_row( $resultNumOfCourse );
                      ?>
                      <h3 class="text-center mb-5" style="color: white">You can select at most <?php echo (5 - $row[0]); ?> courses from the following list:</h3>
                      <table id="courseTable" class="table">
                          <?php
                            if ($row[0] < 5) {
                              if ($resultCourse->num_rows != 0 ){
                                print("<thead>
                                        <tr>
                                          <th></th>
                                          <th>ID</th>
                                          <th>Title</th>
                                          <th>Semester</th>
                                          <th>Days</th>
                                          <th>Time</th>
                                          <th>Instructor</th>
                                          <th>Room</th>
                                          <th>Start Date</th>
                                          <th>End Date</th>
                                          <th>Admin ID</th>
                                        </tr>
                                      </thead>");
                              }
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
                            }
                          ?><!-- end PHP script -->
                        <!-- If student already selected 5 courses before, he/she does not allowed to select course anymore -->
                        <?php if (( $row[0] == 5 )): ?>
                          <div class="card-body align-items-center d-flex flex-column">
                          <h5 class="card-title" style="color: grey">Adding fail</h5>
                          <p class="card-text" style="color: grey">You have already 5 courses for this semester.</p>
                          <a href="/SOEN387_Assignment_1/home.html" class="btn btn-primary">Go Back</a>
                          </div>
                        <?php endif; ?>
                      </table>
                      <br /><br /><br />
                      <div>
                        <h3 class="justify-content-center d-flex" style="color: white">Course Cart:</h3>
                        <form class="align-items-center d-flex flex-column" id="registerForm" onsubmit="isDisabled()" method="post" action="register.php">
                          <input id="studentID" name="stdID" type="text" value="<?=$stdID?>" readonly />
                          <input id="registerButton" type="submit" value="Register"/>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    
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
          // registerButton.removeAttribute("disabled");
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

      function isDisabled(){
        if(courseArray.length === 0){
          event.preventDefault();
          alert("Please select course before register.");
        } else {
          return true;
        }
    }
    </script>
  </body>
</html>
