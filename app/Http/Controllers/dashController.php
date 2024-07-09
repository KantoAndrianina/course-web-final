<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;
use App\Models\DashCourse;
use App\Models\FrontCourse;
use App\Models\Classement;
use App\Models\Import;
use Illuminate\Http\Request;

class dashController extends Controller
{
    public function afficherListeEtapes()
    {
        $etapes = FrontCourse::getlisteEtape();

        return view('dash.listeEtapes', ['etapes' => $etapes]);
    }
    public function afficherformTemps($id)
    {
        $etapes = DashCourse::getEtapeById($id);

        $etapes_details = DashCourse::getEtapeDetailById($id);
        $depart= DashCourse::getEtapeDetailDepartById($id);


        $coureurs = DashCourse::getNumeroCoureurById($id);


        return view('dash.formTemps', ['etapes' => $etapes_details,'etapes_id' => $etapes,'coureurs' => $coureurs , 'depart' => $depart ]);
    }
    public function afficherResultatEtape($id)
    {
        $classeG=Classement::afficherResultatEtape($id);

        return view('dash.listeResultatEtape', ['classeG' => $classeG]);
    }
    public function insertTemps(Request $request)
    {
        try {
            $id_etapes = $request->input('id_etape');
            $id_coureurs = $request->input('id_coureur');

            // $date_depart = $request->input('date_depart');
            // $heure_depart = $request->input('heure_depart');
            // $min_depart = $request->input('min_depart');
            // $sec_depart = $request->input('sec_depart');
            $date_heure_depart = $request->input('date_heure_depart');


            $date_arrivee = $request->input('date_arrivee');
            $heure_arrivee = $request->input('heure_arrivee');
            $min_arrivee = $request->input('min_arrivee');
            $sec_arrivee = $request->input('sec_arrivee');

            // echo $id_etapes;
            // echo $id_coureurs;

            // echo $date_depart;
            // echo $heure_depart;
            // echo $min_depart;
            // echo $sec_depart;

            // echo $date_arrivee;
            // echo $heure_arrivee;
            // echo $min_arrivee;
            // echo $sec_arrivee;
        DashCourse::insertEtapeDetails($id_etapes,$id_coureurs,
        $date_heure_depart,$date_arrivee,$heure_arrivee,$min_arrivee,$sec_arrivee);
            
           
            return redirect()->route('afficherListeEtapes')->with('success', 'Modification réussie');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return redirect()->back()->withInput()->withErrors(['error' => $errorMessage]);
        }
    }
    public function classementGEtape()
    {
        $classeG=Classement::getClassementGEtape();
        $categories=Categorie::all();

        return view('dash.classeGEtapeDash', ['classeG' => $classeG,'categories' => $categories]);
    }
    public function classementGEquipe()
    {
        $classeG=Classement::getClassementGEquipe();
        $categories=Categorie::all();
        $dataString1=Classement::getClassementGEquipePointGraph();
        $dataString2=Classement::getClassementGEquipeNomGraph();
        // echo $dataString2;

         // Collecter les points et identifier les duplications
         $pointsArray = array_map(function($item) {
            return $item->points;
        }, $classeG);

        $duplicatePoints = array_keys(array_filter(array_count_values($pointsArray), function($count) {
            return $count > 1;
        }));

        return view('dash.classeGEquipeDash', ['classeG' => $classeG,'categories' => $categories,'dataString1' => $dataString1,'dataString2' => $dataString2, 'duplicatePoints' => $duplicatePoints]);
    }
    // public function classementCategorie(Request $request)
    // {
    //     $id_categorie = $request->input('id_categorie');
    //     // echo $id_categorie;
    //     if($id_categorie==0)
    //     {
    //         return redirect()->route('afficherClassementGEquipe.dash');
    //     }
    //     $classeG=Classement::getClassementCategorie($id_categorie);
    //     $categories=Categorie::all();
    //     $dataString1=Classement::getClassementEquipeCategoriePointGraph($id_categorie);
    //     $dataString2=Classement::getClassementEquipeCategorieNomGraph($id_categorie);

    //     return view('dash.classeCategorieDash', ['classeG' => $classeG,'categories' => $categories,'dataString1' => $dataString1,'dataString2' => $dataString2]);
        
