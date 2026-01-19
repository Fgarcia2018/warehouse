const API='https://warehouseproject.wuaze.com/apimaterial';

  let arrayMateriales=[];  
  let filtro=[];
let etiquetas;
let datos;
    async function obtenerMateriales(){
        let response=await fetch(API);
        let data=await response.json();   
        arrayMateriales=data;    
        console.log(arrayMateriales);
        filtro=arrayMateriales.filter((material)=>{
        return parseInt(material.stock)>0
    	});
          etiquetas=filtro.map(item=>item.descripcion);
          datos=filtro.map(item=>parseInt(item.stock));
         const ctx = document.getElementById('miGrafico').getContext('2d');
    	const miGrafico = new Chart(ctx, {
        type: 'bar', // Puede ser 'line', 'pie', 'doughnut', etc.
        data: {
            
            labels:etiquetas, // Eje X
            datasets: [{
                label: 'Cantidad Materiales',
                data: datos, // Datos numéricos
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true, // Se ajusta al tamaño del contenedor
            scales: {
                y: {
                    beginAtZero: true // El eje Y comienza en cero
                },
                
                 x: { // Cambia a 'x' en Chart.js v3/v4+
                    ticks: {
                        minRotation: 65, // Rotación mínima de 45 grados
                       // maxRotation: 90  // Rotación máxima de 90 grados
                    	},
                     	font:{
                            size:8
                        }
                
            	}
        }
    }       
       
    })
 }                                

   

 obtenerMateriales();	

//window.onload=function(){   

    	
     
   
	
   
//};
 


    


