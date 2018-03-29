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
$tickets->preserveWhiteSpace = false;
$tickets->formatOutput = true;

$userIdLogged = $_SESSION['loggedInUserId']; // to add it to XML data directly and use it in the next page



if(isset($_POST['add']))
{

//     $display = var_dump($_POST['add']);
//     echo $display;
    // storing form input
    $ticketId = $_POST['ticketId'];
    $ticketDate = $_POST['dated'];
    $ticketStatus = $_POST['ticketStatus'];
    $ticketCategory = $_POST['category'];
    $ticketClientId = $_POST['clientId'];
    $ticketMessage = $_POST['message'];

    //load xml file

    $tickets = simplexml_load_file("tickets.xml");


    // input data into xml file
    $ticket = $tickets->addChild('ticket');
//    echo $ticket;
    $ticket->addAttribute('id',$ticketId);
    $ticket->addChild('issueDate', $ticketDate);
    $ticket->addChild('status', $ticketStatus);
    $ticket->addChild('issueCategory', $ticketCategory);
    $ticket->addChild('clientId', $userIdLogged);
    $messages = $ticket->addChild('messages');
    $message = $messages->addChild('message',$ticketMessage);
    $message->addAttribute('userId',$userIdLogged);

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
<!--        <script type="text/javascript">-->
<!--            $(function () {-->
<!--                $('#datetimepicker1').datetimepicker();-->
<!--            });-->
<!--        </script>-->
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
<!--                <div class='input-group date' id='datetimepicker1'>        datepicker -->
<!--                    <input type='text' class="form-control" />-->
<!--                    <span class="input-group-addon">-->
<!--                        <span class="glyphicon glyphicon-calendar"></span>-->
<!--                    </span>-->
<!--                </div>-->
                <input type="date" class="form-control" name="dated" placeholder="YYYY-MM-DD" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="ticketStatus">Ticket Status</label>
                <select class="custom-select" name="ticketStatus">
                    <option selected>-Choose Status of Ticket--</option>
                    <option value="New">New</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Resolved">Resolved</option>
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
    </form>
</div>

</body>
</html>
