<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AlumnosExport
{
    public function export()
    {
        // Crear una nueva hoja de cálculo
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Definir encabezados
        $headers = ['ID', 'Nombre', 'Apellidos', 'Carnet', 'Grado', 'Edad'];
        $sheet->fromArray([$headers], null, 'A1');

        // Obtener datos desde la base de datos
        $alumnos = DB::table('alumnos')->get();

        // Insertar datos en las filas siguientes
        $row = 2; // Comenzamos en la fila 2
        foreach ($alumnos as $alumno) {
            $sheet->fromArray([
                [$alumno->id, $alumno->nombre, $alumno->apellidos, $alumno->carnet, $alumno->grado, $alumno->edad]
            ], null, "A$row");
            $row++;
        }

        // Crear la respuesta de descarga
        $response = new StreamedResponse(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        });

        // Configurar encabezados para la descarga
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="alumnos.xlsx"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }
}
