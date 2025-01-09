function logsign(val){
    let url="";
    if(val==1){
        url = "signup.php";
    }
    else if(val==2){
        url = "login.php";
    }
    window.location.href = url;
}

function logout(){
    window.location.href = 'profile.php?logout=true';
}

function profile(){
    window.location.href = 'profile.php';
}
function editpro(ep){
    if (ep==1) {
        document.getElementById("pedit").style.display="block";
        document.getElementById("pinfo").style.display="none";
    }
    
    if (ep==2) {
        document.getElementById("aedit").style.display="block";
        document.getElementById("ainfo").style.display="none";
    }   
}

function delit(user_id, product_id) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "cart.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Send the user_id and product_id to the server
    xhr.send("user_id=" + encodeURIComponent(user_id) + "&product_id=" + encodeURIComponent(product_id));
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) { // Request is complete
            if (xhr.status === 200) { // Successful response
                alert("Response from server: " + xhr.responseText); // Display the response from the server
                
                // Remove the item from the DOM
                document.getElementById("item_" + product_id).remove(); // Ensure this matches the ID used in PHP
            } else {
                alert("Error deleting item: " + xhr.status); // Error handling
            }
        }
    };
}


