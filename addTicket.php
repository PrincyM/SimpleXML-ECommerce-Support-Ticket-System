<?php
/**
 * Created by PhpStorm.
 * User: princymascarenhas
 * Date: 2018-03-27
 * Time: 10:41 PM
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$tickets = simplexml_load_file("tickets.xml");

$userIdLogged = $_SESSION['loggedInUserId']; // to add it to XML data directly and use it in the next page


if(isset($_POST['add']))
{

    // storing form input
    $ticketId = $_POST['ticketId'];
    $ticketDate = $_POST['dated'];
    $ticketStatus = $_POST['ticketStatus'];
    $ticketCategory = $_POST['category'];
    $ticketClientId = $_POST['clientId'];
    $ticketMessage = $_POST['message'];
    $ticketDate = date("Y-m-d");
    $ticketTime = date("h:i:sa");

    //load xml file

    $tickets = simplexml_load_file("tickets.xml");


    // input data into xml file
    $ticket = $tickets->addChild('ticket');
    $ticket->addAttribute('id',$ticketId);
    $ticket->addChild('issueDate', $ticketDate);
    $ticket->addChild('status', $ticketStatus);
    $ticket->addChild('issueCategory', $ticketCategory);
    $ticket->addChild('clientId', $userIdLogged);
    $messages = $ticket->addChild('messages');
    $message = $messages->addChild('message',$ticketMessage);
    $message->addAttribute('userId',$userIdLogged);
    $message->addAttribute('dated',$ticketDate);
    $message->addAttribute('time', $ticketTime);

    $tickets->saveXML("tickets.xml");

    header("Location: clientIndex.php");
}

?>
<html>
<head>
    <title>Welcome to our Support Ticket System</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
</head>

<body>
<h3 class="text-center">Add a new ticket by filling requested information below</h3>

<div class="container">
    <form method="post">
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="ticketId">Ticket #</label>
                <input type="text" class="form-control" name="ticketId" placeholder="Add new ticket number" required>
            </div>
            <div class="col-md-4 mb-3">

                <label for="dated">Issue Date</label>
                <input type="date" class="form-control" name="dated" placeholder="YYYY-MM-DD" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="disabledSelect">Ticket Status</label>
                <select id="disabledSelect" class="form-control" name="ticketStatus">
                    <option>New</option>    <!-- this is done as the ticket created would always be new status by the client -->
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="category">Ticket Category</label>
                <select class="custom-select" name="category">
                    <option selected>-Choose the category of your issue--</option>
                    <option value="Order Question">Order Question</option>
                    <option value="Shipping">Shipping</option>
                    <option value="Product Availability">Product Availability</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="message">Your message</label>
                <textarea class="form-control" rows="5" name="message" placeholder="Here you can enter your query..."></textarea>
            </div>
        </div>
        <input class="btn btn-primary" type="submit" name="add" value="Add Ticket" role="button"/>
        <a class="btn btn-outline-success" href="clientIndex.php" role="button">Home</a>
    </form>
</div>

</body>
</html>
