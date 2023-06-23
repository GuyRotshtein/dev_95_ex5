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
    <title>Title</title>
</head>
<body>
    <div class="container justify-content-center pt-5">
        <div class="row justify-content-center">
            <div class="col-2 text-end"><h4>Select a category: </h4></div>
            <div class="col-2 text-start"><select id="catSelect" class="form-select text-center"></select></div>
        </div>
        <div class="row justify-content-center text-center">
            <?php
            include 'db.php';
            include "config.php";

            $query = "SELECT * FROM tbl_95_books";
            $result = mysqli_query($connection, $query);
            if(!$result) {
                die("DB query failed.");
            }

            echo "<ul class='list-group list-group-flush py-3'>";
            while($row = mysqli_fetch_assoc($result)) {
                //output data from each row
                echo "<li class='" .$row["category"]. " list-group-item'><a href='./book.php?book_id=".$row["book_id"]."' class='link-body-emphasis'>";
                echo "<h3>" . $row["name"] . "</h3>";
                echo "<img src='./images/frontCover/" . $row["front_image"] ."' class='bookImage object-fit-contain'/></a></li>";
            }
            echo "</ul>";

            mysqli_free_result($result);
            ?>
        </div>
    </div>
</body>
</html>
<?php
mysqli_close($connection);
?>