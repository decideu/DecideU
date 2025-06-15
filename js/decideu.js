// Decide U
// JavaScript
// Guerrero Castro Blanca Teresita
// Cibrian Castro Ana Cristina
// Vega Escalante Romina
// Última actualización: 14/06/2025
//funcion para que al picar el boton de mas informacion se baje
function scrollSuave(event, id){
    event.preventDefault();
    document.getElementById(id).scrollIntoView({
        behavior: 'smooth'
    });
}
window.addEventListener('scroll', function(){
    //Detectamos el contenido
    var contenido = this.document.querySelector('.contenido2');
    //Posicion del contenido
    var posicion = contenido.getBoundingClientRect().top;
    //Altura de la ventana 
    var alturaPantalla = window.innerHeight;
    //Condicion, si este ya esta visible, le agregamos la clase que esta en css
    if(posicion < alturaPantalla - 100){
        contenido.classList.add('visible');
    }
})
//Apartado de Iniciar
document.querySelector('.registro-btn').addEventListener('click', () => {
  document.querySelector('.container').classList.add('active');
});

document.querySelector('.acceso-btn').addEventListener('click', () => {
  document.querySelector('.container').classList.remove('active');
});
//Funcion al menú oculto para que se muestre
function toggleMenu() {
    document.getElementById("menuLateral").classList.toggle("active");
}
//Funcion para cambiar las recomendaciones
function mostrarRecomendacion(index) {
    const todas = document.querySelectorAll('.recomendacion-contenido');
    todas.forEach(el => el.style.display = 'none');

    const activa = document.getElementById('rec-' + index);
    if (activa) activa.style.display = 'block';

    const botones = document.querySelectorAll('.rec-button');
    botones.forEach(btn => btn.classList.remove('activo'));
    if (botones[index]) botones[index].classList.add('activo');
}
// Función que desplaza al pasar la siguiente pregunta
window.addEventListener('DOMContentLoaded', function () {
    const cuestionario = document.getElementById('cuestionario');
    if (cuestionario) {
        cuestionario.scrollIntoView({ behavior: 'smooth' });
    }
});