<?php

// Lab 2: PHP Expressions and Control Structures

echo '<h1>Lab 2A: Expressions and Control Structures</h1>';

// 1. Expressions and Operators
echo '<h2>1. Expressions and Operators</h2>';

$x = -5;

// TODO: Write an expression that calculates:
$y = 3 * (abs(2 * $x) + 4); 

echo "The value of y is: $y<br>";

// 2. Boolean Comparisons
echo '<h2>2. Comparisons</h2>';

// TODO: Use var_dump() to compare:
var_dump(2 > 1);
var_dump(2 == 3);
var_dump("5" == 5);
var_dump("5" === 5);

// 3. Unary Operators
echo '<h2>3. Unary Operators</h2>';

$c = 5;

// TODO: Create variables that demonstrate unary minus, unary plus,
// and pre-increment. Display the results.
$d = -$c; // Unary minus
$e = +$c; // Unary plus
$f = ++$c; // Pre-increment

echo "Unary minus: $d<br>";
echo "Unary plus: $e<br>";  
echo "Pre-increment: $f<br>";

// 4. Operator Precedence
echo '<h2>4. Operator Precedence</h2>';

// TODO: Compare the results of these two expressions:
$a = 2 + 3 * 4;
$b = (2 + 3) * 4;

echo "Result of 2 + 3 * 4: $a<br>";
echo "Result of (2 + 3) * 4: $b<br>";

// 5. Assignment Associativity
echo '<h2>5. Assignment Associativity</h2>';

// TODO: Assign 0 to $level, $score, and $time in one statement.
// Display each variable.
$level = $score = $time = 0;
echo "Level: $level, Score: $score, Time: $time<br>";

// 6. Equality and Assignment
echo '<h2>6. Equality and Assignment</h2>';

// TODO: Create variables with equal and unequal values.
// Use var_dump() to compare them with == and ===.
$a = 5;
$b = 5;
var_dump($a == $b); // true
var_dump($a === $b); // true
$c = 10;
$d = 20;
var_dump($c == $d); // false
var_dump($c === $d); // false

// 7. Logical Operators
echo '<h2>7. Logical Operators</h2>';

$a = 1;
$b = 0;

// TODO: Use var_dump() to demonstrate &&, ||, and !.
$c = 1;
var_dump($a && $b); // false
var_dump($a || $b); // true
var_dump(!$a); // false
var_dump(!$b); // true

// 8. Scholarship Decision with if...else
echo '<h2>8. Scholarship Decision with if...else</h2>';

$gpa = 3.59;
if ($gpa >= 3.7) {
    echo "Student gets scholarship!<br>";
} else {
    echo "Student does not get scholarship.<br>";
}

// TODO: Use if...else to display whether the student receives a scholarship.

// 9. Scholarship Decision with if...elseif...else
echo '<h2>9. Scholarship Decision with if...elseif...else</h2>';

// TODO: Use if...elseif...else to display:
// Full scholarship for GPA 3.7 or higher
// Partial scholarship for GPA 3.5 through 3.69
// No scholarship otherwise
$gpa = 3.59;
if ($gpa >= 3.7) {
    echo "Student gets full scholarship!<br>";
} elseif ($gpa >= 3.5) {
    echo "Student gets partial scholarship!<br>";
} else {
    echo "Student does not get scholarship.<br>";
}

// 10. Access Status
echo '<h2>10. Access Status</h2>';

$status = 'pending';

// TODO: Use a switch statement to display a message for:
// approved, pending, and all other statuses

switch ($status) {
    case 'approved':
        echo "Access granted<br>";
        break;
    case 'pending':
        echo "Review in progress<br>";
        break;
    default:
        echo "Access denied<br>";
        break;
}

// 11. While Loop
echo '<h2>11. While Loop</h2>';

$fuel = 10;

// TODO: Create a while loop.
// Display "There is enough fuel" while fuel is greater than 1.
// Decrease fuel during each repetition.

while ($fuel > 1) {
    echo "There is enough fuel<br>";
    $fuel--;
}

// 12. Multiplication Table
echo '<h2>12. Multiplication Table</h2>';

// TODO: Create a for loop that displays the 12-times table
// from 1 through 12.

for ($i = 1; $i <= 12; $i++) {
    $result = 12 * $i;
    echo "12 x $i = $result<br>";
}