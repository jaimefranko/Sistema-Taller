const form = document.getElementById("loginform");
const usuario = document.getElementById("usuario");
const contraseña = document.getElementById("clave");
const errorMsg = document.getElementById("error");

form.addEventListener("submit", function(e){
    e.preventDefault(); 
    
    if(usuario.value.trim() === "" || contraseña.value.trim() === ""){
        errorMsg.textContent = "Todos los campos, deben de ser rellenados";
        return;
    } 
    
    if(usuario.value.trim().length < 3){
        errorMsg.textContent = "El usuario debe ser mayor a 2 caracteres";
        return;
    }
    
    if(contraseña.value.length < 6){
        errorMsg.textContent =  "La contraseña debe tener al menos 6 caracteres";
        return;
    } 
    
    form.submit();
});
