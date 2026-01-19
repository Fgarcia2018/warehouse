const API='https://warehouseproject.wuaze.com/apiSalidas';


const radioButtonCodigoSalida=document.querySelector('#salida');
const radioButtonFecha=document.querySelector('#fecha');
const radioButtonDocumento=document.querySelector('#documento');
const listasalidas=document.querySelector('#lista_num_salida');
const listaDocumento=document.querySelector('#lista_num_documento');
const numsalidas=document.querySelector('#num_salida');
const numDocumento=document.querySelector('#num_documento');
const fechasalida=document.querySelector('#fecha_salida');

const tablaDetalle=document.querySelector('.resultado_consulta');
const bodyTabla=document.querySelector('.tabla_body_salida');

let parrafoNumsalida=document.querySelector('.parrafo_datalist_num_salida');
let parrafoNumDocumento=document.querySelector('.parrafo_datalist_documento');
let parrafoFecha=document.querySelector('.parrafo_fecha_salida');

let arraySalidasAgrupadas=[];
let arraySalidas=[];

radioButtonCodigoSalida.addEventListener('click',llenarListasalidas);
radioButtonDocumento.addEventListener('click',llenarListaDocumentos);
radioButtonFecha.addEventListener('click',mostrarCalendario);
numsalidas.addEventListener('input',(e)=>mostrarDetallesalida(e.currentTarget.value,e.currentTarget.id));
numDocumento.addEventListener('input',(e)=>mostrarDetallesalida(e.currentTarget.value,e.currentTarget.id));
fechasalida.addEventListener('input',(e)=>mostrarDetallesalida(e.currentTarget.value,e.currentTarget.id));


// funciones para llenar datalist, mostrar u ocultar calendario dependiendo de la opción de busqueda seleccionada
function llenarListasalidas(){
    // Se llena datalist con los numeros de salida
      parrafoNumsalida.classList.remove('ocultar');
      parrafoFecha.classList.add('ocultar'); 
      parrafoNumDocumento.classList.add('ocultar'); 
      arraySalidasAgrupadas.forEach(salida=>{
          let opciones=document.createElement('option');            
          listasalidas.appendChild(opciones);         
          opciones.value=salida.no_salida;
          opciones.label=salida.fecha_salida;
       });
}  

function llenarListaDocumentos(){
  parrafoNumsalida.classList.add('ocultar');
  parrafoFecha.classList.add('ocultar'); 
  parrafoNumDocumento.classList.remove('ocultar'); 
    arraySalidasAgrupadas.forEach(salida=>{
    let opciones=document.createElement('option');  
    listaDocumento.appendChild(opciones);      
    opciones.value=salida.no_salida;
    opciones.label=salida.fecha_salida;
  });
}
function mostrarCalendario(){
  parrafoNumsalida.classList.add('ocultar');
  parrafoNumDocumento.classList.add('ocultar');
  parrafoFecha.classList.remove('ocultar');
}  

