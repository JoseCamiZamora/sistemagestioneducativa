function IN_form_crear_new_anio(){
  
  $('#modal_anio').modal('show');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/form_nuevo_anio";
  $.ajax({
    url: miurl
    }).done( function(resul){
      $('.preloader').fadeOut();
      $("#contenido_modal_anio").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;
}

function mostrarTextoCompleto(texto) {
  $("#contenido_modal_concepto").html(texto);
  $('#modalTextoConcepto').modal('show');
}

function IN_form_crear_new_materia(){
  
  $('#modal_materia').modal('show');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/form_nuevo_materia";
  $.ajax({
    url: miurl
    }).done( function(resul){
      $('.preloader').fadeOut();
      $("#contenido_modal_materia").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;
}

function IN_form_crear_new_actividad(){
  
  $('#modal_actividad').modal('show');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/form_nueva_activdad";
  $.ajax({
    url: miurl
    }).done( function(resul){
      $('.preloader').fadeOut();
      $("#contenido_modal_actividad").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;
}

function IN_form_crear_new_periodo(){
  
  $('#modal_periodo').modal('show');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/form_nuevo_periodo";
  $.ajax({
    url: miurl
    }).done( function(resul){
      $('.preloader').fadeOut();
      $("#contenido_modal_periodo").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;
}

function IN_form_crear_new_curso(){
  
  $('#modal_curso').modal('show');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/form_nuevo_curso";
  $.ajax({
    url: miurl
    }).done( function(resul){
      $('.preloader').fadeOut();
      $("#contenido_modal_curso").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;
}

function IN_form_crear_new_clasificacion(){
  
  $('#modal_clasificacion').modal('show');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/form_nueva_clasificacion";
  $.ajax({
    url: miurl
    }).done( function(resul){
      $('.preloader').fadeOut();
      $("#contenido_modal_clasificacion").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;
}

function IN_form_crear_new_concepto(){
  
  $('#modal_nuevo_concepto').modal('show');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/form_nuevo_concepto";
  $.ajax({
    url: miurl
    }).done( function(resul){
      $('.preloader').fadeOut();
      $("#contenido_modal_nuevo_concepto").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;
}

function IN_form_crear_new_concepto_comp(){
  
  $('#modal_nuevo_concepto_comp').modal('show');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/form_nuevo_concepto_comp";
  $.ajax({
    url: miurl
    }).done( function(resul){
      $('.preloader').fadeOut();
      $("#contenido_modal_nuevo_concepto_comp").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;
}


function IN_form_crear_new_concepto_trans(){
  
  $('#modal_nuevo_concepto_trans').modal('show');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/form_nuevo_concepto_trans";
  $.ajax({
    url: miurl
    }).done( function(resul){
      $('.preloader').fadeOut();
      $("#contenido_modal_nuevo_concepto_trans").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;
}

function IN_form_crear_new_dimension(){
  
  $('#modal_nuevo_dimension').modal('show');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/form_nueva_dimension";
  $.ajax({
    url: miurl
    }).done( function(resul){
      $('.preloader').fadeOut();
      $("#contenido_modal_nuevo_dimension").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;
}



$(document).on("submit","#f_adicionar_nueva_materia",function(e){
  //funcion para crear un nuevo usuario

 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/configuracion/crear_matria";

 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType : 'html'
 })
 .done(function(resul) {
     $('.preloader').fadeOut();
     $("#contenido_modal_materia").html(resul);
  })
 .fail(function(err){
     $('.preloader').fadeOut();
     SU_revise_conexion();    
 });
});

$(document).on("submit","#f_adicionar_nueva_actividad",function(e){
  //funcion para crear un nuevo usuario

 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/configuracion/crear_actividad";

 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType : 'html'
 })
 .done(function(resul) {
     $('.preloader').fadeOut();
     $("#contenido_modal_actividad").html(resul);
  })
 .fail(function(err){
     $('.preloader').fadeOut();
     SU_revise_conexion();    
 });
});

$(document).on("submit","#f_adicionar_nuevo_periodo",function(e){
  //funcion para crear un nuevo usuario

 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/configuracion/crear_periodo";
 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType : 'html'
 })
 .done(function(resul) {
     $('.preloader').fadeOut();
     $("#contenido_modal_periodo").html(resul);
  })
 .fail(function(err){
     $('.preloader').fadeOut();
     SU_revise_conexion();    
 });
});

$(document).on("submit","#f_adicionar_nuevo_curso",function(e){
  //funcion para crear un nuevo usuario

 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/configuracion/crear_curso";
 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType : 'html'
 })
 .done(function(resul) {
     $('.preloader').fadeOut();
     $("#contenido_modal_curso").html(resul);
  })
 .fail(function(err){
     $('.preloader').fadeOut();
     SU_revise_conexion();    
 });
});

$(document).on("submit","#f_adicionar_nuevo_anio",function(e){
  //funcion para crear un nuevo usuario
  var validacione = validarCheckboxes();
  if(validacione){
    e.preventDefault();
    $('.preloader').fadeIn();
    
    var formu=$(this);
    var urlraiz=$("#url_raiz_proyecto").val();
    var varurl=urlraiz+"/configuracion/crear_anio";
    
    $.ajax({
      // la URL para la petición
      url : varurl,
      data : formu.serialize(),
      method: 'POST',
      dataType : 'html'
    })
    .done(function(resul) {
        $('.preloader').fadeOut();
        $("#contenido_modal_anio").html(resul);
     })
    .fail(function(err){
        $('.preloader').fadeOut();
        SU_revise_conexion();    
    });
  }else{
    e.preventDefault();
  }
 
});

$(document).on("submit","#f_adicionar_nueva_clasificacion",function(e){
  //funcion para crear un nuevo usuario

 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/configuracion/crear_clasificacion";
 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType : 'html'
 })
 .done(function(resul) {
     $('.preloader').fadeOut();
     $("#contenido_modal_clasificacion").html(resul);
  })
 .fail(function(err){
     $('.preloader').fadeOut();
     SU_revise_conexion();    
 });
});

$(document).on("submit", "#f_adicionar_curso_estudiante", function(e) {
  e.preventDefault();
  $('.preloader').fadeIn();

  var idAnio = $("#anio_escolar").val();
  var idCurso = $("#curso").val();
  var idEstudiante = $("#id_estudiante").val();
  
  const select1 = document.getElementById('anio_escolar'); // ID del <select>
  const textoSeleccionado1 = select1.options[select1.selectedIndex].text;
  const select2 = document.getElementById('curso'); // ID del <select>
  const textoSeleccionado2 = select2.options[select2.selectedIndex].text;

  var urlraiz = $("#url_raiz_proyecto").val();
  var miurl = urlraiz + "/configuracion/validar_curso_asociado/" + idAnio + "/" + idCurso + "/" + idEstudiante;

  $.ajax({
    url: miurl,
  })
  .done(function(resul) {
    var estado = resul['estado'];

    if (!estado) {
      // Si no está registrado, procede a guardar
      var formu = $("#f_adicionar_curso_estudiante");
      var varurl = urlraiz + "/configuracion/adicionar_curso_estudiante";

      $.ajax({
        url: varurl,
        data: formu.serialize(),
        method: 'POST',
        dataType: 'html'
      })
      .done(function(resul) {
        $('.preloader').fadeOut();
        $("#contenido_modal_asociar_estudiantes").html(resul);
      })
      .fail(function(err) {
        $('.preloader').fadeOut();
        SU_revise_conexion();
      });

    } else {
      $('.preloader').fadeOut();
      toastr.warning('El estudiante ya se encuentra matriculado en el periodo: '+textoSeleccionado1+'.', '¡Advertencia!');
    }

  })
  .fail(function(err) {
    $('.preloader').fadeOut();
    SU_revise_conexion();
  });
});

function validarCheckboxes() {
  const periodos = document.querySelectorAll('input[name="periodos[]"]:checked');
  const actividades = document.querySelectorAll('input[name="actividades[]"]:checked');
  const cursos = document.querySelectorAll('input[name="cursos[]"]:checked');
  const fechaIni = parseInt($("#anio_inicio").val());
  const fechaFin = parseInt($("#anio_final").val());

  if( fechaFin < fechaIni ){
    toastr.warning('El año de inicio no puede ser menos al año final', '¡Advertencia!');
    return false;
  }

  if (periodos.length === 0) {
      toastr.warning('Debes seleccionar al menos un período.', '¡Advertencia!');
      return false;
  }

  if (actividades.length === 0) {
      toastr.warning('Debes seleccionar al menos una actividad.', '¡Advertencia!');
      return false;
  }

  if (cursos.length === 0) {
      toastr.warning('Debes seleccionar al menos un curso.', '¡Advertencia!');
      return false;
  }

  return true; // Si pasa todas las validaciones
}

function editarMateria(idMateria){
    $('#modal_editar_materia').modal('show');
    $('.preloader').fadeIn();
    var urlraiz=$("#url_raiz_proyecto").val();
    var miurl='';
    miurl=urlraiz+"/configuracion/frm_editar_materia/"+idMateria+"";

    $.ajax({
    url: miurl
    }).done( function(resul){
    
      $('.preloader').fadeOut();
      $("#contenido_modal_editar_materia").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;
  // body...
}

function editarActividad(idActividad){
  $('#modal_editar_actividad').modal('show');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/frm_editar_actividad/"+idActividad+"";

  $.ajax({
  url: miurl
  }).done( function(resul){
  
    $('.preloader').fadeOut();
    $("#contenido_modal_editar_actividad").html(resul);
 
  }).fail( function() 
 {
  $('.preloader').fadeOut();
   SU_revise_conexion();
 }) ;
// body...
}

function editarPeriodo(idPeriodo){
  $('#modal_editar_periodo').modal('show');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/frm_editar_periodo/"+idPeriodo+"";

  $.ajax({
  url: miurl
  }).done( function(resul){
  
    $('.preloader').fadeOut();
    $("#contenido_modal_editar_periodo").html(resul);
 
  }).fail( function() 
 {
  $('.preloader').fadeOut();
   SU_revise_conexion();
 }) ;
// body...
}

function editarCurso(idCurso){
  $('#modal_editar_curso').modal('show');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/frm_editar_curso/"+idCurso+"";

  $.ajax({
  url: miurl
  }).done( function(resul){
  
    $('.preloader').fadeOut();
    $("#contenido_modal_editar_curso").html(resul);
 
  }).fail( function() 
 {
  $('.preloader').fadeOut();
   SU_revise_conexion();
 }) ;
// body...
}

function editarClasificacion(idClasificacion){
  $('#modal_editar_clasificacion').modal('show');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/frm_editar_clasificacion/"+idClasificacion+"";

  $.ajax({
  url: miurl
  }).done( function(resul){
  
    $('.preloader').fadeOut();
    $("#contenido_modal_editar_clasificacion").html(resul);
 
  }).fail( function() 
 {
  $('.preloader').fadeOut();
   SU_revise_conexion();
 }) ;
// body...
}

$(document).on("submit","#f_editar_materia",function(e){
  //funcion para crear un nuevo usuario
 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/configuracion/editar_materia";

 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType : 'html'
 })
 .done(function(resul) {
     $('.preloader').fadeOut();
     $("#contenido_modal_editar_materia").html(resul);
  })
 .fail(function(err){
     $('.preloader').fadeOut();
     SU_revise_conexion();    
 });
});

$(document).on("submit","#f_editar_actividad",function(e){
  //funcion para crear un nuevo usuario
 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/configuracion/editar_actividad";

 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType : 'html'
 })
 .done(function(resul) {
     $('.preloader').fadeOut();
     $("#contenido_modal_editar_actividad").html(resul);
  })
 .fail(function(err){
     $('.preloader').fadeOut();
     SU_revise_conexion();    
 });
});

$(document).on("submit","#f_editar_periodo",function(e){
  //funcion para crear un nuevo usuario
 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/configuracion/editar_periodo";
 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType : 'html'
 })
 .done(function(resul) {
     $('.preloader').fadeOut();
     $("#contenido_modal_editar_periodo").html(resul);
  })
 .fail(function(err){
     $('.preloader').fadeOut();
     SU_revise_conexion();    
 });
});

$(document).on("submit","#f_editar_curso",function(e){
  //funcion para crear un nuevo usuario
 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/configuracion/editar_curso";
 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType : 'html'
 })
 .done(function(resul) {
     $('.preloader').fadeOut();
     $("#contenido_modal_editar_curso").html(resul);
  })
 .fail(function(err){
     $('.preloader').fadeOut();
     SU_revise_conexion();    
 });
});

$(document).on("submit","#f_editar_clasificacion",function(e){
  //funcion para crear un nuevo usuario
 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/configuracion/editar_clasificacion";
 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType : 'html'
 })
 .done(function(resul) {
     $('.preloader').fadeOut();
     $("#contenido_modal_editar_clasificacion").html(resul);
  })
 .fail(function(err){
     $('.preloader').fadeOut();
     SU_revise_conexion();    
 });
});

$(document).on("submit","#f_adicionar_editar_anio",function(e){
  //funcion para crear un nuevo usuario
 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/configuracion/editar_anio";
 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType : 'html'
 })
 .done(function(resul) {
     $('.preloader').fadeOut();
     $("#contenido_modal_editar_anio").html(resul);
  })
 .fail(function(err){
     $('.preloader').fadeOut();
     SU_revise_conexion();    
 });
});

