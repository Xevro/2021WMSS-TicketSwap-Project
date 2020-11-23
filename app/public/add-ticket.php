<?php
// General variables
$basePath = __DIR__ . '/../';
//require database config & functions
require_once $basePath . 'config/database.php';
require_once $basePath . 'src/functions.php';

// Data
require_once $basePath . 'vendor/autoload.php';
//bootstrap twig
$loader = new \Twig\Loader\FilesystemLoader($basePath . '/resources/templates');
$twig = new \Twig\Environment($loader);

$ticketName = isset($_POST['ticketName']) ? (string)$_POST['ticketName'] : '';
$ticketPrice = isset($_POST['ticketPrice']) ? (float)$_POST['ticketPrice'] : '';
$amount = isset($_POST['amount']) ? (int)$_POST['amount'] : '';
$reasonForSell = isset($_POST['reasonForSell']) ? (string)$_POST['reasonForSell'] : '';


$errorName = '';
$errorPrice = '';
$errorAmount = '';
$errorReason = '';

$connection = getDBConnection();

if (isset($_POST['btnRegister'])) {
    $allOk = true;


    if ($ticketName === '') {
        $errorName = 'A valid ticket name is required!';
        $allOk = false;
    }
    if ($ticketPrice === '') {
        $errorPrice = 'A valid price is required!';
        $allOk = false;
    }
    if ($amount === '') {
        $errorAmount = 'A valid amount is required!';
        $allOk = false;
    }
    if ($reasonForSell === '') {
        $errorReason = 'A valid reason is required!';
        $allOk = false;
    }

    if ($allOk) {
        //add to database
        $stmt = $connection->prepare('INSERT INTO Tickets(ticketName, ticketPrice, amount, reasonForSell) VALUES (?,?,?,?)');
        $stmt->execute([$ticketName, $ticketPrice, $amount, $reasonForSell]);
        header('Location: index.php');
        exit();
    }
}

// View
echo $twig->render('pages/add-ticket.twig', ['ticketName' => $ticketName, 'ticketPrice' => $ticketPrice, 'amount' => $amount,
    'reasonForSell' => $reasonForSell, 'errorName' => $errorName, 'errorPrice' => $errorPrice, 'errorAmount' => $errorAmount,
    'errorReason' => $errorReason,
    'action' => $_SERVER['PHP_SELF']]);