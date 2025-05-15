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

function editarEstudiante(id_estudiante){
  console.log(id_estudiante);
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

function editarcliente(id_cliente,estado) {

  console.log(id_cliente,estado);
    $('#modal_editar_cliente').modal();
    $('.preloader').fadeIn();
    var urlraiz=$("#url_raiz_proyecto").val();
    var miurl='';
    miurl=urlraiz+"/clientes/frm_editar_cliente/"+id_cliente+"";

    $.ajax({
    url: miurl
    }).done( function(resul){
    
      $('.preloader').fadeOut();
      $("#contenido_editar_modal_clientes").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;
  // body...
}

function IN_form_crear_cliente(){

    $('#modal_clientes').modal();
    $('.preloader').fadeIn();
    var urlraiz=$("#url_raiz_proyecto").val();
    var miurl='';
    miurl=urlraiz+"/clientes/form_nuevo_cliente";

    $.ajax({
    url: miurl
    }).done( function(resul){
      //console.log("Resultado", resul);
      $('.preloader').fadeOut();
      $("#contenido_modal_clientes").html(resul);
   
    }).fail( function() 
   {
    $('.preloader').fadeOut();
     SU_revise_conexion();
   }) ;
}



$(document).on("submit","#f_editar_cliente",function(e){
  //funcion para actualizar los datos del usuario
  e.preventDefault();
  $('.preloader').fadeIn();

  var formu=$(this);
  var urlraiz=$("#url_raiz_proyecto").val();
  var varurl=urlraiz+"/clientes/editar_cliente";

  $.ajax({
    url : varurl,
    data : formu.serialize(),
    method: 'POST',
    dataType : 'html',
    })
    .done(function(resul) {
     // console.log("Resul xxxxxxxxxxx", resul);
     $('.preloader').fadeOut();
     $("#contenido_editar_modal_clientes").html(resul);
    })
    .fail(function(err){
        SU_revise_conexion();
        $(".preloader").hide();
         
    });
  

});

function cargar_ciudades(idDepa){



  var arrayciudades=VARCIUDADES?VARCIUDADES:[];
  var lstCiti = [];

  arrayciudades.forEach(function(value){
    if(value.cod_departamento == idDepa){
      lstCiti.push(value.municipio);
    }
  });
  let result = lstCiti.filter((item,index)=>{
    return lstCiti.indexOf(item) === index;
  })

  var citiHtmlteams = '';
  citiHtmlteams = '<option value="" class="" selected>Seleccione...</option>';
  result.forEach(function(citi){
      citiHtmlteams += '<option value="'+citi+'" class="">'+citi+'</option>';
  })
  $('#ciudad').html(citiHtmlteams);

}