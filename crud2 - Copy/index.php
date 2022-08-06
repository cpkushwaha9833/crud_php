<?php
//INSERT INTO `inotes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'Buy Books', 'Please Buy Books From Stores.', current_timestamp());
$result = false;
//connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

//creat a connection
$conn = mysqli_connect($servername, $username, $password, $database);



//die if connectoin was not successfully
if(!$conn){
  die("sorry we failed to connect" . mysqli_connect_error());
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
$title = $_POST['title'];
$description = $_POST['description'];

//sql query to be executed
$sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
$result = mysqli_query($conn, $sql);

// add a new trip to thr Trip table in the database

if($result){
    echo "the record has been recorded successfully";
    $insert = true;
}
else{
    echo "the record was not inserted successfully beacuse of this error ----> ". mysqli_error($conn);
}
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>iNotes - Notes taking made easy</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">iNotes</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
              </li>
              </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

<?php
 if($insert){
   echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
   <strong>success!</strong> Your note has been inserted succefully.
   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
 </div>";
 }
?>

      <div class="container my-4">
          <h2>Add a Note</h2>
        <form action = "/crud2/index.php" method = "POST">
            <div class="mb-3">
              <label for="title" class="form-label">Note Title</label>
              <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            </div>
           
            <div class="mb-3">
                <label for="description" class="form-label">Note Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
          </form>
      </div>

<div class="container">         
<table class="table">
  <thead>
    <tr>
      <th scope="col">Sno.</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
           $sql = "SELECT * FROM `notes`";
           $result = mysqli_query($conn, $sql);
           while($row = mysqli_fetch_assoc($result)){
            echo "<tr>
            <th scope='row'>". $row['sno'] . "</th>
            <td>". $row['title'] . "</td>
            <td>". $row['description'] . "</td>
            <td> Actions </td>
          </tr>";
            echo $row['sno'] . ".Title ". $row['title'] ." Desc is ". $row['description'];
            echo "<br>";
          }
         ?>
    
    
  </tbody>
</table>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!---
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    --->
  </body>
</html>