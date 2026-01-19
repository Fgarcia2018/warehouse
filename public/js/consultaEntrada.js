const API='https://warehouseproject.wuaze.com/apiEntradas';
const APIPERSONAL='https://warehouseproject.wuaze.com/apipersonal';


const radioButtonCodigoEntrada=document.querySelector('#codigo_entrada');
const radioButtonReintegro=document.querySelector('#reintegro');
const radioButtonCompra=document.querySelector('#compra');
const radioButtonFecha=document.querySelector('#fecha');
const radioButtonDocumento=document.querySelector('#documento');
const listaEntradas=document.querySelector('#lista_num_entrada');
const listaDocumento=document.querySelector('#lista_num_documento');
const numEntradas=document.querySelector('#num_entrada');
const numDocumento=document.querySelector('#num_documento');
const fechaEntrada=document.querySelector('#fecha_entrada');
const listaCompra=document.querySelector('#num_entrada_compra');
const listaReintegro=document.querySelector('#num_entrada_compra');


const tablaDetalle=document.querySelector('.resultado_consulta');
const bodyTabla=document.querySelector('.tabla_body_entrada');

let parrafoNumEntrada=document.querySelector('.parrafo_datalist_num_entrada');
let parrafoNumDocumento=document.querySelector('.parrafo_datalist_documento');
let parrafoFecha=document.querySelector('.parrafo_fecha_entrada');

let arrayEntradasAgrupadas=[];
let arrayEntradas=[];
let arrayPersonal=[];

radioButtonCompra.addEventListener('click',()=>llenarListaEntradas('compra'));
radioButtonReintegro.addEventListener('click',()=>llenarListaEntradas('reintegro'));
radioButtonFecha.addEventListener('click',mostrarCalendario);
radioButtonDocumento.addEventListener('click',llenarListaDocumentos);
numEntradas.addEventListener('input',(e)=>mostrarDetalleEntrada(e.currentTarget.value,e.currentTarget.id));
fechaEntrada.addEventListener('input',(e)=>mostrarDetalleEntrada(e.currentTarget.value,e.currentTarget.id));
numDocumento.addEventListener('input',(e)=>mostrarDetalleEntrada(e.currentTarget.value,e.currentTarget.id));


async function obtenerPersonal(){
  let response=await fetch(APIPERSONAL);
  let data=await response.json();   
    arrayPersonal=data;      
}

function llenarListaEntradas(opcion){
    parrafoNumEntrada.classList.remove('ocultar');
    parrafoFecha.classList.add('ocultar');
    parrafoNumDocumento.classList.add('ocultar');
    listaEntradas.replaceChildren();
    let filtro=[];
    if(opcion==='compra'){
         filtro=arrayEntradasAgrupadas.filter((entrada)=>{          
            return entrada.tipo_entrada===opcion;
     }); 

    }else if(opcion==='reintegro'){
        filtro=arrayEntradasAgrupadas.filter((entrada)=>{          
           return entrada.tipo_entrada===opcion;
    }); 

}
    filtro.forEach(entrada=>{
        let opciones=document.createElement('option');            
        listaEntradas.appendChild(opciones);       
        opciones.value=entrada.no_entrada;
        opciones.label=entrada.fecha_entrada;
    });
} 
  
