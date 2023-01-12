function validar(){
  var nombre,apellido,email,telefono,precio;

  nombre = document.getElementById("nombre").value;
  apellido = document.getElementById("apellido").value;
  email = document.getElementById("email").value;
  telefono = document.getElementById("telefono").value;
  precio = document.getElementById("precio").value;

if (nombre == "" || apellido ==="" || email ==="" || telefono ==="" || precio ==="") {
  alert("todos los campos son obligatorios");
  return false;
}
else if (nombre.length>20) {
  alert("el nombre del producto es muy largo");
  return false;
}
}