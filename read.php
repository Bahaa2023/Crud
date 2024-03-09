<?php


$connection = new PDO('mysql:host=localhost; dbname=crud_php', 'root', '');

if(isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // Fetching data for the specific student
    $request = $connection->prepare('SELECT * FROM students WHERE student_id = :id');
    $request->bindValue(':id', $student_id);
    $request->execute();
    $student = $request->fetch(PDO::FETCH_ASSOC);

    // Check if student exists
    if($student) {
        echo "ID: " . $student['student_id'] . "<br>";
        echo "First Name: " . $student['first_name'] . "<br>";
        echo "Last Name: " . $student['last_name'] . "<br>";
        echo "Email: " . $student['email'] . "<br><br>";
    } else {
        echo "Student not found.";
    }
} else {
    echo "Please enter your student ID number:";
}

?>









