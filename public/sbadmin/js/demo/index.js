$(document).ready(function () {
    $("#dataTable").DataTable({
        dom: "Bfrtip",
        buttons: [
            "copy",
            "csv",
            "excel",
            {
                extend: "pdfHtml5",
                orientation: "landscape",
                pageSize: "LEGAL",
            },
        ],
    });
});
