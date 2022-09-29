$("document").ready(function () {
    $(".data-table").DataTable({
        scrollY: 300,
        scrollX: true,
        scrollCollapse: true,
        fixedHeader: true,
        columnDefs: [
            {
                targets: "datatable-nosort",
                orderable: false,
            },
        ],
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
        language: {
            info: "_START_-_END_ of _TOTAL_ entries",
            searchPlaceholder: "Search",
            paginate: {
                next: '<i class="ion-chevron-right"></i>',
                previous: '<i class="ion-chevron-left"></i>',
            },
        },
    });

    $(".data-table-export").DataTable({
        scrollY: 300,
        scrollX: true,
        scrollCollapse: true,
        fixedHeader: true,
        columnDefs: [
            {
                targets: "datatable-nosort",
                orderable: false,
            },
        ],
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
        language: {
            info: "_START_-_END_ of _TOTAL_ entries",
            searchPlaceholder: "Search",
            paginate: {
                next: '<i class="ion-chevron-right"></i>',
                previous: '<i class="ion-chevron-left"></i>',
            },
        },
        dom: "Bfrtp",
        buttons: ["copy", "csv", "pdf", "print"],
    });

    $(".data-table-excel").DataTable({
        scrollY: 300,
        scrollX: true,
        scrollCollapse: true,
        fixedHeader: true,
        columnDefs: [
            {
                targets: "datatable-nosort",
                orderable: false,
            },
        ],
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
        language: {
            info: "_START_-_END_ of _TOTAL_ entries",
            searchPlaceholder: "Search",
            paginate: {
                next: '<i class="ion-chevron-right"></i>',
                previous: '<i class="ion-chevron-left"></i>',
            },
        },
        dom: "Bfrtp",
        buttons: [
            {
                extend: "excel",
                text: "Export to Excel",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
                },
            },
        ],
    });

    var table = $(".select-row").DataTable();
    $(".select-row tbody").on("click", "tr", function () {
        if ($(this).hasClass("selected")) {
            $(this).removeClass("selected");
        } else {
            table.$("tr.selected").removeClass("selected");
            $(this).addClass("selected");
        }
    });

    var multipletable = $(".multiple-select-row").DataTable();
    $(".multiple-select-row tbody").on("click", "tr", function () {
        $(this).toggleClass("selected");
    });
    var table = $(".checkbox-datatable").DataTable({
        scrollY: 300,
        scrollX: true,
        scrollCollapse: true,
        fixedHeader: true,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
        language: {
            info: "_START_-_END_ of _TOTAL_ entries",
            searchPlaceholder: "Search",
            paginate: {
                next: '<i class="ion-chevron-right"></i>',
                previous: '<i class="ion-chevron-left"></i>',
            },
        },
        columnDefs: [
            {
                targets: 0,
                searchable: false,
                orderable: false,
                className: "dt-body-center",
                render: function (data, type, full, meta) {
                    return (
                        '<div class="dt-checkbox"><input type="checkbox" name="id[]" value="' +
                        $("<div/>").text(data).html() +
                        '"><span class="dt-checkbox-label"></span></div>'
                    );
                },
            },
        ],
        order: [[1, "asc"]],
    });

    $("#example-select-all").on("click", function () {
        var rows = table.rows({ search: "applied" }).nodes();
        $('input[type="checkbox"]', rows).prop("checked", this.checked);
    });

    $(".checkbox-datatable tbody").on(
        "change",
        'input[type="checkbox"]',
        function () {
            if (!this.checked) {
                var el = $("#example-select-all").get(0);
                if (el && el.checked && "indeterminate" in el) {
                    el.indeterminate = true;
                }
            }
        }
    );
});
