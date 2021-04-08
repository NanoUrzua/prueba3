window.addEventListener("load", function() {
    formAgregarPolera.precio.addEventListener("keypress", soloNumeros, false);
  });

  function soloNumeros(e){
    var key = window.event ? e.which : e.keyCode;
    if (key < 48 || key > 57) {
      e.preventDefault();
    }
  }

  function mostrarMensaje1(){
    alert('alerta');
    }
    