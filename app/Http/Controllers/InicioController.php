<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class InicioController extends Controller
{
    public function index()
    {
        $partidos = [];

        try {
            $response = Http::get('https://www.thesportsdb.com/api/v1/json/3/eventsnextleague.php', [
                'id' => 4328
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $partidos = $data['events'] ?? [];
            }
        } catch (\Exception $e) {
            $partidos = [];
        }

        return view('inicio', compact('partidos'));
    }
}