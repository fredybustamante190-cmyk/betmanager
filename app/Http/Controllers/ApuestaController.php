<?php

namespace App\Http\Controllers;

use App\Models\Apuesta;
use Illuminate\Http\Request;
use App\Models\RegistroFinanciero;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApuestaMail;

class ApuestaController extends Controller
{
    public function index()
    {
        $usuario_id = session('usuario_id');

        $apuestas = Apuesta::where('usuario_id', $usuario_id)->get();
        $movimientos = RegistroFinanciero::where('usuario_id', $usuario_id)->get();

        $saldo = 0;
        $totalDepositos = 0;
        $totalRetiros = 0;
        $totalGanadas = 0;
        $totalPerdidas = 0;

        foreach ($movimientos as $mov) {
            if ($mov->tipo_movimiento == 'deposito') {
                $saldo += $mov->monto;
                $totalDepositos += $mov->monto;
            } elseif ($mov->tipo_movimiento == 'retiro') {
                $saldo -= $mov->monto;
                $totalRetiros += $mov->monto;
            } elseif ($mov->tipo_movimiento == 'ajuste') {
                $saldo += $mov->monto;
            }
        }

        foreach ($apuestas as $apuesta) {
            if ($apuesta->estado == 'ganada') {
                $saldo += $apuesta->monto;
                $totalGanadas += $apuesta->monto;
            } elseif ($apuesta->estado == 'perdida') {
                $saldo -= $apuesta->monto;
                $totalPerdidas += $apuesta->monto;
            }
        }

        return view('apuestas.index', compact(
            'apuestas',
            'saldo',
            'totalDepositos',
            'totalRetiros',
            'totalGanadas',
            'totalPerdidas'
        ));
    }

    public function create()
    {
        return view('apuestas.create');
    }

    public function store(Request $request)
    {
        $apuesta = Apuesta::create([
            'usuario_id' => session('usuario_id'),
            'nombre_apuesta' => $request->nombre_apuesta,
            'tipo_apuesta' => $request->tipo_apuesta,
            'monto' => $request->monto,
            'fecha_apuesta' => $request->fecha_apuesta,
            'estado' => $request->estado,
        ]);

        return redirect()->route('apuestas.index')
            ->with('success', 'Apuesta creada correctamente');
    }

    public function edit($id)
    {
        $apuesta = Apuesta::findOrFail($id);

        if ($apuesta->usuario_id != session('usuario_id')) {
            return redirect()->route('apuestas.index')
                ->with('error', 'No tienes permiso para editar esta apuesta');
        }

        return view('apuestas.edit', compact('apuesta'));
    }

    public function update(Request $request, $id)
    {
        $apuesta = Apuesta::findOrFail($id);

        if ($apuesta->usuario_id != session('usuario_id')) {
            return redirect()->route('apuestas.index')
                ->with('error', 'No tienes permiso para actualizar esta apuesta');
        }

        $apuesta->update([
            'nombre_apuesta' => $request->nombre_apuesta,
            'tipo_apuesta' => $request->tipo_apuesta,
            'monto' => $request->monto,
            'fecha_apuesta' => $request->fecha_apuesta,
            'estado' => $request->estado,
        ]);

        return redirect()->route('apuestas.index')
            ->with('success', 'Apuesta actualizada correctamente');
    }

    public function destroy($id)
    {
        $apuesta = Apuesta::findOrFail($id);

        if ($apuesta->usuario_id != session('usuario_id')) {
            return redirect()->route('apuestas.index')
                ->with('error', 'No tienes permiso para eliminar esta apuesta');
        }

        $apuesta->delete();

        return redirect()->route('apuestas.index')
            ->with('success', 'Apuesta eliminada correctamente');
    }
}