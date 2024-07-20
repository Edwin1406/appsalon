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
        // scripting de los servicios
        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;
       
        const precioServicio =document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `$ ${precio}`;

        // contenedor de servicios
        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id; //creamos un atributo personalizado
        
        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);
        
        console.log(servicioDiv);


        
    });

}