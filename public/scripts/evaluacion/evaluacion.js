function evaluarEstudiante(id_estudiante){
  
  
  var idClase = $('#id_clase').val();
  console.log('jejejeje',idClase);

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

function validarNotasInscritas(idPeriodo){

var idCurso = $('#id_estudiante_curso').val();
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/evaluacion/consultar_evaluacion/"+idPeriodo+"/"+idCurso+"";
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

    $('.preloader').fadeOut();
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;

}