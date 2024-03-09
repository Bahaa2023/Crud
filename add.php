<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to John Doe University</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php

include 'navbar.php';

$connection = new PDO('mysql:host=localhost; dbname=crud_php', 'root', '');

if(isset($_POST['submit'])){

   $first_name = $_POST['first_name'];
   $last_name = $_POST['last_name'];
   $email = $_POST['email'];

   if (!empty($first_name) && !empty($last_name) && !empty($email)) {
    $prepare = $connection->prepare('INSERT INTO students (first_name, last_name, email) VALUES (?, ?, ?)');
    $prepare->bindValue(1, $first_name);
    $prepare->bindValue(2, $last_name);
    $prepare->bindValue(3, $email);
    $results =$prepare->execute();

    if($results){
      echo "<script type=\"text/javascript\"> alert('Congratulations, you have just been registered, you will receive a confirmation by email shortly.'); window.location.href = 'index.php'; </script>";
    }else {
      echo "A problem occurred during registration.";
    }
}else {
  echo "please note that all fields are required";
}


}


 ?>

<h2 class="mt-5 text-center">Welcome to John Doe University</h2>
<p class="mt-5 text-center">Please fill the form below so you can register at our university</p>
<form class="mt-5 text-center" action="add.php" method="post">
  <label>First Name: </label>
  <input type="text" name="first_name">   
  <br><br> 
  <label>Last Name: </label>
  <input type="text" name="last_name">   
  <br><br>
  <label>Email: </label>
  <input type="email" name="email">   
  <br><br>
  <input class="btn btn-primary" type="submit" value="submit" name="submit">
</form>

<?php
include 'footer.php';
?>
</body>
</html>
