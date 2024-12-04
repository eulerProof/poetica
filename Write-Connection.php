<?php
    $author = $_POST['author'];
    $title = $_POST['title'];
    $poem = $_POST['poem'];


    $connection = new mysqli('localhost', 'root', '', 'poems');

    if ($connection->connect_error) {
		die("Invalid query: " . $connection->error);
	} else {
        $statement = $connection->prepare("insert into poem(poem_author, poem_title, poem_contents) value(?, ?, ?)");
			$statement->bind_param("sss", $author, $title, $poem);
			$statement->execute();
			$statement->close();
			$connection->close();
    }
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content ="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="poetica_logo3.png">
    <link rel = "stylesheet" type="text/css" href="style.css">
    <title>Added Successfully</title>
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
          <img src = "poem_icon.png" class="poem-icon">
          
        </div>
        <div class="added-text">
        <p>Poem Added!</p>
        </div>
        <div class="added-subtext">
        <p><strong>Title: </strong><?php echo $title?></p>
        </div>
        <div class="added-subtext">
        <p><strong>Author: </strong> <?php echo $author?></p>
        </div>
        <div class="added-subtext">
            <a href="Browse.php" class="return-text"><button class="return-btn">Return</button></a>
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




