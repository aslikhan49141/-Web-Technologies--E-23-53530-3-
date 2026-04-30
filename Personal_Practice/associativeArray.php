<?php

// Example of an associative array in PHP
$student = [
    'name' => 'Alif Shahriar Likhan',
    'age' => 23,
    'major' => 'Computer Science',
    'university' => 'AIUB'
];

// Accessing values
echo "Name: " . $student['name'] . "</br>";
echo "Age: " . $student['age'] . "</br>";
echo "Major: " . $student['major'] . "</br>";
echo "University: " . $student['university'] . "</br>";

// Using foreach loop to print everything
echo "</br> <h3>Using foreach loop:</h3>";
foreach ($student as $key => $value) {
    echo $key . ": " . $value . "</br>";
}

echo '</br>';
$info=[
    'name' => 'Lamiya Akter Sneha ',
    'age' => 19,
    'sex' => 'Female',
    'married' => 'Yes',
    'Husband' => 'Alif Shahriar Likhan',
    'children' => 'None',
];

foreach($info as $index => $value){
    echo $index . '=' . $value . '</br>'; 
}


?>