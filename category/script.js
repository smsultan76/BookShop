// Toggle sidebar in mobile view
function toggleSidebar() {
    var sidebar = document.getElementById("sidebar");
    if (sidebar.style.transform === "translateX(-100%)" || sidebar.style.transform === "") {
        sidebar.style.transform = "translateX(0)";
    } else if(sidebar.style.transform === "translateX(0px)") {
        sidebar.style.transform = "translateX(-100%)";
    }
}

// Toggle header menu in mobile view
function toggleHeaderMenu() {
    var headerMenu = document.querySelector(".header-menu");
    headerMenu.classList.toggle("active");
}



function login(val){
    let url="";
    if(val== 1){
    url="../user/login.php";
    }
    else if(val==2){
        url="../user/profile.php";
    }
    window.location.href = url;
}