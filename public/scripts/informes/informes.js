function infoEstudiantes(idCurso){
  var idAnio = document.getElementById("anio1").value;
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/informes/info_estudiantes_cursos/"+idAnio+"/"+idCurso+"";
  $.ajax({
  // la URL para la petición
    url : miurl,
  })
  .done(function(resul) {
    var dataC = resul.estudiantes;
    var mateHtmlteams = '';
    mateHtmlteams = '<option value="" class="" selected>Seleccione...</option>';
    dataC.forEach(function(curso){
      mateHtmlteams += '<option value="'+curso.id+'" class="">'+curso.nombre_estudiante+'</option>';
    })
    $('#estudiante1').html(mateHtmlteams);
    document.getElementById("estudiante1").disabled = false;

  $('.preloader').fadeOut();
     
  }).fail(function(err){
      $('.preloader').fadeOut();
      SU_revise_conexion();    
  });

}

function infoEstudiantes2(idCurso){
  var idAnio = document.getElementById("anio2").value;
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/informes/info_estudiantes_cursos/"+idAnio+"/"+idCurso+"";
  $.ajax({
  // la URL para la petición
    url : miurl,
  })
  .done(function(resul) {
    var dataC = resul.estudiantes;
    var mateHtmlteams = '';
    mateHtmlteams = '<option value="" class="" selected>Seleccione...</option>';
    dataC.forEach(function(curso){
      mateHtmlteams += '<option value="'+curso.id+'" class="">'+curso.nombre_estudiante+'</option>';
    })
    $('#estudiante2').html(mateHtmlteams);
    document.getElementById("estudiante2").disabled = false;

  $('.preloader').fadeOut();
     
  }).fail(function(err){
      $('.preloader').fadeOut();
      SU_revise_conexion();    
  });

}

function infoEstudiantes3(idCurso){
  var idAnio = document.getElementById("anio3").value;
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/informes/info_estudiantes_cursos/"+idAnio+"/"+idCurso+"";
  $.ajax({
  // la URL para la petición
    url : miurl,
  })
  .done(function(resul) {
    var dataC = resul.estudiantes;
    var mateHtmlteams = '';
    mateHtmlteams = '<option value="" class="" selected>Seleccione...</option>';
    dataC.forEach(function(curso){
      mateHtmlteams += '<option value="'+curso.id+'" class="">'+curso.nombre_estudiante+'</option>';
    })
    $('#estudiante3').html(mateHtmlteams);
    document.getElementById("estudiante3").disabled = false;

  $('.preloader').fadeOut();
     
  }).fail(function(err){
      $('.preloader').fadeOut();
      SU_revise_conexion();    
  });

}

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
    if(idPeriodo == 1){
        rutaUrl = "pdf_infomre_periodo";
    }if(idPeriodo == 2){
        rutaUrl = "pdf_infomre_periodo_dos";
    }if(idPeriodo == 3){
        rutaUrl = "pdf_infomre_periodo_tres";
    }
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

function generarReporteFinal() {

  var idCurso = $('#curso1').val();
  var idAnio = $('#anio1').val();
  var idPeriodo = 3;
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
  var rutaUrl = "pdf_infomre_periodo_final";
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

function generarReporteCertificadoEstudiosPorPeriodo() {

  var idCurso = $('#curso1').val();
  var idAnio = $('#anio1').val();
  var idPeriodo = $('#periodo1').val();
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
    rutaUrl = "pdf_infomre_certificado_notas_periodo_transicion"
  }else{
    if(idPeriodo == 1){
        rutaUrl = "pdf_infomre_certificado_notas_periodo";
    }if(idPeriodo == 2){
        rutaUrl = "pdf_infomre_certificado_notas_periodo_dos";
    }if(idPeriodo == 3){
        rutaUrl = "pdf_infomre_certificado_notas_periodo_tres";
    }
    
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

function generarReporteEstudianteEvaluaciones() {

  var idCurso = $('#curso1').val();
  var idAnio = $('#anio1').val();
  var idEstudiante = $('#estudiante1').val();
  var idPeriodo = $('#periodo1').val();
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
  if(idEstudiante == ""){
    todoCompleto = false;
    toastr.warning('Antes de generar el reporte debes seleccionar un estudiante', 'Atención');
    return;
  }
  if(idPeriodo == ""){
    todoCompleto = false;
    toastr.warning('Antes de generar el reporte debes seleccionar el periodo', 'Atención');
    return;
  }
  var rutaUrl = '';
  if(idCurso == 1){
    rutaUrl = "pdf_infomre_periodo_estudiante_transicion"
  }else{
    rutaUrl = "pdf_infomre_periodo_estudiante";
  }

  if(todoCompleto){
  $('.preloader').fadeIn();
    var urlraiz = $("#url_raiz_proyecto").val();
    var miurl = urlraiz + "/informes/"+rutaUrl+"/" + idCurso + "/" + idAnio + "/" + idPeriodo+"/"+idEstudiante+"";

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

function generarReporteCertificadoEstudiosEstudiante() {

  var idCurso = $('#curso2').val();
  var idAnio = $('#anio2').val();
  var idEstudiante = $('#estudiante2').val();
  var idPeriodo = $('#periodo2').val();
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
  if(idEstudiante == ""){
    todoCompleto = false;
    toastr.warning('Antes de generar el reporte debes seleccionar un estudiante', 'Atención');
    return;
  }
  if(idPeriodo == ""){
    todoCompleto = false;
    toastr.warning('Antes de generar el reporte debes seleccionar el periodo', 'Atención');
    return;
  }
  var rutaUrl = '';
  if(idCurso == 1){
    rutaUrl = "pdf_infomre_certificado_estudiante_transicion"
  }else{
    rutaUrl = "pdf_infomre_cetirficado_estudiante";
  }

  if(todoCompleto){
  $('.preloader').fadeIn();
    var urlraiz = $("#url_raiz_proyecto").val();
    var miurl = urlraiz + "/informes/"+rutaUrl+"/" + idCurso + "/" + idAnio + "/" + idPeriodo+"/"+idEstudiante+"";

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

function generarReporteConstanciaEstudiosEstudiante() {

  var idCurso = $('#curso3').val();
  var idAnio = $('#anio3').val();
  var idEstudiante = $('#estudiante3').val();
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
  if(idEstudiante == ""){
    todoCompleto = false;
    toastr.warning('Antes de generar el reporte debes seleccionar un estudiante', 'Atención');
    return;
  }
  
  var rutaUrl = "pdf_infomre_constancia_estudiante";
  

  if(todoCompleto){
  $('.preloader').fadeIn();
    var urlraiz = $("#url_raiz_proyecto").val();
    var miurl = urlraiz + "/informes/"+rutaUrl+"/" + idCurso + "/" + idAnio +"/"+idEstudiante+"";

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





