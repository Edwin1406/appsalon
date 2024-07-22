let paso=1;const cita={nombre:"",fecha:"",hora:"",servicios:[]};function inciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),ApiServicios(),nombreCita(),seleccionarFecha(),seleccionarHora(),mostrarResumen()}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");const t=`#paso-${paso}`;document.querySelector(t).classList.add("mostrar");const o=document.querySelector(".tabs .actual");o&&o.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach((e=>{e.addEventListener("click",(e=>{paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()}))}))}function botonesPaginador(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente");1===paso?(e.classList.add("ocultar"),t.classList.remove("ocultar")):3===paso?(e.classList.remove("ocultar"),t.classList.add("ocultar"),mostrarResumen()):(e.classList.remove("ocultar"),t.classList.remove("ocultar"))}function paginaSiguiente(){document.querySelector("#anterior").addEventListener("click",(()=>{paso--,mostrarSeccion(),botonesPaginador()}))}function paginaAnterior(){document.querySelector("#siguiente").addEventListener("click",(()=>{paso++,mostrarSeccion(),botonesPaginador()}))}async function ApiServicios(){try{const e="https://serviacrilico.com/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach((e=>{const{id:t,nombre:o,precio:c}=e,n=document.createElement("P");n.classList.add("nombre-servicio"),n.textContent=o;const a=document.createElement("P");a.classList.add("precio-servicio"),a.textContent=`$ ${c}`;const r=document.createElement("DIV");r.classList.add("servicio"),r.dataset.idServicio=t,r.onclick=function(){seleccionarServicio(e)},r.appendChild(n),r.appendChild(a),document.querySelector("#servicios").appendChild(r)}))}function seleccionarServicio(e){const{id:t}=e,{servicios:o}=cita,c=document.querySelector(`[data-id-servicio="${t}"]`);o.some((e=>e.id===t))?(cita.servicios=o.filter((e=>e.id!==t)),c.classList.remove("seleccionado")):(cita.servicios=[...o,e],c.classList.add("seleccionado")),console.log(cita)}function nombreCita(){const e=document.querySelector("#nombre").value;cita.nombre=e,console.log(cita)}function seleccionarFecha(){document.querySelector("#fecha").addEventListener("input",(function(e){const t=new Date(e.target.value).getUTCDay();[6,0].includes(t)?(e.target.value="",mostrarAlerta("No se puede agendar en fin de semana","error",".formulario")):(cita.fecha=e.target.value,console.log(cita))}))}function seleccionarHora(){document.querySelector("#hora").addEventListener("input",(function(e){const t=e.target.value,o=t.split(":");o[0]<10||o[0]>18?(e.target.value="",mostrarAlerta("Hora no valida","error",".formulario")):(cita.hora=t,console.log(cita))}))}function mostrarAlerta(e,t,o,c=!0){const n=document.querySelector(".alerta");n&&n.remove();const a=document.createElement("DIV");a.textContent=e,a.classList.add("alerta"),a.classList.add(t);document.querySelector(o).appendChild(a),c&&setTimeout((()=>{a.remove()}),3e3)}function mostrarResumen(){const e=document.querySelector(".contenido-resumen");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0===cita.servicios.length)return void mostrarAlerta("Faltan datos de servicios, hora, fecha o nombre","error",".contenido-resumen",!1);const{nombre:t,fecha:o,hora:c,servicios:n}=cita,a=document.createElement("P");a.innerHTML=`<span>Nombre:</span> ${t}`;const r=document.createElement("P");r.innerHTML=`<span>Fecha:</span> ${o}`;const i=document.createElement("P");i.innerHTML=`<span>Hora:</span> ${c}`,n.forEach((t=>{const{id:o,nombre:c,precio:n}=t,a=document.createElement("DIV");a.classList.add("contenedor-servicio");const r=document.createElement("P");r.innerHTML=`<span>Servicio:</span> ${c}`;const i=document.createElement("P");i.innerHTML=`<span>Precio:</span> $ ${n}`;const s=document.createElement("P");s.textContent="X",s.classList.add("eliminar"),s.onclick=function(){cita.servicios=cita.servicios.filter((e=>e.id!==o)),servicioDiv.classList.remove("seleccionado"),mostrarResumen()},a.appendChild(r),a.appendChild(s),a.appendChild(i),e.appendChild(a)})),e.appendChild(a),e.appendChild(r),e.appendChild(i)}document.addEventListener("DOMContentLoaded",(function(){inciarApp()}));