<?php

namespace App\Console\Commands;

use App\ConfAnios;
use App\NotaFinalEstudiante;
use App\NotaFinalTransicion;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

/**
 * Repara los registros duplicados de nota_final_estudiante / nota_final_transicion
 * que quedaron cuando un docente fue reemplazado a mitad de año: cada docente
 * generaba su propia fila (porque id_docente formaba parte de la clave de
 * búsqueda al guardar), dejando el periodo calificado por el otro docente en cero.
 *
 * Por defecto solo genera un reporte. Usar --apply para fusionar y borrar los
 * duplicados de verdad.
 */
class FusionarNotasDuplicadas extends Command
{
    protected $signature = 'notas:fusionar-duplicados
        {tabla=todas : materias|transicion|todas}
        {--apply : Aplica los cambios; sin esta opción solo se muestra el reporte}';

    protected $description = 'Fusiona filas duplicadas de notas finales generadas por cambios de docente a mitad de año';

    public function handle()
    {
        $tabla = $this->argument('tabla');
        $apply = (bool) $this->option('apply');

        if (!in_array($tabla, ['materias', 'transicion', 'todas'])) {
            $this->error("Valor de 'tabla' inválido. Use: materias, transicion o todas.");
            return 1;
        }

        if ($tabla === 'materias' || $tabla === 'todas') {
            $this->procesarMaterias($apply);
        }

        if ($tabla === 'transicion' || $tabla === 'todas') {
            $this->procesarTransicion($apply);
        }

        if (!$apply) {
            $this->newLine();
            $this->comment('Este fue solo un reporte. Ejecute con --apply para aplicar los cambios.');
        }

        return 0;
    }

    private function procesarMaterias(bool $apply): void
    {
        $this->info('=== nota_final_estudiante (materias) ===');

        $grupos = NotaFinalEstudiante::all()->groupBy(function ($item) {
            return $item->id_anio . '|' . $item->id_estudiante . '|' . $item->id_grado . '|' . $item->id_materia;
        })->filter(fn (Collection $g) => $g->count() > 1);

        if ($grupos->isEmpty()) {
            $this->line('No se encontraron duplicados.');
            return;
        }

        $aniosCache = [];

        foreach ($grupos as $clave => $grupo) {
            $primero = $grupo->first();
            $idAnio = $primero->id_anio;

            if (!isset($aniosCache[$idAnio])) {
                $aniosCache[$idAnio] = ConfAnios::find($idAnio);
            }
            $anio = $aniosCache[$idAnio];
            $cantPeriodos = $anio ? $anio->cant_periodos : 3;

            [$notaUno, $notaDos, $notaTres, $extra] = $this->fusionarPeriodos($grupo, true);

            $notaFinal = round((floatval($notaUno) + floatval($notaDos) + floatval($notaTres)) / $cantPeriodos, 2);

            $canonico = $grupo->sortByDesc('updated_at')->first();

            $this->line(sprintf(
                'Estudiante %s | %s | grado %s | materia %s -> filas: %s (docentes: %s)',
                $primero->id_estudiante,
                $primero->nom_estudiante,
                $primero->id_grado,
                $primero->desc_materia,
                $grupo->pluck('id')->implode(', '),
                $grupo->pluck('nom_docente')->unique()->implode(' / ')
            ));
            $this->line(sprintf(
                '  -> fusión: p1=%s p2=%s p3=%s final=%s (fila canónica id=%s, docente=%s)',
                $notaUno, $notaDos, $notaTres, $notaFinal, $canonico->id, $canonico->nom_docente
            ));

            if ($apply) {
                $canonico->nota_periodo_uno = $notaUno;
                $canonico->nota_periodo_dos = $notaDos;
                $canonico->nota_periodo_tres = $notaTres;
                $canonico->nota_final = $notaFinal;
                $canonico->concepto_per1 = $extra['concepto_per1'] ?? $canonico->concepto_per1;
                $canonico->concepto_per2 = $extra['concepto_per2'] ?? $canonico->concepto_per2;
                $canonico->concepto_per3 = $extra['concepto_per3'] ?? $canonico->concepto_per3;
                $canonico->faltas_just_per1 = $extra['faltas_just_per1'] ?? $canonico->faltas_just_per1;
                $canonico->faltas_just_per2 = $extra['faltas_just_per2'] ?? $canonico->faltas_just_per2;
                $canonico->faltas_just_per3 = $extra['faltas_just_per3'] ?? $canonico->faltas_just_per3;
                $canonico->faltas_no_just_per1 = $extra['faltas_no_just_per1'] ?? $canonico->faltas_no_just_per1;
                $canonico->faltas_no_just_per2 = $extra['faltas_no_just_per2'] ?? $canonico->faltas_no_just_per2;
                $canonico->faltas_no_just_per3 = $extra['faltas_no_just_per3'] ?? $canonico->faltas_no_just_per3;
                $canonico->save();

                foreach ($grupo as $fila) {
                    if ($fila->id !== $canonico->id) {
                        $fila->delete();
                    }
                }
            }
        }
    }

