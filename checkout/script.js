var quan=1;
document.getElementById("quanty").value= quan;

var price = parseInt(document.getElementById("price").getAttribute("data-info"));
document.getElementById("unitPrice").value= price;
document.getElementById("tprice").value= price+100;
function quantity(i){
    var quan=document.getElementById("quan").value;
    if(i==1){
        if(quan<=1){

        }else{
            quan--;
        }
    }
    else if(i==2){

        if(quan>=10){

        }else{
            quan++;
        }
    }
    document.getElementById("quanty").value= quan;
    document.getElementById("quan").value= quan;
    
    document.getElementById("tprice").value= price*quan+100;
}

