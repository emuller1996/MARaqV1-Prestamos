$(document).ready(function () {
  const tablePrestamo = $("#table-prestamos").DataTable({
    language: language,
    searching: true,
    responsive: true,
  });

  $("#input-search-prestamo").on("keyup", function () {
    var valorBusqueda = $(this).val(); // Obtener el valor del campo de búsqueda
    // Aplicar el filtro al DataTable por la columna de nombre
    tablePrestamo.search(valorBusqueda, true, false).draw();
  });
  $(".dt-search").addClass("d-none");

  $("#filter-status-prestamo").on("change", (e) => {
    console.log(e.target.value);
    if (e.target.value === "TODOS") {
      tablePrestamo.column(3).search("").draw();
    } else {
      tablePrestamo.column(3).search(e.target.value).draw();
    }
  });
});
