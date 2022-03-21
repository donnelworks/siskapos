(function( $ ){
   $.fn.loadTable = function(props) {
     var table = this;
     $(table).DataTable({
       ajax: {
         url: props.url,
         type: "post",
         data: function ( d ) {
           var formData = $(props.dataFilter).serializeArray();
           $.each(formData, function(key, val) {
             d[val.name] = val.value;
           });
         }
       },
       columns: props.columns,
       order: props.order,
       pageLength: props.pageLength,
       responsive: true,
       processing: true,
       serverSide: true,
       searching: false,
       lengthChange: false,
       oLanguage: {
         sProcessing: 'Mohon Tunggu...',
         sInfo: '_START_ s/d _END_ dari _TOTAL_ data',
         sEmptyTable: '<span class="text-teal">Tidak Ada Data</span>',
         sInfoEmpty: '0 data'
       },
     });

     // Filter
     $('.filter-data').click(function(e){
       e.preventDefault();
       var filterTable = $(this).data('filter-table');
       reloadTable(filterTable);
     });

     // Reset Filter
     $('.reset-filter-data').click(function(e){
       e.preventDefault();
       var filterTable = $(this).data('filter-table');
       var filterForm = $(this).data('filter-form');
       var periodForm = $(this).data('periode-form');
       if (periodForm) {
         setPeriode(periodForm, false);
       }
       $(filterForm).trigger('reset');
       reloadTable(filterTable);
     });

   };
})( jQuery );
