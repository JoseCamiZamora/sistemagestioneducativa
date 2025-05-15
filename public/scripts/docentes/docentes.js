function IN_form_crear_new_docente(){
  
  $('#modal_docente').modal();
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/docentes/form_nuevo_docente";
  $.ajax({
    url: miurl
    }).done( function(resul){
      $('.preloader').fadeOut();
      $("#contenido_modal_docente").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;
}

$(document).on("submit","#f_nuevo_docente",function(e){
  //funcion para crear un nuevo usuario

 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/docentes/crear_docente";

 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType : 'html'
 })
 .done(function(resul) {
     $('.preloader').fadeOut();
     $("#contenido_modal_docente").html(resul);
  })
 .fail(function(err){
     $('.preloader').fadeOut();
     SU_revise_conexion();    
 });
});

function verInfoEstidiante(id_estudiante){
  console.log(id_estudiante);
    $('#modal_info_estudiantes').modal();
    $('.preloader').fadeIn();
    var urlraiz=$("#url_raiz_proyecto").val();
    var miurl='';
    miurl=urlraiz+"/estudiantes/frm_info_estudiante/"+id_estudiante+"";

    $.ajax({
    url: miurl
    }).done( function(resul){
    
      $('.preloader').fadeOut();
      $("#contenido_modal_info_estudiantes").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;
  // body...

}

function editarDocente(id_docente){
  console.log(id_docente);
    $('#modal_editar_docentes').modal();
    $('.preloader').fadeIn();
    var urlraiz=$("#url_raiz_proyecto").val();
    var miurl='';
    miurl=urlraiz+"/docentes/frm_editar_docente/"+id_docente+"";

    $.ajax({
    url: miurl
    }).done( function(resul){
    
      $('.preloader').fadeOut();
      $("#contenido_modal_editar_docentes").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;
  // body...

}

function clasesDocente(id_docente){
  console.log("jejejeje",id_docente);
    $('#modal_clases_docentes').modal();
    $('.preloader').fadeIn();
    var urlraiz=$("#url_raiz_proyecto").val();
    var miurl='';
    miurl=urlraiz+"/docentes/frm_clases_docente/"+id_docente+"";

    $.ajax({
    url: miurl
    }).done( function(resul){
    
      $('.preloader').fadeOut();
      $("#contenido_modal_clases_docentes").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;
  // body...

}

$(document).on("submit","#f_editar_docente",function(e){
  //funcion para crear un nuevo usuario
 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/docentes/editar_docente";

 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType : 'html'
 })
 .done(function(resul) {
     $('.preloader').fadeOut();
     $("#contenido_modal_editar_docentes").html(resul);
  })
 .fail(function(err){
     $('.preloader').fadeOut();
     SU_revise_conexion();    
 });
});

function borrarDataAcudiente1(){
  $('#parentesco1').val("");
 $('#tipoDocumento1').val("");
  $('#nro_identificacion1').val("");
  $('#nombres1').val("");
  $('#ocupacion1').val("");
  $('#telefono1').val("");
}

function borrarDataAcudiente2(){
  $('#parentesco2').val("");
  $('#tipoDocumento2').val("");
  $('#nro_identificacion2').val("");
  $('#nombres2').val("");
  $('#ocupacion2').val("");
  $('#telefono2').val("");
}

function borrarDataAcudiente3(){
  $('#parentesco3').val("");
  $('#tipoDocumento3').val("");
  $('#nro_identificacion3').val("");
  $('#nombres3').val("");
  $('#ocupacion3').val("");
  $('#telefono3').val("");
}




function infoMaterias(idTipo){

  var arrayMaterias=MATERIAS?MATERIAS:[];
  var lstMaterias = [];

  arrayMaterias.forEach(function(value){
    if(value.tipo_curso  == idTipo){
      lstMaterias.push(value);
    }
  });
  let result = lstMaterias.filter((item,index)=>{
    return lstMaterias.indexOf(item) === index;
  })
  var mateHtmlteams = '';
  mateHtmlteams = '<option value="" class="" selected>Seleccione...</option>';
  result.forEach(function(citi){
    mateHtmlteams += '<option value="'+citi.id+'" class="">'+citi.nombre+'</option>';
  })
  $('#materia').html(mateHtmlteams);
  document.getElementById("materia").disabled = false;
  validarChexbox(idTipo);
}


function eliminarCurso(id_clase, btn){
  console.log(id_clase);
  var urlraiz=$("#url_raiz_proyecto").val();
    var miurl='';
    miurl=urlraiz+"/docentes/borrar_clase_docente/"+id_clase+"";

    $.ajax({
      url : miurl,
    })
     .done(function(resul) {
       if(resul.estado=="borrada"){  
          toastr.success('La clase fue eliminada exitosamente', '¡Éxito!');
          const fila = btn.closest('tr');
          if (fila) {
            fila.remove();
          }
        }
     }).fail(function(err){
        $('.preloader').fadeOut();
        SU_revise_conexion();    
    });
}

function validarChexbox(idTipo){
  const tipoGradoSelectParam = Number(idTipo);
  const arraygrados = GRADOS ? GRADOS : [];

  // Filtrar los cursos por tipo
  const lstCursosConfiguradas = arraygrados.filter(
    item => item.tipo_grado === tipoGradoSelectParam
  );

  // Obtener los nombres válidos para mostrar
  const nombresValidos = lstCursosConfiguradas.map(c => c.nombre.trim());

  // Obtener todos los checkbox contenedores
  const checkboxes = document.querySelectorAll('.espaciado-checkbox');

  checkboxes.forEach(box => {
    const label = box.querySelector('label');
    const nombreCurso = label ? label.textContent.trim() : '';

    if (nombresValidos.includes(nombreCurso)) {
      box.style.display = 'inline-block';
    } else {
      box.style.display = 'none';
      const input = box.querySelector('input');
      if (input) input.checked = false;
    }
  });
}

$(document).on("submit","#f_adicionar_clases_docente",function(e){
  //funcion para crear un nuevo usuario
 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/docentes/adicionar_clases_docente";

 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType : 'html'
 })
 .done(function(resul) {
     $('.preloader').fadeOut();
     $("#contenido_modal_clases_docentes").html(resul);
  })
 .fail(function(err){
     $('.preloader').fadeOut();
     SU_revise_conexion();    
 });
});