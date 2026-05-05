


@extends('layouts.app')



@section('content')

<div class="container">
    <div class="page-header row no-gutters py-4">
      <div class="col-12 col-sm-10 text-center text-sm-left mb-4 mb-sm-0">
        <span class="text-uppercase page-subtitle">MÓDULOS DE CONFIGURACION DEL SISTEMA</span>
        <h4 class="page-title">Bienvenido : {{ $usuario_actual->nombres }} </h4>
      </div>
      <div  class=" ml-auto" style="text-align: right; margin-top: 2px;">
          Atrás
          <a href="{{ url('home') }}" class="mb-2 btn btn-sm  mr-1 btn-redondo-suave text-primary" title="salir a menu" ><i class="fa fa-chevron-left" aria-hidden="true"></i> </a>
      </div>
    </div>
    <div class="row">

 @if($usuario_actual->rol == 1)
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
          
              <a href="{{ url('/configuracion/listado_clasificacion') }}" style='width: 100%'>
          
              <img src="{{ asset('/assets/img/materia.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
            
              <h4 style='margin-bottom: 1px;' >Clasificación de Cursos</h4>
              <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Configuración de tipo cursos</span>
              </a>
            
          </div>
        </div>
      </div>
    </div> 
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
          
              <a href="{{ url('/configuracion/listado_materias') }}" style='width: 100%'>
          
              <img src="{{ asset('/assets/img/cursos.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
            
              <h4 style='margin-bottom: 1px;' >Materias</h4>
              <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Configuración de materias</span>
              </a>
            
          </div>
        </div>
      </div>
    </div> 
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
          
              <a href="{{ url('/configuracion/listado_actividades') }}" style='width: 100%'>
          
                <img src="{{ asset('/assets/img/actividades.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
            
              <h4 style='margin-bottom: 1px;' >Actividades a Evaluar</h4>
              <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Configuración periodos escolares</span>
              </a>
            
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
          
              <a href="{{ url('/configuracion/listado_periodos') }}" style='width: 100%'>
          
                <img src="{{ asset('/assets/img/periodo.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
            
              <h4 style='margin-bottom: 1px;' >Periodos Escolares</h4>
              <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Configuración periodos escolares</span>
              </a>
            
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
          
              <a href="{{ url('/configuracion/index_conceptos') }}" style='width: 100%'>
          
                <img src="{{ asset('/assets/img/papeleria.png') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
            
              <h4 style='margin-bottom: 1px;' >Conceptos Evaluación</h4>
              <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Configuración de comceptos</span>
              </a>
            
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
          
              <a href="{{ url('/configuracion/listado_cursos') }}" style='width: 100%'>
          
              <img src="{{ asset('/assets/img/curso.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
            
              <h4 style='margin-bottom: 1px;' >Cursos</h4>
              <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Configuración de cursos</span>
              </a>
            
          </div>
        </div>
      </div>
    </div> 
      
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
          
              <a href="{{ url('/configuracion/listado_anios') }}" style='width: 100%'>
          
                <img src="{{ asset('/assets/img/calendar.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
            
              <h4 style='margin-bottom: 1px;' >Año Lectivo</h4>
              <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Información de los estudiantes</span>
              </a>
            
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
          
              <a href="{{ url('/configuracion/listado_docentes') }}" style='width: 100%'>
          
              <img src="{{ asset('/assets/img/confDocente.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
            
              <h4 style='margin-bottom: 1px;' >Configurar Docentes</h4>
              <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Configuración de Clases</span>
              </a>
            
          </div>
        </div>
      </div>
    </div> 
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
          
              <a href="{{ url('/configuracion/listado_estudiantes') }}" style='width: 100%'>
          
              <img src="{{ asset('/assets/img/asociar.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
            
              <h4 style='margin-bottom: 1px;' >Configurar Estudiantes</h4>
              <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Configuracion de docentes</span>
              </a>
            
          </div>
        </div>
      </div>
    </div> 
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
          
              <a href="{{ url('/configuracion/listado_anios_finalizar') }}" style='width: 100%'>
          
              <img src="{{ asset('/assets/img/finclase.png') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
            
              <h4 style='margin-bottom: 1px;' >Finalización de clases</h4>
              <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Finalizar año escolar</span>
              </a>
            
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
              <a href="#" style='width: 100%; text-decoration: none;' data-toggle="modal" data-target="#modalInactivar" data-bs-toggle="modal" data-bs-target="#modalInactivar">
              <img src="{{ asset('/assets/img/trabajador.png') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
              <h4 style='margin-bottom: 1px;' >Inactivar Estudiante</h4>
              <span class="text-danger" style="font-size:0.9em;margin-top:1px;" >Suspender del curso actual</span>
              </a>
          </div>
        </div>
      </div>
    </div>
      
    @endif


      <div class="col-md-12 ">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Actividad Reciente <span class="nav-link-icon__wrapper">
                      <i class="material-icons"></i>
                      <span id="cantidad_notificaciones" class="badge badge-pill badge-danger"  style="display: inline;padding: .1rem .25rem !important">0</span>
                    </span></h6>
                    <div class="block-handle"></div>
                  </div>
                
                 <div class="card-body p-0" id="bloque_actividad_reciente" >  
                    

                 </div>
                   
      </div>
  </div>
