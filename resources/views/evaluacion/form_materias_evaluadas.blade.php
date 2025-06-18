
<form  method="post"  action="adicionar_observacion_final" id="f_adicionar_observacion_final"   >
    <div class="form-row col-md-12 mt-2">
      <div class="col-md-12">
        
          @foreach($evaluaciones as $eva)
            <input  class="form-control "   name="nom_estudiante" value="{{$eva->nom_materia}}" required style="margin-top: -6px;" disabled>
          @endforeach
      </div>
    </div>
</form>





                    