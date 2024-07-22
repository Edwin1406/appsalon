let paso=1;const cita={nombre:"",fecha:"",hora:"",servicios:[]};function inciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),ApiServicios(),nombreCita()}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");const o=`#paso-${paso}`;document.querySelector(o).classList.add("mostrar");const t=document.querySelector(".tabs .actual");t&&t.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach((e=>{e.addEventListener("click",(e=>{paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()}))}))}function botonesPaginador(){const e=document.querySelector("#anterior"),o=document.querySelector("#siguiente");1===paso?(e.classList.add("ocultar"),o.classList.remove("ocultar")):3===paso?(e.classList.remove("ocultar"),o.classList.add("ocultar")):(e.classList.remove("ocultar"),o.classList.remove("ocultar"))}function paginaSiguiente(){document.querySelector("#anterior").addEventListener("click",(()=>{paso--,mostrarSeccion(),botonesPaginador()}))}function paginaAnterior(){document.querySelector("#siguiente").addEventListener("click",(()=>{paso++,mostrarSeccion(),botonesPaginador()}))}async function ApiServicios(){try{const e="https://serviacrilico.com/api/servicios",o=await fetch(e);mostrarServicios(await o.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach((e=>{const{id:o,nombre:t,precio:c}=e,i=document.createElement("P");i.classList.add("nombre-servicio"),i.textContent=t;const a=document.createElement("P");a.classList.add("precio-servicio"),a.textContent=`$ ${c}`;const s=document.createElement("DIV");s.classList.add("servicio"),s.dataset.idServicio=o,s.onclick=function(){seleccionarServicio(e)},s.appendChild(i),s.appendChild(a),document.querySelector("#servicios").appendChild(s)}))}function seleccionarServicio(e){const{id:o}=e,{servicios:t}=cita,c=document.querySelector(`[data-id-servicio="${o}"]`);t.some((e=>e.id===o))?(cita.servicios=t.filter((e=>e.id!==o)),c.classList.remove("seleccionado")):(cita.servicios=[...t,e],c.classList.add("seleccionado")),console.log(cita)}function nombreCita(){const e=document.querySelector("#nombre");cita.nombre=e,console.log(cita)}document.addEventListener("DOMContentLoaded",(function(){inciarApp()}));