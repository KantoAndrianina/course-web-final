<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Classement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassementController extends Controller
{
    public function classementGEtape()
    {
        $classeG=Classement::getClassementGEtape();

        return view('front.classeGEtape', ['classeG' => $classeG]);
    }

    public function classementGEquipe()
    {

        $classeG=Classement::getClassementGEquipe();
        $categories=Categorie::all();
        
        return view('front.classeGEquipe', ['classeG' => $classeG,'categories' => $categories]);
    }

    public function confirmerClassement(Request $request)
    {
        $id_etape = $request->input('id_etape');
        // echo $id_etape;
            $results=Classement::confirmerClassement($id_etape);

            // return redirect()->route('afficherListeEtapes')->with('success', 'Classement confirmé et points attribués.');
        return view('dash.points', ['results' => $results]);

        
    }
    public function confirmerClassementCat()
    {
        Classement::confirmerClassementCategorie();

        return redirect()->route('afficherClassementGEtape.dash');

    }
    

}
