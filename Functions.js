function getFeatured() {
    fetch('https://poetrydb.org/random/2000/title,author')
        .then(response => response.json())
        .then(res => {
            console.log(res);
            res.forEach(name => {
                const markup = `
                <div class = "featured-box" onclick='sendValue(${title})'>
                    <p>${name.title}</p>
                    <p>${name.author}</p>
                </div>
                `;
             
                document.querySelector(".place").insertAdjacentHTML("beforeend", markup);
            })
        })
        .catch(error => console.error(error));

}
function sendSearch() {
    var a = document.getElementById("search-bar").value;
    console.log(a);
    localStorage.setItem('searchPrompt', a);
    window.location.href="Search Results.html";
}
function randomDice() {
    let x = parseInt(Math.random() * 6);
    console.log(x);
    var image = "";
    if(x == 0) {
        image = "dice_1.png"
    } else if(x == 1) {
        image = "dice_2.png"
    } else if(x == 2) {
        image = "dice_3.png"
    } else if(x == 3) {
        image = "dice_4.png"
    } else if(x == 4) {
        image = "dice_5.png"
    } else if(x == 5) {
        image = "dice_6.png"
    }

    document.getElementById("dice").src = image;
}
function sendValue(x) {
    try {
        var a = x;
        var b = JSON.stringify(a);
        console.log(a);
        console.log(b);
        localStorage.setItem('value', a);
        if(Number.isInteger(a)) {
            window.location.href="test.php?uid= " + a;
        } else {
            window.location.href="PoemPage.html";
        }
       
    } catch(err) {
        window.location.href="NotFound.html";
    }
}