// funcion para mostrar resultado de la consulta en una tabla
function mostrarDetallesalida(dato,elemento){
    // Se obtienen los encabeados de la tabla
    let tituloTabla=document.querySelector('.tabla_titulo');
    let encabezadoNumSalida=document.querySelector('.n_salida');
    let encabezadoCodigo=document.querySelector('.enc_codigo');
    let encabezadoDescripcion=document.querySelector('.enc_descripcion');
    let encabezadoUnidad=document.querySelector('.enc_unidad');
    let encabezadoCantidad=document.querySelector('.enc_cantidad');
    let encabezadoIdTrabajador=document.querySelector('.enc_id_trabajador');
    let encabezadoNomTrabajador=document.querySelector('.enc_nom_trabajador');
    let encabezadoDocumento=document.querySelector('.n_documento');
    // Se muestra titulo de la tabla y se reemplaza el contenido dependiendo de la opcion seleccionada
    tituloTabla.classList.remove('ocultar');
    bodyTabla.replaceChildren();
    tablaDetalle.classList.remove('ocultar');
    // Array para almacenar el resultado del filtro dependiendo de la opcion seleccionada
    let filtro=[];
    // Se muestran o se ocultan encabezados dependiendo de la opción seleccionada
    if (elemento==='num_salida'){
        encabezadoNumSalida.classList.add('ocultar');
        encabezadoDocumento.classList.add('ocultar');  
        encabezadoCodigo.classList.remove('ocultar'); 
        encabezadoDescripcion.classList.remove('ocultar'); 
        encabezadoUnidad.classList.remove('ocultar'); 
        encabezadoCantidad.classList.remove('ocultar');
        encabezadoIdTrabajador.classList.remove('ocultar');
        encabezadoNomTrabajador.classList.remove('ocultar');
        tituloTabla.innerText='Salida de materiales No. '+dato;
        filtro=arraySalidas.filter((salida)=>{          
        return salida.no_salida===dato;
        }); 
    }else if(elemento==='fecha_salida'){
        tituloTabla.innerText='Salida de materiales el '+dato;
        encabezadoNumSalida.classList.remove('ocultar');
        encabezadoCodigo.classList.add('ocultar'); 
        encabezadoDescripcion.classList.add('ocultar'); 
        encabezadoUnidad.classList.add('ocultar'); 
        encabezadoCantidad.classList.add('ocultar');
        encabezadoIdTrabajador.classList.remove('ocultar');
        encabezadoNomTrabajador.classList.remove('ocultar');
        encabezadoDocumento.classList.add('ocultar');     
        filtro=arraySalidas.filter((salida)=>{              
        return salida.fecha_salida.substring(0,10)==dato;
      }); 
    }else if(elemento==='num_documento'){
      tituloTabla.innerText='Documento No. '+dato;
      encabezadoDocumento.classList.remove('ocultar'); 
      encabezadoNumSalida.classList.remove('ocultar');
      encabezadoCodigo.classList.add('ocultar'); 
      encabezadoDescripcion.classList.add('ocultar'); 
      encabezadoUnidad.classList.add('ocultar'); 
      encabezadoCantidad.classList.add('ocultar'); 
      encabezadoIdTrabajador.classList.add('ocultar');
      encabezadoNomTrabajador.classList.add('ocultar');  
      filtro=arraySalidasAgrupadas.filter((salida)=>{          
        return salida.no_salida===dato;
      }); 
  } 
    // Se muestra el resultado del filtro realizado
    filtro.forEach((salida)=>{
        let num;
        // Se crea la fila
        let filaMaterial=document.createElement('tr');
        //Se crean las celdas  
        let celdaFecha=document.createElement('td');    
        let celdaNumSalida=document.createElement('td');  
        let celdaCodigo=document.createElement('td');
        let celdaDescripcion=document.createElement('td');
        let celdaUnidad=document.createElement('td');
        let celdaCantidad=document.createElement('td');
        let celdaPersonalAsignado=document.createElement('td');
        let celdaNomPersonalAsignado=document.createElement('td');
        let celdaAlmacenista=document.createElement('td');
        let celdaDocumento=document.createElement('td');
      
        //Se crean los elementos para mostrar la informacion
        let fecha=document.createElement('label');   
        let numSalida=document.createElement('label');
        let codigo=document.createElement('label');
        let descripcion=document.createElement('label');
        let unidad=document.createElement('label');
        let cantidad=document.createElement('label');
        let personalAsignado=document.createElement('label');    
        let nomPersonalAsignado=document.createElement('label');      
        let almacenista=document.createElement('label');
        let documento=document.createElement('a');

        //Se configuran atributos a los elementos
        documento.setAttribute('href',salida.documento); 
        documento.setAttribute('target','_blank');

        //Se asignan valores a los elementos  
        fecha.innerText=salida.fecha_salida; 
        numSalida.innerText=salida.no_salida; 
        codigo.innerText=salida.id_material;
        descripcion.innerText=salida.descripcion_material;
        unidad.innerText=salida.unidad_material;
        cantidad.innerText=salida.cantidad_salida;
        personalAsignado.innerText=salida.id_trabajador_responsable;
        nomPersonalAsignado.innerText=salida.nombre_responsable;
        almacenista.innerText=salida.id_almacenista;
        documento.innerText=salida.documento;
        
        //Se agregan elementos a las celdas
        celdaFecha.appendChild(fecha);
        celdaNumSalida.appendChild(numSalida);
        celdaCodigo.appendChild(codigo); 
        celdaDescripcion.appendChild(descripcion);
        celdaUnidad.appendChild(unidad);
        celdaCantidad.appendChild(cantidad);
        celdaPersonalAsignado.appendChild(personalAsignado);
        celdaNomPersonalAsignado.appendChild(nomPersonalAsignado);
        celdaAlmacenista.appendChild(almacenista);
        celdaDocumento.appendChild(documento);

        //Se agregan celdas a la fila dependiendo de la opcion seleccionada para la consulta
        filaMaterial.appendChild(celdaFecha);  
        if(elemento==='num_salida'){
          filaMaterial.appendChild(celdaCodigo);    
          filaMaterial.appendChild(celdaDescripcion);  
          filaMaterial.appendChild(celdaUnidad);  
          filaMaterial.appendChild(celdaCantidad); 
        }
        if(elemento==='fecha_salida'|| elemento==='num_documento'){
          filaMaterial.appendChild(celdaNumSalida); 
        }    
        if(elemento==='fecha_salida' || elemento==='num_salida'){
          filaMaterial.appendChild(celdaPersonalAsignado);
          filaMaterial.appendChild(celdaNomPersonalAsignado);
        }       
        filaMaterial.appendChild(celdaAlmacenista); 
        if(elemento==='num_documento'){
          filaMaterial.appendChild(celdaDocumento);  
        } 
        //Se agrega la fila al cuerpo de la tabla
        bodyTabla.appendChild(filaMaterial);
    });
}
async function obtenerSalidas(agrupadas){
    let response=await fetch(`${API}/agrupada/${agrupadas}`);
    let data=await response.json();   
    if(agrupadas==='true'){
      arraySalidasAgrupadas=data; 
    }else{
      arraySalidas=data;
    }
}
// Se llaman funciones para traer las salidas de los materiales
// se obtienen las salidas agrupadas
obtenerSalidas('true');
// Se obtienen las salidas sin agrupar
obtenerSalidas('false');