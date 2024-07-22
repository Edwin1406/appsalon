let paso=1;const cita={nombre:"",fecha:"",hora:"",servicios:[]};function inciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),ApiServicios(),nombreCita(),seleccionarFecha(),seleccionarHora(),mostrarResumen()}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");const t=`#paso-${paso}`;document.querySelector(t).classList.add("mostrar");const o=document.querySelector(".tabs .actual");o&&o.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach((e=>{e.addEventListener("click",(e=>{paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()}))}))}function botonesPaginador(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente");1===paso?(e.classList.add("ocultar"),t.classList.remove("ocultar")):3===paso?(e.classList.remove("ocultar"),t.classList.add("ocultar"),mostrarResumen()):(e.classList.remove("ocultar"),t.classList.remove("ocultar"))}function paginaSiguiente(){document.querySelector("#anterior").addEventListener("click",(()=>{paso--,mostrarSeccion(),botonesPaginador()}))}function paginaAnterior(){document.querySelector("#siguiente").addEventListener("click",(()=>{paso++,mostrarSeccion(),botonesPaginador()}))}async function ApiServicios(){try{const e="https://serviacrilico.com/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach((e=>{const{id:t,nombre:o,precio:a}=e,c=document.createElement("P");c.classList.add("nombre-servicio"),c.textContent=o;const n=document.createElement("P");n.classList.add("precio-servicio"),n.textContent=`$ ${a}`;const r=document.createElement("DIV");r.classList.add("servicio"),r.dataset.idServicio=t,r.onclick=function(){seleccionarServicio(e)},r.appendChild(c),r.appendChild(n),document.querySelector("#servicios").appendChild(r)}))}function seleccionarServicio(e){const{id:t}=e,{servicios:o}=cita,a=document.querySelector(`[data-id-servicio="${t}"]`);o.some((e=>e.id===t))?(cita.servicios=o.filter((e=>e.id!==t)),a.classList.remove("seleccionado")):(cita.servicios=[...o,e],a.classList.add("seleccionado")),console.log(cita)}function nombreCita(){const e=document.querySelector("#nombre").value;cita.nombre=e,console.log(cita)}function seleccionarFecha(){document.querySelector("#fecha").addEventListener("input",(function(e){const t=new Date(e.target.value).getUTCDay();[6,0].includes(t)?(e.target.value="",mostrarAlerta("No se puede agendar en fin de semana","error",".formulario")):(cita.fecha=e.target.value,console.log(cita))}))}function seleccionarHora(){document.querySelector("#hora").addEventListener("input",(function(e){const t=e.target.value,o=t.split(":");o[0]<10||o[0]>18?(e.target.value="",mostrarAlerta("Hora no valida","error",".formulario")):(cita.hora=t,console.log(cita))}))}function mostrarAlerta(e,t,o,a=!0){const c=document.querySelector(".alerta");c&&c.remove();const n=document.createElement("DIV");n.textContent=e,n.classList.add("alerta"),n.classList.add(t);document.querySelector(o).appendChild(n),a&&setTimeout((()=>{n.remove()}),3e3)}function mostrarResumen(){const e=document.querySelector(".contenido-resumen");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0===cita.servicios.length)return void mostrarAlerta("Faltan datos de servicios, hora, fecha o nombre","error",".contenido-resumen",!1);const{nombre:t,fecha:o,hora:a,servicios:c}=cita,n=document.createElement("P");n.innerHTML=`<span>Nombre:</span> ${t}`;const r=document.createElement("P");r.innerHTML=`<span>Fecha:</span> ${o}`;const i=document.createElement("P");i.innerHTML=`<span>Hora:</span> ${a}`,c.forEach((t=>{const{id:o,nombre:a,precio:c}=t,n=document.createElement("DIV");n.classList.add("contenedor-servicio");const r=document.createElement("P");r.innerHTML=`<span>Servicio:</span>${a}`;const i=document.createElement("P");i.innerHTML=`<span>Precio:</span> $${c}`,n.appendChild(r),n.appendChild(i),e.appendChild(n)})),e.appendChild(n),e.appendChild(r),e.appendChild(i)}document.addEventListener("DOMContentLoaded",(function(){inciarApp()}));