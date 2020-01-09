var table;
$(function() {
    // Setting datatable defaults
    $.extend($.fn.dataTable.defaults, {
        autoWidth: false,
        dom:
            '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: "<span>Filter:</span> _INPUT_",
            searchPlaceholder: "Type to filter...",
            lengthMenu: "<span>Show:</span> _MENU_",
            paginate: {
                first: "First",
                last: "Last",
                next: "&rarr;",
                previous: "&larr;"
            }
        }
    });

    table = $("#order-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columns: [
            { data: "rownum", searchable: false },
            { data: "order_code" },
            { data: "customer.name" },
            { data: "action", searchable: false, orderable: false }
        ]
    });
});
