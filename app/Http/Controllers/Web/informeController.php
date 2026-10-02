<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaz\InformeServiceInterface;

class informeController extends Controller
{
    private $informeService;

    public function __construct(InformeServiceInterface $informeService)
    {
        $this->informeService = $informeService;
    }

    public function index()
    {
        $resumen = $this->informeService->resumen();

        return view('informe.informe_resumen', compact('resumen'));
    }

    public function profesor($id)
    {
        $modulos = $this->informeService->modulosDeProfesor($id, 'codigo');

        return view('informe.informe_profesor', compact('modulos'));
    }
}
