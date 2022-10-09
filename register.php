<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
  <?php
    extract( $_POST );
    print( "$stdID" );
    print(count( $_POST )); // 计算 $_POST 长度
    print( var_dump( $_POST ) ); // 查看获取的所有post数据
    $courseID = $_POST['courseID'];

    $ID = 1;

    // build SELECT query
    for($i=0; $i < (count( $courseID )); $i++){ // 有几个 input 就创建几个 insert query，-1 是减去studentID的input
      // $_POST 第一项是studentID，所以从第二个element开始
      $query="INSERT INTO registration (ID, studentID, courseID)
      VALUES ('$ID','$stdID','$courseID[$i]')";
      $ID++;

      // Connect to MySQL
      if ( !( $database = mysqli_connect( "localhost",
      "root", "" ) ) )                      
      die( "Could not connect to database </body></html>" );

      // open Products database
      if ( !mysqli_select_db( $database ,"course_management" ) )
          die( "Could not open products database </body></html>" );



      // query Products database
      if ( !( $result = mysqli_query( $database,$query) ) ) 
      {
          print( "Could not execute query! <br />" );
          die( mysqli_error() . "</body></html>" );
      } // end if
      else
      {
      print("Course was inserted into the Database correctly");
      }
          mysqli_close( $database );
    }
  ?><!-- end PHP script -->
  
</body>
</html>