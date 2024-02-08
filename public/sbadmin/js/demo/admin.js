$(document).ready(function() {
  $('#dataTable').DataTable( {
      dom: 'Bfrtip',
      buttons: [
          'copy', 'csv', 'excel',

      ],
      scrollX: true,
  });
});
