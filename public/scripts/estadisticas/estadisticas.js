function infoCursos(idAnio, idDocente){

  var arrayCursos=CURSOS?CURSOS:[];
  var arrayDirectores=DIRECTORES?DIRECTORES:[];

  const anioFiltro = idAnio;
  const docenteFiltro = idDocente;

  const filtrados = arrayDirectores.filter(est =>
    parseInt(est.id_anio) === parseInt(anioFiltro) &&
    parseInt(est.id_docente) === parseInt(docenteFiltro)
  );

  // Extraemos los ID de curso desde los directores filtrados
  const idsCursos = filtrados.map(item => parseInt(item.id_curso));

  // Filtramos los cursos que coincidan con esos ID
  const cursosFiltrados = arrayCursos.filter(curso =>
    idsCursos.includes(parseInt(curso.id))
  );

  var mateHtmlteams = '';
  mateHtmlteams = '<option value="" class="" selected>Seleccione...</option>';
  cursosFiltrados.forEach(function(citi){
    mateHtmlteams += '<option value="'+citi.id+'" class="">'+citi.nombre+'</option>';
  })
  $('#curso').html(mateHtmlteams);
  document.getElementById("curso").disabled = false;

}

function generarReporteRankigEstudiantes (){
  var anio = document.getElementById("anio").value;
  var curso = document.getElementById("curso").value;
  var periodo = document.getElementById("periodo").value;

  $('.preloader').fadeIn();
    var urlraiz=$("#url_raiz_proyecto").val();
    var miurl='';
    miurl=urlraiz+"/estadisticas/reporte_estudiantes_excel_materias/"+anio+"/"+curso+"/"+periodo+"";
    $.ajax({
      url: miurl
      }).done( function(resul){
        const base64 = resul.file;
        const fileName = resul.filename;

        // Crear y forzar descarga
        const link = document.createElement('a');
        link.href = 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,' + base64;
        link.download = fileName;
        link.click();
      $('.preloader').fadeOut();
    
    }).fail( function() 
    {
      $('.preloader').fadeOut();
      SU_revise_conexion();
    }) ;

}

