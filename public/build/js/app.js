let paso=1;const cita={id:"",nombre:"",fecha:"",hora:"",servicios:[]};function inciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),ApiServicios(),nombreCita(),idCliente(),seleccionarFecha(),seleccionarHora(),mostrarResumen(),ApiHoras()}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");const t=`#paso-${paso}`;document.querySelector(t).classList.add("mostrar");const o=document.querySelector(".tabs .actual");o&&o.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach((e=>{e.addEventListener("click",(e=>{paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()}))}))}function botonesPaginador(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente");1===paso?(e.classList.add("ocultar"),t.classList.remove("ocultar")):3===paso?(e.classList.remove("ocultar"),t.classList.add("ocultar"),mostrarResumen()):(e.classList.remove("ocultar"),t.classList.remove("ocultar"))}function paginaSiguiente(){document.querySelector("#anterior").addEventListener("click",(()=>{paso--,mostrarSeccion(),botonesPaginador()}))}function paginaAnterior(){document.querySelector("#siguiente").addEventListener("click",(()=>{paso++,mostrarSeccion(),botonesPaginador()}))}async function ApiServicios(){try{const e="https://serviacrilico.com/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach((e=>{const{id:t,nombre:o,precio:a}=e,n=document.createElement("P");n.classList.add("nombre-servicio"),n.textContent=o;const c=document.createElement("P");c.classList.add("precio-servicio"),c.textContent=`$ ${a}`;const r=document.createElement("DIV");r.classList.add("servicio"),r.dataset.idServicio=t,r.onclick=function(){seleccionarServicio(e)},r.appendChild(n),r.appendChild(c),document.querySelector("#servicios").appendChild(r)}))}function seleccionarServicio(e){const{id:t}=e,{servicios:o}=cita,a=document.querySelector(`[data-id-servicio="${t}"]`);o.some((e=>e.id===t))?(cita.servicios=o.filter((e=>e.id!==t)),a.classList.remove("seleccionado")):(cita.servicios=[...o,e],a.classList.add("seleccionado")),console.log(cita)}function idCliente(){const e=document.querySelector("#id").value;cita.id=e,console.log(cita)}function nombreCita(){const e=document.querySelector("#nombre").value;cita.nombre=e}function seleccionarFecha(){document.querySelector("#fecha").addEventListener("input",(function(e){const t=new Date(e.target.value).getUTCDay();[6,0].includes(t)?(e.target.value="",mostrarAlerta("No se puede agendar en fin de semana","error",".formulario")):(cita.fecha=e.target.value,console.log(cita))}))}async function ApiHoras(){try{const e="https://serviacrilico.com/api/horas",t=await fetch(e);mostrarHoras(await t.json())}catch(e){console.log(e)}}function mostrarHoras(e){const t=e.map((e=>e.hora.slice(0,5)));console.log(t);document.querySelector("#hora").addEventListener("input",(function(e){const o=e.target.value,a=o.split(":"),n=t.includes(o);a[0]<10||a[0]>18||n?(e.target.value="",mostrarAlerta("Hora no valida o esa Hora ya fue reservada","error",".formulario")):(cita.hora=o,console.log(cita))}))}function seleccionarHora(){document.querySelector("#hora").addEventListener("input",(function(e){const t=e.target.value,o=t.split(":");o[0]<10||o[0]>18?(e.target.value="",mostrarAlerta("Hora no valida","error",".formulario")):(cita.hora=t,console.log(cita))}))}function mostrarAlerta(e,t,o,a=!0){const n=document.querySelector(".alerta");n&&n.remove();const c=document.createElement("DIV");c.textContent=e,c.classList.add("alerta"),c.classList.add(t);document.querySelector(o).appendChild(c),a&&setTimeout((()=>{c.remove()}),3e3)}function mostrarResumen(){const e=document.querySelector(".contenido-resumen");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0===cita.servicios.length)return void mostrarAlerta("Faltan datos de servicios, hora, fecha o nombre","error",".contenido-resumen",!1);const{nombre:t,fecha:o,hora:a,servicios:n}=cita,c=document.createElement("H3");c.textContent="Resumen de Servicios",e.appendChild(c),n.forEach((t=>{const{id:o,nombre:a,precio:n}=t,c=document.createElement("DIV");c.classList.add("contenedor-servicio");const r=document.createElement("P");r.innerHTML=`<span>Servicio:</span> ${a}`;const i=document.createElement("P");i.innerHTML=`<span>Precio:</span> $ ${n}`,c.appendChild(r),c.appendChild(i),e.appendChild(c)}));const r=document.createElement("H3");r.textContent="Resumen de Cita",e.appendChild(r);const i=document.createElement("P");i.innerHTML=`<span>Nombre:</span> ${t}`;const s=new Date(o),d=s.getMonth(),l=s.getDate()+2,u=s.getFullYear(),m=new Date(Date.UTC(u,d,l)).toLocaleDateString("es-ES",{weekday:"long",year:"numeric",month:"long",day:"numeric"}),p=document.createElement("P");p.innerHTML=`<span>Fecha:</span> ${m}`;const v=document.createElement("P");v.innerHTML=`<span>Hora:</span> ${a} Horas`;const h=document.createElement("BUTTON");h.classList.add("boton"),h.textContent="Reservar Cita",h.onclick=reservarCita,e.appendChild(i),e.appendChild(p),e.appendChild(v),e.appendChild(h)}async function reservarCita(){const{nombre:e,fecha:t,hora:o,servicios:a,id:n}=cita,c=a.map((e=>e.id));console.log(c);const r=new FormData;r.append("fecha",t),r.append("hora",o),r.append("usuarioId",n),r.append("servicios",c);try{const t="https://serviacrilico.com/api/citas",o=await fetch(t,{method:"POST",body:r}),a=await o.json();console.log(a.resultado),a.resultado&&Swal.fire({position:"top-end",icon:"success",title:`Gracias ${e} tu cita ha sido registrada`,showConfirmButton:!1,timer:3e3}).then((()=>{window.location.reload()}))}catch(e){Swal.fire({position:"top-end",icon:"error",title:"Error no se pudo registrar la cita",showConfirmButton:!1,timer:3e3})}}document.addEventListener("DOMContentLoaded",(function(){inciarApp()}));