//function to show-hide and empty options for every field in the form bays with one fiber:
const remark = (selectedValue, indexx) => {
    let _id = `${selectedValue.value}_${indexx}`; //esta linea es para convertir al tipo id del option list y no tome el value
    const textBoxEmpty = document.getElementById(`textBoxEmpty_${indexx}`);
    const selectDamage = document.getElementById(`selectDamage_${indexx}`);

    textBoxEmpty.style.display = "none";
    selectDamage.style.display = "none";
    
    textBoxEmpty.value = "";
    selectDamage.value = "";

    textBoxEmpty.removeAttribute("required");
    selectDamage.removeAttribute("required");

    if (_id == `empty_${indexx}`) { //comparar por id del select 
        textBoxEmpty.style.display = "block";
        textBoxEmpty.setAttribute("required", "required");  
    } else if (_id == (`damage_${indexx}`) || _id == (`bad_${indexx}`)) {
        selectDamage.style.display = "block";
        selectDamage.setAttribute("required", "required");
    }
} // end remark
//function to show-hide and empty options for every field in the form orange and blue fiber:
//Orange option
const remarK_orange = (selectedValue_orange, indexX) => {    
    let idOrange = `${selectedValue_orange.value}_${indexX}_orange`;//esta linea es para convertir al tipo id del option list y no tome el value
    const textBoxEmpty = document.getElementById(`textBoxEmpty_${indexX}_orange`);
        const selectDamage = document.getElementById(`selectDamage_${indexX}_orange`);        
        /**Las dos proximas lineas de codigo, son para que se limpien los campos cada que se selecciona una nueva opcion en el select de Option en Orange*/
        textBoxEmpty.style.display = "none"
        selectDamage.style.display = "none"        
          
        textBoxEmpty.value = ""
        selectDamage.value = ""       

        textBoxEmpty.removeAttribute("required");
        selectDamage.removeAttribute("required");

    if (idOrange == `empty_${indexX}_orange`) {
        textBoxEmpty.style.display = "block"                
        textBoxEmpty.setAttribute("required", "required");                  
    } else if ((idOrange == (`damage_${indexX}_orange`)) || (idOrange == (`bad_${indexX}_orange`))) {        
        selectDamage.style.display = "block"    
        selectDamage.setAttribute("required", "required");
    } 
} // end remark_orange

//Blue option
const remarK_blue = (selectedValue_blue, indexX) => {    
    let idBlue = `${selectedValue_blue.value}_${indexX}_blue`;//esta linea es para convertir al tipo id del option list y no tome el value       
    const textBoxEmpty = document.getElementById(`textBoxEmpty_${indexX}_blue`);
    const selectDamage = document.getElementById(`selectDamage_${indexX}_blue`);
    textBoxEmpty.style.display = "none"
    selectDamage.style.display = "none"        
      
    textBoxEmpty.value = ""
    selectDamage.value = ""       

    textBoxEmpty.removeAttribute("required");
    selectDamage.removeAttribute("required");      

    if (idBlue == `empty_${indexX}_blue`) {
        textBoxEmpty.style.display = "block"   
        textBoxEmpty.setAttribute("required", "required");                          
    } else if ((idBlue == (`damage_${indexX}_blue`)) || (idBlue == (`bad_${indexX}_blue`))) {        
        selectDamage.style.display = "block"    
        selectDamage.setAttribute("required", "required");
    } 
} // end remark_blue

/**
 * Objeto para inicializar el JSON proveniente de la consulta SELECT en php, 
 * y poder consumirlo cuando sea necesario:
 */
let objJson = {
    jsonInicializado: "",
    get getJson() {
        return this.jsonInicializado;
    }
};

const mapColor = (indice, colorFound) => {
    const data = objJson.getJson;
    const matchingItem = data.find(item => item.index === indice && item.color === colorFound);
    if (matchingItem) {        
      return matchingItem.color;
    } else {
      return null; // o cualquier otro valor que quieras devolver en caso de no encontrar ningún objeto
    }
  }; 

