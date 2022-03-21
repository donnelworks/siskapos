// Boostrap Custom Input
bsCustomFileInput.init();

// Select
$('.select').select2({
  theme: 'bootstrap4'
});

// Tooltip
$('[data-toggle="tooltip"]').tooltip();

// Scrollbar
$('.scrollbar').overlayScrollbars(
  {
  	className       : "os-theme-thin-dark",
  	resize          : "none",
  	sizeAutoCapable : true,
  	paddingAbsolute : true,
  	scrollbars : {
      visibility: "auto",
      autoHide: "leave",
      autoHideDelay: 800,
  		clickScrolling : true
  	}
  }
);

// Select Number Input
$('.number').click(function(){
  $(this).select();
});

// Blur Number Input
$('.number').blur(function(){
  if ($(this).val() == "") {
    $(this).val(0);
  }
});

// Periode
function setPeriode(period, autoFill)
{
  $(period).daterangepicker({
    showDropdowns: true,
    autoUpdateInput: autoFill ? true : false,
    startDate: new Date(),
    endDate: new Date(),
    locale: {
       "format": "DD-MM-YYYY",
       "separator": " s/d ",
       "applyLabel": "Terapkan",
       "cancelLabel": "Reset",
       "fromLabel": "Dari",
       "toLabel": "Sampai",
       "weekLabel": "M",
       "daysOfWeek": [
           "Min",
           "Sen",
           "Sel",
           "Rab",
           "Kam",
           "Jum",
           "Sab"
       ],
       "monthNames": [
           "Januari",
           "Februari",
           "Maret",
           "April",
           "Mei",
           "Juni",
           "Juli",
           "Agustus",
           "September",
           "Oktober",
           "November",
           "Desember"
       ],
       "firstDay": 1
   },
  });

  $(period).on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format("DD-MM-YYYY") + " s/d " + picker.endDate.format("DD-MM-YYYY"));
  });

  $(period).on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
    $(this).data('daterangepicker').setStartDate(new Date());
    $(this).data('daterangepicker').setEndDate(new Date());
  });
}

// Reload DataTable
function reloadTable(table)
{
  $(table).DataTable().one('draw', function (){
    $(table).DataTable().columns.adjust().responsive.recalc();
  }).ajax.reload(null, false);
}

// On Loading Element
function loadingElementOn(el)
{
  $(el).LoadingOverlay("show", {
    background: "rgba(255, 255, 255, 0)",
    image: "",
    imageAnimation: "2s rotate_right",
    fontawesome: "fas fa-circle-notch fa-spin",
    fontawesomeColor: "#f1b44c",
    fontawesomeAutoResize: true,
    fontawesomeResizeFactor: 0.5,
  });
}

// Off Loading Element
function loadingElementOff(el)
{
  $(el).LoadingOverlay("hide", true);
}

// On Loading Screen
function loadingScreenOn()
{
  $.LoadingOverlay("show", {
    background: "rgba(0, 102, 102, 0.8)",
    image: "",
    imageAnimation: "2s rotate_right",
    fontawesome: "fas fa-circle-notch fa-spin",
    fontawesomeColor: "#f1b44c",
    fontawesomeAutoResize: false,
    fontawesomeResizeFactor: 0.5,
  });
}

// Off Loading Screen
function loadingScreenOff()
{
  $.LoadingOverlay("hide");
}

// On Loading Link
function loadingLinkOn(el, icon = null)
{
  $(el).addClass('disabled')
  .prepend('<i class="bx bx-loader-alt bx-spin" id="iconSpin"></i>');
  if (icon != null) {
    var iconA = icon.split(" ")[0];
    var iconB = icon.split(" ")[1];
    $(el).find("."+iconA+"."+iconB).remove();
  }
}

// Off Loading Link
function loadingLinkOff(el, icon = null)
{
  $(el).removeClass('disabled');
  $('#iconSpin').remove();
  if (icon != null) {
    var iconA = icon.split(" ")[0];
    var iconB = icon.split(" ")[1];
    $(el).prepend('<i class="'+iconA+' '+iconB+'"></i>');
  }
}

// On Loading Tombol
function loadingBtnOn(el)
{
  $(el).prop('disabled', true)
  .prepend('<i class="bx bx-loader-alt bx-spin mr-2" id="iconSpin"></i>');
}

// Off Loading Tombol
function loadingBtnOff(el)
{
  $(el).prop('disabled', false);
  $('#iconSpin').remove();
}

// Alert Sukses
function alertSukses(alert)
{
  toastr.success(alert);
}

// Alert Error
function alertError(alert)
{
  toastr.error(alert);
}

// Angka Random 6 Digits
function randNumb(min, max){
  return Math.floor(Math.random()*(max-min+1)+min);
}

// Tanggal Biasa Normal
function tgl(string)
{
  var p = string.split(/\D/g);
  return [p[2],p[1],p[0] ].join("-");
}

// Tanggal dan Jam
function tglJam(string)
{
  bulanIndo = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep' , 'Okt', 'Nov', 'Des'];
  date = string.split(" ")[0];
  time = string.split(" ")[1];
  tanggal = date.split("-")[2];
  bulan = date.split("-")[1];
  tahun = date.split("-")[0];
  return tanggal + " " + bulanIndo[Math.abs(bulan)] + " " + tahun + " - " + time;
}

// Tanggal Indo
function tglIndo(string)
{
  bulanIndo = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep' , 'Okt', 'Nov', 'Des'];
  tanggal = string.split("-")[2];
  bulan = string.split("-")[1];
  tahun = string.split("-")[0];
  return tanggal + " " + bulanIndo[Math.abs(bulan)] + " " + tahun;
}

// Bulan Indo
function blnIndo(string)
{
  bulanIndo = ['', 'JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGT', 'SEP' , 'OKT', 'NOV', 'DES'];
  return bulanIndo[Math.abs(string)];
}

// Load Number Input
function loadNumber()
{
  $('.number').number( true, 2, ',', '.');
  $('.number').click(function(){
    $(this).select();
  });
  $('.number').blur(function(){
    if ($(this).val() == "") {
      $(this).val(0);
    }
  });
}
