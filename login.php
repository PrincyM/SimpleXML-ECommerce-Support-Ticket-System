<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
 * Created by PhpStorm.
 * User: princymascarenhas
 * Date: 2018-03-26
 * Time: 11:23 PM
 */
session_start();

$users = simplexml_load_file("users.xml");

if(isset($_POST['Submit']))
{
    if (empty($_POST["username"]) || empty($_POST["password"]))
    {
        echo 'Please fill in both username and password';
    }
    else
        {
        for($i = 0; $i < count($users); $i++) {

            if($_POST["username"] == $users->user[$i]->username) {

                if($_POST["password"] == $users->user[$i]->password){
                    // logged in]
                    $_SESSION['loggedInUserId'] = $users->user[$i]->attributes()->id . "";
                    $_SESSION['loggedInUserRole'] = $users->user[$i]->attributes() . "";
                    $_SESSION['loggedInUserName'] = $users->user[$i]->name->children() . "";
                    $loggedInUser = $users->user[$i]; // check so that the details only of that user is shown

                    if($loggedInUser->attributes() == "client")
                    {
                        header("Location:clientIndex.php");
                    }
                    else
                    {
                        header("Location: staffIndex.php");
                    }
                }
            }
            else {
                echo "Username or password is incorrect";
            }
        }
    }
}

?>
<html>
<title>Support Ticket System Log In</title>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Support Ticket System</h1>
    <form name="login"  method="post" class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <div class="form-group col-md-3 text-center">
                <label for="username" class="sr-only">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Your username" autofocus="">
            </div>
            <div class="form-group col-md-3">
                <label for="password" class="sr-only">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
        <button type="submit" name="Submit" value="Submit" class="btn btn-lg btn-primary btn-block col-md-3">Sign in</button>
    </form>
</div>
</body>
</html>