		
		<!DOCTYPE html >
		
		
		<html>
		   <head>
		      <title>Search Results</title>
		   <style type = "text/css">
		         body  { font-family: arial, sans-serif;
		                 background-color: #F0E68C } 
		         table { background-color: #ADD8E6 }
		         td    { padding-top: 2px;
		                 padding-bottom: 2px;
		                 padding-left: 4px;
		                 padding-right: 4px;
		                 border-width: 1px;
		                 border-style: inset }
		      </style>
		   </head>
		   <body>
		      <?php
		         extract( $_POST );
		
		         // build SELECT query
		         $query = "SELECT courseID FROM registration where studentID = $studentID";
		         // Connect to MySQL
		         if ( !( $database = mysqli_connect( "localhost",
		            "root", "" ) ) )                      
		            die( "Could not connect to database </body></html>" );
		   
		         // open Products database
		         if ( !mysqli_select_db( $database, "products") )
		            die( "Could not open products database </body></html>" );
		
		         // query Products database
		         if ( !( $result = mysqli_query( $database, $query) ) ) 
		         {
		            print( "Could not execute query! <br />" );
		            die( mysqli_error() . "</body></html>" );
		         } // end if
		
		         mysqli_close( $database );
		      ?><!-- end PHP script -->
		      <h3>Search Results</h3>
		      <table>
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
		      </table>
		      <br />Your search yielded <strong>
		      <?php print( "$counter" ) ?> results.<br /><br /></strong>
		      <h5> Thank you for using the application!</h5>
		   </body>
		</html>
