<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipeRequest;
use App\Models\Classement;
use App\Models\Equipe;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\FrontCourse;
use App\Traits\ExceptionTrait;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class EquipeController extends Controller
{

    public function loginEquipe(EquipeRequest $request)
    {
        try {
            $validator = Validator::make($request->all(), $request->rules());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput($request->input());
            }

            $login = $request->login;
            $mdp = $request->mdp;
            // $mdp = password_hash($request->mdp, PASSWORD_DEFAULT);

            // echo $login . ' ' . $mdp;

            try {
                $equipeId = Equipe::loginEquipe($login, $mdp);
                Session::put('equipe_id', $equipeId);

                return redirect()->route('details.liste_etape')->with('success', 'equipe logué');
            } catch (Exception $e) {
                return redirect()->back()->withErrors(['message' => $e->getMessage()]);
            }

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function logoutEquipe(Request $request)
    {
        Session::forget('equipe_id');

        return redirect()->route('welcome')->with('success', 'Déconnexion réussie.');
    }
    public function listeEtapeDetails(Request $request)
    {
        $equipe_id=Session::get('equipe_id');

        $etapes = FrontCourse::getlisteEtapeDetails($equipe_id);

        return view('front.liste_etape_details', ['etapes' => $etapes]);
    }

    public function listeEtapeEquipe()
    {
        $etapes = FrontCourse::getlisteEtape();

        return view('front.liste_etape', ['etapes' => $etapes]);
    }

    public function formCoureur($id_etapes,Request $request)
    {
        $etapes = FrontCourse::getEtapeById($id_etapes);

        $equipe_id=Session::get('equipe_id');

        $coureurs = FrontCourse::getCoureursById($equipe_id);


        return view('front.formCoureur', ['etapes' => $etapes,'coureurs' => $coureurs]);
    }
    public function insertCoureur(Request $request)
    {
        try {
            $id_etapes = $request->input('id_etapes');
            $id_coureurs = $request->input('id_coureurs');

            ExceptionTrait::checkCoureurExists($id_etapes, $id_coureurs);
            ExceptionTrait::checkCoureurExistEtape($id_etapes, $id_coureurs);

            // echo $id_etapes;
            // echo "lol";
            // echo $id_coureurs;
        $etape_details = FrontCourse::insertCoureur($id_etapes,$id_coureurs);

            return redirect()->route('details.liste_etape')->with('success', 'Modification réussie');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return redirect()->back()->withInput()->withErrors(['error' => $errorMessage]);
        }
    }
    public function afficherCertificat()
    {
        // $data = 'A';
        $data =Classement::getClassementGEquipePDF();

        return view('dash.certificat', ['data'=>$data]);
    }

    public function afficherCertificatCategorie($id_cat)
    {
        // $data = 'A';
        $data =Classement::getClassementCategorieEquipePDF($id_cat);

        return view('dash.certificat_categorie', ['data'=>$data]);
    }
    
    
}
