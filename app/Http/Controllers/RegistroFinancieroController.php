<?php

namespace App\Http\Controllers;

use App\Models\RegistroFinanciero;
use App\Models\Apuesta;
use Illuminate\Http\Request;

class RegistroFinancieroController extends Controller
{
    public function index()
    {
        $usuario_id = session('usuario_id');

        $registros = RegistroFinanciero::where('usuario_id', $usuario_id)->get();
        $apuestas = Apuesta::where('usuario_id', $usuario_id)->get();

        $saldo = 0;
        $totalDepositos = 0;
        $totalRetiros = 0;
        $totalAjustes = 0;

        foreach ($registros as $registro) {
            if ($registro->tipo_movimiento == 'deposito') {
                $saldo += $registro->monto;
                $totalDepositos += $registro->monto;
            } elseif ($registro->tipo_movimiento == 'retiro') {
                $saldo -= $registro->monto;
                $totalRetiros += $registro->monto;
            } elseif ($registro->tipo_movimiento == 'ajuste') {
                $saldo += $registro->monto;
                $totalAjustes += $registro->monto;
            }
        }

        foreach ($apuestas as $apuesta) {
            if ($apuesta->estado == 'ganada') {
                $saldo += $apuesta->monto;
            } elseif ($apuesta->estado == 'perdida') {
                $saldo -= $apuesta->monto;
            }
        }

        return view('registro_financieros.index', compact(
            'registros',
            'saldo',
            'totalDepositos',
            'totalRetiros',
            'totalAjustes'
        ));
    }

    public function create()
    {
        return view('registro_financieros.create');
    }

    public function store(Request $request)
    {
        RegistroFinanciero::create([
            'usuario_id' => session('usuario_id'),
            'tipo_movimiento' => $request->tipo_movimiento,
            'monto' => $request->monto,
            'descripcion' => $request->descripcion,
            'fecha_movimiento' => $request->fecha_movimiento,
        ]);

        return redirect()->route('registro-financieros.index')
            ->with('success', 'Movimiento financiero registrado correctamente');
    }

    public function edit($id)
    {
        $registro = RegistroFinanciero::findOrFail($id);

        if ($registro->usuario_id != session('usuario_id')) {
            return redirect()->route('registro-financieros.index')
                ->with('error', 'No tienes permiso para editar este registro');
        }

        return view('registro_financieros.edit', compact('registro'));
    }

    public function update(Request $request, $id)
    {
        $registro = RegistroFinanciero::findOrFail($id);

        if ($registro->usuario_id != session('usuario_id')) {
            return redirect()->route('registro-financieros.index')
                ->with('error', 'No tienes permiso para actualizar este registro');
        }

        $registro->update([
            'tipo_movimiento' => $request->tipo_movimiento,
            'monto' => $request->monto,
            'descripcion' => $request->descripcion,
            'fecha_movimiento' => $request->fecha_movimiento,
        ]);

        return redirect()->route('registro-financieros.index')
            ->with('success', 'Movimiento financiero actualizado correctamente');
    }

    public function destroy($id)
    {
        $registro = RegistroFinanciero::findOrFail($id);

        if ($registro->usuario_id != session('usuario_id')) {
            return redirect()->route('registro-financieros.index')
                ->with('error', 'No tienes permiso para eliminar este movimiento');
        }

        $registro->delete();

        return redirect()->route('registro-financieros.index')
            ->with('success', 'Movimiento financiero eliminado correctamente');
    }
}