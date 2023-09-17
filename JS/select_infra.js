/** GLOBALS */
let btnCheck = document.querySelector('#btnCheck');
let bayselected = document.querySelector('#bayselected');
// Modal
let modal = document.getElementById("ventanaModal");
let closemodal = document.querySelector("#closemodal");
let exclose = document.querySelectorAll("#close");
let applychanges = document.getElementById('applychanges');
//Table
let theads = document.querySelector('#theads');
let tbodys = document.querySelector('#tbodys');
//Arrays
let arrrepairedLocations = [];
let arrlocationsSelectedBay = [];
//Arrays
const arrBays = {
    'BAY 1': { start: 1, end: 20 },
    'BAY 2': { start: 21, end: 40 },
    'BAY 3': { start: 41, end: 60 },
    'BAY 4': { start: 61, end: 80 },
    'BAY 5': { start: 81, end: 100 },
    'BAY 6': { start: 101, end: 120 },
    'BAY 7': { start: 121, end: 140 },
    'MDIAG': { start: 121, end: 140 },
    'BAY 8': { start: 141, end: 160 },
    'NAUTILUS': { start: 1, end: 10 }
};

const setId = {
    idi: 0,
    get getIdi() {
        return this.idi;
    }
} // end setId

const setBay = {
    bay: "",
    get getBay() {
        return this.bay;
    }
} // end setId

function functionToggle() {
    let chkLocation = document.querySelectorAll("input[name='chkLocation']");
    
    chkLocation.forEach((something) => {
        something.addEventListener('change', function(objInput) {            
            let indexx = objInput.currentTarget.attributes.indiceinput.value;
            let repairedLoc = "";
            let remarkLoc = "";
            let repairedLocIndex = "";
            let remarkLocIndex = "";
            let colores = "";
            let locationtextBay = null;
            let locationtextremarkBay = null;
            let tempLocation = arrlocationsSelectedBay[indexx-1];

            locationtextBay = document.getElementById(`Loc_${indexx}`);
            locationtextremarkBay = document.getElementById(`Remark_Loc_${indexx}`);
                         
            //Variables for control 'arrrepairedLocations' when Infra user check and uncheck the slide button
            repairedLocIndex = `Loc_${indexx} = 'good'`;
            remarkLocIndex = `Remark_Loc_${indexx} = '-'`;
            
            if (objInput.currentTarget.attributes.inputcolor) {                
                colores = objInput.currentTarget.attributes.inputcolor.value;
                locationtextBay = document.getElementById(`loc_${colores}_${indexx}`);
                locationtextremarkBay = document.getElementById(`remark_${colores}_${indexx}`);       
                
                repairedLocIndex = `loc_${colores}_${indexx} = 'good'`;
                remarkLocIndex = `remark_${colores}_${indexx} = '-'`;
            }

            if (this.checked) {                
                // console.log(objInput.currentTarget.attributes); // verify attributes from input check                                                                                   
                if (colores === "orange" || colores === "blue") {                                                               
                    repairedLoc = `loc_${colores}_${indexx} = 'good'`;
                    remarkLoc = `remark_${colores}_${indexx} = '-'`;                   
                    
                    locationtextBay.innerHTML = "good";
                    locationtextremarkBay.innerHTML = "-";      
                    
                    arrrepairedLocations.push(repairedLoc);
                    arrrepairedLocations.push(remarkLoc);                 
                    
                    //Enable button Apply changes:
                    applychanges.disabled = (arrrepairedLocations.length > 0) ? false : true;    
                } else {
                    //Enable button Apply changes:
                    applychanges.disabled = false;                                                                         
                    repairedLoc = `Loc_${indexx} = 'good'`;
                    remarkLoc = `Remark_Loc_${indexx} = '-'`;
                                        
                    locationtextBay.innerHTML = "good";
                    locationtextremarkBay.innerHTML = "-";  
                    
                    arrrepairedLocations.push(repairedLoc);
                    arrrepairedLocations.push(remarkLoc);   
                    
                     //Enable button Apply changes:
                     applychanges.disabled = (arrrepairedLocations.length > 0) ? false : true;
                } // end else                                                               
            } else {
                if (objInput.currentTarget.attributes.inputcolor) {
                    locationtextBay.innerHTML = (colores === "orange") ? tempLocation.locationO : tempLocation.locationB;
                    locationtextremarkBay.innerHTML = (colores === "orange") ? tempLocation.remarkO : tempLocation.remarkB;  
                    
                    //console.log(`Before: ${arrrepairedLocations}`);                    
                    let indexfound = arrrepairedLocations.indexOf(repairedLocIndex);                                                          
                    if (indexfound > -1) {
                        arrrepairedLocations.splice(indexfound, 2);                        
                    }        

                    /** The last 4 code lines, are equals like this:
                     * let indexfound = -1;
                        for (let i = 0; i < arrrepairedLocations.length; i++) {
                            if (arrrepairedLocations[i] === repairedLocIndex) {
                                indexfound = i;
                                break;
                            }
                        }

                        if (indexfound > -1) {
                        let newArr = [];
                        for (let i = 0; i < arrrepairedLocations.length; i++) {
                            if (i !== indexfound && i !== indexfound + 1) {
                            newArr[newArr.length] = arrrepairedLocations[i];
                            }
                        }
                        arrrepairedLocations = newArr;
                        }
                     */

                    applychanges.disabled = (arrrepairedLocations.length > 0) ? false : true;
                    //console.log(`After: ${arrrepairedLocations}`);                    
                } else {
                    locationtextBay.innerHTML = tempLocation.location;
                    locationtextremarkBay.innerHTML = tempLocation.remark;      
                                        
                    //console.log(`Before: ${arrrepairedLocations}`);                                      
                    let indexfound = arrrepairedLocations.indexOf(repairedLocIndex);                                        
                    if (indexfound > -1) {
                        arrrepairedLocations.splice(indexfound, 2);                        
                    }        
                    
                    applychanges.disabled = (arrrepairedLocations.length > 0) ? false : true;
                    //console.log(`After: ${arrrepairedLocations}`);                                                          
                }                 
            } // end this.checked
        }); // end eventListener
    }); // end foreach
} // end functionToggle()

