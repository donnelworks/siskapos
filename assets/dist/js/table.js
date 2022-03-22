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
       scrollX: props.scrollX,
       responsive: props.responsive,
       processing: true,
       serverSide: true,
       searching: false,
       lengthChange: false,
       fixedColumns: props.fixedColumns,
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

     $(table).on('click', '.btn-menu-table', function() {
       dropmenuPostion();
     });

     function dropmenuPostion() {
       var dropdownMenu;

       $(window).on('show.bs.dropdown', function(e) {
         dropdownMenu = $(e.target).find('.dropdown-menu');
         $('body').append(dropdownMenu.detach());
         var eOffset = $(e.target).offset();

         dropdownMenu.css({
           'display': 'block',
           'top': eOffset.top + $(e.target).outerHeight(),
           'left': eOffset.left - 50
         });
       });

       $(window).on('hide.bs.dropdown', function(e) {
         $(e.target).append(dropdownMenu.detach());
         dropdownMenu.hide();
       });
     }

   };
})( jQuery );
