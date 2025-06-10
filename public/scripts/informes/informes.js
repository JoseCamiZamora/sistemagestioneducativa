function generarReportePorPeriodo() {
  var idCurso = $('#curso').val();
  var idAnio = $('#anio').val();
  var idPeriodo = $('#periodo').val();

  $('.preloader').fadeIn();
  var urlraiz = $("#url_raiz_proyecto").val();
  var miurl = urlraiz + "/informes/pdf_infomre_periodo/" + idCurso + "/" + idAnio + "/" + idPeriodo;

  $.ajax({
    url: miurl,
    type: 'GET',
    dataType: 'json',
    success: function(resul) {
      if (resul.url) {
        // Abre el PDF en una nueva pestaña
        window.open(resul.url, '_blank');
      } else {
        alert("No se recibió la URL del PDF.");
      }
      $('.preloader').fadeOut();
    },
    error: function() {
      $('.preloader').fadeOut();
      SU_revise_conexion(); // función de error personalizada
    }
  });
}