function showResults(params) {    
    const parametroConsulta1 = params.attributes; // El valor del parámetro que deseas enviar    
    const idiParam = parametroConsulta1.attid.value;
    const parametroConsulta = parametroConsulta1.value.value;            
    setBay.bay = params.value;
    arrrepairedLocations = [];

    var formData = new URLSearchParams();
    formData.append('idis', idiParam);
    formData.append('param', parametroConsulta);

    /** Si tubiera que enviar la info con la siguiente estructura:
     *  var formData = new FormData();
        formData.append('idis', idiParam);
        formData.append('param', parametroConsulta);
        
        Se hace esto:
        fetch('php/yourScript.php', {
            method: 'POST',
            headers: {'Content-Type': 'multipart/form-data'}, // Se utiliza este header, en mi caso, lo hago por URL, por eso cambia el Objeto que va en el body 
            fetch(`php/consultLocations.php?param=${encodeURIComponent(idiParam)}`) //Esto funciona bien cuando solo se envia un parametro y el header tambien va con: application/x-www-form-urlencoded
            Y el body
            body: formData
        })

        en caso de enviar un JSON: 
        fetch('php/yourScript.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(jsonData)
        })        
     */

    try {
        fetch('php/consultLocations.php', {
                method: 'POST',
                headers: {'Content-type': 'application/x-www-form-urlencoded'},
                body: formData
            }
        )
        .then(response => response.json())
        .then(data => {    
            let arrResReceived = data.data;      
            arrlocationsSelectedBay = data.data; // Array used to control the locations when the toggle check is Checked or Unchecked
            setId.idi = data.idi;                                      
            bayselected.innerHTML = params.value;                            
            const { start = 0, end = 0 } = arrBays[params.value] || {};

            let theadString = "";                     
            let rowString = "";

            let contHead = 0;
            let contOrange = 0;
            let contBlue = 0;  
            let counterSelector = 1;  
            
            /** Make table head */                
            for (let index = start; index <= end; index++) {                        
                let location = arrResReceived[contHead].location;                                    
                let _checked = (location === "good") ? "checked": "";                        
                let _disabled = (location === "good") ? "disabled": "";                        
                
                if (parametroConsulta === 'BAY 3' || parametroConsulta === 'BAY 5') {                            
                    let colorLocOrange = arrResReceived[contOrange].colorO;                                    
                    let colorLocBlue = arrResReceived[contBlue].colorB;                                    
                    theadString += `<th colspan="3">
                                        <div class="flex-column">
                                            <div>Location ${index}</div>
                                            <div class="flex-row">
                                                <div>
                                                    Orange:
                                                    <label class="switch">
                                                        <input type="checkbox" indiceinput="${counterSelector}" inputcolor="${colorLocOrange}" name="chkLocation" id="locacion_${index}_orange" ${_checked} ${_disabled}>
                                                        <span class="slider round"></span>                                                    
                                                    </label>
                                                </div>
                                                <div>
                                                    Blue: 
                                                    <label class="switch">
                                                        <input type="checkbox" indiceinput="${counterSelector}" inputcolor="${colorLocBlue}" name="chkLocation" id="locacion_${index}_blue" ${_checked} ${_disabled}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                <div>
                                            </div>
                                        <div>
                                    </th>`;   
                                    contOrange++;             
                                    contBlue++;                                                         
                } else {                            
                    theadString += `<th colspan="2">
                                        <div class="flex-column">
                                            <div>Location ${index}</div>
                                            <label class="switch">
                                                <input type="checkbox" name="chkLocation" indiceinput="${counterSelector}" id="locacion_${index}"  ${_checked} ${_disabled}>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </th>`;                
                }             
                contHead++;         
                counterSelector++;                                                                                 
            } // end for  
            theads.innerHTML = theadString;                            
            
            /** Make table body */
            if (parametroConsulta === 'BAY 3' || parametroConsulta === 'BAY 5') { 
                let counterSelector = 1;   
                for (let i = 0; i < arrResReceived.length; i++) {
                    let item = arrResReceived[i];                                                                                                         
                            rowString += `<td id="tdbold"><div class"divtd"><p class="text-orange">${item.colorO}</p><p class="text-blue">${item.colorB}</p></div></td>`;
                            rowString += `<td><p id="loc_${item.colorO}_${counterSelector}">${item.locationO}</p><p id="loc_${item.colorB}_${counterSelector}">${item.locationB}</p></td>`;
                            rowString += `<td><p id="remark_${item.colorO}_${counterSelector}">${item.remarkO}</p><p id="remark_${item.colorB}_${counterSelector}">${item.remarkB}</p></td>`;                                
                        counterSelector++        
                } // end for                                                 
            } else {
                let counterSelector = 1;
                for (let i = 0; i < arrResReceived.length; i++) {
                    let item = arrResReceived[i];                            
                    rowString += `<td class="tdbold" id="Loc_${counterSelector}">${item.location}</td>`;
                    rowString += `<td id="Remark_Loc_${counterSelector}">${item.remark}</td>`; 
                    counterSelector++;                           
                } // end for  
            }
                                                                    
            tbodys.innerHTML = rowString;
            modal.style.display = "block";    
            
            functionToggle(); //function to asign functionality to the toggle check            
        })
        .catch(error => {                
            console.error(error);
        });    
    } catch (error) {
        alert(error);
    }
        
} // end showResults

