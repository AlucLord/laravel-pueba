<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Grado;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AlumnoController extends Controller
{
    /**
     * Lista de alumnos.
     */
    public function index()
    {
        $alumnos = Alumno::with('grado')->get();
        return view('alumnos.index', compact('alumnos'));
    }

    /**
     * Formulario para crear un nuevo alumno.
     */
    public function create()
    {
        $grados = [
            ['id' => 1, 'nombre' => 'Primero'],
            ['id' => 2, 'nombre' => 'Segundo'],
            ['id' => 3, 'nombre' => 'Tercero'],
            ['id' => 4, 'nombre' => 'Cuarto'],
            ['id' => 5, 'nombre' => 'Quinto'],
            ['id' => 6, 'nombre' => 'Sexto'],
            ['id' => 7, 'nombre' => 'Séptimo'],
            ['id' => 8, 'nombre' => 'Octavo'],
            ['id' => 9, 'nombre' => 'Noveno']
        ];
        return view('alumnos.create', compact('grados'));
    }

    /**
     * Almacena un nuevo alumno en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'n_carnet' => 'required|unique:alumnos',
            'grado_id' => 'required|integer|min:1|max:9',
            'nombre_padre' => 'required',
            'nombre_madre' => 'required',
            'edad' => 'required|integer|min:3',
            'nota_final' => 'required|numeric|min:0|max:10',
        ]);

        Alumno::create($request->all());
        return redirect()->route('alumnos.index')->with('success', 'Alumno creado correctamente.');
    }

    public function edit($id)
    {
        $alumno = Alumno::findOrFail($id);
        $grados = Grado::all();
        return view('alumnos.edit', compact('alumno', 'grados'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'n_carnet' => 'required|unique:alumnos,n_carnet,' . $id,
            'grado_id' => 'required|integer|exists:grados,id',
            'nombre_padre' => 'required',
            'nombre_madre' => 'required',
            'edad' => 'required|integer|min:3',
            'nota_final' => 'required|numeric|min:0|max:10.00',
        ]);

        $alumno = Alumno::findOrFail($id);
        $alumno->update($request->all());

        return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado correctamente.');
    }

    public function destroy($id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->delete();

        return redirect()->route('alumnos.index')->with('success', 'Alumno eliminado correctamente');
    }

    public function export()
    {
        // Crear hoja de cálculo
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Definir encabezados
        $headers = ['ID', 'Nombre', 'Apellido', 'Carnet', 'Grado', 'Edad', 'Nota Final', 'Nombre Padre', 'Nombre Madre'];
        $sheet->fromArray([$headers], null, 'A1');

        // Obtener datos
        $alumnos = DB::table('alumnos')
            ->join('grados', 'alumnos.grado_id', '=', 'grados.id')
            ->select(
                'alumnos.id', 
                'alumnos.nombre', 
                'alumnos.apellido', 
                'alumnos.n_carnet', 
                'grados.nombre as grado', 
                'alumnos.edad',
                'alumnos.nota_final',
                'alumnos.nombre_padre',
                'alumnos.nombre_madre',
                )
            ->get();

        // Insertar datos en filas
        $row = 2;
        foreach ($alumnos as $alumno) {
            $sheet->fromArray([
                [
                    $alumno->id, 
                    $alumno->nombre, 
                    $alumno->apellido, 
                    $alumno->n_carnet, 
                    $alumno->grado, 
                    $alumno->edad,
                    $alumno->nota_final,
                    $alumno->nombre_padre,
                    $alumno->nombre_madre,
                ]
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
        $response->headers->set('Content-Disposition', 'attachment;filename="reporte_alumnos.xlsx"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }
}
