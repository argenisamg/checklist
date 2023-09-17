/** GLOBALS */
let btnCheck = document.querySelector('#btnCheck');
let bayselected = document.querySelector('#bayselected');
// Modal
let modal = document.getElementById("ventanaModal");
let closemodal = document.querySelector("#closemodal");
let exclose = document.querySelectorAll("#close");
//Table
let theads = document.querySelector('#theads');
let tbodys = document.querySelector('#tbodys');

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

function showResults(params) {    
    const parametroConsulta = params.value; // El valor del parámetro que deseas enviar    
        fetch(`php/consultLocations.php?param=${encodeURIComponent(parametroConsulta)}`)
            .then(response => response.json())
                .then(data => {    
                    let arrResReceived = data.data;                                            
                    bayselected.innerHTML = params.value;                            
                    const { start = 0, end = 0 } = arrBays[params.value] || {};

                    let theadString = "";                     
                    let rowString = "";

                    for (index = start; index <= end; index++) {
                        if (parametroConsulta === 'BAY 3' || parametroConsulta === 'BAY 5') {                            
                            theadString += `<th colspan="3">Location ${index}
                                                <label class="switch">
                                                    <input type="checkbox" id="amgcheck">
                                                    <span class="slider round"></span>
                                                </label>
                                            </th>`;                
                        } else {                            
                            theadString += `<th colspan="2">Location ${index}
                                                <label class="switch">
                                                    <input type="checkbox" id="amgcheck">
                                                    <span class="slider round"></span>
                                                </label>
                                            </th>`;                
                        }
                    }
                    theads.innerHTML = theadString;                                                         

                    let cont = 1;
                    if (parametroConsulta === 'BAY 3' || parametroConsulta === 'BAY 5') {
                        for (let i = 0; i < arrResReceived.length - 1; i+=2) {
                            let item1 = arrResReceived[i];                            
                                let item2 = arrResReceived[cont];
                                if (cont <= arrResReceived.length) {                                                                                       
                                    rowString += `<td id="tdbold">${item1.color}</br></br></br>${item2.color}</td>`;
                                    rowString += `<td>${item1.location}</br></br></br>${item2.location}</td>`;
                                    rowString += `<td>${item1.remark}</br></br></br>${item2.remark}</td>`;                                                                
                                    cont += 2;                           
                                }
                        } // end for    
                    } else {
                        for (let i = 0; i < arrResReceived.length; i++) {
                            let item1 = arrResReceived[i];                            
                            rowString += `<td id="tdbold">${item1.location}</td>`;
                            rowString += `<td>${item1.remark}</td>`;                            
                        } // end for  
                    }
                                                                           
                    tbodys.innerHTML = rowString;
                    modal.style.display = "block";                                 
                })
                .catch(error => {                
                    console.error(error);
                });    
} // end selectDamageLocations

// Close modal when the user makes click outside it:
window.addEventListener("click", (event) => {
    if (event.target == modal) {
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
            modal.style.display = "none";
        } 
    });           
});


document.addEventListener('DOMContentLoaded', () => {
    fetch('php/select_infra.php', {
        method: 'POST',
        headers: {'Content-type': 'application/x-www-form-urlencoded'}        
    })
    .then(response => {
        if (response.ok) {                        
            return response.json();
        } else {
            throw new Error('An error occurred while submitting the request.');
        }
    })
    .then(data => { 
        // console.log(data.data); 
        let arrData = [];
        arrData = data.data;        
        let fillSelect = '';        
        arrData.forEach((element) => {
            fillSelect += `<input type="button" id="btnCheck" class="fill-primary" value="${element.bay}" onclick="showResults(this);">`;                                        
        });        
        btnCheck.innerHTML = fillSelect;
      
    }) // end then        
    .catch(error => console.error(error));
});