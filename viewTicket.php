<?php
/**
 * Created by PhpStorm.
 * User: princymascarenhas
 * Date: 2018-03-28
 * Time: 12:22 PM
 */

$tickets = simplexml_load_file("tickets.xml");
$users = simplexml_load_file("users.xml");

if(isset($_GET['id']))
{
    $id = $_GET['id']; // passing query value into a variable
    $ticket = $tickets->xpath("/tickets/ticket[@id=$id]");
//    $role = $users->
//    $supportMessage = $tickets->xpath("/tickets/ticket[@id=$id]/messages/message[@userId=""]");
    //$userId = $_SESSION['loggedInUserId'];


}

function getUserRole($userId)
{
    $users = simplexml_load_file("users.xml");
    $user = $users->xpath("/users/user[@id=$userId]")[0];


    return $user->attributes()->role; // return the role of the userId

}
?>

<html>
<title>Ticket Details</title>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Ticket Details</h1>

    <div class="jumbotron">
        <dl class="row">
            <dt class="col-sm-3">Ticket ID:</dt>
            <dd class="col-sm-9"><?php echo $ticket[0]->attributes(); ?></dd>

            <dt class="col-sm-3">Issue Date:</dt>
            <dd class="col-sm-9"><?php echo  $ticket[0]->issueDate; ?></dd>

            <dt class="col-sm-3">Status:</dt>
            <dd class="col-sm-9"><?php echo  $ticket[0]->status; ?></dd>

            <dt class="col-sm-3 text-truncate">Issue Category:</dt>
            <dd class="col-sm-9"><?php echo  $ticket[0]->issueCategory; ?></dd>

            <dt class="col-sm-3">Messages</dt>
            <dd class="col-sm-9">
                <dl class="row">
                    <dt class="col-sm-4">Your message:</dt>
                    <dd class="col-sm-8"><?php echo $ticket[0]->messages->message; ?></dd>
                </dl>
                <dl class="row">
                    <dt class="col-sm-4">Support Staff Message:</dt>
                    <dd class="col-sm-8">
                        <?php foreach ($ticket[0]->messages->message as $ticketElement) :?>
                        <?php echo getUserRole($ticketElement->attributes()); ?></dd>
                    <?php endforeach;?>
                </dl>
            </dd>
        </dl>

<!--        <hr class="my-4">-->
<!--        <p class="lead">-->
<!--            <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>-->
<!--        </p>-->
    </div>

</div> <!-- end of container -->

</body>
</html>
