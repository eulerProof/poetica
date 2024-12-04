<?php

    $id = $_GET['uid'];
    $connection = new mysqli('localhost', 'root', '', 'poems');
    if ($connection->connect_error) {
        die('Connection Failed! : '.$connection->connect_error);
    }

    $delete = mysqli_query($connection, "DELETE FROM poem WHERE poem_ID = '$id'");
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content ="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="poetica_logo3.png">
    <link rel = "stylesheet" type="text/css" href="style.css">
    <title>Deleted Successfully</title>
</head>

<body class="write-page">
    <div class="tab-bar">
        <nav class="left" id="tab">
            <ul>
                <li><a href="Home.html" class="logo"><img class="logo" src="poetica_logo.png"></a></li>
            </ul>    
        </nav>
        <div class="blank"></div>
        <nav id="tab" class="center">
            <ul>
                <li><a href="Home.html">Home</a></li>
                <li><a href="Browse.php">Browse</a></li>
                <li><a href="Write.html" id="selected">Write</a></li>
                <li><div class="search-bar-full"><input type="text" class="search-bar" placeholder="Search" id="search-bar"><button class="search-button" onclick="sendSearch()"><img src="search.png" class="search"></button></div></li>

            </ul>
        </nav>
    </div>

    <div class="added-container">
        <div class="added-icon">
          <img src = "trash.png" class="poem-icon">
          
        </div>
        <div class="added-text">
        <p>Deleted Successfully</p>
        </div>
        <div class="added-subtext">
            <a href="Home.html" class="return-text"><button class="return-btn">Return Home</button></a>
        </div>

        
    </div>
    <script src="Functions.js"></script>
    <footer>
        <div class="footer">
            <div class="first-column">
                <img src="poetica_logo2.png" class="logo">
                <p class="footer-logo-text">Poetry Library</p>
            </div>
        </div>
    </footer>
</body>


</html>
