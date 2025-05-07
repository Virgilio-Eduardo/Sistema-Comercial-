

document.querySelectorAll('input[type="number"]').forEach(inputNumber => {
    inputNumber.oninput = () => {
        if(inputNumber.value.length > inputNumber.maxlength) inputNumber.value
        = inputNumber.value.slice(0, inputNumber.maxlength);

};
});




function copyMenu() {
    var dptCategery = document.querySelector('.dpt-cat');
    var dptPlace = document.querySelector('.departments')
    dptPlace.innerHTML = dptCategery.innerHTML;

    var mainNav = document.querySelector('.header .flex .box');
    var  navPlace = document.querySelector('.off-canvas nav');
    navPlace.innerHTML = mainNav.innerHTML;

    var mainConta = document.querySelector('.header .flex .box-icon');
    var  divConta = document.querySelector('.thetop-nav');
    divConta.innerHTML = mainConta.innerHTML;


}

copyMenu();

const menuButton = document.querySelector('.menu_principal');
closeButton = document.querySelector('.t-close');
addClass = document.querySelector('.site');
menuButton.addEventListener( 'click', function () {
 addClass.classList.toggle('showmenu')
})

closeButton.addEventListener( 'click', function () {
    addClass.classList.remove('showmenu')
})



const submenu = document.querySelectorAll('.has-child');
submenu.forEach((menu)=> menu.addEventListener('click', toggle));

function toggle(e){
    e.preventDefault();
    submenu.forEach((item) => item != this ? item.closest('.has-child').classList.remove('expand') : null);
    if (this.closest('.has-child').classList != 'expand');
    this.closest('.has-child').classList.toggle('expand');
}

const searchButton = document.querySelector('.t-search'),
     tClose = document.querySelector('.search-close'),
     showClass = document.querySelector('.site');

     searchButton.addEventListener('click', function() {
        showClass.classList.toggle('showsearch')
     })

     tClose.addEventListener('click', function() {
        showClass.classList.remove('showsearch')
     })


const dptButton = document.querySelector('.dpt-cat .dpt-trigger'),
    dptClass = document.querySelector('.site');

    dptButton.addEventListener('click', function() {
        dptClass.classList.toggle('showdpt')
    })