$(document).on("submit","#f_nueva_dimension",function(e){
  //funcion para crear un nuevo usuario
 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/configuracion/nueva_dimension";
 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType : 'html'
 })
 .done(function(resul) {
     $('.preloader').fadeOut();
     $("#contenido_modal_nuevo_dimension").html(resul);
  })
 .fail(function(err){
     $('.preloader').fadeOut();
     SU_revise_conexion();    
 });
});

$(document).on("submit","#f_editar_dimension",function(e){
  //funcion para crear un nuevo usuario
 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/configuracion/editar_dimension";
 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType : 'html'
 })
 .done(function(resul) {
     $('.preloader').fadeOut();
     $("#contenido_modal_editar_dimension").html(resul);
  })
 .fail(function(err){
     $('.preloader').fadeOut();
     SU_revise_conexion();    
 });
});


function borrarMateria(idMateria){

  swal({
    title: "Advertencia!!",
    text:"Esta seguro que desea borrar la materia ",
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
    miurl=urlraiz+"/configuracion/borrar_materia/"+idMateria+"";
    $.ajax({
    // la URL para la petición
      url : miurl,
    })
    .done(function(resul) {
        $('.preloader').fadeOut();
        if(resul.estado=="borrada"){  location.reload();  }
        if(resul.estado!="borrada"){  location.reload();  }
        
    }).fail(function(err){
        $('.preloader').fadeOut();
        SU_revise_conexion();    
    });
  });

}

