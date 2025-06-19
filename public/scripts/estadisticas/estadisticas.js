function infoCursos(idAnio, idDocente){

  var arrayCursos=CURSOS?CURSOS:[];
  var arrayDirectores=DIRECTORES?DIRECTORES:[];

  const anioFiltro = idAnio;
  const docenteFiltro = idDocente;
  console.log(anioFiltro,docenteFiltro, arrayDirectores);

  const filtrados = arrayDirectores.filter(est =>
    parseInt(est.id_anio) === parseInt(anioFiltro) &&
    parseInt(est.id_docente) === parseInt(docenteFiltro)
  );

  // Extraemos los ID de curso desde los directores filtrados
  const idsCursos = filtrados.map(item => parseInt(item.id_curso));
  console.log(idsCursos,arrayCursos);

  // Filtramos los cursos que coincidan con esos ID
  const cursosFiltrados = arrayCursos.filter(curso =>
    idsCursos.includes(parseInt(curso.id))
  );

  console.log(cursosFiltrados);
  var mateHtmlteams = '';
  mateHtmlteams = '<option value="" class="" selected>Seleccione...</option>';
  cursosFiltrados.forEach(function(citi){
    mateHtmlteams += '<option value="'+citi.id+'" class="">'+citi.nombre+'</option>';
  })
  $('#curso').html(mateHtmlteams);
  document.getElementById("curso").disabled = false;


  /*var lstCursos = [];

  filtrados.forEach(function(value){
    if(value.tipo_  == idTipo){
      lstMaterias.push(value);
    }
  });
  let result = lstMaterias.filter((item,index)=>{
    return lstMaterias.indexOf(item) === index;
  })
  
  
  validarChexbox(idTipo);*/
}