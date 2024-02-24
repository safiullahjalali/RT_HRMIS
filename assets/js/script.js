// add hovered class to selected list item

let list = document.querySelectorAll(".navigation li");

function activeLink(){
    list.forEach((item) =>{
        item.classList.remove("hovered");
    });
    this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover",activeLink));

// Menu toggle
$(document).ready(function(){
    
    //var toggle = document.querySelector(".toggle ion-icon");
    var nav = document.querySelector(".navigation");
    var main = document.querySelector(".main");

    $(".toggle").click(function(){
        nav.classList.toggle("active");
        main.classList.toggle("active");
    });
});