const mapFunction = (indice) => {    
    const data = objJson.getJson;    
    contadorIndices = 0;    
    data.forEach(function (item) {
        if (item.color) {
            if (indice == item.index) {                                 
                contadorIndices++;
            }           
        } else {
            if (indice == item.index) {                           
                contadorIndices++;
            }
        }          
    });   
    return contadorIndices;
} // end mapFunction

let generateDisabledFields = {
    _indiceTabla: 0,
    _color: "",     
    _indiceJson: 0,
    
    set color(newColor) {
        this._color = newColor;
    },
    set indiceTabla(newIndice) {
        this._indiceTabla = newIndice;
    },
    set indexToFind(newIndiceJson) {
        this._indiceJson = newIndiceJson;
    },
    
    get getColorsFiber() {
        /**get para fibras de color */
        let color = this._color;
        const data = objJson.getJson;        
        let indiceTabla = this._indiceTabla;
        let indiceJson = this._indiceJson;
        let respuesta = "";
        
        data.forEach(function (item) {
            if (item.color == color && item.index == indiceJson) {                
                let convertColor = item.color.charAt(0).toUpperCase() + item.color.slice(1);                    
                respuesta += `
                <td><label class="checkbox-container">${convertColor}<input type="checkbox" name="${item.color}_${indiceTabla}" value="${item.color}" required checked disabled><span class="checkmark"></span></label>
                <input type="text"  name="location_${indiceTabla}_${item.color}" id="location_${indiceTabla}_${item.color}" value="${item.location}" required disabled readonly>
                <input type="text" name="textBoxEmpty_${indiceTabla}_${item.color}" id="textBoxEmpty_${indiceTabla}_${item.color}" value="${item.remark}" required disabled readonly>
                <label>Reported by last shif</label></td>`;                    
            } 
        });
        return respuesta;
    },
    
    get getSimple() {
        /**get para una sola fibra */
        const data = objJson.getJson;
        let indiceTabla = this._indiceTabla;
        let indiceJson = this._indiceJson;
        let respuesta = "";        
        data.forEach(function (item) {            
            if (indiceJson == item.index) {                                
                respuesta += `<td><input type="text" name="location_${indiceTabla}" id="location_${indiceTabla}" value="${item.location}" required disabled readonly>
                <label>Reported by last shif</label></td>
                <td><input type="text" name="textBoxEmpty_${indiceTabla}" id="textBoxEmpty_${indiceTabla}" value="${item.remark}" disabled readonly>
                <label>Reported by last shif</label></td>`;                                    
            } // end if            
        }); // end forEach
        //console.log(respuesta);
        return respuesta;
    } // end getSimple                                         
}; // end generateDisabledFields


let generateColorHTML = (color, baya) => {
    /**Al recibir el paramtro 'color', ya sea orange o blue. Se convierte la cadena
     * con la primer letra en mayuscula y las demas en minusculas...
     * color.charAt(0): convierte la primer letra del valor de la cadena 'color' en mayuscula.
     * + color.slice(1)// concatena el resto del valor de la cadena 'color':
     * Entonces seria orange por Orange y blue por Blue:
     */
    let convertColor = color.charAt(0).toUpperCase() + color.slice(1);
    return `<td>
                  <label class="checkbox-container">${convertColor}<input type="checkbox" id="${color}_${baya}" name="${color}_${baya}" value="${color}" onclick="this.checked ? document.getElementById('location_${baya}_${color}').disabled = false : document.getElementById('location_${baya}_${color}').disabled = true;" required><span class="checkmark"></span></label>
                  <select input name="location_${baya}_${color}" id="location_${baya}_${color}" class="" onchange="remarK_${color}(this, ${baya});" required disabled>
                      <option aling="center" value=""></option>
                      <option aling="center" id="damage_${baya}_${color}" value='damage'> Damage </option>
                      <option aling="center" id="good_${baya}_${color}" value="good"> Good </option>
                      <option aling="center" id="bad_${baya}_${color}" value="bad"> Bad </option>
                      <option aling="center" id="empty_${baya}_${color}" value="empty"> Empty </option>
                  </select>
                  <input type="text" name="textBoxEmpty_${baya}_${color}" id="textBoxEmpty_${baya}_${color}" pattern="[A-Za-z0-9 ]+" value="" placeholder="type..." style="display:none;">
                  <select name="selectDamage_${baya}_${color}" id="selectDamage_${baya}_${color}" style="display:none;">
                      <option value="" selected></option>
                      <option value="Broken cable but functional">Broken Cable/Functional</option>
                      <option value="Ripped fiber">Ripped fiber</option>
                      <option value="Requires fiber">Requires fiber</option>
                  </select>
            </td>`;
} // end generateColorHTML   

