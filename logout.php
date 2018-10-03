<?php
 if(!isset($_SESSION))  { 
        session_start(); 
        } 
include('header.php');
// did the user's browser send a cookie for the session?
if( isset( $_COOKIE[ session_name() ] ) ) {

    // empty the cookie
    setcookie( session_name(), '', time()-86400, '/' );

}

// clear all session variables
session_unset();

// destroy the session
session_destroy();

include('header.php');

?>
<!DOCTYPE html>
<html>
 <link rel="stylesheet" type="text/css" href="backgraound.css">
<body>


<h1>Logged out</h1>

<p class="lead">You've been logged out. See you next time!
</p>
</body>
</html>
<?php
include('footer.php');
?>