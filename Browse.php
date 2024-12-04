<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content ="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="poetica_logo3.png">
    <link rel = "stylesheet" type="text/css" href="style.css">
    <title>Browse</title>
</head>

<body>
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
                <li><a href="" id="selected">Browse</a></li>
                <li><a href="Write.html">Write</a></li>
                <li><div class="search-bar-full"><input type="text" class="search-bar" placeholder="Search" id="search-bar"><button class="search-button" onclick="sendSearch()"><img src="search.png" class="search"></button></div></li>
            </ul>
            
        </nav>
    </div>



    <div class="browse-titles">
        <div><p class="browse-title">Browse Library</p></div>
        <div class="sort"><p class="sort-label">Sort By</p> </div>
        <select class="sort-select" id="sort-select" onchange="changeValue()">
            <option value="alphabetical" id="alp" selected>A - Z</option>
            <option value="author" id="auth">Author</option>
            <option value="linecount" id="length">Length</option>
            <option value="userpoems" id="yourpoems">Your Poems</option>
        </select>
        <!-- <input type="text" class="search-bar" placeholder="Search"> -->
    </div>

    <div class="browse-library">
        <div class="no" id="test"></div>
    </div>
    <script src="Functions.js">

    </script>
    <script>
        
        var selectValue = String(document.getElementById("sort-select").value);
        var op1 = document.getElementById("alp").value;
       
        var op2 = document.getElementById("auth").value;

        var op3 = document.getElementById("length").value;

        var op4 = document.getElementById("yourpoems").value;

        console.log(selectValue);
        console.log(op2);
        
        function changeValue() {
            selectValue = document.getElementById("sort-select").value;
            if (selectValue == op1) {
                document.getElementById("test").innerHTML = "";

                fetch('https://poetrydb.org/title')
                .then(response => response.json())
                .then(res => {
                console.log(res);
            
                for (let i = 0; i < res.titles.length; i++){
                    var author = "";
                    var x = JSON.stringify(res.titles[i]);
                    if (x.includes("\'")) {
                        continue;
                    } else {
                        const markup = `
                            <div class = "featured-box" onclick = 'sendValue(${x})'>
                                <div class="poem-box-title">
                                    <p>${res.titles[i]}</p>
                                </div>
                            </div>             
                        `;
             
                    document.querySelector(".no").insertAdjacentHTML("beforeend", markup);
                    }     
                }})
                .catch(error => 
                    document.querySelector(".no").insertAdjacentHTML("beforeend", '<div class="error-container"><img src="no-wifi.png" class="no-wifi"><p class="error-text">Connection Error</p></div>')
                );
            }
            else if (selectValue == op2) {
                document.getElementById("test").innerHTML = "";
                fetch('https://poetrydb.org/authors')
                .then(response => response.json())
                .then(res => {
                console.log(res);
                      
                for (let i = 0; i < res.authors.length; i++){
                    var auth = res.authors[i];   
                        fetch(`https://poetrydb.org/author/${auth}/author,title`)
                        .then(res => res.json())
                        .then(re => {
                            re.forEach(e => {
                                var x = JSON.stringify(e.title);
                                if(x.includes("\'")) {
                                    
                                } else {
                                    const te = `  
                                <div class = "featured-box" onclick = 'sendValue(${x})'>
                                    <div class="poem-box-title">
                                        <p>${e.title}</p>
                                        <p>Author: ${e.author}</p>
                                    </div>
                                
                                </div>  `   
                                document.querySelector(".no").insertAdjacentHTML("beforeend", te);
                                }
                                
                            });
                        })
                        
                     
                }})
                .catch (error  =>
                    document.querySelector(".no").insertAdjacentHTML("beforeend", '<div><img src="no-wifi.png" class="no-wifi"><p class="error-text">Connection Error</p></div>')
                )
                
            } else if (selectValue == op3) {
                document.getElementById("test").innerHTML = "";
                for(i = 1; i < 900; i++) {
                    fetch(`https://poetrydb.org/linecount/${i}/title,linecount`)
                    .then(response => response.json())
                    .then(res => { 
                        
                        if (res.hasOwnProperty("status: 400")) {
                            
                        } else {
                            res.forEach(e => {
                                var x = JSON.stringify(e.title);
                                    if(x.includes("\'")) {
                                        
                                    } else {
                                        const te = `  
                                        <div class = "featured-box" onclick = 'sendValue(${x})'>
                                            <div class="poem-box-title">
                                                <p>${e.title}</p>
                                                <p>Lines: ${e.linecount}</p>
                                            </div>
                                        
                                        </div>  `   
                                    document.querySelector(".no").insertAdjacentHTML("beforeend", te);
                                    }
                            })   
                        }
                                
                    })
                    .catch (error  =>
                        console.log(error)
                    )
                }
                
            }

            else if (selectValue == op4) {
                document.getElementById("test").innerHTML = "";
                <?php
                    $connection = new mysqli('localhost', 'root', '', 'poems');
                    if ($connection->connect_error) {
                       die('Connection Failed! : '.$connection->connect_error);
                   }
                   
                   $sql = "SELECT * FROM poem";
                   $result = $connection->query($sql);

                   while($row = $result->fetch_assoc()) {
                        ?>
                            console.log(<?php $row["poem_title"]; ?>)
                            var a = "";
                            var x = Math.floor(parseInt(<?php echo $row["poem_ID"]?>));
                            a = `  
                                <div class = "featured-box"  onclick = sendValue(${x})> 
                                    <div class="poem-box-title" >
                                        <p><?php echo $row["poem_title"]?></p>
                                        <p>Author: <?php echo $row["poem_author"]?></p>
                                        
                                    </div>
                                        
                            </div>  `   
                            document.querySelector(".no").insertAdjacentHTML("beforeend", a);
                        <?php
                   }

                ?>
            }
        }
        changeValue();          
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