</div>

<div class="modal fade" id="modalInactivar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inactivar Estudiante del Curso</h5>
                <button type="button" class="close btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Año Académico</label>
                        <select id="select-anio" class="form-control">
                            <option value="">Seleccione año...</option>
                            @isset($anios)
                                @foreach($anios as $anio)
                                    <option value="{{ $anio->id }}">{{ $anio->anio_inicio }} - {{ $anio->anio_fin }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Grado / Curso</label>
                        <select id="select-grado" class="form-control" >
                            <option value="">Seleccione grado...</option>
                        </select>
                    </div>
                </div>

                <div class="table-responsive mt-3">
                    <table class="table table-striped table-bordered text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>Estudiante</th>
                                <th>Estado Actual</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-estudiantes">
                            <tr>
                                <td colspan="3" class="text-muted">Seleccione un año y un grado para ver los estudiantes</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAnio = document.getElementById('select-anio');
    const selectGrado = document.getElementById('select-grado');
    const tablaEstudiantes = document.getElementById('tabla-estudiantes');

    // 🌟 INYECTAMOS LA URL BASE DE LARAVEL AQUÍ
    const baseUrl = "{{ url('/') }}"; 

    // 1. Filtrar Grados al cambiar el Año
    selectAnio.addEventListener('change', function() {
        if(this.value) {
            // Usamos la baseUrl para construir la ruta correcta
            fetch(`${baseUrl}/get-grados/${this.value}`)
                .then(res => {
                    if(!res.ok) throw new Error("Error en la ruta al buscar grados");
                    return res.json();
                })
                .then(data => {
                    selectGrado.innerHTML = '<option value="">Seleccione grado...</option>';
                    data.forEach(g => {
                        selectGrado.innerHTML += `<option value="${g.id}">${g.nombre}</option>`;
                    });
                    selectGrado.disabled = false;
                })
                .catch(err => console.error("Error Fetch Grados: ", err));
        } else {
            selectGrado.innerHTML = '<option value="">Seleccione grado...</option>';
            selectGrado.disabled = true;
            tablaEstudiantes.innerHTML = '<tr><td colspan="3" class="text-muted">Seleccione un año y un grado para ver los estudiantes</td></tr>';
        }
    });

    // 2. Filtrar Estudiantes al cambiar el Grado
    selectGrado.addEventListener('change', function() {
        if(this.value && selectAnio.value) {
            tablaEstudiantes.innerHTML = '<tr><td colspan="3">Cargando...</td></tr>';
            
            // Usamos la baseUrl para construir la ruta correcta
            fetch(`${baseUrl}/get-estudiantes/${selectAnio.value}/${this.value}`)
                .then(res => {
                    if(!res.ok) throw new Error("Error en la ruta al buscar estudiantes");
                    return res.json();
                })
                .then(data => {
                    tablaEstudiantes.innerHTML = '';
                    if(data.length === 0) {
                        tablaEstudiantes.innerHTML = '<tr><td colspan="3">No hay estudiantes en este curso.</td></tr>';
                        return;
                    }

                    data.forEach(e => {
                        let nombreCompleto = e.estudiante ? e.estudiante.nombres : 'Sin Nombre';
                        let badgeClass = e.estado === 'A' ? 'badge-success' : 'badge-danger';
                        let estadoTexto = e.estado === 'A' ? 'Activo' : 'Inactivo';
                        
                        let botonAccion = e.estado === 'A' 
                            ? `<button class="btn btn-sm btn-danger" onclick="confirmarInactivacion(${e.id})">Inactivar</button>` 
                            : `<span class="text-muted">Ya inactivo</span>`;

                        tablaEstudiantes.innerHTML += `
                            <tr>
                                <td class="text-left">${nombreCompleto}</td>
                                <td><span class="badge badge-pill ${badgeClass}">${estadoTexto}</span></td>
                                <td>${botonAccion}</td>
                            </tr>`;
                    });
                })
                .catch(err => console.error("Error Fetch Estudiantes: ", err));
        }
    });
});

// 3. Alerta de confirmación y petición POST
function confirmarInactivacion(idRegistro) {
    const baseUrl = "{{ url('/') }}"; // Lo volvemos a inyectar aquí por el scope de la función

    Swal.fire({
        title: '¿Estás seguro?',
        text: "El estudiante quedará en estado inactivo (I) para este curso.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, inactivar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            
            // Usamos la baseUrl para construir la ruta correcta
           fetch(`${baseUrl}/inactivar-estudiante`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    // 👇 Usamos la directiva de Blade directamente 👇
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                },
                body: JSON.stringify({ id: idRegistro })
            })
            .then(res => res.json())
            .then(response => {
                if(response.success) {
                    Swal.fire('¡Inactivado!', 'El estudiante ha sido inactivado correctamente.', 'success');
                    document.getElementById('select-grado').dispatchEvent(new Event('change'));
                } else {
                    Swal.fire('Error', 'Hubo un problema al inactivar.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'Error de conexión con el servidor.', 'error');
            });
        }
    });
}
</script>

@endsection