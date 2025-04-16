<?php

namespace App\Http\Controllers\Tema;

use App\Models\Tema;
use App\Http\Resources\TemaResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TemaController extends Controller
{
    public function index(Request $request) {

        $per_page = request()->get('per_page') ?: 9;

        $temas = Tema::paginate($per_page);

        return Inertia::render('Tema/Index', [
            'message' => 'hallo friends! I am from TemaController',
            'temas' => TemaResource::collection($temas)
        ]);
    }

    public function update(Request $request, $id) {

        $tema = Tema::findOrFail($id);

        $tema->definicion = $request->definicion;

        $tema->save();

        return back();
    }
}