function borrarActividad(idActividad){

  swal({
    title: "Advertencia!!",
    text:"Esta seguro que desea borrar la actividad ",
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
    miurl=urlraiz+"/configuracion/borrar_actividad/"+idActividad+"";
    $.ajax({
    // la URL para la petición
      url : miurl,
    })
    .done(function(resul) {
        $('.preloader').fadeOut();
        if(resul.estado=="borrada"){  location.reload();  }
        if(resul.estado!="borrada"){  location.reload();  }
        
    }).fail(function(err){
        $('.preloader').fadeOut();
        SU_revise_conexion();    
    });
  });

}

function borrarPeriodo(idPeriodo){

  swal({
    title: "Advertencia!!",
    text:"Esta seguro que desea borrar el periodo ",
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
    miurl=urlraiz+"/configuracion/borrar_periodo/"+idPeriodo+"";
    $.ajax({
    // la URL para la petición
      url : miurl,
    })
    .done(function(resul) {
        $('.preloader').fadeOut();
        if(resul.estado=="borrada"){  location.reload();  }
        if(resul.estado!="borrada"){  location.reload();  }
        
    }).fail(function(err){
        $('.preloader').fadeOut();
        SU_revise_conexion();    
    });
  });

}

function borrarCurso(idCurso){

  swal({
    title: "Advertencia!!",
    text:"Esta seguro que desea borrar el curso ",
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
    miurl=urlraiz+"/configuracion/borrar_curso/"+idCurso+"";
    $.ajax({
    // la URL para la petición
      url : miurl,
    })
    .done(function(resul) {
        $('.preloader').fadeOut();
        if(resul.estado=="borrada"){  location.reload();  }
        if(resul.estado!="borrada"){  location.reload();  }
        
    }).fail(function(err){
        $('.preloader').fadeOut();
        SU_revise_conexion();    
    });
  });

}

