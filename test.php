
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content ="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="poetica_logo3.png">
    <link rel = "stylesheet" type="text/css" href="style.css">
    <title>Poem Page</title>
</head>

<body class="poempage">
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
                <li><a href="Write.html">Write</a></li>
                <li><div class="search-bar-full"><input type="text" class="search-bar" placeholder="Search" id="search-bar"><button class="search-button" onclick="sendSearch()"><img src="search.png" class="search"></button></div></li>
            </ul>
        </nav>
    </div>


    
    <div class="poem-display">
        <div class="poem-column-1">
            <div class="poem-title"><p id= "poem-title">Title</p></div>
            <p class="poem-author" id = "poem-author">By Author Name</p>
            <button class="delete-poem" onclick="deletePoem()">Delete Poem</button>
        </div>
        <div class="poem-column-2">
            <div class="poem">

            </div>
        </div>
    </div>
    <script src="Functions.js">
        
    </script>
    <script>
        var a = localStorage.getItem('value');
            <?php
                $connection = new mysqli('localhost', 'root', '', 'poems');
                if ($connection->connect_error) {
                    die('Connection Failed! : '.$connection->connect_error);
                }
                    $id = $_GET['uid'];
                    $sql = "SELECT * FROM poem WHERE poem_ID = $id"; 
                    $result = $connection->query($sql);

                    while($row = $result->fetch_assoc()) {
            ?>          document.getElementById("poem-title").innerHTML = "<?php echo $row["poem_title"]; ?>";
                        document.getElementById("poem-author").innerHTML = "By " + "<?php echo $row["poem_author"]; ?>";

                        const markup = `<?php echo nl2br($row["poem_contents"])?>`;
                        document.querySelector(".poem").insertAdjacentHTML("beforeend", markup);        
                    <?php        
                    }
                ?> 
            
        function deletePoem() {
            if(confirm("Are you sure you wish to delete this poem? This is irreversible.") == true) {
                //code sa delete
                window.location.href="Delete Success.php?uid=" + <?php echo $id ?>;
            } else {
                alert("Poem NOT Deleted");
            }
        }
    </script>
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