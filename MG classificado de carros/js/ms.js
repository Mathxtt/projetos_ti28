// INICIO MENU DO SITE
let menu = document.querySelector(".menuLinks");
let menuDois = document.querySelector("#menuBtn");

menuDois.onclick = () => {
    menu.classList.toggle('active');
}
//  FIM MENU DO SITE

// scroll
Window.onscroll = () =>{
    let topoSite = document.querySelector("header");

    topoSite.classList.toggle('sticky', window.scrollY > 100);
}

// INICIO CONTADOR DE VEICULOS 

let campoConta = document.querySelectorAll('.numero');

let intervalo = 1000;

campoConta.forEach((campoConta) => {

    let valorInicial = 0;

    let finalValor = parseInt(campoConta.getAttribute("mg-c-valor"));

    let duracao = Math.floor(intervalo/finalValor);

    let contador = setInterval(function (){
        valorInicial += 1;

        campoConta.textContent = valorInicial;

        if(valorInicial == finalValor){
            clearInterval(contador);
        }
    }, duracao)
})