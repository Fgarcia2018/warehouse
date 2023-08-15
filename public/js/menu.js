// Obtener elementos del menu desplegable
const dropdownTitle = document.querySelector('.dropdown .title');
const dropdownOptions = document.querySelectorAll('.dropdown .option');
const dropdownTitle2 = document.querySelector('.dropdown2 .title2');
const dropdownOptions2 = document.querySelectorAll('.dropdown2 .option2');
//vincula listeners a estos elementos para el menu desplegable
dropdownTitle.addEventListener('mouseover', toggleMenuDisplay);
dropdownOptions.forEach(option => option.addEventListener('click',handleOptionSelected));
// dropdownTitle2.addEventListener('mouseover', toggleMenuDisplay);
// dropdownOptions2.forEach(option2 => option2.addEventListener('click',handleOptionSelected));
// document.querySelector('.dropdown .title').addEventListener('change',handleTitleChange);
//========================================================================================================================
//                                   Bloque para el menú desplegable
// =======================================================================================================================

function toggleClass(elem,className){
	if (elem.className.indexOf(className) !== -1){
		elem.className = elem.className.replace(className,'');
	}
	else{
		elem.className = elem.className.replace(/\s+/g,' ') + 	' ' + className;
	}	
	return elem;
}

function toggleDisplay(elem){
	const curDisplayStyle = elem.style.display;			
				
	if (curDisplayStyle === 'none' || curDisplayStyle === ''){
		elem.style.display = 'block';
	}
	else{
		elem.style.display = 'none';
	}
}

function toggleMenuDisplay(e){
	const dropdown = e.currentTarget.parentNode;
	// const dropdown2 = e.currentTarget.parentNode;
	console.log(e.currentTarget.parentNode);
	const menu = dropdown.querySelector('.menu');
	// const menu2 = dropdown2.querySelector('.menu2');
	toggleClass(menu,'hide');
	// toggleClass(menu2,'hide');
}

function handleOptionSelected(e){
	toggleClass(e.target.parentNode, 'hide');
	const id = e.target.id;
	const newValue = e.target.textContent + ' ';
	const titleElem = document.querySelector('.dropdown .title');
	titleElem.textContent = newValue;
	//Activa evento personalizado
	document.querySelector('.dropdown .title').dispatchEvent(new Event('change'));
	// document.querySelector('.dropdown2 .title2').dispatchEvent(new Event('change'));
	//setTimeout se usa para que la transición se muestre correctamente
}

