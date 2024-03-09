<?php

$connect = new PDO('mysql:host=localhost; dbname=crud_php', 'root', '');

// Check if the form is submitted
if(isset($_POST['update_id'])) {
    $update_id = $_POST['update_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    // Prepare and execute the update query
    $request = $connect->prepare('UPDATE students SET first_name = :first_name, last_name = :last_name, email = :email WHERE student_id = :id');
    $request->bindValue(':first_name', $first_name );
    $request->bindValue(':last_name', $last_name );
    $request->bindValue(':email', $email );
    $request->bindValue(':id', $update_id );
    $success = $request->execute();

    // Display a message based on the result
    if($success) {

        echo "<script>alert('Student with ID $update_id has been updated.'); window.location.href = 'index.php';</script>";

    } else {
        echo "<script>alert('Failed to update student with ID $update_id.');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
</head>
<body>

<h1>Update Student</h1>

<form action="update.php" method="get">
    <label for="id">Enter Student ID:</label>
    <input type="text" name="id">
    <input type="submit" value="Submit">
</form>

<?php
// Fetching data from the database
if(isset($_GET['id'])) {
    $student_id = $_GET['id'];

    $request = $connect->prepare('SELECT * FROM students WHERE student_id = :id');
    $request->bindValue(':id', $student_id);
    $request->execute();
    $student = $request->fetch(PDO::FETCH_ASSOC);

    if($student) {
        ?>

        
        <form action="update.php" method="post">
        <input type="hidden" name="update_id" value="<?php echo $student['student_id']; ?>">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" value="<?php echo $student['first_name']; ?>">
            <br>
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" value="<?php echo $student['last_name']; ?>">
            <br>
            <label for="age">Email</label>
            <input type="text" name="email" value="<?php echo $student['email']; ?>">
            <br>
            <input type="submit" value="Update">
        </form>
        <?php
    } else {
        echo "Student not found.";
    }
}
?>

<a href="index.php">Return</a>

</body>
</html>
