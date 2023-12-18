<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginCandidatRequest;
use App\Http\Requests\RegisterCandidatRequest;
use App\Models\Candidat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CandidatController extends Controller
{
    public function registerCandidat(RegisterCandidatRequest $request)
    {
        try {
            // dd($request);
            $candidat = new Candidat();
            $candidat->nom = $request->nom;
            $candidat->telephone = $request->telephone;
            $candidat->email = $request->email;
            $candidat->password = Hash::make($request->password);
            $candidat->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'inscription reussi'
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function login(LoginCandidatRequest $request)
    {
        // try {
            if (Auth::guard('candidat')->attempt($request->only(['email', 'password']))) {
                $candidat = Auth::guard('candidat')->user();
                $token = $candidat->createToken('THIS_IS_THE_KEY_FOR_THE_PRIVATE_ROUTE', ['candidat'])->plainTextToken;
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'utilisateur connecté',
                    'status_body' => $candidat,
                    'token' => $token
                ]);
            }
        // } catch (Exception $e) {
        //     return response()->json($e);
        // }
    }

    public function index(Candidat $candidat)
    {
        try {
            return response()->json([
                'status_code' => 200,
                'status_message'=>"liste des candidats",
                'candidats'=> Candidat::all(),
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function accepted(Candidat $candidat)
    {
        try {
            $candidat->is_accepted = true;
            $candidat->save();
            return response()->json([
            'status_code' => 200,
            'status_message'=>"vous avez accepter cette candidature",
            'candidat'=> $candidat
        ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function listesAccepter($id)
    {
        try {
            $candidat = Candidat::where('is_accepeted', 1);
            return response()->json([
                'status_code' => 200,
                'status_message' => "Listes des candidats accpeter",
                'listes_accepter' => $candidat,
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function listesNonAccepter($id)
    {
        try {
            $candidat = Candidat::where('is_accepeted', 0);
            return response()->json([
                'status_code' => 200,
                'status_message' => "Listes des candidats pas encors accepter",
                'listes_accepter' => $candidat,
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
