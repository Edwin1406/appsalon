let paso=1;function inciarApp(){mostrarSeccion(),tabs(),botonesPaginador()}function mostrarSeccion(){const t=document.querySelector(".mostrar");t&&t.classList.remove("mostrar");const o=`#paso-${paso}`;document.querySelector(o).classList.add("mostrar");const e=document.querySelector(".tabs .actual");e&&e.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach((t=>{t.addEventListener("click",(t=>{paso=parseInt(t.target.dataset.paso),mostrarSeccion()}))}))}function botonesPaginador(){document.querySelector("#siguiente");const t=document.querySelector("#anterior");1===paso&&t.classList.add("ocultar")}document.addEventListener("DOMContentLoaded",(function(){inciarApp()}));