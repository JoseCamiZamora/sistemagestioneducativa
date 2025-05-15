<style>
    .datepicker {
        border-radius: 0rem !important;
        direction: ltr;
    }

    .datepicker {
        font-size: .85rem;
        padding: 0px !important;
        border-radius: 0rem !important;
        direction: ltr;
        border: 1px solid #9b9ba8;
        width: 139.2px;
    }

    .ui-timepicker-standard {

        z-index: 9999 !important;
    }

    .seleccionada {
        background-color: yellow; /* Cambia el color de fondo */
        font-weight: bold; /* Hace el texto en negrita */
    }

    .sugerencias {
        position: absolute; /* ✅ Hace que la lista se superponga */
        background: white;
        border: 1px solid #ccc;
        list-style: none;
        padding: 5px;
        width: 200px;
        max-height: 150px;
        overflow-y: auto;
        z-index: 1000; /* ✅ Asegura que la lista esté por encima de otros elementos */
        box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
        display: none; /* ✅ Se oculta inicialmente */
    }   
</style>
<form  method="post"  action="editar_estudiante" id="f_editar_estudiante"   >
   <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
   <input type="hidden" id="id_estudiante" name="id_estudiante" value="{{$estudiante->id}}"> 
   <div class="form-row" style="background-color: #66d1ea">
      <label for="feLastName" style="color: black; margin-top: 8px;margin-left: 8px">DATOS BASICOS DEL ESTUDIANTE</label>
    </div>
    <div class="form-row col-md-12 mt-3">
      <div class="col-md-2">
          <label for="feLastName">Tipo documento</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="tipoDocumento" name="tipoDocumento" style="margin-top: -6px; height: 33px;padding-top: 4px;" >
            <option value="{{$estudiante->id_tipo_documento}}">{{$estudiante->tipo_documento}}</option>
            @foreach($tiposDocumentos as $tipo)
              <option value="{{$tipo->id}}">{{$tipo->descripcion}}</option>
            @endforeach
          </select>
      </div>
      <div class="form-group col-md-3">
        <label for="feLastName">Nro. Identificación</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="12" class="form-control" id="identificacion" name="identificacion"  
        value="{{$estudiante->identificacion}}"  >
      </div>
      <div class="form-group col-md-3">
        <label for="feLastName">Lugar de Expedición</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="12" class="form-control" id="lugar_expedicion" name="lugar_expedicion"  
        value="{{$estudiante->lugar_expedicion}}"  >
      </div>
      <div class="form-group col-md-2" >
        <label for="feLastName">Fecha Nacimiento</label><spam style="color: red;"> * </spam>
        <input  class="form-control datepicker"   name="fecha_nacimiento"  
         style="height: 32px" value="{{$estudiante->fecha_nacimiento}}">
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Lugar de Nacimiento</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="12" class="form-control" id="lugar_nacimeinto" name="lugar_nacimeinto"  
        value="{{$estudiante->lugar_nacimiento}}"  >
      </div>
    </div>
    <div class="form-row col-md-12 mt-3">
      <div class="form-group col-md-2">
        <label for="feLastName">Primer Nombre</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="125" class="form-control" id="primer_nombre" name="primer_nombre" 
        value="{{$estudiante->primer_nombre}}" >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Segundo Nombre</label>
        <input type="text" maxlength="125" class="form-control" id="segundo_nombre" name="segundo_nombre" 
        value="{{$estudiante->segundo_nombre}}"  >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Primer Apellido</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="125" class="form-control" id="primer_apellido" name="primer_apellido" 
        value="{{$estudiante->primer_apellido}}" >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Segundo Apellidos</label>
        <input type="text" maxlength="125" class="form-control" id="segundo_apellido" name="segundo_apellido" 
        value="{{$estudiante->segundo_apellido}}"  >
      </div>
      <div class="col-md-2" >
         <label for="feLastName">Genero</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="genero" name="genero" style="margin-top: -6px; height: 33px;padding-top: 4px;"  >
            <option value="{{$estudiante->genero}}" selected >{{$estudiante->genero}}</option>
            <option value="Masculino" >Masculino</option>
            <option value="Femenino" >Femenino</option>
            <option value="No binario" >No binario</option>
          </select>
      </div>
      <div class="col-md-2" >
         <label for="feLastName">Tipo De Sangre(RH)</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="rh" name="rh" style="margin-top: -6px; height: 33px;padding-top: 4px;"  >
            <option value="{{$estudiante->tipo_rh}}" selected >{{$estudiante->tipo_rh}}</option>
            <option value="A+" >A+</option>
            <option value="A-" >A-</option>
            <option value="B+" >B+</option>
            <option value="B-" >B-</option>
            <option value="AB+" >AB+</option>
            <option value="AB-" >AB-</option>
            <option value="O+" >O+</option>
            <option value="O-" >O-</option>
          </select>
      </div>
    </div>
    <br>
    <div class="form-row" style="background-color: #66d1ea">
      <label for="feLastName" style="color: black; margin-top: 8px;margin-left: 8px">DATOS DE UBICACION Y CONTACTO DEL ESTUDIANTE</label>
    </div>
    <div class="form-row col-md-12 mt-2">
      <div class="form-group col-md-2">
        <label for="feLastName">Nacionalidad</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="125" class="form-control" id="nacionalidad" name="nacionalidad" 
        value="{{$estudiante->nacionalidad}}"  >
      </div>
      <div class="form-group col-md-4">
        <label for="feLastName">Dirección Recidencia</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="125" class="form-control" id="direccion" name="direccion" 
        value="{{$estudiante->direccion}}"  >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Barrio</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="125" class="form-control" id="barrio" name="barrio" 
        value="{{$estudiante->barrio}}"  >
      </div>
      <div class="col-md-2" >
         <label for="feLastName">Comuna</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="comuna" name="comuna" style="margin-top: -6px; height: 33px;padding-top: 4px;" >
            <option value="{{$estudiante->comuna}}" selected >{{$estudiante->comuna}}</option>
            <option value="Comuna 1" >Comuna 1</option>
            <option value="Comuna 2" >Comuna 2</option>
            <option value="Comuna 3" >Comuna 3</option>
            <option value="Comuna 4" >Comuna 4</option>
            <option value="Comuna 5" >Comuna 5</option>
            <option value="Comuna 6" >Comuna 6</option>
            <option value="Comuna 7" >Comuna 7</option>
            <option value="Comuna 8" >Comuna 8</option>
            <option value="Comuna 9" >Comuna 9</option>
            <option value="Comuna 10" >Comuna 10</option>
            <option value="Comuna 11" >Comuna 11</option>
            <option value="Comuna 12" >Comuna 12</option>
          </select>
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Corregimiento</label>
        <input type="text" maxlength="125" class="form-control" id="corregimiento" name="corregimiento" 
        value="{{$estudiante->corregimiento}}"  >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Vereda</label>
        <input type="text" maxlength="125" class="form-control" id="vereda" name="vereda" 
        value="{{$estudiante->vereda}}"  >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Telefono</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="12" class="form-control" id="telefono" name="telefono" value="{{$estudiante->telefono}}"  >
      </div>
      <div class="form-group col-md-4">
        <label for="feLastName">Correo electrónico</label>
        <input type="text" maxlength="125" class="form-control" id="email" name="email" value="{{$estudiante->correo_electronico}}" >
      </div>
    </div>
    <br>
    <div class="form-row" style="background-color: #66d1ea">
      <label for="feLastName" style="color: black; margin-top: 8px;margin-left: 8px">DATOS BASICOS PADRE/MADRE O ACUDIENTE</label>
    </div>
    <div class="form-row col-md-12 mt-3">
    @if($responsable1 == "N")
      <div class="col-md-2" >
         <label for="feLastName">Parentesco</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="parentesco1" name="parentesco1" style="margin-top: -6px; height: 33px;padding-top: 4px;" >
            <option value="" selected >Seleccione...</option>
            <option value="Padre" >Padre</option>
            <option value="Madre" >Madre</option>
            <option value="Acudiente" >Acudiente</option>
          </select>
      </div>
      <div class="col-md-2">
          <label for="feLastName">Tipo documento</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="tipoDocumento1" name="tipoDocumento1" style="margin-top: -6px; height: 33px;padding-top: 4px;" >
            <option value="" selected >Seleccione...</option>
            @foreach($tiposDocumentos as $tipo)
              <option value="{{$tipo->codigo}}">{{$tipo->descripcion}}</option>
            @endforeach
          </select>
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Nro. Identificación</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="125" class="form-control" id="nro_identificacion1" name="nro_identificacion1" 
        value="" >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Nombres y apellidos</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="125" class="form-control" id="nombres1" name="nombres1" 
        value="" >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Ocupación</label>
        <input type="text" maxlength="125" class="form-control" id="ocupacion1" name="ocupacion1" 
        value="" >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Telefono</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="12" class="form-control" id="telefono1" name="telefono1" 
        value="" >
      </div>
      @else
        <div class="col-md-2" >
          <label for="feLastName">Parentesco</label><spam style="color: red;"> * </spam>
            <select class="form-control" id="parentesco1" name="parentesco1" style="margin-top: -6px; height: 33px;padding-top: 4px;" >
              <option value="{{$responsable1->tipo}}" selected >{{$responsable1->tipo}}</option>
              <option value="Padre" >Padre</option>
              <option value="Madre" >Madre</option>
              <option value="Acudiente" >Acudiente</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="feLastName">Tipo documento</label><spam style="color: red;"> * </spam>
            <select class="form-control" id="tipoDocumento1" name="tipoDocumento1" style="margin-top: -6px; height: 33px;padding-top: 4px;" >
              <option value="{{$responsable1->id_documento}}" selected >{{$responsable1->nombreDocumento}}</option>
              @foreach($tiposDocumentos as $tipo)
                <option value="{{$tipo->codigo}}">{{$tipo->descripcion}}</option>
              @endforeach
            </select>
        </div>
        <div class="form-group col-md-2">
          <label for="feLastName">Nro. Identificación</label><spam style="color: red;"> * </spam>
          <input type="text" maxlength="125" class="form-control" id="nro_identificacion1" name="nro_identificacion1" 
          value="{{$responsable1->identificacion}}" >
        </div>
        <div class="form-group col-md-2">
          <label for="feLastName">Nombres y apellidos</label><spam style="color: red;"> * </spam>
          <input type="text" maxlength="125" class="form-control" id="nombres1" name="nombres1" 
          value="{{$responsable1->nombres}}" >
        </div>
        <div class="form-group col-md-2">
          <label for="feLastName">Ocupación</label>
          <input type="text" maxlength="125" class="form-control" id="ocupacion1" name="ocupacion1" 
          value="{{$responsable1->ocupacion}}" >
        </div>
        <div class="form-group col-md-1">
          <label for="feLastName">Telefono</label><spam style="color: red;"> * </spam>
          <input type="text" maxlength="12" class="form-control" id="telefono1" name="telefono1" 
          value="{{$responsable1->telefono}}"  >
        </div>
        <div class="form-group col-md-1" style="margin-top: 16px;">
        <a class="nav-link nav-link-icon text-center"  href="javascript:void(0);" onclick="borrarDataAcudiente1()" role="button" id="subirfile" >
          <i class="fa fa-trash" title="Editar Insumo" style=""></i><br>
        </a>
      </div>
      @endif
    </div>
    <div class="form-row col-md-12 mt-3">
    @if($responsable2 == "N")
      <div class="col-md-2" >
         <label for="feLastName">Parentesco</label>
          <select class="form-control" id="parentesco2" name="parentesco2"  style="margin-top: -6px; height: 33px;padding-top: 4px;" >
            <option value="" selected >Seleccione...</option>
            <option value="Padre" >Padre</option>
            <option value="Madre" >Madre</option>
            <option value="Acudiente" >Acudiente</option>
          </select>
      </div>
      <div class="col-md-2">
          <label for="feLastName">Tipo documento</label>
          <select class="form-control" id="tipoDocumento2" name="tipoDocumento2"  style="margin-top: -6px; height: 33px;padding-top: 4px;" >
            <option value="" selected >Seleccione...</option>
            @foreach($tiposDocumentos as $tipo)
              <option value="{{$tipo->codigo}}">{{$tipo->descripcion}}</option>
            @endforeach
          </select>
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Nro. Identificación</label>
        <input type="text" maxlength="125" class="form-control" id="nro_identificacion2" name="nro_identificacion2" 
        value="" >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Nombres y Apellidos</label>
        <input type="text" maxlength="125" class="form-control" id="nombres2" name="nombres2" 
        value="" >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Ocupación</label>
        <input type="text" maxlength="125" class="form-control" id="ocupacion2" name="ocupacion2" 
        value="" >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Telefono</label>
        <input type="text" maxlength="12" class="form-control" id="telefono2" name="telefono2" 
        value="" >
      </div>
      @else
        <div class="col-md-2" >
          <label for="feLastName">Parentesco</label>
            <select class="form-control" id="parentesco2" name="parentesco2" style="margin-top: -6px; height: 33px;padding-top: 4px;" >
              <option value="{{$responsable2->tipo}}" selected >{{$responsable2->tipo}}</option>
              <option value="Padre" >Padre</option>
              <option value="Madre" >Madre</option>
              <option value="Acudiente" >Acudiente</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="feLastName">Tipo documento</label>
            <select class="form-control" id="tipoDocumento2" name="tipoDocumento2" style="margin-top: -6px; height: 33px;padding-top: 4px;" >
              <option value="{{$responsable2->id_documento}}" selected >{{$responsable2->nombreDocumento}}</option>
              @foreach($tiposDocumentos as $tipo)
                <option value="{{$tipo->codigo}}">{{$tipo->descripcion}}</option>
              @endforeach
            </select>
        </div>
        <div class="form-group col-md-2">
          <label for="feLastName">Nro. Identificación</label>
          <input type="text" maxlength="125" class="form-control" id="nro_identificacion2" name="nro_identificacion2" 
          value="{{$responsable2->identificacion}}" >
        </div>
        <div class="form-group col-md-2">
          <label for="feLastName">Nombres y Apellidos</label>
          <input type="text" maxlength="125" class="form-control" id="nombres2" name="nombres2" 
          value="{{$responsable2->nombres}}" >
        </div>
        <div class="form-group col-md-2">
          <label for="feLastName">Ocupación</label>
          <input type="text" maxlength="125" class="form-control" id="ocupacion2" name="ocupacion2" 
          value="{{$responsable2->ocupacion}}" >
        </div>
        <div class="form-group col-md-1">
          <label for="feLastName">Telefono</label>
          <input type="text" maxlength="12" class="form-control" id="telefono2" name="telefono2" 
          value="{{$responsable2->telefono}}" >
        </div>
        <div class="form-group col-md-1" style="margin-top: 16px;">
        <a class="nav-link nav-link-icon text-center"  href="javascript:void(0);" onclick="borrarDataAcudiente2()" role="button" id="subirfile" >
          <i class="fa fa-trash" title="Editar Insumo" style=""></i><br>
        </a>
      </div>
      @endif
    </div>
    <div class="form-row col-md-12 mt-3">
    @if($responsable3 == "N")
    <div class="col-md-2" >
         <label for="feLastName">Parentesco</label>
          <select class="form-control" id="parentesco3" name="parentesco3" style="margin-top: -6px; height: 33px;padding-top: 4px;" >
            <option value="" selected >Seleccione...</option>
            <option value="Padre" >Padre</option>
            <option value="Madre" >Madre</option>
            <option value="Acudiente" >Acudiente</option>
          </select>
      </div>
      <div class="col-md-2">
          <label for="feLastName">Tipo documento</label>
          <select class="form-control" id="tipoDocumento3" name="tipoDocumento3" style="margin-top: -6px; height: 33px;padding-top: 4px;"  >
            <option value="" selected >Seleccione...</option>
            @foreach($tiposDocumentos as $tipo)
              <option value="{{$tipo->codigo}}">{{$tipo->descripcion}}</option>
            @endforeach
          </select>
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Nro. Identificación</label>
        <input type="text" maxlength="125" class="form-control" id="nro_identificacion3"  name="nro_identificacion3" 
        value="" >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Nombres y Apellidos</label>
        <input type="text" maxlength="125" class="form-control" id="nombres3" name="nombres3" 
        value="" >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Ocupación</label>
        <input type="text" maxlength="125" class="form-control" id="ocupacion3" name="ocupacion3"  
        value="" >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Telefono</label>
        <input type="text" maxlength="12" class="form-control" id="telefono3" name="telefono3"  value="" >
      </div>
    @else
    <div class="col-md-2" >
         <label for="feLastName">Parentesco</label>
          <select class="form-control" id="parentesco3" name="parentesco3"  style="margin-top: -6px; height: 33px;padding-top: 4px;" >
            <option value="{{$responsable3->tipo}}" selected >{{$responsable3->tipo}}</option>
            <option value="Padre" >Padre</option>
            <option value="Madre" >Madre</option>
            <option value="Acudiente" >Acudiente</option>
          </select>
      </div>
      <div class="col-md-2">
          <label for="feLastName">Tipo documento</label>
          <select class="form-control" id="tipoDocumento3" name="tipoDocumento3"  style="margin-top: -6px; height: 33px;padding-top: 4px;" >
            <option value="{{$responsable3->id_documento}}" selected >{{$responsable3->nombreDocumento}}</option>
            @foreach($tiposDocumentos as $tipo)
              <option value="{{$tipo->codigo}}">{{$tipo->descripcion}}</option>
            @endforeach
          </select>
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Nro. Identificación</label>
        <input type="text" maxlength="125" class="form-control" id="nro_identificacion3" name="nro_identificacion3" 
        value="{{$responsable3->identificacion}}" >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Nombres y Apellidos</label>
        <input type="text" maxlength="125" class="form-control" id="nombres3" name="nombres3" 
        value="{{$responsable3->nombres}}" >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Ocupación</label>
        <input type="text" maxlength="125" class="form-control" id="ocupacion3" name="ocupacion3" 
        value="{{$responsable3->ocupacion}}"  >
      </div>
      <div class="form-group col-md-1">
        <label for="feLastName">Telefono</label>
        <input type="text" maxlength="12" class="form-control" id="telefono3" name="telefono3" 
        value="{{$responsable3->telefono}}" >
      </div>
      <div class="form-group col-md-1" style="margin-top: 16px;">
        <a class="nav-link nav-link-icon text-center"  href="javascript:void(0);" onclick="borrarDataAcudiente3()" role="button" id="subirfile" >
            <i class="fa fa-trash" title="Editar Insumo" style=""></i><br>
        </a>
      </div>
    @endif
    </div>
    <br>
    <div class="form-row" style="background-color: #66d1ea">
      <label for="feLastName" style="color: black; margin-top: 8px;margin-left: 8px">DATOS ADICIONALES</label>
    </div>
    <div class="form-row col-md-12 mt-3">
      <div class="col-md-3" >
          <label for="feLastName">Cuenta Con Alguna Discapacidad</label><spam style="color: red;"> * </spam>
            <select class="form-control" id="discapaciadad" style="margin-top: -6px; height: 33px;padding-top: 4px;"name="discapaciadad" >
              <option value="{{$estudiante->tiene_discapacidad}}" selected >{{$estudiante->tiene_discapacidad}}</option>
              <option value="SI" >SI</option>
              <option value="NO" >NO</option>
            </select>
        </div>
        <div class="form-group col-md-9">
          <label for="feLastName">Describa la Discapacidad</label>
          <input type="text" maxlength="125" class="form-control" id="desc_discapacidad" name="desc_discapacidad" 
          value="{{$estudiante->desc_discapacidad}}" >
        </div>
    </div>
    <div class="form-row col-md-12 mt-3">
      <div class="col-md-2 " >
         <label for="feLastName">Tipo Seguridad Social</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="seguridad_social" name="seguridad_social" style="margin-top: -6px; height: 33px;padding-top: 4px;"  >
            <option value="{{$estudiante->tipos_seguridad_social}}" selected >{{$estudiante->tipos_seguridad_social}}</option>
            <option value="Subcidiado" >Subcidiado</option>
            <option value="Contributivo" >Contributivo</option>
            <option value="No_tiene" >No Tiene</option>
          </select>
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Nombre EPS</label>
        <input type="text" maxlength="125" class="form-control" id="eps" name="eps" value="{{$estudiante->eps}}"  >
      </div>
      <div class="col-md-2" >
         <label for="feLastName">Sisben</label>
          <select class="form-control" id="sisben" style="margin-top: -6px; height: 33px;padding-top: 4px;"name="sisben" >
            <option value="{{$estudiante->sisben}}" selected >{{$estudiante->sisben}}</option>
            <option value="Grupo A" >Grupo A</option>
            <option value="Grupo B" >Grupo B</option>
            <option value="Grupo C" >Grupo C</option>
            <option value="Grupo D" >Grupo D</option>
          </select>
      </div>
      <div class="col-md-2" >
         <label for="feLastName">Estrato</label>
          <select class="form-control"  style="margin-top: -6px; height: 33px;padding-top: 4px;" id="estrato" name="estrato" >
            <option value="{{$estudiante->estrato}}" selected >{{$estudiante->estrato}}</option>
            <option value="Nivel 1" >Nivel 1</option>
            <option value="Nivel 2" >Nivel 2</option>
            <option value="Nivel 3" >Nivel 3</option>
            <option value="Nivel 4" >Nivel 4</option>
            <option value="Nivel 5" >Nivel 5</option>
          </select>
      </div>
      <div class="col-md-4" >
        <label for="feLastName">Vacunas Recibidas</label>
        <div style="display: flex; gap: 20px; align-items: center;">
        @if($vacuna1 =='S')
          <label><input type="checkbox" name="vacunas[]" value="DPT" checked > DPT</label>
        @else
          <label><input type="checkbox" name="vacunas[]" value="DPT" > DPT</label>
        @endif
        @if($vacuna2 =='S')
          <label><input type="checkbox" name="vacunas[]" value="T.VIRAL" checked >  T.VIRAL</label>
        @else
          <label><input type="checkbox" name="vacunas[]" value="T.VIRAL" > T.VIRAL</label>
        @endif
        @if($vacuna3 =='S')
          <label><input type="checkbox" name="vacunas[]" value="POL" checked > POL</label>
        @else
          <label><input type="checkbox" name="vacunas[]" value="POL" > POL</label>
        @endif
        @if($vacuna4 =='S')
          <label><input type="checkbox" name="vacunas[]" value="SAR" checked > SAR</label>
        @else
          <label><input type="checkbox" name="vacunas[]" value="SAR" > SAR</label>
        @endif
        @if($vacuna5 =='S')
          <label><input type="checkbox" name="vacunas[]" value="BCB" checked > BCB</label>
        @else
          <label><input type="checkbox" name="vacunas[]" value="BCB" > BCB</label>
        @endif
        @if($vacuna6 =='S')
          <label><input type="checkbox" name="vacunas[]" value="HIB" checked > HIB</label>
        @else
          <label><input type="checkbox" name="vacunas[]" value="HIB" > HIB</label>
        @endif
        @if($vacuna7 =='S')
          <label><input type="checkbox" name="vacunas[]" value="H.V." checked > H.V.</label>
        @else
          <label><input type="checkbox" name="vacunas[]" value="H.V." > H.V.</label>
        @endif
        </div>
      </div>
     </div>
    <div class="form-row col-md-12 mt-3">
      <div class="col-md-6 " >
         <label for="feLastName">Poblacion Victima de Conflicto</label>
          <select class="form-control" id="victima_conflicto" name="victima_conflicto" style="margin-top: -6px; height: 33px;padding-top: 4px;" >
            <option value="{{$estudiante->pob_victima_conflicto}}" selected >{{$estudiante->pob_victima_conflicto}}</option>
            <option value="SI" >SI</option>
            <option value="NO" >NO</option>
          </select>
      </div>
      <div class="col-md-6 " >
         <label for="feLastName">Población Desmovilizada de Conlicto Armado</label>
          <select class="form-control" id="pob_des_conflicto" name="pob_des_conflicto" style="margin-top: -6px; height: 33px;padding-top: 4px;" >
            <option value="{{$estudiante->pob_desplazada_conflicto}}" selected >{{$estudiante->pob_desplazada_conflicto}}</option>
            <option value="SI" >SI</option>
            <option value="NO" >NO</option>
          </select>
      </div>
    </div>
    <div class="form-row col-md-12 mt-3">
      <div class="form-group col-md-12">
        <label for="feLastName">Observaciones Adicionales</label>
        <textarea id="observaciones" name="observaciones" rows="3" cols="33" maxlength="200" style="width: 100%;" >{{$estudiante->observaciones_adicionales}}</textarea>
      </div>
    </div>
    <br>
    <div class="form-row col-md-12 mt-3  text-center">
      <button type="submit" class="btn btn-accent text-center" >Actualziar Información Matricula</button>
    </div>
</form>
<script src="{{ asset('/assets/plugins/jquery.dropdown.min.js') }}"></script>
<script>
  $.fn.datepicker.defaults.format = "yyyy-mm-dd";
  $('.datepicker').datepicker({
      startDate: ''
  });
  if ($.fn.dropdown) {
        $('.dropdown-mul-1').dropdown({
            readOnly: false,
            limitCount: 40,
            multipleMode: 'label',
            choice: function() {
            }
        });

    }
</script>





                    