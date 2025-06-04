function evaluarEstudiante(id_estudiante){
  
  
  var idClase = $('#id_clase').val();

  $('#modal_evaluacion').modal();
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/evaluacion/form_evaluacion/"+id_estudiante+"/"+idClase+"";
  $.ajax({
    url: miurl
    }).done( function(resul){
      $('.preloader').fadeOut();
      $("#contenido_modal_evaluacion").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;

}

function evaluarEstudianteComportamiento(id_estudiante){
  
  var idClase = $('#id_clase').val();
  $('#modal_evaluacion').modal();
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/evaluacion/form_evaluacion_comportamiento/"+id_estudiante+"/"+idClase+"";
  $.ajax({
    url: miurl
    }).done( function(resul){
      $('.preloader').fadeOut();
      $("#contenido_modal_evaluacion").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;

}


function evaluarEstudianteTransicion(id_estudiante){
  
  
  var idClase = $('#id_clase').val();

  $('#modal_evaluacion').modal();
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/evaluacion/form_evaluacion_transicion/"+id_estudiante+"/"+idClase+"";
  $.ajax({
    url: miurl
    }).done( function(resul){
      $('.preloader').fadeOut();
      $("#contenido_modal_evaluacion").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;

}

function generarConceptoTransicion(id_estudiante){
  
  var idClase = $('#id_clase').val();
  $('#modal_evaluacion').modal();
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/evaluacion/form_generar_concepto_transicion/"+id_estudiante+"/"+idClase+"";
  $.ajax({
    url: miurl
    }).done( function(resul){
      $('.preloader').fadeOut();
      $("#contenido_modal_evaluacion").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;
}



function validarNotasComportamiento(val_nota){
  var desempenio = "";
   if (val_nota >= 4.6) {
      desempenio = 'Superior';
    } else if (val_nota >= 4.0) {
      desempenio = 'Alto';
    } else if (val_nota >= 3.0) {
      desempenio = 'Básico';
    } else {
      desempenio = 'Bajo';
    }

    document.getElementById("desempenio_compo").value = desempenio;
    var arrayConceptos=CONCEPTOS_COMPORTAMIENTO?CONCEPTOS_COMPORTAMIENTO:[];

    const idPeriodo = parseInt($('#periodo').val(), 10);
    if (!idPeriodo) {
      toastr.warning('Por favor seleccione un periodo antes de generar el concepto.', 'Atención');
      return; // Detener ejecución si no hay selección
    }
    

    const resultado = arrayConceptos.filter(item =>
      item.desempenio === desempenio
    );
    let resultadoConcepto = "";
    if(resultado.length > 0){
      resultadoConcepto = resultado[0].descripcion;
    }

    document.getElementById("conceptos_comportamiento").value = resultadoConcepto;

}



$(document).on("submit", "#f_adicionar_evaluacion_estudiante", function(e) {
  e.preventDefault();
  $('.preloader').fadeIn();

  var formu = $(this);
  var urlraiz = $("#url_raiz_proyecto").val();
  var varurl = urlraiz + "/evaluacion/crear_evaluacion_estudiante";

  // Limpiar inputs ocultos anteriores
  formu.find('.input-dinamico').remove();

  // Recorrer cada fila
  $('#tablaDatos tr').each(function(index, fila) {
    const notasArray = [];
    $(fila).find('.limitado').each(function(i, celda) {
      const id = $(celda).data('id');
      const valor = parseFloat($(celda).text()) || 0;
      notasArray.push({ id: id, value: valor });
    });

    // Convertir el array en JSON para enviarlo
    $('<input>').attr({
      type: 'hidden',
      name: `filas[${index}][notas]`,
      value: JSON.stringify(notasArray),
      class: 'input-dinamico'
    }).appendTo(formu);

    // Adjuntar nota final
    const notaFinal = $(fila).find('.nota-final').text();
    $('<input>').attr({
      type: 'hidden',
      name: `filas[${index}][nota_final]`,
      value: notaFinal,
      class: 'input-dinamico'
    }).appendTo(formu);

    // Adjuntar desempeño
    const desempeno = $(fila).find('.desempeno').text();
    $('<input>').attr({
      type: 'hidden',
      name: `filas[${index}][desempeno]`,
      value: desempeno,
      class: 'input-dinamico'
    }).appendTo(formu);
  });

  // Enviar AJAX
  $.ajax({
    url: varurl,
    data: formu.serialize(),
    method: 'POST',
    dataType: 'html'
  })
  .done(function(resul) {
    $('.preloader').fadeOut();
    $("#contenido_modal_evaluacion").html(resul);
  })
  .fail(function(err) {
    $('.preloader').fadeOut();
    SU_revise_conexion();
  });
});

$(document).on("submit", "#f_adicionar_evaluacion_comportamiento", function(e) {
  e.preventDefault();
  $('.preloader').fadeIn();

  var formu = $(this);
  var urlraiz = $("#url_raiz_proyecto").val();
  var varurl = urlraiz + "/evaluacion/crear_evaluacion_comportamiento";

  // Limpiar inputs ocultos anteriores
  formu.find('.input-dinamico').remove();

  // Recorrer cada fila
  $('#tablaDatos tr').each(function(index, fila) {
    const notasArray = [];
    $(fila).find('.limitado').each(function(i, celda) {
      const id = $(celda).data('id');
      const valor = parseFloat($(celda).text()) || 0;
      notasArray.push({ id: id, value: valor });
    });

    // Convertir el array en JSON para enviarlo
    $('<input>').attr({
      type: 'hidden',
      name: `filas[${index}][notas]`,
      value: JSON.stringify(notasArray),
      class: 'input-dinamico'
    }).appendTo(formu);

    // Adjuntar nota final
    const notaFinal = $(fila).find('.nota-final').text();
    $('<input>').attr({
      type: 'hidden',
      name: `filas[${index}][nota_final]`,
      value: notaFinal,
      class: 'input-dinamico'
    }).appendTo(formu);

    // Adjuntar desempeño
    const desempeno = $(fila).find('.desempeno').text();
    $('<input>').attr({
      type: 'hidden',
      name: `filas[${index}][desempeno]`,
      value: desempeno,
      class: 'input-dinamico'
    }).appendTo(formu);
  });

  // Enviar AJAX
  $.ajax({
    url: varurl,
    data: formu.serialize(),
    method: 'POST',
    dataType: 'html'
  })
  .done(function(resul) {
    $('.preloader').fadeOut();
    $("#contenido_modal_evaluacion").html(resul);
  })
  .fail(function(err) {
    $('.preloader').fadeOut();
    SU_revise_conexion();
  });
});

$(document).on("submit", "#f_adicionar_evaluacion_comportamiento_transicion", function(e) {
  e.preventDefault();
  $('.preloader').fadeIn();

  var formu = $(this);
  var urlraiz = $("#url_raiz_proyecto").val();
  var varurl = urlraiz + "/evaluacion/crear_evaluacion_comportamiento_transicion";

  // Limpiar inputs ocultos anteriores
  formu.find('.input-dinamico').remove();

  // Recorrer cada fila
  $('#tablaDatos tr').each(function(index, fila) {
    const notasArray = [];
    $(fila).find('.limitado').each(function(i, celda) {
      const id = $(celda).data('id');
      const valor = parseFloat($(celda).text()) || 0;
      notasArray.push({ id: id, value: valor });
    });

    // Convertir el array en JSON para enviarlo
    $('<input>').attr({
      type: 'hidden',
      name: `filas[${index}][notas]`,
      value: JSON.stringify(notasArray),
      class: 'input-dinamico'
    }).appendTo(formu);

    // Adjuntar nota final
    const notaFinal = $(fila).find('.nota-final').text();
    $('<input>').attr({
      type: 'hidden',
      name: `filas[${index}][nota_final]`,
      value: notaFinal,
      class: 'input-dinamico'
    }).appendTo(formu);

    // Adjuntar desempeño
    const desempeno = $(fila).find('.desempeno').text();
    $('<input>').attr({
      type: 'hidden',
      name: `filas[${index}][desempeno]`,
      value: desempeno,
      class: 'input-dinamico'
    }).appendTo(formu);
  });

  // Enviar AJAX
  $.ajax({
    url: varurl,
    data: formu.serialize(),
    method: 'POST',
    dataType: 'html'
  })
  .done(function(resul) {
    $('.preloader').fadeOut();
    $("#contenido_modal_evaluacion").html(resul);
  })
  .fail(function(err) {
    $('.preloader').fadeOut();
    SU_revise_conexion();
  });
});



function validarNotasInscritas(idPeriodo){

var idCurso = $('#id_estudiante_curso').val();
var idClase = $('#id_clase').val();
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/evaluacion/consultar_evaluacion/"+idPeriodo+"/"+idCurso+"/"+idClase+"";
  $.ajax({
    url: miurl
    }).done( function(resul){
      // Asumiendo que resul es un solo objeto, no un array de filas
    const fila = $('#tablaDatos tr').first(); // O selecciona correctamente según tu estructura

    // Pintar notas por tipo
    $(fila).find('.limitado').each(function(_, celda) {
      const tipoId = $(celda).data('id');
      const notaObj = resul.notas.find(n => n.id == tipoId);
      if (notaObj) {
        $(celda).text(notaObj.nota);
      } else {
        $(celda).text('0');
      }
    });

    // Pintar nota final
    $(fila).find('.nota-final').text(parseFloat(resul.nota_final).toFixed(1));

    // Pintar desempeño
    $(fila).find('.desempeno').text(resul.desempenio || 'Bajo');

    document.getElementById("conceptos").value = resul.conceptos;

    $('.preloader').fadeOut();
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;

}

function validarNotasInscritasComportamiento(idPeriodo){

var idCurso = $('#id_estudiante_curso').val();
var idClase = $('#id_clase').val();
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/evaluacion/consultar_evaluacion_comportamiento/"+idPeriodo+"/"+idCurso+"/"+idClase+"";
  $.ajax({
    url: miurl
    }).done( function(resul){
    // Asumiendo que resul es un solo objeto, no un array de filas

    document.getElementById("nota_comportamiento").value = resul.notaComportamiento;

    var desempenio = "";
    if (resul.notaComportamiento >= 4.6) {
      desempenio = 'Superior';
    } else if (resul.notaComportamiento >= 4.0) {
      desempenio = 'Alto';
    } else if (resul.notaComportamiento >= 3.0) {
      desempenio = 'Básico';
    } else {
      desempenio = 'Bajo';
    }

    document.getElementById("desempenio_compo").value = desempenio;
    document.getElementById("conceptos_comportamiento").value = resul.conceptoComportamiento;

    $('.preloader').fadeOut();
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;

}

function validarNotasInscritasComportamientoTransicion(idPeriodo){

var idCurso = $('#id_estudiante_curso').val();
var idClase = $('#id_clase').val();
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/evaluacion/consultar_evaluacion_comportamiento/"+idPeriodo+"/"+idCurso+"/"+idClase+"";
  $.ajax({
    url: miurl
    }).done( function(resul){
    // Asumiendo que resul es un solo objeto, no un array de filas

    var desempenio = "";
    if (resul.notaComportamiento >= 2.5 && resul.notaComportamiento <= 3) {
      desempenio = 'Alto';
    } else if (resul.notaComportamiento >= 1.5 && resul.notaComportamiento < 2.5) {
      desempenio = 'Medio';
    } else if (resul.notaComportamiento > 0 && resul.notaComportamiento < 1.5) {
      desempenio = 'Bajo';
    }
    if(resul.notaComportamiento == 0){
       document.getElementById("desempenio_compo").value = "";
    }else{
       document.getElementById("desempenio_compo").value = resul.notaComportamiento;
    }

   
    document.getElementById("conceptos_comportamiento").value = resul.conceptoComportamiento;

    $('.preloader').fadeOut();
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;

}




function validarNotasInscritasTransicion(idPeriodo){

  var idCurso = $('#id_estudiante_curso').val();
  var idClase = $('#id_clase').val();
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/evaluacion/consultar_evaluacion_transicion/"+idPeriodo+"/"+idCurso+"/"+idClase+"";
  $.ajax({
    url: miurl
    }).done( function(resul){
      // Asumiendo que resul es un solo objeto, no un array de filas
    if(resul.notas.length > 0){
      resul.notas.forEach(item => {
        const select = document.querySelector(`.evaluacion-select[data-id='${item.id}']`);
        if (select) {
          select.value = item.nota;
        }
      });
    }else{
      document.querySelectorAll('.evaluacion-select').forEach(select => {
        select.value = ""; // Selecciona "Evaluar al estudiante"
        select.classList.remove('bg-success', 'bg-warning', 'bg-danger'); // Limpia colores
      });
    }
    if(resul.desempenio == "Logro Alcanzado"){
      document.getElementById("resultadoFinal").value = "😀 Logro Alcanzado";
      document.getElementById("resultadoFinal").innerText = "😀 Logro Alcanzado";
    }else{
      document.getElementById("resultadoFinal").value = "😐 Logro En Proceso";
      document.getElementById("resultadoFinal").innerText = "😐 Logro En Proceso";
    }

    $('.preloader').fadeOut();
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;

}

function validarNotasMateriasTransicion(idPeriodo){

  var idCurso = $('#id_estudiante_curso').val();
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/evaluacion/consultar_evaluacion_materias_transicion/"+idPeriodo+"/"+idCurso+"";
  $.ajax({
    url: miurl
    }).done( function(resul){
      // Asumiendo que resul es un solo objeto, no un array de filas
   
    const fila = $('#tablaDatos tr').first(); // O selecciona correctamente según tu estructura

    $(fila).find('.limitado').each(function(_, celda) {
      const tipoId = $(celda).data('id');
      const notaObj = resul.notas.find(n => n.id == tipoId);
      if (notaObj) {
         let imagenHtml = '';
        if(notaObj.nota >= 1.5){
          imagenHtml = `<img src="${rutaFeliz}" style="max-height: 30px;" onerror="this.onerror=null; this.src='image.png'">`;
        }else if(notaObj.nota > 0 ){
          imagenHtml = `<img src="${rutaNeutro}" style="max-height: 30px;" onerror="this.onerror=null; this.src='image.png'">`;
        }
        $(celda).html(imagenHtml);
      } else {
         $(celda).html('');
      }
    });

    // Pintar nota final
    let imagenHtmlFinal = '';
    if(resul.nota_final >= 1.5 ){
        imagenHtmlFinal = `<img src="${rutaFeliz}" style="max-height: 30px;" onerror="this.onerror=null; this.src='image.png'">`;
    }else if(resul.nota_final > 0){
        imagenHtmlFinal = `<img src="${rutaNeutro}" style="max-height: 30px;" onerror="this.onerror=null; this.src='image.png'">`;
    }
    $(fila).find('.nota-final').html(imagenHtmlFinal);

    // Pintar desempeño
    $(fila).find('.desempeno').text(resul.desempenio || '');
    if(resul.textoConcepto != ""){
      document.getElementById("conceptos").value = resul.textoConcepto;
    }else{
      document.getElementById("conceptos").value = "";
    }
    

    $('.preloader').fadeOut();
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;

}


$(document).on("submit", "#f_adicionar_evaluacion_transicion", function(e) {
  e.preventDefault();
  $('.preloader').fadeIn();

  var formu = $(this);
  var urlraiz = $("#url_raiz_proyecto").val();
  var varurl = urlraiz + "/evaluacion/crear_evaluacion_transicion";

  // Enviar AJAX
  $.ajax({
    url: varurl,
    data: formu.serialize(),
    method: 'POST',
    dataType: 'html'
  })
  .done(function(resul) {
    $('.preloader').fadeOut();
    $("#contenido_modal_evaluacion").html(resul);
  })
  .fail(function(err) {
    $('.preloader').fadeOut();
    SU_revise_conexion();
  });
});

$(document).on("submit", "#f_adicionar_concepto_transicion", function(e) {
  e.preventDefault();
  $('.preloader').fadeIn();
  var concepto = document.getElementById("conceptos").value;
  if(concepto != ''){
    var formu = $(this);
    var urlraiz = $("#url_raiz_proyecto").val();
    var varurl = urlraiz + "/evaluacion/crear_concepto_transicion";

    formu.find('.input-dinamico').remove();
    $('#tablaDatos tr').each(function(index, fila) {
      const notasArray = [];
      $(fila).find('.limitado').each(function(i, celda) {
        const id = $(celda).data('id');
        const valor = parseFloat($(celda).text()) || 0;
        notasArray.push({ id: id, value: valor });
      });

      // Convertir el array en JSON para enviarlo
      $('<input>').attr({
        type: 'hidden',
        name: `filas[${index}][notas]`,
        value: JSON.stringify(notasArray),
        class: 'input-dinamico'
      }).appendTo(formu);
    // Adjuntar desempeño
      const desempeno = $(fila).find('.desempeno').text();
      $('<input>').attr({
        type: 'hidden',
        name: `filas[${index}][desempeno]`,
        value: desempeno,
        class: 'input-dinamico'
      }).appendTo(formu);
    });

    // Enviar AJAX
    $.ajax({
      url: varurl,
      data: formu.serialize(),
      method: 'POST',
      dataType: 'html'
    })
    .done(function(resul) {
      $('.preloader').fadeOut();
      $("#contenido_modal_evaluacion").html(resul);
    }).fail(function(err) {
      $('.preloader').fadeOut();
      SU_revise_conexion();
    });
  }else{
     toastr.warning('Antes de almacenar el registro de debe generar el concepto de la evaluación', '¡Advertencia!');
     e.preventDefault();
    $('.preloader').fadeOut();
  }
});

function evaluarEstudianteComportamientoTransicion(id_estudiante){
  
  var idClase = $('#id_clase').val();
  $('#modal_evaluacion').modal();
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/evaluacion/form_evaluacion_comportamiento_transicion/"+id_estudiante+"/"+idClase+"";
  $.ajax({
    url: miurl
    }).done( function(resul){
      $('.preloader').fadeOut();
      $("#contenido_modal_evaluacion").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;

}








