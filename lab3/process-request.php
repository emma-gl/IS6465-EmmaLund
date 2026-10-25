<?php

#echo "Hello from the server";


if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Method not allowed");
}

$course = trim($_POST["course"] ?? "");
$topic = trim($_POST["topic"] ?? "");
$preferredTime = $_POST["preferredtime"] ?? "";
$preferredDate = $_POST["date"] ?? "";


$errors = [];
$allowedCourses = ["IS 6465", "IS 6495", "IS 6570"];
$allowedTimes = ["Morning", "Afternoon", "Evening"];

if (!in_array($course, $allowedCourses, true)) {
    $errors["course"] = "Select a valid course.";
}

if (!in_array($preferredTime, $allowedTimes, true)) {
    $errors["preferred_time"] = "Select a valid preferred time.";
}




if ($topic === "" || mb_strlen($topic) > 120) {
    $errors["topic"] = "Enter a topic of 1 to 120 characters.";
}

$date = DateTime::createFromFormat("Y-m-d", $preferredDate);
$validDate = $date && $date->format("Y-m-d") === $preferredDate;

if (!$validDate) {
    $errors["preferred_date"] = "Enter a valid preferred date.";
} elseif ($preferredDate < date("Y-m-d")) {
    $errors["preferred_date"] = "Preferred date cannot be in the past.";
}


if (!$errors) {
    echo "<h1>Request received</h1>";
    echo "<p>Course: " . htmlspecialchars($course, ENT_QUOTES, "UTF-8") . "</p>";
    echo "<p>Topic: " . htmlspecialchars($topic, ENT_QUOTES, "UTF-8") . "</p>";
    echo "<p>Preferred Date: " . htmlspecialchars($preferredDate, ENT_QUOTES, "UTF-8") . "</p>";
    echo "<p>Preferred Time: " . htmlspecialchars($preferredTime, ENT_QUOTES, "UTF-8") . "</p>";
    echo "<p>Status: Pending review</p>";
}

print_r($errors);



?>