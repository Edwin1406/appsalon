document.addEventListener('DOMContentLoaded', function() {
    inciarApp();
});


function inciarApp() {
    ApiServicios(); //consultando la api de servicios
}



async function ApiServicios(){
    try {
        const url = 'https://serviacrilico.com/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);
    } catch (e) {
      console.log(e);
        
    }

}

function mostrarServicios(servicios){
    servicios.forEach(servicio => {
        const {id,nombre,precio} =servicio;
        console.log(id,nombre,precio);
    });

}