
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add.php">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="update.php">Update</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="delete.php">Delete</a>
            </li>
          </ul>
          <?php include 'read.php'; ?>
          <form action="read.php" method="get"> <!-- Adjust the action attribute here -->
<input type="text" name="student_id">
    <input type="submit" value="Submit">
</form>
   
    
    
</form>

        </div>
      </nav>