let generateTableHTML = (locIndex) => {

    return `<td>
        <select input name="location_${locIndex}" id="location_${locIndex}" onchange="remark(this, ${locIndex});" required>
            <option aling="center" value=''></option>
            <option aling="center" name='Damage' id='damage_${locIndex}' value='damage'> Damage </option>
            <option aling="center" name='Good' id='good_${locIndex}' value='good'> Good </option>
            <option aling="center" name='Bad' id='bad_${locIndex}' value='bad'> Bad </option>
            <option aling="center" name='Empty' id='empty_${locIndex}' value='empty'> Empty </option>
        </select>
        </td>
        <td>
            <input type="text" name="textBoxEmpty_${locIndex}" id="textBoxEmpty_${locIndex}" pattern="[A-Za-z0-9 ]+" value="" placeholder="type..." style="display:none;">                        
            <select name="selectDamage_${locIndex}" id="selectDamage_${locIndex}" style="display:none;">
                <option value="" selected></option>
                <option value="Broken cable but functional">Broken Cable/Functional</option>
                <option value="Ripped fiber">Ripped fiber</option>
                <option value="Requires fiber">Requires fiber</option>
            </select> 
        </td>`;
} // end generateTableHTML

const createPrincipalTable = (selectorBay) => {
    /**
     * Crear la tabla con base al contenido del JSON en respuesta del php (select):
     */
    const bay_1 = { startInic: 1, fin: 20 };
    const bay_2 = { startInic: 21, fin: 40 };
    const bay_3 = { startInic: 41, fin: 60 };
    const bay_4 = { startInic: 61, fin: 80 };
    const bay_5 = { startInic: 81, fin: 100 };
    const bay_6 = { startInic: 101, fin: 120 };
    const bay_7 = { startInic: 121, fin: 140 }; //aplica para MDIAG y Bay_7                
    const bay_8 = { startInic: 141, fin: 160 };
    const nautilus = { startInic: 1, fin: 10 };
    let bahiaSelected;
    let isValuesInJSON = 0;
    /* Seleccionar el Array de acuerdo al value del 'Select' */
    
    if (selectorBay == 'mdiag') {
        bahiaSelected = eval(bay_7);
    } else {
        bahiaSelected = eval(selectorBay);
    }
    let empieza = bahiaSelected.startInic;
    let filas = bahiaSelected.fin;
    let tabla = "";    
    let counterLocations = 1;

    for (let i = empieza; i <= filas; i++) {
        tabla += "<tr>";
        if ((selectorBay == 'bay_3') || (selectorBay == 'bay_5')) {
            tabla += `<th>Location: ${i}</th>`;
                isValuesInJSON = mapFunction(counterLocations);            
                if (isValuesInJSON > 0) {                                        
                    /**Si hay dos indices en la misma fila: */
                    generateDisabledFields.indiceTabla = i;   
                    generateDisabledFields.indexToFind = counterLocations;  
                    if (isValuesInJSON == 2) {                           
                        generateDisabledFields.color = "orange";                        
                        tabla += generateDisabledFields.getColorsFiber;
                        generateDisabledFields.color = "blue";
                        tabla += generateDisabledFields.getColorsFiber;
                    } else if (isValuesInJSON == 1) {                                     
                        let colorIs = (mapColor(counterLocations, "orange")) ? "orange" : mapColor(counterLocations, "blue");                                                                               
                            if (colorIs == "orange") {                               
                                generateDisabledFields.color = colorIs;                                                            
                                //generateDisabledFields.indexToFind = counterLocations;
                                tabla += generateDisabledFields.getColorsFiber;
                                tabla += generateColorHTML("blue", i);
                            } else if (colorIs == "blue") {                    
                                tabla += generateColorHTML("orange", i)           
                                generateDisabledFields.color = colorIs;                                                            
                                //generateDisabledFields.indexToFind = counterLocations;
                                tabla += generateDisabledFields.getColorsFiber;
                            }                       
                    }                                                                                                                                                  
                    tabla += "</tr>";             
                    counterLocations++;                  
                } else {
                    tabla += generateColorHTML("orange", i) + generateColorHTML("blue", i);
                    tabla += "</tr>"; 
                    counterLocations++;                   
                }//end if respuesta           
        } else {
            if (selectorBay == 'mdiag') {
                tabla += `<th>MD_${i}</th>`;                
            } else {
                tabla += `<th>Location: ${i}</th>`;                    
            }            
            isValuesInJSON = mapFunction(counterLocations);            
            if (isValuesInJSON > 0) {                       
                generateDisabledFields.indiceTabla = i;     
                generateDisabledFields.indexToFind = counterLocations;
                tabla += generateDisabledFields.getSimple;                
                tabla += "</tr>";             
                counterLocations++;
            } else {
                tabla += generateTableHTML(i);
                tabla += "</tr>";
                counterLocations++;
            } //end if respuesta                            
        }
    } //end for filas
    tabla += "</tr>";
    return tabla;
} // end function 'crear'