function borrarClasificacion(idClasificacion){

  swal({
    title: "Advertencia!!",
    text:"Esta seguro que desea borrar la clasificación ",
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
    miurl=urlraiz+"/configuracion/borrar_clasificacion/"+idClasificacion+"";
    $.ajax({
    // la URL para la petición
      url : miurl,
    })
    .done(function(resul) {
        $('.preloader').fadeOut();
        if(resul.estado=="borrada"){  location.reload();  }
        if(resul.estado!="borrada"){  location.reload();  }
        
    }).fail(function(err){
        $('.preloader').fadeOut();
        SU_revise_conexion();    
    });
  });

}

function editarAnio(idAnio){
  $('#modal_editar_anio').modal('show');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/frm_editar_anio/"+idAnio+"";

  $.ajax({
  url: miurl
  }).done( function(resul){
  
    $('.preloader').fadeOut();
    $("#contenido_modal_editar_anio").html(resul);
 
  }).fail( function() 
 {
  $('.preloader').fadeOut();
   SU_revise_conexion();
 }) ;
// body...
}

function editarDimencion(idDimension){
  $('#modal_editar_dimension').modal('show');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/frm_editar_dimension/"+idDimension+"";

  $.ajax({
  url: miurl
  }).done( function(resul){
  
    $('.preloader').fadeOut();
    $("#contenido_modal_editar_dimension").html(resul);
 
  }).fail( function() 
 {
  $('.preloader').fadeOut();
   SU_revise_conexion();
 }) ;
// body...
}



