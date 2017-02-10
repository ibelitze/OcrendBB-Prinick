
function goLostpass() {

      var connect, form, response, result, email;

      email= document.getElementById('email_lostpass').value;

      //Si el campo email está vacío...
      if(email == ''){
        result= ' <div class="alert alert-dismissible alert-danger">';
        result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        result +=    '<h4>ERROR </h4>';
        result +=    '<p>Por favor, rellene el campo del email</p></div>';
        __('_AJAX_LOSTPASS_').innerHTML= result;

      }

  // Si todo sale bien y se comprueba el campo con javascript
      else {

        form= "email=" + email;
        //Si el navegador es muy viejo, se usa ActiveXObject... de resto, todos los navegadores usan XMLHttpRequest
            connect= window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

        //Cuando haya un movimiento, petición, recepción o algo nuevo entre AJAX y PHP
            connect.onreadystatechange= function(){

              if(connect.readyState== 4 && connect.status== 200){

                //Si todo salió bien...
                    if(connect.responseText== 1){
                      result= ' <div class="alert alert-dismissible alert-Success">';
                      result +=    '<h4>Se ha enviado el correo</h4>';
                      result +=    '<p>Revisa tu bandeja de entrada y haz click en el enlace..</p></div>';
                      __('_AJAX_LOSTPASS_').innerHTML= result;
                      window.location.reload();
                    }
                    else{
                      __('_AJAX_LOSTPASS_').innerHTML= connect.responseText;
                      // window.location.reload();
                    }
              }

              //Aquí todavía no se ha recibido información de PHP.. así que ponemos a esperar al usuario
              if(connect.readyState!= 4){
                result= ' <div class="alert alert-dismissible alert-warning">';
                result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                result +=    '<h4>Espere!</h4>';
                result +=    '<p>Estamos enviándote el email para el cambio de contraseña...</p></div>';
                __('_AJAX_LOSTPASS_').innerHTML= result;
              }

            }// fin del onreadystatechange

        //Enviamos los datos tipo POST, le indicamos que tipo de codificación debe usar con el POST,
        //Enviamos el formulario (form)
            connect.open('POST', 'ajax.php?mode=lostpass', true);
            connect.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            connect.send(form);

          }// FIN DEL else




} // FIN DEL goLostpass


function runScriptLostpass(event){
  // si la tecla presionada es igual al número ASCI de la tecla ENTER
  if(event.keyCode == 13){
    goLostpass();
  }
}
