$(document).ready(function(){
    $("#ejecutaMensaje").click(function(){
        EjecutarMensaje();
    });
});

function confirmaAlertas(){
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
          });
        }
      });
}

function confirmaAlertas(mensaje,ruta){
    Swal.fire({
        title: "Alerta?",
        text: mensaje,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar!"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = ruta
        }
      });
}


function soloNumeros(evt) {
  key = (document.all) ? evt.keyCode : evt.which;
  //alert(key);
  if (key == 17) return false;
  /* digitos,del, sup,tab,arrows*/
  return ((key >= 48 && key <= 57) || key == 8 || key == 127 || key == 9 || key == 0);
}

function buscadorInterno(ruta){
 //alert(ruta+'?b='+document.getElementById('b').value);

  if(document.getElementById('b').value == 0){
    return false;
  }
  window.location = ruta+'?b='+document.getElementById('b').value;

}