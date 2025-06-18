function generarReportePorPeriodo() {

  var idCurso = $('#curso').val();
  var idAnio = $('#anio').val();
  var idPeriodo = $('#periodo').val();
  var todoCompleto = true;
  if(idAnio == ""){
    todoCompleto = false;
    toastr.warning('Antes de generar el reporte debes seleccionar el año.', 'Atención');
    return;
  }
  if(idCurso == ""){
    todoCompleto = false;
    toastr.warning('Antes de generar el reporte debes seleccionar el curso', 'Atención');
    return;
  }
  if(idPeriodo == ""){
    todoCompleto = false;
    toastr.warning('Antes de generar el reporte debes seleccionar el periodo', 'Atención');
    return;
  }
  var rutaUrl = '';
  if(idCurso == 1){
    rutaUrl = "pdf_infomre_periodo_transicion"
  }else{
    rutaUrl = "pdf_infomre_periodo";
  }

  if(todoCompleto){
  $('.preloader').fadeIn();
    var urlraiz = $("#url_raiz_proyecto").val();
    var miurl = urlraiz + "/informes/"+rutaUrl+"/" + idCurso + "/" + idAnio + "/" + idPeriodo;

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
  
}

function generarReporteDirectorGruopo(idAnio, idCurso){
  
  var idPeriodo = $('#periodo').val();
  var todoCompleto = true;
  if(idPeriodo == ""){
    todoCompleto = false;
    toastr.warning('Antes de generar el reporte debes seleccionar el periodo', 'Atención');
    return;
  }

  if(todoCompleto){
  $('.preloader').fadeIn();
    var urlraiz = $("#url_raiz_proyecto").val();
    var miurl = urlraiz + "/informes/pdf_informe_director_grupo/" + idCurso + "/" + idAnio + "/" + idPeriodo;

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


}