/**Funcion para hacer la consulta antes de mostrar el formulario 
 * Bay seleccionada:
 */
const selectCheck = (selectedByUser) => {    
    let baySelected = selectedByUser.value;
    if (baySelected == "select") {
        const shiftTable = document.getElementById('shiftTable');
        const tableConstructor = document.getElementById('tableConstructor');
        const advert = document.getElementById('advert');

        shiftTable.style.display = "none";
        tableConstructor.innerHTML = "";
        advert.style.display = "block";
        objJson.jsonInicializado = [{ "index": "", "location": "", "remark": "" }];
    } else {

        fetch('php/select_check.php', {
            method: 'POST',
            headers: {'Content-type': 'application/x-www-form-urlencoded'},
            body: `selected=${baySelected}`
        })
        .then(response => {
            if (response.ok) {
                return response.text();
            } else {
                throw new Error('An error occurred while submitting the request.');
            }
        })
        .then(responseText => {
            let ajaxRequest = responseText.trim();
            //console.log(responseText);
            if (ajaxRequest == "Error" || ajaxRequest == "Error statement" || ajaxRequest == "Error query") {
                alert(`${ajaxRequest}, contact with Data Mining !`);
                window.location.href = "./principal.php";
            } else {
                if (ajaxRequest == "good") {
                    objJson.jsonInicializado = [{ "index": "", "location": "", "remark": "" }];
                    makeFormBays(baySelected);
                } else {
                    
                    const newJson = JSON.parse(ajaxRequest);                                        
                    objJson.jsonInicializado = newJson.data;
                    makeFormBays(baySelected);
                }
            } //end if ajaxRequest
        })
        .catch(error => console.error(error));
    }// end if else

} // end selectCheck       

/**
 * Objeto para inicializar variable con el valor del
 * elemento del Select principal asociado, este objeto
 * se creo con el fin de usar el boton 'Clean':
 */
let iniciarVariable = {
    variableIniciada: "",
    get getVariable() {
        return this.variableIniciada;
    }
};

