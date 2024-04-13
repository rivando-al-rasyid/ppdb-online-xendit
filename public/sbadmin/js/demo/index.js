$(document).ready(function () {
    $("#dataTable").DataTable({
        paging: true, // Adjusted to true to demonstrate setting pageLength; set to false if you do not want paging
        pageLength: 25, // Default page length set to 25; adjust as needed
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
                pageSize: "LEGAL",
            },
        ],
    });
});