function infoClasesConfig(idDocente,idAnio){
  const tbody = document.querySelector("#miTabla tbody");
  if(tbody != null){
    tbody.innerHTML = ""; // Limpiar contenido anterior
  }

  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/consultar_lista_anios/"+idDocente+"/"+idAnio+"";

  $.ajax({
  url: miurl
  }).done( function(resul){
    const lstClasesConfiguradas = resul.lstAnio;
    if(lstClasesConfiguradas.length > 0){
      const tabla = document.getElementById('tablaMaterias');
      let asignacionIndex = 0;
      lstClasesConfiguradas.forEach(function(clase){
        const cursos = JSON.parse(clase.json_cursos);
        //const ids_grados = cursos.map(g => g.id);
        const ids_grados = cursos.map(curso => ({ value: curso.id }));
        const cursosTexto = cursos.map(g => g.nombre).join(', ');
        const row = document.createElement('tr');
          row.innerHTML = `
            <td>${clase.nom_anio}<input type="hidden" name="asignaciones[${asignacionIndex}][anio]" value="${clase.id_anio}"></td>
            <td>${clase.nom_materia}<input type="hidden" name="asignaciones[${asignacionIndex}][materia]" value="${clase.id_materia}"></td>
            <td>${cursosTexto}<input type="hidden" name="asignaciones[${asignacionIndex}][cursos][]" value="${ids_grados}"</td>
            <td style="text-align: center;"><button type="button" class="btn btn-danger btn-sm " onclick="eliminarCurso(${clase.id}, this)">🗑️</button></td>
          `;
          tabla.appendChild(row);
          asignacionIndex++;
        })
    }
  }).fail( function() 
 {
  $('.preloader').fadeOut();
   SU_revise_conexion();
 }) ;  
}

function infoDirGrupo(idDocente,idAnio){
  const tbody = document.querySelector("#miTabla tbody");
  if(tbody != null){
    tbody.innerHTML = ""; // Limpiar contenido anterior
  }

  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/consultar_lista_director_grupo/"+idDocente+"/"+idAnio+"";

  $.ajax({
  url: miurl
  }).done( function(resul){
    const lstDirectorConfiguradas = resul.lstDirector;
    if(lstDirectorConfiguradas.length > 0){
      const tabla = document.getElementById('tablaDirectorGrupo');
      let asignacionIndex = 0;
      lstDirectorConfiguradas.forEach(function(clase){
        const row = document.createElement('tr');
          row.innerHTML = `
            <td>${clase.nom_anio}<input type="hidden" name="asignaciones[${asignacionIndex}][anio]" value="${clase.id_anio}"></td>
            <td>${clase.nom_curso}<input type="hidden" name="asignaciones[${asignacionIndex}][materia]" value="${clase.id_curso}"></td>
            <td style="text-align: center;"><button type="button" class="btn btn-danger btn-sm " onclick="eliminarGrupo(${clase.id}, this)">🗑️</button></td>
          `;
          tabla.appendChild(row);
          asignacionIndex++;
        })
    }else{
      document.getElementById("btn_actualizar").style.display = "none";
    }
  }).fail( function() 
 {
  $('.preloader').fadeOut();
   SU_revise_conexion();
 }) ;  
}

function matricularEstudiante(idEstudiante){
  $('#modal_asociar_estudiantes').modal('show');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/frm_asociar_curso/"+idEstudiante+"";

  $.ajax({
  url: miurl
  }).done( function(resul){
  
    $('.preloader').fadeOut();
    $("#contenido_modal_asociar_estudiantes").html(resul);
 
  }).fail( function() 
 {
  $('.preloader').fadeOut();
   SU_revise_conexion();
 }) ;

}

