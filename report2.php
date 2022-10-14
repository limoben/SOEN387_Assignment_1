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
	<link rel="stylesheet" href="./report2.css" />
  </head>
		   <body>
		      <?php
		         extract( $_POST );
		
		         // build SELECT query
		         $query = "SELECT student.firstName, registration.studentID FROM registration join student where student.ID = registration.studentID and registration.courseID = $courseID";
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
		
		         mysqli_close( $database );
		      ?><!-- end PHP script -->
		      <section class="intro">
  <div class="bg-image h-100" style="background-image: url('https://mdbootstrap.com/img/Photos/new-templates/tables/img2.jpg');">
    <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0,0,0,.25);">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card bg-dark shadow-2-strong">
              <div class="card-body">
                <div class="table-responsive">
			  
								<h2 class="text-center mb-5">Report System</h2>
		      <table class="table">
			  <thead>
                      <tr>
                        <th scope="col">Student Name</th>
						<th scope="col">Student ID</th>
                      </tr>
                    </thead>
					<tbody>
		         <?php
		            // fetch each record in result set
		            for ( $counter = 0; $row = mysqli_fetch_row( $result );
		               $counter++ )
		            {
		               // build table to display results
		               print( "<tr>" );
		               foreach ( $row as $key => $value ) 
		                  print( "<td>$value</td>" );
		
		               print( "</tr>" );
		            } // end for
		         ?><!-- end PHP script -->
				 </tbody>
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
