<?php

$connect = new PDO('mysql:host=localhost; dbname=crud_php', 'root', '');

// Check if the delete button is clicked
if(isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Prepare and execute the delete query
    $request = $connect->prepare('DELETE FROM students WHERE student_id = :id');
    $request->bindValue(':id', $delete_id);
    $success = $request->execute();

    // Redirect to the same page after deletion
    header("Location: delete.php");
    exit;
}

// Fetching data from the database
$request = $connect->query('SELECT * FROM students');
$students = $request->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
    <script>
        function confirmDelete(student_id) {
            var result = confirm("Are you sure you want to delete this student?");
            if(result) {
                // Set the value of the hidden input field with the ID
                document.getElementById('delete_id').value = student_id;
                // Submit the form
                document.getElementById('delete_form').submit();
            }
        }
    </script>
</head>
<body>

<h1>Delete Student</h1>

<!-- Displaying data with delete buttons -->
<ul>
    <?php foreach($students as $student): ?>
    <li>
        <?php echo "ID: " . $student['student_id'] . ", Name: " . $student['first_name'] . " " . $student['last_name']; ?>
        <!-- Pass the student's ID to the confirmDelete function -->
        <button onclick="confirmDelete(<?php echo $student['student_id']; ?>)">Delete</button>
    </li>
    <?php endforeach; ?>
</ul>

<!-- Form to handle deletion -->
<form id="delete_form" method="post" style="display: none;">
    <input type="hidden" name="delete_id" id="delete_id">
</form>
<a href="index.php">Return</a>
</body>
</html>
