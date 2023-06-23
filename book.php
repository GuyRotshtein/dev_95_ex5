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
    <script src="./js/insertHeader.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <title>Book Details</title>
</head>
<body>
    <div class="container justify-content-center text-center">
        <?php
        include 'db.php';
        include 'config.php';

        $id = $_GET['book_id'] ?: 0;
        $query = "SELECT * FROM tbl_95_books WHERE book_id = $id";
        $result = mysqli_query($connection, $query);
        if(!$result || $id === 0) {
            echo '<h2> ERROR: BOOK ID DOES NOT EXIST </h2>';
            echo '<h4>Please return to the book list and try again</h4>';
            die("DB query failed.");
        }

        while($row = mysqli_fetch_assoc($result)) {
            echo '<div class="row pb-5 text-center">';
            echo '<h1>'.$row["name"].'</h1></div>';
            echo '<div class="row pb-5 justify-content-center">
              <img src="./images/frontCover/'.$row["front_image"].'" class="bookImage object-fit-contain" title="Front cover of '.$row["name"].'" alt="Front cover of '.$row["name"].'">';
            echo '<img src="./images/backCover/'.$row["back_image"].'" class="bookImage object-fit-contain" title="Back cover of '.$row["name"].'" alt="Back cover of '.$row["name"].'"></div>';
            echo '<div class="row py-3 text-center"><h3>Description:</h3></div>';
            echo '<div class="row justify-content-center"><div class="col-8 text-center"><p>'.$row["description"].'</p></div></div>';
        }
        ?>
        <div id="goBack" class="row pt-5"><a href="./index.php">Go back</a></div>
    </div>
</body>
</html>
<?php
mysqli_close($connection);
?>