    // }
    public function classementCategorie(Request $request)
    {
        $id_categorie = $request->input('id_categorie');
        if ($id_categorie == 0) {
            return redirect()->route('afficherClassementGEquipe.dash');
        }
        
        $classeG = Classement::getClassementCategorie($id_categorie);
        $categories = Categorie::all();
        $dataString1 = Classement::getClassementEquipeCategoriePointGraph($id_categorie);
        $dataString2 = Classement::getClassementEquipeCategorieNomGraph($id_categorie);

        // Collecter les points et identifier les duplications
        $pointsArray = array_map(function($item) {
            return $item->points;
        }, $classeG);

        $duplicatePoints = array_keys(array_filter(array_count_values($pointsArray), function($count) {
            return $count > 1;
        }));

        return view('dash.classeCategorieDash', [
            'classeG' => $classeG,
            'categories' => $categories,
            'dataString1' => $dataString1,
            'dataString2' => $dataString2,
            'duplicatePoints' => $duplicatePoints
        ]);
    }


    public function classementEtapeCategorie(Request $request)
    {
        $id_categorie = $request->input('id_categorie');
        // echo $id_categorie;
        if($id_categorie==0)
        {
            return redirect()->route('afficherClassementGEtape.dash');
        }
        $classeG=Classement::getClassementEtapeCategorie($id_categorie);
        $categories=Categorie::all();

        return view('dash.classeEtapeCategorieDash', ['classeG' => $classeG,'categories' => $categories]);
        
    }

    public function formImportEtapeResultat()
    {
        return view('dash.import_form_etape');
    }

    public function formImportPoint()
    {
        return view('dash.import_form_point');
    }

    public function reinitialisationDB()
    {
        return view('dash.reinit');
    }
    public function genererCategorie()
    {
        $generer=DashCourse::getGenererCategorie();

        return view('dash.genererCateg', ['generer' => $generer]);
    }


    public function reinitialisationConfirm()
    {
        try {
            Import::reinitialisationConfirm();


            return redirect()->route('form.import.etape')->with('success', 'Réinitialisation effectuée avec succès');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return redirect()->back()->withErrors(['error' => $errorMessage]);
        }
    }

    public function afficherListePenalite()
    {
        $penalite = DashCourse::getListePenalite();

        return view('dash.listePenalite', ['penalite' => $penalite]);
    }
    public function afficherValidSuppPenal($id)
    {
        // echo $id;
        return view('dash.validationSuppPenal', ['id' => $id]);
    }
    public function afficherAjoutPenal()
    {
        $nomEtape = DashCourse::getNomEtape();

        $nomEquipe = DashCourse::getNomEquipe();


        return view('dash.formAjoutPenal', ['nomEtape' => $nomEtape,'nomEquipe' => $nomEquipe]);
    }
    public function ajoutPenal()
    {
        $penal = DashCourse::insertPenalite();

        return view('dash.formAjoutPenal', ['penal' => $penal]);
    }
    public function insertPenalite(Request $request)
    {
        try {
            $id_etapes = $request->input('id_etape');
            $id_coureurs = $request->input('id_coureur');

            $heure_penalite = $request->input('heure_penalite');
            $min_penalite = $request->input('min_penalite');
            $sec_penalite = $request->input('sec_penalite');

            // echo $id_etapes;
            // echo $id_coureurs;

            // echo $heure_penalite;
            // echo $min_penalite;
            // echo $sec_penalite;

           
        $penal = DashCourse::insertPenalite($id_etapes,$id_coureurs,$heure_penalite, $min_penalite,$sec_penalite);
        //  echo $penal;
           
            return redirect()->route('afficherListePenalite.dash')->with('success', 'Modification réussie');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return redirect()->back()->withInput()->withErrors(['error' => $errorMessage]);
        }
    }
    public function deletePenal($id)
    {
        //  echo $id;

        try {
            DashCourse::deletePenal($id);

            return redirect()->route('afficherListePenalite.dash')->with('success', 'Réinitialisation effectuée avec succès');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return redirect()->back()->withErrors(['error' => $errorMessage]);
        }

    }
   
    public function classementDetailEquipe($id_equipe)
    {
        $classeG=Classement::getClassementDetailEquipe($id_equipe);

        return view('dash.classeDetailEquipe', ['classeG' => $classeG]);
    }
    public function classementDetailEquipeEtape($id_equipe)
    {
        $classeG=Classement::getClassementDetailEquipeEtape($id_equipe);

        return view('dash.classeDetailEquipeEtape', ['classeG' => $classeG]);
    }
}
