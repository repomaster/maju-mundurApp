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

    table = $("#product-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: url + "/merchant/products/ajax",
        columns: [
            { data: "rownum", searchable: false },
            { data: "name" },
            { data: "stock", searchable: false },
            { data: "price", searchable: false },
            { data: "description", orderable: false, searchable: false },
            { data: "action", orderable: false, searchable: false }
        ]
    });
});
