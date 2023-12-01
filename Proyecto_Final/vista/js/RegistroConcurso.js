document.addEventListener("DOMContentLoaded",()=>{
    document.getElementById("btnGuardar").addEventListener('click',
    (e)=>{
    
    
    // Ejemplo de JavaScript inicial para deshabilitar el envío de formularios si hay campos no válidos
    (function () {
        'use strict'
    
        // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
        var forms = document.querySelectorAll('.needs-validation')
    
        // Bucle sobre ellos y evitar el envío
        Array.prototype.slice.call(forms)
        .forEach(function (form) {
            
            form.addEventListener('submit', function (event) {
                console.log("Hello");
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
            }, false)
            
        })
    })()
    
    
    let frm=document.getElementsByTagName("form")[0];
    if(frm.checkValidity()){

        //Cancelar el submit para que más adelante la 
        //redirección sí funcione
        e.preventDefault();
        
        location.replace('indexAdmin.html');
    }    
});
})