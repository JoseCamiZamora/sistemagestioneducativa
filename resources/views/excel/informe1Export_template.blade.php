      <style>
         table {
            border-collapse: collapse;
            width: 100%;
         }

         table, th, td {
            border: 1px solid black;
         }
      </style>
      <table    class='table table-generic table-strech' >

            <thead class="bg-light">
               <TR>
                  <TD ALIGN=center ROWSPAN=4 COLSPAN=1 > <img id="main-logo"
                     src="{{ asset('/assets/img/proinco3.png') }}" alt="logo proinco"
                     style="text-align: center; margin-left: 10px;" /></TD>
                  <TD style="text-align: center; height:35px " ROWSPAN=2 COLSPAN=11><strong>FUNDACION PROINCO</strong></TD>
                  <TD style="text-align: center"><strong>CÓDIGO</strong></TD>
               </TR>
               <TR>
                  <TD style="text-align: center"><strong>EF-FO-31</strong></TD>
               </TR>
               <TR>
                  <TD style="text-align: center; height:30px " COLSPAN=11 ><strong>PROCESO EDUCACIÓN FORMAL</strong></TD>
                  <TD style="text-align: center"><strong>VERSION 001</strong></TD>
               </TR>
               <TR>
                  <TD style="text-align: center; height:30px " COLSPAN=11><strong>CONSOLIDADO DE NOTAS Y PROMEDIO GENERAL</strong></TD>
                  <TD style="text-align: center"> <strong>09/12/2024</strong></TD>
               </TR>
               <tr>
                <th scope="col" class="th-gris text-center" colspan="13" ></th>
              </tr>
              <tr>
                <th scope="col" class="th-gris text-center" colspan="2" ><strong>Docente que diligencia:</strong></th>
                <th scope="col" class="th-gris text-center" colspan="11" >{{$docente->nom_completo}}</th>
              </tr>
              <tr>
                <th scope="col" class="th-gris text-center" colspan="2" ><strong>Fecha de ligenciamiento:</strong></th>
                <th scope="col" class="th-gris text-center" colspan="11" >{{ date('d/m/Y') }}</th>
              </tr>
              <tr>
                <th scope="col" class="th-gris text-center" colspan="2" ><strong>Grado</strong></th>
                <th scope="col" class="th-gris text-center" colspan="3" >{{$cursoFinal->nombre}}</th>
                <th scope="col" class="th-gris text-center" colspan="2" ></th>
                <th scope="col" class="th-gris text-center" colspan="2" ><strong>Trimestre</strong></th>
                <th scope="col" class="th-gris text-center" colspan="4" >{{$periodoFinal->nombre}}</th>
              </tr>
               <tr>
                <th scope="col" class="th-gris text-center" colspan="13" ></th>
              </tr>
              <tr>
                <th scope="col" class="th-gris text-center" style="text-align: center;" colspan="13" ><strong>RANKING DE ESTUDIANTES EVALUADOS</strong></th>
              </tr>
              <tr>
               <th scope="col" class="th-gris text-center" style="text-align: center;width: 95px;" ><strong>No</strong></th>
               <th scope="col" class="th-gris text-left; width: 120px;" style="text-align: center;width: 230px;" ><strong>Nombres y Apellidos</strong></th>
                <th scope="col" class="th-gris text-center; width: 100px;" style="text-align: center;width: 100px;"><strong>MATEMATICAS</strong></th>
                <th scope="col" class="th-gris text-center; width: 100px;" style="text-align: center;width: 90px;"><strong>CASTELLANO</strong></th>
                <th scope="col" class="th-gris text-center; width: 100px;" style="text-align: center;width: 60px;"><strong>INGLES</strong></th>
                <th scope="col" class="th-gris text-center; width: 100px;" style="text-align: center;width: 90px;"><strong>NATURALES</strong></th>
                <th scope="col" class="th-gris text-center; width: 100px;" style="text-align: center;width: 120px;"><strong>ETICA y RELIGION</strong></th>
                <th scope="col" class="th-gris text-center; width: 100px;" style="text-align: center;width: 80px;"><strong>SOCIALES</strong></th>
                <th scope="col" class="th-gris text-center; width: 100px;" style="text-align: center;width: 100px;"><strong>INFORMATICA</strong></th>
                <th scope="col" class="th-gris text-center; width: 100px;" style="text-align: center;width: 80px;"><strong>ED. FISICA</strong></th>
                <th scope="col" class="th-gris text-center; width: 100px;" style="text-align: center;width: 80px;"><strong>ARTISTICA</strong></th>
                <th scope="col" class="th-gris text-center; width: 100px;" style="text-align: center;width: 140px;"><strong>COMPORTAMIENTO</strong></th>
                <th scope="col" class="th-gris text-center; width: 100px;" style="text-align: center;width: 90px;"><strong>PROMEDIO</strong></th>
              </tr>
            </thead>
            <tbody>
               @foreach($listadoEstudiantes as $info)
                  <tr>
                     <td class='text-center' style="background-color: #dee2ec; font-weight: 700;border:1px solid white !important;text-align: center">{{ $loop->index+1 }}</td>
                     <td class="text-center">{{ $info['ESTUDIANTE'] ?? '' }}</td>
                     <td class="text-center" style="text-align: center;">{{ $info['MATEMATICAS'] ?? '0' }}</td>
                     <td class="text-center" style="text-align: center;">{{ $info['CASTELLANO'] ?? '0' }}</td>
                     <td class="text-center" style="text-align: center;">{{ $info['INGLES'] ?? '0' }}</td>
                     <td class="text-center" style="text-align: center;">{{ $info['CIENCIAS NATURALES'] ?? '0' }}</td>
                     <td class="text-center" style="text-align: center;">{{ $info['RELIGION - ETICA Y VALORES'] ?? '0' }}</td>
                     <td class="text-center" style="text-align: center;">{{ $info['SOCIALES'] ?? '0' }}</td>
                     <td class="text-center" style="text-align: center;">{{ $info['INFORMATICA'] ?? '0' }}</td>
                     <td class="text-center" style="text-align: center;">{{ $info['EDUCACION FISICA'] ?? '0' }}</td>
                     <td class="text-center" style="text-align: center;">{{ $info['ARTISTICA'] ?? '0' }}</td>
                     <td class="text-center" style="text-align: center;">{{ $info['COMPORTAMIENTO'] ?? '0' }}</td>
                     <td class="text-center" style="text-align: center;">{{ $info['PROMEDIO'] ?? '0' }}</td>
                  </tr>
               @endforeach
            </tbody>
            <tr>
                <th scope="col" class="th-gris text-center" colspan="12" ><strong>Promedio General del curso:</strong></th>
                <th scope="col" class="th-gris text-center" colspan="1"  style="font-size: 16px;text-align: center;"><strong>{{$promedioCurso }}</strong></th>
              </tr>
          </table>