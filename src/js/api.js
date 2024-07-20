document.addEventListener('DOMContentLoaded', function() {
    inciarApp();
});


function inciarApp() {
    mostrarServicios();
}



async function mostrarServicios(){
    try {
        const url = 'https://serviacrilico.com/api/servicios';
        const resultado = await fetch(url);
        const json = await resultado.json();
        console.log(json);
    } catch (e) {
      console.log(e);
        
    }

}