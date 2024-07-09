<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FrontCourse extends Model
{
    public static function getlisteEtapeDetails($equipe_id)
    {
        $etapes = DB::select('select id_coureur, nom_coureur ,nb_coureur ,id_etape,nom_etape, id_equipe, nom_equipe ,
        IFNULL(duree, "PAS ENCORE DE TEMPS") as duree
        from v_liste_etape_details
        WHERE id_equipe= ?', [$equipe_id]);

        return collect($etapes);
    }
    public static function getlisteEtape()
    {
        $etapes = DB::select('select * from etapes');

        return $etapes;
    }
    public static function getEtapeById($id)
    {
        $etapes = DB::select('select * from etapes where id= ?', [$id]);

        return $etapes;
    }
    public static function getCoureursById($equipe_id)
    {
        $coureurs = DB::select('select * from coureurs where equipe_id= ?', [$equipe_id]);

        return $coureurs;
    }
    public static function insertCoureur($id_etapes,$id_coureurs)
    {
        $etape_details = DB::select('
        INSERT INTO etape_details (etape_id, coureur_id)
        VALUES (?, ? )
        ',[$id_etapes ,$id_coureurs]);

        return $etape_details;
    }
    public static function getClassementGEtape()
    {
        $classeG = DB::select('select nom_etape, nom_coureur,nom_equipe,duree, points
        from v_classement_details 
         GROUP BY nom_coureur,nom_etape,nom_equipe,duree, points
        ORDER BY  duree ASC');

        return $classeG;
    }
    public static function getClassementGEquipe()
    {
        $classeGEquipe = DB::select('select nom_equipe
        from v_classement_details 
         GROUP BY nom_equipe
        ORDER BY  nom_equipe ASC');

        return $classeGEquipe;
    }
}
