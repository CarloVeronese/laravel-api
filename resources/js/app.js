import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
]);

const deleteDomEl = document.getElementById('myBtn');
const noBtnDomEl = document.getElementById('noBtn');
const formDomEl = document.getElementById("bgForm");

deleteDomEl.addEventListener('click', function(){
    formDomEl.classList.add("active");
});

noBtnDomEl.addEventListener('click', function () {
    formDomEl.classList.remove("active");
});