// Close modal when the user makes click outside it:
window.addEventListener("click", (event) => {
    if (event.target == modal) {
        applychanges.disabled = true;
        modal.style.display = "none";
    }
});

//Button Close
closemodal.addEventListener("click", () => {
    modal.style.display = "none";
});    

// Close modal when the user makes click on 'x':
exclose.forEach((elemento) => {
    elemento.addEventListener("click", () => {          
        if (modal.style.display === "block") {                
            applychanges.disabled = true;
            modal.style.display = "none";
        } 
    });           
});

//Verify Status Flag after Apply changes by Infra:
const verifyFlag = () => {
    let jsonRepair = JSON.stringify(arrrepairedLocations);    
    //Enable button Apply changes:
    applychanges.disabled = true;   
    //Reset Array:
    arrrepairedLocations = [];
          
    let formData = new FormData();
    formData.append('idi', setId.getIdi);
    formData.append('bay', setBay.getBay);    
     
     const xhr = new XMLHttpRequest();
     xhr.open("POST", "php/verify_status_flag.php", true, xhr.responseType = "json");
     xhr.send(formData);
     xhr.onreadystatechange = function() {
       if (xhr.readyState === XMLHttpRequest.DONE) {
         if (xhr.readyState === 4 && xhr.status === 200) {                                    
             if (xhr.response.statusis) {                                          
                alert(xhr.response.msg);                       
             } else {                
                alert(`Error: [${xhr.response.msg}]`);                             
             }                      
         } else {    
            modal.style.display = "none";      
            alert(`Server error: ${xhr.statusText}!`);          
         }
       }
     }; // end onreadystatechange  
} // end verifyFlag

//Apply changes by infra:
applychanges.addEventListener('click', () => {   
    if (arrrepairedLocations.length > 0) {
        let jsonRepair = JSON.stringify(arrrepairedLocations);    
        //Enable button Apply changes:
        applychanges.disabled = true;   
        //Reset Array:
        arrrepairedLocations = [];
            
        let formData = new FormData();
        formData.append('idi', setId.getIdi);
        formData.append('bay', setBay.getBay);
        formData.append('json', jsonRepair);
        
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "php/update_check_list.php", true, xhr.responseType = "json");
        xhr.send(formData);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.readyState === 4 && xhr.status === 200) {                                    
                    if (xhr.response.statusis) {   
                        modal.style.display = "none";                            
                        alert(xhr.response.msg)
                        verifyFlag();                            
                    } else {
                        modal.style.display = "none";
                        alert(`Error: [${xhr.response.msg}]`);                             
                    }                      
                } else {    
                    modal.style.display = "none";      
                    alert(`Server error: ${xhr.statusText}!`);          
                }
            }
        }; // end onreadystatechange         
    } else {
        alert('The information that you trying to send is empty !');
    }                
}); // end applychanges click

document.addEventListener('DOMContentLoaded', () => {
    fetch('php/select_infra.php', {
        method: 'POST',               
    })
    .then(response => {
        if (response.ok) {                        
            return response.json();
        } else {
            throw new Error('An error occurred while submitting the request.');
        }
    })
    .then(data => {         
        let arrData = [];
        arrData = data.data;                
        let fillSelect = '';                                
        
        arrData.forEach((element) => {            
            if (element[0].bayname !== '') {                
                fillSelect += `<input type="button" id="btnCheck" class="fill-primary" attId="${element[0].bayId}" value="${element[0].bayname}" onclick="showResults(this);">`;                                        
            }
        });        
        btnCheck.innerHTML = fillSelect;
      
    }) // end then        
    .catch(error => console.error(error));
});