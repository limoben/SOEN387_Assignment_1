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
		      
				 $query="INSERT INTO course (ID,title,semester,days,time,instructor,room,startDate,endDate,adminID)
				 VALUES ('$courseID','$Title','$Semester','$Days','$Time', '$Instructor', '$Room', '$StartDate', '$EndDate', '$AdminId')";
				 
				 
		         // Connect to MySQL
		         if ( !( $database = mysqli_connect( "localhost",
		            "root", "" ) ) )                      
		            die( "Could not connect to database </body></html>" );
		   
		         // open Products database
		         if ( !mysqli_select_db( $database ,"products" ) )
		            die( "Could not open products database </body></html>" );
		     
		
		
		        
		      ?><!-- end PHP script -->
 <section class="intro">
  <div class="bg-image h-100" style="background-image: url('https://mdbootstrap.com/img/Photos/new-templates/tables/img2.jpg');">
    <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0,0,0,.25);">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12">
          
			  
								<h2 class="text-center mb-5">Adding Course Result</h2>

		      <div class="card text-center">
<?php if ( $result = mysqli_query( $database,$query) ): ?>
  <div class="card-body">
    <h5 class="card-title">Adding Successfully</h5>
    <p class="card-text">You have already add your course successfully.</p>
    <a href="/home" class="btn btn-primary">Go Back</a>
  </div>
  <?php endif; ?>
  <?php if (!( $result = mysqli_query( $database,$query) )): ?>
	<div class="card-body">
    <h5 class="card-title">Adding fail</h5>
    <p class="card-text"> add your course fail.</p>
    <a href="/home" class="btn btn-primary">Go Back</a>
  </div>
<?php endif; ?>
</div>

</div>
        </div>
      </div>
    </div>
  </div>
</section>
		   </body>
		</html>
