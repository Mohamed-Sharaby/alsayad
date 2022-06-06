/**
* Theme: Adminto Admin Template
* Author: Coderthemes
* Component: Datatable
*
*/

var handleDataTableButtons = function() {
    "use strict";
    0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
        dom: "Bfrtip",
        buttons: [
            // {
        //     extend: "copy",
        //     className: "btn-sm"
        // }, {
        //     extend: "csv",
        //     className: "btn-sm"
        // },
        //     {
        //     extend: "excel",
        //     className: "btn-sm",
        //         text:'تصدير اكسيل'
        // },
        //     {
        //     extend: "pdf",
        //     className: "btn-sm"
        // },
            {
            extend: "print",
                text:'طباعة',
            className: "btn-sm",
                customize: function (win) {
                    $(win.document.body).css('direction', 'rtl');
                }
        }
        ],
        responsive: !0
    })
},
TableManageButtons = function() {
    "use strict";
    return {
        init: function() {
            handleDataTableButtons()
        }
    }
}();
