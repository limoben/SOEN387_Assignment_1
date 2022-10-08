<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
  <?php
    extract( $_POST );
    print( "$stdID" );
    print( "$courseID" );

    // build SELECT query
    
    // $query="INSERT INTO books (ID,Title,Category,ISBN)
    // VALUES ('$ID','$Title','$Category','$ISBN')";

    // // Connect to MySQL
    // if ( !( $database = mysqli_connect( "localhost",
    //     "root", "" ) ) )                      
    //     die( "Could not connect to database </body></html>" );

    // // open Products database
    // if ( !mysqli_select_db( $database ,"products" ) )
    //     die( "Could not open products database </body></html>" );



    // // query Products database
    // if ( !( $result = mysqli_query( $database,$query) ) ) 
    // {
    //     print( "Could not execute query! <br />" );
    //     die( mysqli_error() . "</body></html>" );
    // } // end if
    // else
    // {
    // print("Book was insterted into the Database correctly");
    // }
    //     mysqli_close( $database );
  ?><!-- end PHP script -->
  
</body>
</html>