let paso = 1;
document.addEventListener('DOMContentLoaded', function() {
    inciarApp();
});

function inciarApp() { 
    tabs(); //cambiar la seccion cuando se da click en un tab
}

function tabs(){
    const botones = document.querySelectorAll('.tabs button');
    console.log(botones.length);
}