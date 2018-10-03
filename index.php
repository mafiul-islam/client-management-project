<?php
 session_start();

  include('functions.php');
  
  if( isset( $_POST['login'] ) ) {

    //create variables
    //wrap data with variable function
    $formEmail = validateFormData( $_POST['email'] );
    $formPass =  validateFormData($_POST['password']);
     
    //connect to database
    include('connection.php');

     $server = "localhost";
     $username = "root";
     $password = "";
     $db = "db_profilebook";

 //create a connection 
    
    $conn = mysqli_connect($server,$username,$password,$db);

 //check the connection 

 if( !$conn ) {
    die("connection failed: " . mysqli_connect_error() );
 }
       
       //create query
    $query = "SELECT name, password FROM users WHERE email = '$formEmail'";

    //store the result
    $result = mysqli_query( $conn , $query);

    //verify if result is returned

    if( mysqli_num_rows ($result) > 0 ) {

        //store basic user data in variables

        while ( $row = mysqli_fetch_assoc($result ) ) {
            $name = $row['name'];
            $hashedPass = $row['password'];
        }

        //verify hashed password with submitted password

        if (password_verify( $formPass, $hashedPass )) {
            //correct login details !
            //store data in sesson variable
            $_SESSION['loggedInUser'] = $name;

            //redirect user to clients page
            header("Location: clients.php");
        } else { //hashed password didn't verify

             // error message
        $loginError = "<div class='alert alert-danger'> wrong username / password combination . try again!.  </div>";
         echo $loginError;


        }

    } else { //there are no result in database

            $loginError = "<div class='alert alert-danger'> No Such User In Database . please try again . <a class='close' data-dismiss ='alert'> &times; </a>  </div>";
             echo $loginError;


    }


     

  }

 

include('header.php');


//$password = password_hash("mafiul123", PASSWORD_DEFAULT);
//echo $password;

?> 

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Client Address Book</title>
         <link rel="stylesheet" type="text/css" href="style.css">


        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>



<h1>Client Address Book</h1>
<p class="lead">Log in to your account.</p>


<form class="container" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] ); ?>" method="post">
    <div class="form-group">
        <label for="login-email">Email</label>
        <input type="text"  placeholder="email" name="email">
    </div>
    <div class="form-group">
        <label for="login-password" >Password</label>
        <input type="password" id="login-password" placeholder="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary" name="login">Login</button>
</form>

</body>
</html>

<?php
include('footer.php');
?>

