<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$tickets = simplexml_load_file("tickets.xml");
$users = simplexml_load_file("users.xml");

session_start();

$userIdLogged = $_SESSION['loggedInUserId']; // getting session variable to add it to XML data directly


if(isset($_GET['id']))
{
    $id = $_GET['id']; // passing query value into a variable
    $ticket = $tickets->xpath("/tickets/ticket[@id=$id]")[0];
    //var_dump($ticket);
    $messages = $ticket->messages;


    if(isset($_POST['addMessage']))
    {
        $ticketMessage = $_POST['message'];

        $message = $messages->addChild('message', $ticketMessage);
        $message->addAttribute('userId',$userIdLogged);

        $tickets->saveXML("tickets.xml");

    }

}

function getUserRole($userId)
{
    $users = simplexml_load_file("users.xml");
    $user = $users->xpath("/users/user[@id=$userId]")[0];
    echo $user;
    return $user->attributes()->role; // return the role of the userId

}

function getUserName($userId)
{
    $users = simplexml_load_file("users.xml");
    $user = $users->xpath("/users/user[@id=$userId]/username")[0];
    return $user;
}

function getMessage($userId,$ticketId)
{
    $tickets = simplexml_load_file("tickets.xml");
    $ticketUserId = $tickets->xpath("/tickets/ticket[@id=$ticketId]/messages/message[@userId=$userId]")[0];

    return $ticketUserId;
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
                <dd class="col-sm-9"><?php echo $ticket->attributes(); ?></dd>

                <dt class="col-sm-3">Issue Date:</dt>
                <dd class="col-sm-9"><?php echo  $ticket->issueDate; ?></dd>

                <dt class="col-sm-3">Status:</dt>
                <dd class="col-sm-9"><?php echo  $ticket->status; ?></dd>

                <dt class="col-sm-3 text-truncate">Issue Category:</dt>
                <dd class="col-sm-9"><?php echo  $ticket->issueCategory; ?></dd>

                <dt class="col-sm-3">Messages</dt>
                <dd class="col-sm-9">
                    <dl class="row">
                        <?php foreach ($messages->message as $ticketElement) :?>
                            <?php if(getUserRole($ticketElement->attributes()) == 'client') { ?>
                                <dt class="col-sm-4"><?php echo getUserName($ticketElement->attributes()); ?></dt>
                                <dd class="col-sm-8"><?php echo $ticketElement; ?></dd>
                            <?php }  ?>
                            <?php if(getUserRole($ticketElement->attributes()) == 'staff') { ?>
                                <dt class="col-sm-4"><?php echo getUserName($ticketElement->attributes()); ?>(Support Staff)</dt>
                                <dd class="col-sm-8"><?php echo $ticketElement; ?></dd>
                            <?php } ?>
                        <?php endforeach;?>
                    </dl>
                </dd>
            </dl>
        </div>
        <form method="post">
            <div class="col-md-6 mb-3">
                <label for="message">Your message</label>
                <textarea class="form-control" rows="5" name="message" placeholder="Here you can enter additional messages for the support staff to address..."></textarea>
            </div>

            <input class="btn btn-primary" type="submit" name="addMessage" value="Add Message" role="button"/>
        </form>


    </div> <!-- end of container -->

    </body>
    </html>