    private function procesarTransicion(bool $apply): void
    {
        $this->info('=== nota_final_transicion ===');

        $grupos = NotaFinalTransicion::all()->groupBy(function ($item) {
            return $item->id_anio . '|' . $item->id_estudiante . '|' . $item->id_grado;
        })->filter(fn (Collection $g) => $g->count() > 1);

        if ($grupos->isEmpty()) {
            $this->line('No se encontraron duplicados.');
            return;
        }

        $aniosCache = [];

        foreach ($grupos as $clave => $grupo) {
            $primero = $grupo->first();
            $idAnio = $primero->id_anio;

            if (!isset($aniosCache[$idAnio])) {
                $aniosCache[$idAnio] = ConfAnios::find($idAnio);
            }
            $anio = $aniosCache[$idAnio];
            $cantPeriodos = $anio ? $anio->cant_periodos : 3;

            [$notaUno, $notaDos, $notaTres, $extra] = $this->fusionarPeriodos($grupo, false);

            $notaFinal = round((floatval($notaUno) + floatval($notaDos) + floatval($notaTres)) / $cantPeriodos, 2);

            $canonico = $grupo->sortByDesc('updated_at')->first();

            $this->line(sprintf(
                'Estudiante %s | %s | grado %s -> filas: %s (docentes: %s)',
                $primero->id_estudiante,
                $primero->nom_estudiante,
                $primero->id_grado,
                $grupo->pluck('id')->implode(', '),
                $grupo->pluck('nom_docente')->unique()->implode(' / ')
            ));
            $this->line(sprintf(
                '  -> fusión: p1=%s p2=%s p3=%s final=%s (fila canónica id=%s, docente=%s)',
                $notaUno, $notaDos, $notaTres, $notaFinal, $canonico->id, $canonico->nom_docente
            ));

            if ($apply) {
                $canonico->nota_periodo_uno = $notaUno;
                $canonico->nota_periodo_dos = $notaDos;
                $canonico->nota_periodo_tres = $notaTres;
                $canonico->nota_final = $notaFinal;
                if (isset($extra['concepto_per1'])) {
                    $canonico->concepto_per1 = $extra['concepto_per1'];
                }
                if (isset($extra['concepto_per2'])) {
                    $canonico->concepto_per2 = $extra['concepto_per2'];
                }
                if (isset($extra['concepto_per3'])) {
                    $canonico->concepto_per3 = $extra['concepto_per3'];
                }
                $canonico->save();

                foreach ($grupo as $fila) {
                    if ($fila->id !== $canonico->id) {
                        $fila->delete();
                    }
                }
            }
        }
    }

    /**
     * Recorre las filas de un grupo duplicado y devuelve [notaUno, notaDos, notaTres, extra]
     * tomando el valor no-cero de cada periodo (y de los campos de concepto/faltas si existen
     * en el modelo) en lugar de quedarse con una sola fila.
     */
    private function fusionarPeriodos(Collection $grupo, bool $conFaltas): array
    {
        $notaUno = 0;
        $notaDos = 0;
        $notaTres = 0;
        $extra = [];

        $camposConcepto = ['concepto_per1' => 'nota_periodo_uno', 'concepto_per2' => 'nota_periodo_dos', 'concepto_per3' => 'nota_periodo_tres'];
        $camposFaltasJust = ['faltas_just_per1' => 'nota_periodo_uno', 'faltas_just_per2' => 'nota_periodo_dos', 'faltas_just_per3' => 'nota_periodo_tres'];
        $camposFaltasNoJust = ['faltas_no_just_per1' => 'nota_periodo_uno', 'faltas_no_just_per2' => 'nota_periodo_dos', 'faltas_no_just_per3' => 'nota_periodo_tres'];

        foreach ($grupo as $fila) {
            if (floatval($fila->nota_periodo_uno) > 0) {
                $notaUno = $fila->nota_periodo_uno;
            }
            if (floatval($fila->nota_periodo_dos) > 0) {
                $notaDos = $fila->nota_periodo_dos;
            }
            if (floatval($fila->nota_periodo_tres) > 0) {
                $notaTres = $fila->nota_periodo_tres;
            }

            foreach ($camposConcepto as $campo => $periodoRef) {
                if (!empty($fila->{$campo}) && floatval($fila->{$periodoRef}) > 0) {
                    $extra[$campo] = $fila->{$campo};
                }
            }

            if ($conFaltas) {
                foreach ($camposFaltasJust as $campo => $periodoRef) {
                    if (floatval($fila->{$periodoRef}) > 0) {
                        $extra[$campo] = $fila->{$campo};
                    }
                }
                foreach ($camposFaltasNoJust as $campo => $periodoRef) {
                    if (floatval($fila->{$periodoRef}) > 0) {
                        $extra[$campo] = $fila->{$campo};
                    }
                }
            }
        }

        return [$notaUno, $notaDos, $notaTres, $extra];
    }
}