function infoGrados(idTipo){
    const tipoGradoSelectParam = Number(idTipo);
    var arrayCursos=CURSOS?CURSOS:[];
    const lstCursosConfiguradas = arrayCursos.filter(
      item => Number(item.tipo_grado) === tipoGradoSelectParam
    );

    var mateHtmlteams = '';
    mateHtmlteams = '<option value="" class="" selected>Seleccione...</option>';
    lstCursosConfiguradas.forEach(function(citi){
      mateHtmlteams += '<option value="'+citi.id+'" class="">'+citi.nombre+'</option>';
    })
    $('#curso').html(mateHtmlteams);
    document.getElementById("curso").disabled = false;

}

function eliminarAsociacion(idAsociacion){
  swal({
    title: "Advertencia!!",
    text:"Esta seguro que desea borrar la matricula del estudiante a este periodo",
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
    miurl=urlraiz+"/configuracion/borrar_asocacion/"+idAsociacion+"";
    $.ajax({
    // la URL para la petición
      url : miurl,
    })
    .done(function(resul) {
        $('.preloader').fadeOut();
        if(resul.estado=="borrada"){  location.reload();  }
        if(resul.estado!="borrada"){  location.reload();  }
        toastr.success('La matricula fue eliminada exitosamente', '¡Éxito!');
    }).fail(function(err){
        $('.preloader').fadeOut();
        SU_revise_conexion();    
    });
  });

}

function infoMateriasConcepto(idAnio,idDocente){
 
  $('.preloader').fadeIn();

  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/info_materia_docente/"+idAnio+"/"+idDocente+"";
  $.ajax({
  // la URL para la petición
    url : miurl,
  })
  .done(function(resul) {
    var data = resul.materias;
    var mateHtmlteams = '';
    mateHtmlteams = '<option value="" class="" selected>Seleccione...</option>';
    data.forEach(function(citi){
      mateHtmlteams += '<option value="'+citi.id_materia+'" class="">'+citi.nom_materia+'</option>';
    })
    $('#materia').html(mateHtmlteams);
    document.getElementById("materia").disabled = false;

  $('.preloader').fadeOut();
     
  }).fail(function(err){
      $('.preloader').fadeOut();
      SU_revise_conexion();    
  });


}

function infoCursosConcepto(idMateria, idDocente){
 
  $('.preloader').fadeIn();
  var idAnio = document.getElementById("anio").value;

  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/info_cursos_docente/"+idAnio+"/"+idDocente+"/"+idMateria+"";
  $.ajax({
  // la URL para la petición
    url : miurl,
  })
  .done(function(resul) {
    var dataC = resul.cursos;
    var mateHtmlteams = '';
    mateHtmlteams = '<option value="" class="" selected>Seleccione...</option>';
    dataC.forEach(function(curso){
      mateHtmlteams += '<option value="'+curso.id+'" class="">'+curso.nombre+'</option>';
    })
    $('#curso').html(mateHtmlteams);
    document.getElementById("curso").disabled = false;

  $('.preloader').fadeOut();
     
  }).fail(function(err){
      $('.preloader').fadeOut();
      SU_revise_conexion();    
  });


}

$(document).on("submit","#f_nuevo_concepto",function(e){
  //funcion para crear un nuevo usuario
 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/configuracion/nuevo_concepto";
 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType: 'json',
 })
 .done(function(resul) {
  console.log(resul);
  if(resul.message == 'NO'){
    toastr.warning('EL concepto que esta intentanto adicionar ya se enceuntra almacenado. Valida la información e intenta nuevamente ', '¡Advertencia!');
  }else{
    toastr.success('EL concepto fue alamacenado exitosamente ', 'Exito!');
    $('#conceptos').val('');

     //$("#contenido_modal_nuevo_concepto").html(resul);
  }
     $('.preloader').fadeOut();
  })
 .fail(function(err){
     $('.preloader').fadeOut();
     SU_revise_conexion();    
 });
});

