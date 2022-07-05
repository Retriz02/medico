/* EMERGENTE 1 */
//recibe los elementos de ventanas emergentes por su id
const open = document.getElementById('open');
const modal_container = document.getElementById('modal_container');
const close = document.getElementById('close');

//en caso de hacer click muestra la pantalla emergente
open.addEventListener('click', () => {
  modal_container.classList.add('show');
});

//en caso de hacer click oculta la pantalla emergente
close.addEventListener('click', () => {
  modal_container.classList.remove('show');
});

/* EMERGENTE 2 */
//recibe los elementos de ventanas emergentes por su id
const open1 = document.getElementById('open1');
const modal_container1 = document.getElementById('modal_container1');
const close1 = document.getElementById('close1');

//en caso de hacer click oculta la pantalla emergente
open1.addEventListener('click', () => {
  modal_container1.classList.add('show');  
});

//en caso de hacer click oculta la pantalla emergente
close1.addEventListener('click', () => {
  modal_container1.classList.remove('show');
});
