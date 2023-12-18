<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFormationRequest;
use App\Http\Requests\EditFormationRequest;
use App\Models\Formation;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class FormationController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'status_code' => 200,
                'status_message' => "listes des formations",
                'formations' => Formation::all(),
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function store(CreateFormationRequest $request)
    {
        try {
            $formation = new Formation();
            $formation->libelle = $request->libelle;
            $formation->description = $request->description;
            $formation->duree = $request->duree;
            $formation->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => "Formation enregistrer",
                'formations' => $formation,
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function update(EditFormationRequest $request, $id)
    {
        try {
            $formation = Formation::find($id);
            $formation->libelle = $request->libelle;
            $formation->description = $request->description;
            $formation->duree = $request->duree;
            $formation->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => "Formation mise à jour",
                'formations' => $formation,
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function destroy(Formation $formation)
    {
        try {
            $formation->delete();
            return response()->json([
                'status_code' => 200,
                'status_message' => "Formation supprimée",
                'formations' => $formation,
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
