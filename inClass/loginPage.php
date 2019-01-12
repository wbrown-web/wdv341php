<?php 

session_start();

$message = "0";


    if valid user 

        welcome back


    else //user is not logged in so ask
          if //submit variable set
                capture login and password into variables 
                did you submit a login?

            try connect to db 

            create sql
            sql select with a from and where clause  where username = "username"


            bind paramaters


              catch(PDOException $e) 
                {
                    $message = "There has been a problem "
                }
              
                $row = $stmt->fetch();

                if ($row['username']) === $inUsername) //would need to check for password or do a rowCount($row)
                {
                    $_SESSION['validUser']= "yes";
                    $message = "Welcome Back $inUsername";

                }
                else {
                    $_SESSION['validUser']= "no";
                    $message
                }

          else  //shwow form
          
               
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

if validUser {
    show the information they should see once logged in
}
    
else {

    show login form again
}

// Link back to homepage
</body>
</html>