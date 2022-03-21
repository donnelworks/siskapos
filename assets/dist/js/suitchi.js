(function( $ ){
   $.fn.suitchi = function(elTwo) {
     var elOne = this;

     $(this).css('display', 'none');
     $(elTwo).css('display', 'block');

     $('.dismiss-suitchi').click(function(){
       var suitchiTable = $(this).data('suitchi-table');
       $(elTwo).css('display', 'none');
       $(elOne).css('display', 'block');
       $('.form-control').removeClass('is-invalid');
       $('.invalid-message').remove();
       if (suitchiTable != undefined) {
         reloadTable(suitchiTable);
       }
     });

     return this;
   };
})( jQuery );
