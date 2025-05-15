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

$(document).on("submit","#f_nuevo_cliente",function(e){
   //funcion para crear un nuevo usuario
  e.preventDefault();
  $('.preloader').fadeIn();

  var formu=$(this);
  var urlraiz=$("#url_raiz_proyecto").val();
  var varurl=urlraiz+"/clientes/crear_cliente";

  
  $.ajax({
    // la URL para la petición
    url : varurl,
    data : formu.serialize(),
    method: 'POST',
    dataType : 'html'
  })
  .done(function(resul) {
      $('.preloader').fadeOut();
      $("#contenido_modal_clientes").html(resul);
   })
  .fail(function(err){
      $('.preloader').fadeOut();
      SU_revise_conexion();    
  });
});

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


  //console.log("jejejeje",result);

  /*

 
  var tipoDoc = arraytipodoc.find(function(ins, index) {
      if(ins.codigo == INSUMOFOUND.codigo_identificacion )
        return true;   
  });

  if(INSUMOFOUND){
     $('#FAC_cliente_NIT').val(INSUMOFOUND.identificacion);
     $('#FAC_cliente_direccion').val(INSUMOFOUND.direccion);
     $('#FAC_cliente_telefono').val(INSUMOFOUND.telefono);
     $('#FAC_cliente_tipo_documento').val(tipoDoc.descripcion);
  }
*/
  

}

function esEmpresa(codigo){

console.log("jejejeje", codigo);
  if(codigo == 31){
    document.getElementById('dv').disabled = false;
  }else{
    document.getElementById('dv').disabled = true;
    $('#dv').val('');
  }
}