$(document).on("submit","#f_nuevo_concepto_comp",function(e){
  //funcion para crear un nuevo usuario
 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/configuracion/nuevo_concepto_comp";
 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType: 'json',
 })
 .done(function(resul) {
  console.log(resul);
  if(resul.message == 'NO'){
    toastr.warning('EL concepto que esta intentanto adicionar ya se enceuntra almacenado. Valida la información e intenta nuevamente ', '¡Advertencia!');
  }else{
    toastr.success('EL concepto fue alamacenado exitosamente ', 'Exito!');
    $('#conceptos').val('');

     //$("#contenido_modal_nuevo_concepto").html(resul);
  }
     $('.preloader').fadeOut();
  })
 .fail(function(err){
     $('.preloader').fadeOut();
     SU_revise_conexion();    
 });
});

$(document).on("submit","#f_nuevo_concepto_trans",function(e){
  //funcion para crear un nuevo usuario
 e.preventDefault();
 $('.preloader').fadeIn();

 var formu=$(this);
 var urlraiz=$("#url_raiz_proyecto").val();
 var varurl=urlraiz+"/configuracion/nuevo_concepto_trans";
 
 $.ajax({
   // la URL para la petición
   url : varurl,
   data : formu.serialize(),
   method: 'POST',
   dataType: 'json',
 })
 .done(function(resul) {
  console.log(resul);
  if(resul.message == 'NO'){
    toastr.warning('EL concepto que esta intentanto adicionar ya se enceuntra almacenado. Valida la información e intenta nuevamente ', '¡Advertencia!');
  }else{
    toastr.success('EL concepto fue alamacenado exitosamente ', 'Exito!');
    $('#conceptos').val('');

     //$("#contenido_modal_nuevo_concepto").html(resul);
  }
     $('.preloader').fadeOut();
  })
 .fail(function(err){
     $('.preloader').fadeOut();
     SU_revise_conexion();    
 });
});



function editarconcepto(idConcepto){
  $('#modal_editar_concepto').modal('show');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/frm_editar_concepto/"+idConcepto+"";

  $.ajax({
  url: miurl
  }).done( function(resul){
  
    $('.preloader').fadeOut();
    $("#contenido_modal_editar_concepto").html(resul);
 
  }).fail( function() 
 {
  $('.preloader').fadeOut();
   SU_revise_conexion();
 }) ;
// body...
}

function editarconceptoComp(idConcepto){
  $('#modal_editar_concepto_comp').modal('show');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/frm_editar_concepto_comp/"+idConcepto+"";

  $.ajax({
  url: miurl
  }).done( function(resul){
  
    $('.preloader').fadeOut();
    $("#contenido_modal_editar_concepto_comp").html(resul);
 
  }).fail( function() 
 {
  $('.preloader').fadeOut();
   SU_revise_conexion();
 }) ;
// body...
}

function editarconceptoTrans(idConcepto){
  $('#modal_editar_concepto_trans').modal('show');
  $('.preloader').fadeIn();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl='';
  miurl=urlraiz+"/configuracion/frm_editar_concepto_trans/"+idConcepto+"";

  $.ajax({
  url: miurl
  }).done( function(resul){
  
    $('.preloader').fadeOut();
    $("#contenido_modal_editar_concepto_trans").html(resul);
 
  }).fail( function() 
 {
  $('.preloader').fadeOut();
   SU_revise_conexion();
 }) ;
// body...
}



function borrarconcepto(idConcepto){
  swal({
    title: "Advertencia!!",
    text:"Esta seguro que desea borrar el concepto..",
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
    miurl=urlraiz+"/configuracion/borrar_concepto/"+idConcepto+"";
    $.ajax({
    // la URL para la petición
      url : miurl,
    })
    .done(function(resul) {
        $('.preloader').fadeOut();
        if(resul.estado=="borrada"){  location.reload();  }
        if(resul.estado!="borrada"){  location.reload();  }
         toastr.success('El concepto fue eliminado exitosamente', '¡Éxito!');
    }).fail(function(err){
        $('.preloader').fadeOut();
        SU_revise_conexion();    
    });
  });

}

function borrarconceptoComp(idConcepto){
  swal({
    title: "Advertencia!!",
    text:"Esta seguro que desea borrar el concepto..",
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
    miurl=urlraiz+"/configuracion/borrar_concepto_comp/"+idConcepto+"";
    $.ajax({
    // la URL para la petición
      url : miurl,
    })
    .done(function(resul) {
        $('.preloader').fadeOut();
        if(resul.estado=="borrada"){  location.reload();  }
        if(resul.estado!="borrada"){  location.reload();  }
         toastr.success('El concepto fue eliminado exitosamente', '¡Éxito!');
    }).fail(function(err){
        $('.preloader').fadeOut();
        SU_revise_conexion();    
    });
  });

}

