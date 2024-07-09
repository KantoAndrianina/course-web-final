<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Traits\ExceptionTrait;


class DashCourse extends Model
{
    public static function getEtapeById($id)
    {
        $etapes = DB::select('select * from etapes where id= ?', [$id]);

        return $etapes;
    }
    public static function getEtapeDetailById($id)
    {
        $etapes_details = DB::select(' select * from etape_details where etape_id= ?', [$id]);

        return $etapes_details;
    }
    public static function getEtapeDetailDepartById($id)
    {
        $etapes_detail_query = DB::select(' select distinct depart from etape_details where etape_id= ?', [$id]);
        $etapes_details = $etapes_detail_query[0]->depart;
        return $etapes_details;
    }
    public static function getNumeroCoureurById($id)
    {
        $coureurs = DB::select(' select * from v_classement_details where id_etape= ?', [$id]);

        return $coureurs;
    }
    public static function insertEtapeDetails($id_etapes,$id_coureurs,
    $date_heure_depart,$date_arrivee,$heure_arrivee,$min_arrivee,$sec_arrivee)
    {
        // $etape_details = DB::select("
        // INSERT INTO etape_details (etape_id, coureur_id, depart,arrivee)
        // VALUES (?, ? , ?,
        // '" . $date_arrivee .' '.$heure_arrivee.':'.$min_arrivee.':'.$sec_arrivee."')
        // ",[$id_etapes ,$id_coureurs,$date_heure_depart]);

        
        $date_heure_arrivee = $date_arrivee . ' ' . $heure_arrivee . ':' . $min_arrivee . ':' . $sec_arrivee;

        ExceptionTrait::validateDateArrivee($date_heure_depart,$date_heure_arrivee);

        DB::update('
            UPDATE etape_details
            SET depart = ?, arrivee = ?
            WHERE etape_id = ? AND coureur_id = ?
        ', [
            $date_heure_depart,
            $date_heure_arrivee,
            $id_etapes,
            $id_coureurs
        ]);

    }
    public static function getGenererCategorie()
    {
        DB::select("INSERT INTO categorie_coureurs (categorie_id, coureur_id)
            SELECT c.id, cr.id
            FROM categories c
            JOIN coureurs cr
            ON (c.nom = 'Homme' AND cr.genre = 'M') OR 
            (c.nom = 'Femme' AND cr.genre = 'F') OR
            (c.nom = 'Junior' AND YEAR(cr.date_naissance) >= 2006) 
            -- OR (c.nom = 'Senior' AND DATEDIFF(CURRENT_DATE, cr.date_naissance) / 365.25 > 60) 
            WHERE (c.id, cr.id) not in (select categorie_id, coureur_id from categorie_coureurs)
        ");
        // DB::select("INSERT INTO categorie_coureurs (categorie_id, coureur_id)
        //     SELECT c.id, cr.id
        //     FROM categories c
        //     JOIN coureurs cr
        //     ON (c.nom = 'Homme' AND cr.genre = 'M') OR 
        //     (c.nom = 'Femme' AND cr.genre = 'F') OR
        //     (c.nom = 'Junior' AND DATEDIFF(CURRENT_DATE, cr.date_naissance) / 365.25 < 18) 
        //     -- OR (c.nom = 'Senior' AND DATEDIFF(CURRENT_DATE, cr.date_naissance) / 365.25 > 60) 
        //     WHERE (c.id, cr.id) not in (select categorie_id, coureur_id from categorie_coureurs)
        // ");
        
        $categories =  DB::select(' select * from v_categorie_coureurs ');

        return $categories;
    }
    
    public static function getListePenalite()
    {
        $penalite = DB::select('select * from penalites');

        return $penalite;
    }
    public static function getNomEtape()
    {
        $nomEtape = DB::select('select * from etapes');

        return $nomEtape;
    }
    public static function getNomEquipe()
    {
        $nomEquipe = DB::select('select * from equipes');

        return $nomEquipe;
    }

    public static function insertPenalite($id_etapes,$id_coureurs,$heure_penalite, $min_penalite,$sec_penalite)
    {
        $penal = DB::select("
        INSERT INTO penalites 
        (etape_id, equipe_id, penalite)
        VALUES (?, ?, '" . $heure_penalite.':'.$min_penalite.':'.$sec_penalite. "')
        ",[$id_etapes ,$id_coureurs]);

        return $penal;
    }
    public static function deletePenal($id)
    {
        $penal = DB::select("
        DELETE from penalites where id = ?
        ",[$id ]);

        return $penal;
    }
    
}
