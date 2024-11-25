// Este codigo javascript es utilizado para mostrar el menu en dispositivos moviles 
document.getElementById("btn-menu").addEventListener("click", mostrar_menu);

document.getElementById("backmenu").addEventListener("click", ocultar_menu);

nav = document.getElementById("menu");
background_menu = document.getElementById("backmenu");

function mostrar_menu(){

    nav.style.right = "0px";
    background_menu.style.display = "block";
}

function ocultar_menu(){

    nav.style.right = "-250px";
    background_menu.style.display = "none";
}