function borrarconceptoTrans(idConcepto){
  swal({
    title: "Advertencia!!",
    text:"Esta seguro que desea borrar el concepto..",
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
    miurl=urlraiz+"/configuracion/borrar_concepto_trans/"+idConcepto+"";
    $.ajax({
    // la URL para la petición
      url : miurl,
    })
    .done(function(resul) {
        $('.preloader').fadeOut();
        if(resul.estado=="borrada"){  location.reload();  }
        if(resul.estado!="borrada"){  location.reload();  }
         toastr.success('El concepto fue eliminado exitosamente', '¡Éxito!');
    }).fail(function(err){
        $('.preloader').fadeOut();
        SU_revise_conexion();    
    });
  });

}

function borrarDimencion(idDimension){
  swal({
    title: "Advertencia!!",
    text:"Esta seguro que desea borrar la dimensión..",
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
    miurl=urlraiz+"/configuracion/borrar_dimension/"+idDimension+"";
    $.ajax({
    // la URL para la petición
      url : miurl,
    })
    .done(function(resul) {
        $('.preloader').fadeOut();
        if(resul.estado=="borrada"){  location.reload();  }
        if(resul.estado!="borrada"){  location.reload();  }
         toastr.success('El concepto fue eliminado exitosamente', '¡Éxito!');
    }).fail(function(err){
        $('.preloader').fadeOut();
        SU_revise_conexion();    
    });
  });

}

$(document).on("submit","#f_editar_concepto",function(e){
  //funcion para crear un nuevo usuario
  e.preventDefault();
  $('.preloader').fadeIn();

  var formu=$(this);
  var urlraiz=$("#url_raiz_proyecto").val();
  var varurl=urlraiz+"/configuracion/editar_concepto";
  
  $.ajax({
    // la URL para la petición
    url : varurl,
    data : formu.serialize(),
    method: 'POST',
    dataType : 'html'
  })
  .done(function(resul) {
      $('.preloader').fadeOut();
      $("#contenido_modal_editar_concepto").html(resul);
    })
  .fail(function(err){
      $('.preloader').fadeOut();
      SU_revise_conexion();    
  });
});

$(document).on("submit","#f_editar_concepto_comp",function(e){
  //funcion para crear un nuevo usuario
  e.preventDefault();
  $('.preloader').fadeIn();

  var formu=$(this);
  var urlraiz=$("#url_raiz_proyecto").val();
  var varurl=urlraiz+"/configuracion/editar_concepto_comp";
  
  $.ajax({
    // la URL para la petición
    url : varurl,
    data : formu.serialize(),
    method: 'POST',
    dataType : 'html'
  })
  .done(function(resul) {
      $('.preloader').fadeOut();
      $("#contenido_modal_editar_concepto_comp").html(resul);
    })
  .fail(function(err){
      $('.preloader').fadeOut();
      SU_revise_conexion();    
  });
});

$(document).on("submit","#f_editar_concepto_trans",function(e){
  //funcion para crear un nuevo usuario
  e.preventDefault();
  $('.preloader').fadeIn();

  var formu=$(this);
  var urlraiz=$("#url_raiz_proyecto").val();
  var varurl=urlraiz+"/configuracion/editar_concepto_trans";
  
  $.ajax({
    // la URL para la petición
    url : varurl,
    data : formu.serialize(),
    method: 'POST',
    dataType : 'html'
  })
  .done(function(resul) {
      $('.preloader').fadeOut();
      $("#contenido_modal_editar_concepto_trans").html(resul);
    })
  .fail(function(err){
      $('.preloader').fadeOut();
      SU_revise_conexion();    
  });
});

function finalizarAnioEscolar(idAnio){
  swal({
    title: "Advertencia!!",
    text:"Esta seguro que desea finalizar el año escolar..",
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
    miurl=urlraiz+"/configuracion/finalizar_anio_escolar/"+idAnio+"";
    $.ajax({
    // la URL para la petición
      url : miurl,
    })
    .done(function(resul) {
        $('.preloader').fadeOut();
        if(resul.estado=="borrada"){  location.reload();  }
        if(resul.estado!="borrada"){  location.reload();  }
         toastr.success('El proceso se finalizó con éxitosamente', '¡Éxito!');
    }).fail(function(err){
        $('.preloader').fadeOut();
        SU_revise_conexion();    
    });
  });

}















