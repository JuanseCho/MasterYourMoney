$(function () {
    
        new DataTable('#tabla_historialDeUso', {
            responsive: {
                details: {
                    display: DataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return 'Details for ' + data[0] + ' ' + data[1];
                        }
                    }),
                    renderer: DataTable.Responsive.renderer.tableAll({
                        tableClass: 'table'
                    })
                }
            },
        
        search: {
            return: true
        },
        paging: false,
        scrollY: 300
        
    });
})
