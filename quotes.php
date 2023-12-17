<?php
// quotes.php

// Define an array of quotes
$quotes = [
    "Quote 1",
    "Quote 2",
    "Quote 3",
    "Quote 4",
    "Quote 5",
    // Add more quotes as needed
];

// Check if a session is not started
// session_status() === PHP_SESSION_NONE checks if a session is not already started
if(session_status() === PHP_SESSION_NONE){
    session_start(); // If not, start a session
}

// Check if all quotes have been shown
// !isset($_SESSION['quotes']) checks if the 'quotes' key is not set in the session
if(!isset($_SESSION['quotes'])){
    $_SESSION['quotes'] = $quotes; // If not, set it to the initial quotes array
}

// If all quotes have been shown, return a message and reset the session
// empty($_SESSION['quotes']) checks if the 'quotes' key in the session is empty
if(empty($_SESSION['quotes'])){
    $_SESSION['quotes'] = $quotes; // If it is, reset it to the initial quotes array
    header('Content-Type: application/json'); // Set the response header to indicate that the response is a JSON object
    echo json_encode(['quote' => 'Quote has run out']); // Send a JSON object with a 'quote' key and a value of 'Quote has run out'
    exit; // Stop the script execution
}

// Get a random quote
$random_key = array_rand($_SESSION['quotes'], 1); // Get a random key from the 'quotes' array in the session
$random_quote = $_SESSION['quotes'][$random_key]; // Use the random key to get a random quote from the 'quotes' array in the session

// Remove the shown quote from the session
unset($_SESSION['quotes'][$random_key]); // Remove the quote that was just shown from the 'quotes' array in the session

// Return the quote in JSON format
header('Content-Type: application/json'); // Set the response header to indicate that the response is a JSON object
echo json_encode(['quote' => $random_quote]); // Send a JSON object with a 'quote' key and the value of the random quote
?>