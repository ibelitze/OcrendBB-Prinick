
function goReg() {

      var connect, form, response, result, user, pass, tyc, pass_dos;

      user= document.getElementById('user_reg').value;
      pass= document.getElementById('pass_reg').value;
      pass_dos= document.getElementById('pass_reg_dos').value;
      email= document.getElementById('email_reg').value;
      tyc= document.getElementById('tyc_reg').checked? true: false;


      if(tyc){

        if(user!=''  && pass!=''  && pass_dos!=''  && email!=''){
          //Si todos los campos fueron rellenados:
          if(pass_dos === pass){

            form= "user=" + user +  "&pass=" + pass + "&email="+ email;
            //Si el navegador es muy viejo, se usa ActiveXObject... de resto, todos los navegadores usan XMLHttpRequest
                connect= window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

            //Cuando haya un movimiento, petición, recepción o algo nuevo entre AJAX y PHP
                connect.onreadystatechange= function(){
                  
                  if(connect.readyState== 4 && connect.status== 200){

                    //Si todo salió bien...
                        if(connect.responseText== 1){
                          result= ' <div class="alert alert-dismissible alert-Success">';
                          result +=    '<h4>Registro completado!</h4>';
                          result +=    '<p>Bienvenido, te estamos redireccionando...</p></div>';
                          __('_AJAX_REG_').innerHTML= result;
                          location.reload();
                        }
                        else{
                          __('_AJAX_REG_').innerHTML= connect.responseText;
                        }

                  //Aquí todavía no se ha recibido información de PHP.. así que ponemos a esperar al usuario
                      }
                      else if(connect.readyState!= 4){
                        result= ' <div class="alert alert-dismissible alert-warning">';
                        result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                        result +=    '<h4>Espere!</h4>';
                        result +=    '<p>Estamos procesando los datos. Solo tomará unos segundos...</p></div>';
                        __('_AJAX_REG_').innerHTML= result;
                      }

                }

            //Enviamos los datos tipo POST, le indicamos que tipo de codificación debe usar con el POST,
            //Enviamos el formulario (form)
                connect.open('POST', 'ajax.php?mode=reg', true);
                connect.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                connect.send(form);

          }
          //Error si las contraseñas no coinciden en el registro
          else {
            result= ' <div class="alert alert-dismissible alert-danger">';
            result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
            result +=    '<h4>ERROR</h4>';
            result +=    '<p>Las contraseñas introducidas deben coincidir.</p></div>';
            __('_AJAX_REG_').innerHTML= result;
          }
        }
        //Error si no pasa la comprobación (los campos están vacíos, o algunos)
        else {
          result= ' <div class="alert alert-dismissible alert-danger">';
          result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
          result +=    '<h4>ERROR</h4>';
          result +=    '<p>Debe llenar todos los datos del formulario.</p></div>';
          __('_AJAX_REG_').innerHTML= result;
        }

        //Si no ha aceptado los términos y condiciones.
      }else {
        result= ' <div class="alert alert-dismissible alert-danger">';
        result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        result +=    '<h4>ERROR</h4>';
        result +=    '<p>Debe aceptar los términos y condiciones.</p></div>';
        __('_AJAX_REG_').innerHTML= result;
      }

}




//Esto para poder usar la tecla ENTER para enviar el formulario
function runScriptReg(event){
  // si la tecla presionada es igual al número ASCI de la tecla ENTER
  if(event.keyCode == 13){
    goReg();
  }
}
