const SendJsonToPhp = (json, fileData) => {          
  let btn = document.getElementById('enviar').name;      
  let formData = new FormData();
    if (fileData != null || fileData != "") {
      formData.append('file', fileData); 
    }  

  formData.append('json', json);
  formData.append('button', btn);

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "php/insert_chk_lst.php", true, xhr.responseType = "json");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.readyState === 4 && xhr.status === 200) {                                 
          if (xhr.response == "true") {
            alert("Data stored successfully.");    
            //console.log(xhr.response);        
            window.location.href="./principal.php";  
          } else {
            alert(`Error [ ${xhr.response} ], contact with Data Mining !`);
            //console.log(xhr.response);
            window.location.href="./principal.php";
          }                      
      } else {
        console.error(xhr.statusText);
        alert("Error server, contact with Data Mining !");
        window.location.href="./principal.php";
      }
    }
  };
  xhr.send(formData);
        
} // end SendJsonToPhp

document.addEventListener("DOMContentLoaded", function (e) {          
  const form = document.querySelector('form');  
  form.onsubmit = function(e) {
    let buttSelected = document.getElementById('enviar').name;
    let remarktext = document.getElementById('remarktext').value;        
    let fileUpload = document.getElementById(`file_${buttSelected}`).files[0];
    let cont = 0; //monitorea las iteraciones una sola fibra y orange
    let contBlue = 0; //monitorea las iteraciones de la fibra azul    
    const objBay = {"bay_1": 1,"bay_2": 21,"bay_3": 41,"bay_4": 61,"bay_5": 81,"bay_6": 101,"bay_7": 121,"bay_8": 141};
        
    cont = (buttSelected == "nautilus") ? objBay["bay_1"] : objBay[buttSelected];
    contBlue = (buttSelected === 'bay_3' || buttSelected === 'bay_5') ? objBay[buttSelected] : contBlue;
    
    e.preventDefault();              
    let jsonFormData = new FormData();
    let flag = "true";
    
    if (remarktext != "") {
      for (let input of form.elements) {
        if ((input.name !== 'Borrar') && (input.id !== 'enviar')) {
          if (input.type === 'file') {
            continue;
          }
          if (input.value.trim().length > 0 && input.name) { //con esta linea valido si el campo no esta vacio para poder ser parte del JSON                       
             jsonFormData.append(input.name, input.value);
              if ( (input.name == `location_${cont}`) ) {
                if (input.value != "good") flag = "false";                                  
                cont++;                              
              } else if ( input.name == `location_${cont}_orange` ) {              
                        if (input.value != "good") flag = "false";                                             
                        cont++; 
              } else if ( input.name === `location_${contBlue}_blue` ) {              
                        if (input.value != "good") flag = "false";
                        contBlue++; 
              }
          } // end if inputs   
        } // end if para omitir botones en json
      } //end for

      jsonFormData.append("flag", flag);          
    
    //Crear el JSON en formato vertical, se logra con 'null, 2', sin esto se crea el JSON pero 'informal'
    let json = JSON.stringify(Object.fromEntries(jsonFormData.entries()), null, 2);
    if (json === "" || json === null) {
      alert('Error in JSON, contact with Data Mining !');
      window.location.href="./principal.php";
    } else {      
      SendJsonToPhp(json, fileUpload);      
      //console.log(json);
    }    
    } else {
      alert("Missing Remark all.");
    }
    
  }//end function (e) 
});