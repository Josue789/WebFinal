$(document).ready(function() {
    let mdlConfirmacion;

    mdlConfirmacion = new bootstrap.Modal(document.getElementById('mdlConfirmacion'), {
        backdrop: 'static',
        keyboard: false
    });

    mdlConfirmacion._element.addEventListener('show.bs.modal', function (event) {
        let clave = event.relatedTarget.value;
        // Cargar el nombre de la persona a eliminar tomado de la primera celda
        document.getElementById("spnPersona").innerText =
            event.relatedTarget.closest("tr").children[0].innerText;

        // Cargar la clave en el value del botón "SI"
        document.getElementById("btnConfirmar").value = clave;
        console.log(clave);
    });

    $("#lista").DataTable({
        dom: 'Bfrtip',
        buttons: [
            'pageLength',
        ],
        stateSave: true,
        searching: true,
    });

    const searchInput = $('input[type="search"]');
    searchInput.on('input', function () {
        const searchValue = $(this).val();
        $('#lista').DataTable().search(searchValue).draw();
    });

    function confirmar(btn) {
        // Colocar en el span el nombre de quien eliminar
        mdlConfirmacion.show(btn);
    }

    window.confirmar = confirmar;
});
