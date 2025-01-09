function login(val){
    let url="";
    if(val== 1){
    url="login.php";
    }
    else if(val==2){
        url="profile.php";
    }
    window.location.href = url;
}
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


function addbook(data){
    if(data==1){
    window.location.href='addbook.php';
    }else if(data=2) window.location.href='sales.php';
}


function editimg(Id1){
    window.location.href="editimg.php?Id="+Id1;
}
function editdata(Id2){
    window.location.href="editdata.php?Id="+Id2;
}
function cencel(){
    window.location.href="seller.php";
}

function logout(){
    window.location.href= "seller.php?logout=23332972"
}


// delete book 

function deletebook(product_id, seller_id){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "seller.php", true);
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

    xhr.send("product_id="+encodeURIComponent(product_id)+"seller_id="+encodeURIComponent(seller_id));

    xhr.onreadystatechange= function(){
        if(xhr.readyState===4){
            if(xhr.status===200){
                alert("Response from server: "+xhr.responseText);
                document.getElementById("item_"+product_id).remove();

            }else{alert("Error Delete: ")}
        }
    };
}