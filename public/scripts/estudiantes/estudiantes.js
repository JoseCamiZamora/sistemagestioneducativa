function IN_form_crear_new_estudiante(){
  
  $('#modal_estudiantes').modal();
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/estudiantes/form_nuevo_estudiante";
  $.ajax({
    url: miurl
    }).done( function(resul){
      $('.preloader').fadeOut();
      $("#contenido_modal_estudiantes").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;
}

$(document).on("submit","#f_nuevo_estudiante",function(e){
  //funcion para crear un nuevo usuario
 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/estudiantes/crear_estudiante";

 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType : 'html'
 })
 .done(function(resul) {
     $('.preloader').fadeOut();
     $("#contenido_modal_estudiantes").html(resul);
  })
 .fail(function(err){
     $('.preloader').fadeOut();
     SU_revise_conexion();    
 });
});

function verInfoEstidiante(id_estudiante){
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

function editarEstudiante(id_estudiante){
    $('#modal_editar_estudiantes').modal();
    $('.preloader').fadeIn();
    var urlraiz=$("#url_raiz_proyecto").val();
    var miurl='';
    miurl=urlraiz+"/estudiantes/frm_editar_estudiante/"+id_estudiante+"";

    $.ajax({
    url: miurl
    }).done( function(resul){
    
      $('.preloader').fadeOut();
      $("#contenido_modal_editar_estudiantes").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;
  // body...

}

$(document).on("submit","#f_editar_estudiante",function(e){
  //funcion para crear un nuevo usuario
 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/estudiantes/editar_estudiante";

 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType : 'html'
 })
 .done(function(resul) {
     $('.preloader').fadeOut();
     $("#contenido_modal_editar_estudiantes").html(resul);
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

function FC_cambiar_filtro_grado($idGrado){
  $('.preloader').fadeIn();
  var idAnio=$('#select_filtro_val_anio').val();
  if(idAnio == "0"){
     toastr.warning('Se debe seleccionar almenos un año para continuar con la busqueda', '¡Advertencia!');
     $('#select_filtro_val_grado').val(0)
  }else{
    var urlraiz=$("#url_raiz_proyecto").val();
    var miurl='';
    miurl=urlraiz+'/estudiantes/listado_estudiantes_filtro/'+idAnio+'/'+$idGrado+"";
    window.location.href= miurl;
    $('#select_filtro_val_anio').val(idAnio);
    $('#select_filtro_val_grado').val($idGrado)

  }
   $('.preloader').fadeOut();
  

}

function inactivarEstudiante(idEstudiante){
  swal({
    title: "Advertencia!!",
    text:"Esta seguro que desea inactivar el estudiante..!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    cancelButtonText:"Cancelar",
    confirmButtonText: "Aceptar",
    closeOnConfirm: true
  },
  function(){
    var urlraiz=$("#url_raiz_proyecto").val();
    var miurl='';
    miurl=urlraiz+"/estudiantes/inactivarEstudiante/"+idEstudiante+"";
    $.ajax({
    // la URL para la petición
      url : miurl,
    })
    .done(function(resul) {
        $('.preloader').fadeOut();
        if(resul.estado=="OK"){  location.reload();  }
        toastr.success('El estudiante fue inactivado exitosamente', '¡Éxito!');
    }).fail(function(err){
        $('.preloader').fadeOut();
        SU_revise_conexion();    
    });
  });

}

function activarEstudiante(idEstudiante){
  swal({
    title: "Advertencia!!",
    text:"Esta seguro que desea activar el estudiante..!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    cancelButtonText:"Cancelar",
    confirmButtonText: "Aceptar",
    closeOnConfirm: true
  },
  function(){
    var urlraiz=$("#url_raiz_proyecto").val();
    var miurl='';
    miurl=urlraiz+"/estudiantes/activarEstudiante/"+idEstudiante+"";
    $.ajax({
    // la URL para la petición
      url : miurl,
    })
    .done(function(resul) {
        $('.preloader').fadeOut();
        if(resul.estado=="OK"){  location.reload();  }
        toastr.success('El estudiante fue activado exitosamente', '¡Éxito!');
    }).fail(function(err){
        $('.preloader').fadeOut();
        SU_revise_conexion();    
    });
  });

}

function infoGradosNuevoEstudiante(idTipo){
 //debugger;
    const tipoGradoSelectParam = Number(idTipo);
    var arrayCursos=CURSOS?CURSOS:[];
    const lstCursosConfiguradas = arrayCursos.filter(
      item => item.tipo_grado === tipoGradoSelectParam
    );

    var mateHtmlteams = '';
    mateHtmlteams = '<option value="" class="" selected>Seleccione...</option>';
    lstCursosConfiguradas.forEach(function(citi){
      mateHtmlteams += '<option value="'+citi.id+'" class="">'+citi.nombre+'</option>';
    })
    $('#curso').html(mateHtmlteams);
    document.getElementById("curso").disabled = false;

}




