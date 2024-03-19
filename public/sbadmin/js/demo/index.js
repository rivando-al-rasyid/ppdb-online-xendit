$(document).ready(function () {
    $("#dataTable").DataTable({
        paging: false,
        scrollCollapse: true,
        scrollX: true,
        dom: "Bfrtip",
        buttons: [
            "copy",
            "csv",
            "excel",
            {
                extend: "pdfHtml5",
                orientation: "landscape",
                pageSize: "legal",
            },
        ],
    });
});
