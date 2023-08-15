const APIENTRADAS='http://fagm.epizy.com/apiEntradas';
const APISALIDAS='http://fagm.epizy.com/apiSalidas';
const APIPERSONAL='http://fagm.epizy.com/apipersonal';

const radioButtonEntrada=document.querySelector('#entrada');
const radioButtonSalida=document.querySelector('#salida');
const listaDocumentos=document.querySelector('#lista_num_documento');
const mensajeRespuesta=document.querySelector('.resultado_documento');

const numDocumento=document.querySelector('#num_documento');
const formulario=document.querySelector('.form_documentos');

let arrayEntradasAgrupadas=[];
let arraySalidasAgrupadas=[];
let arrayPersonal=[];

radioButtonEntrada.addEventListener('click',()=>llenarLista('entrada'));
radioButtonSalida.addEventListener('click',()=>llenarLista('salida'));

function llenarLista(opcion){
  // Se llena los datalist dependiendo si se selecciona entradas o salidas
    formulario.classList.remove('ocultar');
    listaDocumentos.replaceChildren();
    if(opcion==='entrada'){
      arrayEntradasAgrupadas.forEach(entrada=>{
        let opciones=document.createElement('option');            
        listaDocumentos.appendChild(opciones);       
        opciones.value=entrada.no_entrada;
        opciones.label=entrada.fecha_entrada;
    });
    }
    if(opcion==='salida'){
      arraySalidasAgrupadas.forEach(salida=>{
        let opciones=document.createElement('option');            
        listaDocumentos.appendChild(opciones);       
        opciones.value=salida.no_salida;
        opciones.label=salida.fecha_salida;
    });
    }
}
async function obtenerEntradas(agrupadas){
  let response=await fetch(`${APIENTRADAS}/agrupada/${agrupadas}`);
  let data=await response.json();   
  if(agrupadas==='true'){
    arrayEntradasAgrupadas=data; 
  }else{
    arrayEntradas=data;
  }
}

async function obtenerSalidas(agrupadas){
  let response=await fetch(`${APISALIDAS}/agrupada/${agrupadas}`);
  let data=await response.json();   
  if(agrupadas==='true'){
    arraySalidasAgrupadas=data; 
  }else{
    arraySalidas=data;
  }
}

async function enviarDatos(){   
      const formdata=new FormData(formulario);
      const response=await fetch('http://fagm.epizy.com/docs/subirDocumento',{
          method:'POST',
          body:formdata
  });
      if (response.status==200){
          mensajeRespuesta.classList.remove('ocultar');
          mensajeRespuesta.innerHTML=await response.json();
          mensajeRespuesta.style.backgroundColor='#C3FF99';
          mensajeRespuesta.style.border='1px solid green';
          mensajeRespuesta.style.borderRadius='8px';
          mensajeRespuesta.style.color='green'; 
          mensajeRespuesta.style.fontSize='2 rem'; 
          deshabilitarElementos();     
       }
}

function deshabilitarElementos(){
  let buttonEnviarDocumento=document.querySelector('#subir_archivo');
  let buttonElegirArchivo=document.querySelector('#archivo');
  buttonEnviarDocumento.disabled=true;
  buttonElegirArchivo.disabled=true;
  numDocumento.disabled=true;
  radioButtonEntrada.disabled=true;
  radioButtonSalida.disabled=true;
}
obtenerEntradas('true');
obtenerSalidas('true');