function llenarListaDocumentos(){
  parrafoNumDocumento.classList.remove('ocultar');
  parrafoNumEntrada.classList.add('ocultar');
  parrafoFecha.classList.add('ocultar'); 
  arrayEntradasAgrupadas.forEach(entrada=>{
      let opciones=document.createElement('option');            
      listaDocumento.appendChild(opciones);       
      opciones.value=entrada.no_entrada;
      opciones.label=entrada.fecha_entrada;
  });
}   
function mostrarCalendario(){
  parrafoNumEntrada.classList.add('ocultar');
  parrafoFecha.classList.remove('ocultar');
  parrafoNumDocumento.classList.add('ocultar');
}  
function mostrarDetalleEntrada(codigoEntrada,elemento){
    // Se obtienen los encabezados de las tablas
    let tituloTabla=document.querySelector('.tabla_titulo');
    let encabezadoNumEntrada=document.querySelector('.n_entrada');
    let encabezadoCodigo=document.querySelector('.enc_codigo');
    let encabezadoDescripcion=document.querySelector('.enc_descripcion');
    let encabezadoUnidad=document.querySelector('.enc_unidad');
    let encabezadoCantidad=document.querySelector('.enc_cantidad');
    let encabezadosIdReintegro=document.querySelector('.idreintegrado');
    let encabezadosNomReintegro=document.querySelector('.nomreintegrado');
    let encabezadosProveedor=document.querySelector('.proveedor');
    let encabezadoDocumento=document.querySelector('.enc_documento');
    
    tituloTabla.classList.remove('ocultar');
    bodyTabla.replaceChildren();
    tablaDetalle.classList.remove('ocultar');
    // Se declara array para almacenar los filtros realizados
    let filtro=[];

    // Dependiendo de la opcion seleccionda para realizar el filtro se ocultan o se muestran encabezados
    if (elemento==='num_entrada'){
        encabezadoNumEntrada.classList.add('ocultar');
        tituloTabla.innerText='Entrada No. '+codigoEntrada;
        filtro=arrayEntradas.filter((entrada)=>{          
        return entrada.no_entrada===codigoEntrada;
      }); 
    }else if(elemento==='fecha_entrada'){
      encabezadoNumEntrada.classList.remove('ocultar');
      encabezadosIdReintegro.classList.remove('ocultar');
      encabezadosNomReintegro.classList.remove('ocultar');
      encabezadosProveedor.classList.remove('ocultar');
      encabezadoCodigo.classList.add('ocultar'); 
      encabezadoDescripcion.classList.add('ocultar'); 
      encabezadoUnidad.classList.add('ocultar'); 
      encabezadoCantidad.classList.add('ocultar');
      encabezadoDocumento.classList.add('ocultar');
      tituloTabla.innerText='Entradas de material el '+codigoEntrada;
      filtro=arrayEntradas.filter((entrada)=>{          
        return entrada.fecha_entrada.substring(0,10)==codigoEntrada;
      }); 
    }
    if(elemento==='num_documento'){
        encabezadoNumEntrada.classList.remove('ocultar');
        encabezadosIdReintegro.classList.add('ocultar');
        encabezadosNomReintegro.classList.add('ocultar');
        encabezadosProveedor.classList.add('ocultar');
        encabezadoCodigo.classList.add('ocultar'); 
        encabezadoDescripcion.classList.add('ocultar'); 
        encabezadoUnidad.classList.add('ocultar'); 
        encabezadoCantidad.classList.add('ocultar');
        encabezadoDocumento.classList.remove('ocultar');
        filtro=arrayEntradasAgrupadas.filter((entrada)=>{          
          return entrada.no_entrada===codigoEntrada;
        }); 
    } 
    if(radioButtonReintegro.checked){
        encabezadosIdReintegro.classList.remove('ocultar');
        encabezadosNomReintegro.classList.remove('ocultar');
        encabezadosProveedor.classList.add('ocultar');
        encabezadoCodigo.classList.remove('ocultar'); 
        encabezadoDescripcion.classList.remove('ocultar'); 
        encabezadoUnidad.classList.remove('ocultar'); 
        encabezadoCantidad.classList.remove('ocultar');
        encabezadoDocumento.classList.add('ocultar');
    }
    if(radioButtonCompra.checked){
      encabezadosIdReintegro.classList.add('ocultar');
      encabezadosNomReintegro.classList.add('ocultar');
      encabezadosProveedor.classList.remove('ocultar');
      encabezadoCodigo.classList.remove('ocultar'); 
      encabezadoDescripcion.classList.remove('ocultar'); 
      encabezadoUnidad.classList.remove('ocultar'); 
      encabezadoCantidad.classList.remove('ocultar');
      encabezadoDocumento.classList.add('ocultar');
    }
    // Se crean la celdas necsarias de acuerdo a la opcion de seleccionada para realizar la consulta
    filtro.forEach((entrada)=>{
        let num;
        // se crea una fila
        let filaMaterial=document.createElement('tr');
        // Se crean las celdas  
        let celdaFecha=document.createElement('td');
        let celdaProveedor=document.createElement('td');
        let celdaNumEntrada=document.createElement('td');
        let celdaCodigo=document.createElement('td');
        let celdaDescripcion=document.createElement('td');
        let celdaUnidad=document.createElement('td');
        let celdaCantidad=document.createElement('td');
        let celdaPersonalReintegro=document.createElement('td');
        let celdaNomPersonalReintegro=document.createElement('td');
        let celdaAlmacenista=document.createElement('td'); 
        let celdaDocumento=document.createElement('td');       
        // Se crean las elementos html para mostrar la informacion requerida
        let fecha=document.createElement('label');    
        let proveedor=document.createElement('label');
        let numEntrada=document.createElement('label');
        let codigo=document.createElement('label');
        let descripcion=document.createElement('label');
        let unidad=document.createElement('label');
        let cantidad=document.createElement('label');
        let personalReintegro=document.createElement('label');   
        let nomPersonalReintegro=document.createElement('label');        
        let almacenista=document.createElement('label');
        let documento=document.createElement('a');
        // Se configuran atributos para los elementos html
        documento.setAttribute('href',entrada.documento); 
        documento.setAttribute('target','_blank');
        //Se asigna la informacion a mostrar en cada elemento 
        fecha.innerText=entrada.fecha_entrada;         
        proveedor.innerText=entrada.proveedor;
        numEntrada.innerText=entrada.no_entrada;
        codigo.innerText=entrada.id_material;
        descripcion.innerText=entrada.descripcion_material;
        unidad.innerText=entrada.unidad_material;
        cantidad.innerText=entrada.cantidad_entrada;
        personalReintegro.innerText=entrada.id_trabajador_reintegro;
        documento.innerText=entrada.documento;
        // Se concatena el nombre y apellido del trabajador y se asigna en al elemento html para mostrarlo
        arrayPersonal.forEach((persona)=>{
          if(entrada.id_trabajador_reintegro===persona.id.toString()){
            nomPersonalReintegro.innerText=persona.nombre;
          }
            });
        
        almacenista.innerText=entrada.id_trabajador_recibe;
        // Se agregan elementos hijos a las celdas
        celdaFecha.appendChild(fecha);          
        celdaProveedor.appendChild(proveedor); 
        celdaNumEntrada.appendChild(numEntrada); 
        celdaCodigo.appendChild(codigo); 
        celdaDescripcion.appendChild(descripcion);
        celdaUnidad.appendChild(unidad);
        celdaCantidad.appendChild(cantidad);
        celdaPersonalReintegro.appendChild(personalReintegro);
        celdaNomPersonalReintegro.appendChild(nomPersonalReintegro);
        celdaAlmacenista.appendChild(almacenista);
        celdaDocumento.appendChild(documento);

        // Se agregan celdas a cada fila, dependiendo de la opcion de busqueda seleccionada se agregan determinadas celdas
        filaMaterial.appendChild(celdaFecha);
        if (radioButtonCompra.checked || radioButtonFecha.checked){
          filaMaterial.appendChild(celdaProveedor); 
        } 
        if(elemento==='fecha_entrada' || elemento==='num_documento'){
          filaMaterial.appendChild(celdaNumEntrada);
        }
        if(elemento==='num_entrada'){
          filaMaterial.appendChild(celdaCodigo);    
          filaMaterial.appendChild(celdaDescripcion);  
          filaMaterial.appendChild(celdaUnidad);  
          filaMaterial.appendChild(celdaCantidad); 
        }
        if(radioButtonReintegro.checked || radioButtonFecha.checked){
          filaMaterial.appendChild(celdaPersonalReintegro);
          filaMaterial.appendChild(celdaNomPersonalReintegro);
        }
        filaMaterial.appendChild(celdaAlmacenista);   
        if(elemento==='num_documento'){
          filaMaterial.appendChild(celdaDocumento);  
        } 

        //Se agregan filas al cuerpo de la tabla 
        bodyTabla.appendChild(filaMaterial);
    });
}
async function obtenerEntradas(agrupadas){
    let response=await fetch(`${API}/agrupada/${agrupadas}`);
    let data=await response.json();   
    if(agrupadas==='true'){
      arrayEntradasAgrupadas=data; 
    }else{
      arrayEntradas=data;
    }
}
// se llama funcion para obtener las entradas de materiales
// Entradas agrupadas
obtenerEntradas('true');
// Entradas sin agrupar
obtenerEntradas('false');
// Se obtiene listado del personal operativo
obtenerPersonal();