const makeFormBays = (selectorBay) => {
    iniciarVariable.variableIniciada = selectorBay;
    let btnAction = iniciarVariable.getVariable;
    /*esta misma variable bntAction se usa para asignar la propiedad 
    'name' del boton del formulario creado por Bay para 
    poder cacharlo en el php y hacer el respectivo insert a la DB*/
    const shiftTable = document.getElementById('shiftTable');
    shiftTable.style.display = "block";
    const advert = document.getElementById('advert');
    advert.style.display = "none";    

    const table = `<table cellpadding='0' cellspacing='2' class='table'>
                                            <thead>
                                                <tr>                                            
                                                    <th aling="center"><h3>Location</h3></th>
                                                    <th aling="center"><h3>Option</h3></th>
                                                    <th aling="center"><h3>Remark</h3></th>                        
                                                </tr>
                                            </thead>
                                                <tbody id="tbodyContent"></tbody>
                                                <tr>
                                                    <th class="remark-all">Remark all</th>
                                                    <td aling="left" colspan="2">
                                                    <input type="text" size="auto" id="remarktext" name="remarktext" pattern="[A-Za-z0-9 ]+" required>
                                                    </td>
                                                </tr>                                       
                                                <tr class="upload-image">   
                                                    <th>
                                                        Upload image: 
                                                    </th>                                         
                                                    <td aling="center" colspan="2">
                                                        <div>
                                                            <div id="image_${btnAction}" class="input-value"></div>
                                                            <label for="file_${btnAction}"></label>
                                                            <input type="file" id="file_${btnAction}" name="file_${btnAction}"> 
                                                        </div>   
                                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                                    </td>                                                                                 
                                                </tr>                                    
                                                <tr>                                            
                                                    <td align="center" colspan="3">
                                                        <input type="reset" name="Borrar" id="Borrar" value="Clean" onclick="resetForm();">                                                
                                                        <input type="submit" name="${btnAction}" id="enviar" value="Send">
                                                    </td>                                                                                        
                                                </tr>
                                        </table>`;
    document.querySelector("#tableConstructor").innerHTML = table;
    const $dinamicTable = createPrincipalTable(selectorBay);
    document.querySelector("#tbodyContent").innerHTML = $dinamicTable;   

} // end functio 'makeFormBays'

/**
 * Funcion para cuando se pulsa el boton 'Clean'
 */
const resetForm = () => {
    const inicializado = iniciarVariable.getVariable;
    let campo1, campo2, campo3;
    const bays = {
        'bay_1': { start: 1, end: 20 },
        'bay_2': { start: 21, end: 40 },
        'bay_3': { start: 41, end: 60 },
        'bay_4': { start: 61, end: 80 },
        'bay_5': { start: 81, end: 100 },
        'bay_6': { start: 101, end: 120 },
        'bay_7': { start: 121, end: 140 },
        'mdiag': { start: 121, end: 140 },
        'bay_8': { start: 141, end: 160 },
        'nautilus': { start: 1, end: 10 }
    };
    const { start = 0, end = 0 } = bays[inicializado] || {}; // Asigna valores predeterminados y maneja si `inicializado` no está en la matriz `bays`.

    for (let i = start; i <= end; i++) {
        if (inicializado == `bay_3` || inicializado == `bay_5`) {
            const colores = ['orange', 'blue'];
            for (let color of colores) {
                //console.log(`Color: ${color}, Indice: ${i}`);
                campo1 = document.getElementById(`${color}_${i}`);
                campo2 = document.getElementById(`textBoxEmpty_${i}_${color}`);
                campo3 = document.getElementById(`selectDamage_${i}_${color}`);
                document.getElementById(`location_${i}_${color}`).disabled = true;
                if (campo1 && campo2 && campo3) {
                    campo1.style.display = 'none';
                    campo2.style.display = 'none';
                    campo3.style.display = 'none';
                }
            }
        } else {
            campo1 = document.getElementById(`textBoxEmpty_${i}`);
            campo2 = document.getElementById(`selectDamage_${i}`);
            if (campo1 && campo2) { // Verifica si los elementos existen antes de intentar ocultarlos
                campo1.style.display = 'none';
                campo2.style.display = 'none';
            }
        } // endf if inicializado                        

    } // end for                 
}; // end function resetForm
