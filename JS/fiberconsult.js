let fiberregister = document.querySelector('.fiberregister');
let fiberconsult = document.querySelector('.fiberconsult');
let linkConsult = document.querySelector('#linkConsult');
let linkCancel = document.querySelector('#linkCancel');

linkConsult.addEventListener('click', () => {    
    toggleDivs();
});

linkCancel.addEventListener('click', () => {
    toggleDivs();
});

const toggleDivs = () => {
    if (fiberregister.classList.contains("show")) {          
        fiberregister.classList.remove("show");
        fiberconsult.classList.add("show");
    } else {
        fiberconsult.classList.remove("show");
        fiberregister.classList.add("show");
    }
} // end toggleDivs

document.addEventListener('DOMContentLoaded', () => {
    fiberregister.classList.contains("show");
});