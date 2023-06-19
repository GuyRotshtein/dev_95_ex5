<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <title>Book Details</title>
</head>
<body>
<?php
include 'db.php';
include "config.php";

$id = $_GET['book_id'];
$query = "SELECT * FROM tbl_95_books WHERE book_id = $id";
$result = mysqli_query($connection, $query);
if(!$result) {
    die("DB query failed.");
}

echo "<ul>";
while($row = mysqli_fetch_assoc($result)) {
    //output data from each row
    echo "<li class=`" .$row["category"]. "`><a href='./book.php?book_id=".$row["book_id"]."'>";
    echo "<h3> Book Name: " . $row["name"] . "</h3>";
    echo "<img src='./images/frontCover/" . $row["frontImage"] ."' class='bookImage'/></a>";
    echo "<p> Cat. ID: ". $row["category"] . "</p></li>";
}
echo "</ul>";
mysqli_free_result($result);
?>
<div class="container justify-content-center">
    <div class="row pb-5 text-center">
        <h1>Book Name</h1>
    </div>
    <div class="row pb-5 justify-content-center">
        <img src="./images/frontCover/default.png" class="bookImage object-fit-contain">
        <img src="./images/backCover/default.png" class="bookImage object-fit-contain">
    </div>
</div>
<div>
    <a href="./index.php">Go back</a>
</div>
</body>
</html>
<?php
mysqli_close($connection);
?>