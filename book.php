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
    <script src="./js/injectHeader.js"></script>
    <script src="./js/script.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <title>Book Details</title>
</head>
<body>
    <div class="container min-vh-100 justify-content-center text-center bg-light bg-gradient pt-4">
        <?php
        include 'db.php';
        include 'config.php';

        $id = $_GET['book_id'] ?: 0;
        $query = "SELECT * FROM tbl_95_books WHERE book_id = $id";
        $result = mysqli_query($connection, $query);
        if(!$result || $id === 0) {
            header('Location: ./index.php');
            echo '<h2> ERROR: BOOK ID DOES NOT EXIST </h2>';
            echo '<h4>Please return to the book list and try again</h4>';
            die("DB query failed.");
        }

        while($row = mysqli_fetch_assoc($result)) {
            echo '<div class="row pb-5 text-center"><h1>'.$row["book_name"].'</h1><br>';
            echo '<h5 class="text-body-tertiary text center">Written by '.$row["author_name"].'</h5></div>';
            echo '<div class="row pb-5 justify-content-center" id="bookCovers">
              <img src="./uploads/frontCover/'.$row["front_image"].'" class="bookImage object-fit-scale pb-1" title="Front cover of '.$row["book_name"].'" alt="Front cover of '.$row["book_name"].'">';
            echo '<img src="./uploads/backCover/'.$row["back_image"].'" class="bookImage object-fit-scale pb-1" title="Back cover of '.$row["book_name"].'" alt="Back cover of '.$row["book_name"].'"></div>';
            echo '<div class="row pb-0 text center"><H4>Rating:</H4></div><div class="row d-flex justify-content-center">';

            for($i = 0; $i < $row['rating']; $i++){
                echo '<div class="ratingStar sGold"></div>';
            }
            for($j = 0; $j < (10-$row['rating']);$j++){
                echo '<div class="ratingStar sGrey"></div>';
            }
            echo '</div><div class="row pt-1 pb-3 text-body-secondary text-center"><span>'.$row["rating"].'&#47;10</span></div>';
            echo '<div class="row pt-3 pb-2 text-center"><h3>Description:</h3></div>';
            echo '<div class="row justify-content-center"><div class="col-8 text-center"><p>'.$row["description"].'</p></div></div>';
            echo '<br><div class="row d-flex justify-content-center align-items-baseline"><h5 class="w-auto">Price: </h5>'.$row["price"].'&#36;</div>';

            $categoryId = $row["category"];
            $path='./js/data/categories.json';
            $jsonString = file_get_contents($path);
            $jsonData = json_decode($jsonString, true);
            $results = array_filter($jsonData['categories'], function($categories) use ($categoryId){
                return $categories['id'] == $categoryId;
            });

            echo '<div class="row pt-3 text-center"><h6 class="text-body-secondary">Category: '.$results[$categoryId-1]["name"].'</h6></div>';
        }
        ?>
        <div id="goBack" class="row py-5"><a href="./index.php">Go back</a></div>
    </div>
    <footer class="d-flex flex-wrap py-2 bg-body-secondary border-top">
        <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
            </a>
            <span class="mb-3 mb-md-0 text-body-secondary">© Guy Rotshtein, Shenkar college</span>
        </div>
    </footer>
</body>
</html>
<?php
mysqli_close($connection);
?>