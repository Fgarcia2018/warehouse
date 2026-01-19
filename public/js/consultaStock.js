const API='https://warehouseproject.wuaze.com/apimaterial';

const radioButtonCodigoSalida=document.querySelector('#cantidad');
const tablaConsulta=document.querySelector('.tabla_consulta');
const tablaDetalle=document.querySelector('.resultado_consulta');
const cantidadConsultaStock=document.querySelector('#cantidad_stock');
const bodyTabla=document.querySelector('.tabla_body_stock');

let parrafoCantidad=document.querySelector('.parrafo_cantidad');
let arrayMateriales=[];

radioButtonCodigoSalida.addEventListener('click',mostrarParrafosConsulta);
cantidadConsultaStock.addEventListener('input',(e)=>mostrarDetalleConsulta(e.currentTarget.value,e.currentTarget.id));

function mostrarParrafosConsulta(){
    parrafoCantidad.classList.remove('ocultar');
}  

function mostrarDetalleConsulta(dato,elemento){
    let tituloTabla=document.querySelector('.tabla_titulo');
    tituloTabla.classList.remove('ocultar');  
    tituloTabla.innerText='Materiales En Stock menor o igual a '+dato; 
    tablaDetalle.classList.remove('ocultar'); 
    bodyTabla.replaceChildren();   
    let filtro=[];
    if (elemento==='cantidad_stock'){
        filtro=arrayMateriales.filter((material)=>{          
        return material.stock<=parseInt(dato);
     }); 
    } 
    filtro.sort((a,b)=>{
      if(parseInt(b.stock)>parseInt(a.stock)){
        return 1;
      }
      if(parseInt(b.stock)<parseInt(a.stock)){
      return -1;
       }   
        return 0; 
    });
    filtro.forEach((material)=>{
        let num;
        let filaMaterial=document.createElement('tr'); 
        let celdaCodigo=document.createElement('td');
        let celdaDescripcion=document.createElement('td');
        let celdaUnidad=document.createElement('td');
        let celdaCantidadEntrada=document.createElement('td');
        let celdaCantidadSalida=document.createElement('td');
        let celdaCantidadStock=document.createElement('td');
        let codigo=document.createElement('label');
        let descripcion=document.createElement('label');
        let unidad=document.createElement('label');    
        let cantidadEntrada=document.createElement('label');  
        let cantidadSalida=document.createElement('label'); 
        let cantidadStock=document.createElement('label');         
              
        codigo.innerText=material.id;
        descripcion.innerText=material.descripcion;
        unidad.innerText=material.unidad;
        cantidadEntrada.innerText=material.entrada_material;
        cantidadSalida.innerText=material.salida_material;
        cantidadStock.innerText=material.stock; 
            
        celdaCodigo.appendChild(codigo); 
        celdaDescripcion.appendChild(descripcion);
        celdaUnidad.appendChild(unidad);
        celdaCantidadEntrada.appendChild(cantidadEntrada);
        celdaCantidadSalida.appendChild(cantidadSalida);
        celdaCantidadStock.appendChild(cantidadStock);  
         
        filaMaterial.appendChild(celdaCodigo);    
        filaMaterial.appendChild(celdaDescripcion);  
        filaMaterial.appendChild(celdaUnidad);  
        filaMaterial.appendChild(celdaCantidadEntrada); 
        filaMaterial.appendChild(celdaCantidadSalida);
        filaMaterial.appendChild(celdaCantidadStock);    
       
        bodyTabla.appendChild(filaMaterial);  
    });
  }
async function obtenerMateriales(){
    let response=await fetch(API);
    let data=await response.json();   
    arrayMateriales=data;    
}
obtenerMateriales();
