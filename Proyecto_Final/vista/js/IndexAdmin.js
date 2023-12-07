let mdlConfirmacion;

document.addEventListener('DOMContentLoaded', () => {
    mdlConfirmacion = document.getElementById('mdlConfirmacion');
    mdlConfirmacion.addEventListener('show.bs.modal', event => {
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
});

function confirmar(btn) {
    // Colocar en el span el nombre de quien eliminar
    const mdlEliminar = new bootstrap.Modal('#mdlConfirmacion', {
        backdrop: 'static'
    });
    mdlEliminar.show(btn);
}
