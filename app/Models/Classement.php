<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classement extends Model
{
    use HasFactory;

    public static function confirmerClassement($id_etape)
    {

        // DB::beginTransaction();

        // try {
            $results = DB::select("
                SELECT 
                    id_coureur, 
                    id_etape, 
                    duree,
                    CASE 
                        WHEN duree IS NULL THEN 0
                        WHEN ranking = 1 THEN 10
                        WHEN ranking = 2 THEN 6
                        WHEN ranking = 3 THEN 4
                        WHEN ranking = 4 THEN 2
                        WHEN ranking = 5 THEN 1
                        ELSE 0
                    END AS points
                FROM (
                    SELECT 
                        id_coureur, 
                        id_etape, 
                        duree,
                        @rank := IF(@prev_etape = id_etape, IF(@prev_duree = duree, @rank, @rank + @rank_inc), 1) AS ranking,
                        @rank_inc := IF(@prev_etape = id_etape, IF(@prev_duree = duree, 0, 1), 1),
                        @prev_etape := id_etape,
                        @prev_duree := duree
                    FROM 
                        v_classement_details,
                        (SELECT @rank := 0, @rank_inc := 1, @prev_etape := NULL, @prev_duree := NULL) r
                    WHERE 
                        id_etape = ? 
                    ORDER BY 
                        id_etape, 
                        CASE WHEN duree IS NULL THEN 1 ELSE 0 END, 
                        duree
                ) ranked
                ORDER BY id_etape, ranking
            ", [$id_etape]);

                    // var_dump($results);
            
            foreach ($results as $result) {
                DB::table('etape_details')
                    ->where('coureur_id', $result->id_coureur)
                    ->where('etape_id', $result->id_etape)
                    ->update(['points' => $result->points]);
            }

            DB::commit();

         return $results;
      
    }
    
    public static function getClassementGEtape()
    {
        $classeG = DB::select('SELECT nom_etape, nom_coureur,nom_equipe,duree,penalite,temps_final, points
        from v_classement_general_penalites 
         GROUP BY nom_coureur, rang_etape, nom_etape,nom_equipe,duree, penalite,temps_final, points
        ORDER BY  rang_etape, temps_final ASC');

        // $classeG = DB::select("
        // SELECT nom_etape, 
        //     nom_coureur, 
        //     nom_equipe, 
        //     duree, 
        //     penalite, 
        //     temps_final, 
        //     points
        // FROM v_classement_general_penalites
        // GROUP BY nom_coureur, 
        //         rang_etape, 
        //         nom_etape, 
        //         nom_equipe, 
        //         duree, 
        //         penalite, 
        //         temps_final, 
        //         points
        // ORDER BY rang_etape COLLATE utf8mb4_bin, 
        //         temps_final COLLATE utf8mb4_bin ASC
        // ");

        return $classeG;
    }
    public static function afficherResultatEtape($id)
    {
        $classeG = DB::select('SELECT nom_etape, nom_coureur,nom_equipe,duree,penalite,temps_final, points
        from v_classement_general_penalites 
        where id_etape=?
         GROUP BY nom_coureur, rang_etape, nom_etape,nom_equipe,duree, penalite,temps_final, points
        ORDER BY  rang_etape, temps_final ASC
        ',[$id]);

        return $classeG;
    }
    public static function getClassementGEquipe()
    {
        $classeGEquipe = DB::select('select id_equipe, nom_equipe, sum(points) points
        from v_classement_general_penalites 
         GROUP BY id_equipe, nom_equipe
        ORDER BY points DESC');

        return $classeGEquipe;
    }
    public static function getClassementCategorie($id_categorie)
    {
        $classeCat = DB::select('select id_equipe,nom_equipe,id_categorie,nom_categorie, sum(points) points
        from v_classement_categorie_point_penalites
        where id_categorie='. $id_categorie . '
        group by id_equipe,nom_equipe,id_categorie,nom_categorie
        ORDER BY points DESC');

        return $classeCat;
    }

    public static function getClassementEtapeCategorie($id_categorie)
    {
        $classeCat = DB::select('select id_etape, rang_etape, nom_etape, id_coureur,nom_coureur, id_equipe, nom_equipe,id_categorie,nom_categorie, duree, penalite,temps_final, points
        from v_classement_categorie_point_penalites
        where id_categorie='. $id_categorie .'
        ORDER BY points DESC');

        return $classeCat;
    }

    public static function getClassementGEquipePointGraph()
    {
        // $classeCat = '[10, 19, 3, 5, 2]';

        $classeG = self::getClassementGEquipe();

        $points = array_map(function($row) {
            return $row->points;
        }, $classeG);

        $pointsString = '[' . implode(', ', $points) . ']';

        return $pointsString;

        // return $classeCat;
    }

    public static function getClassementGEquipeNomGraph()
    {
        // $classeCat = '[10, 19, 3, 5, 2]';

        $classeG = self::getClassementGEquipe();

        $points = array_map(function($row) {
            return $row->nom_equipe;
        }, $classeG);

        $pointsString = '["' . implode('", "', $points) . '"]';

        return $pointsString;

        // return $classeCat;
    }

    public static function getClassementEquipeCategoriePointGraph($id_categorie)
    {
        // $classeCat = '[10, 19, 3, 5, 2]';

        $classeG = self::getClassementCategorie($id_categorie);

        $points = array_map(function($row) {
            return $row->points;
        }, $classeG);

        $pointsString = '[' . implode(', ', $points) . ']';

        return $pointsString;

        // return $classeCat;
    }

    public static function getClassementEquipeCategorieNomGraph($id_categorie)
    {
        // $classeCat = '[10, 19, 3, 5, 2]';

        $classeG = self::getClassementCategorie($id_categorie);

        $points = array_map(function($row) {
            return $row->nom_equipe;
        }, $classeG);

        $pointsString = '["' . implode('", "', $points) . '"]';

        return $pointsString;

        // return $classeCat;
    }

    public static function getClassementGEquipePDF()
    {
        $classeGEquipe = DB::select('select nom_equipe, sum(points) points
        from v_classement_general_penalites 
         GROUP BY nom_equipe
        ORDER BY points DESC limit 1');

        return $classeGEquipe;
    }
    public static function getClassementCategorieEquipePDF($id_categorie)
    {
        $classeCat = DB::select('select id_equipe,nom_equipe,id_categorie,nom_categorie, sum(points) points
        from v_classement_categorie_point_penalites
        where id_categorie='. $id_categorie . '
        group by id_equipe,nom_equipe,id_categorie,nom_categorie
        ORDER BY points DESC limit 1');

        return $classeCat;
    }
    public static function getClassementDetailEquipe($id_equipe)
    {
        $classeG = DB::select('SELECT nom_etape, nom_coureur, id_equipe, nom_equipe,duree,penalite,temps_final, points
        from v_classement_general_penalites 
        where id_equipe = ?
         GROUP BY nom_coureur, rang_etape, nom_etape, id_equipe,nom_equipe,duree, penalite,temps_final, points
        ORDER BY  points DESC', [$id_equipe]);

        // $classeG = DB::select('select id_equipe, nom_equipe, sum(points) points
        // from v_classement_general_penalites 
        // where id_equipe = ?
        //  GROUP BY id_equipe, nom_equipe
        // ORDER BY points DESC', [$id_equipe]);

        return $classeG;
    }
    public static function getClassementDetailEquipeEtape($id_equipe)
    {
        $classeG = DB::select('SELECT id_etape,nom_etape, id_equipe, nom_equipe, sum(points) points
        from v_classement_general_penalites 
        where id_equipe = ?
        GROUP BY id_etape,nom_etape, id_equipe, nom_equipe
        ORDER BY  points DESC', [$id_equipe]);

        // $classeG = DB::select('select id_equipe, nom_equipe, sum(points) points
        // from v_classement_general_penalites 
        // where id_equipe = ?
        //  GROUP BY id_equipe, nom_equipe
        // ORDER BY points DESC', [$id_equipe]);

        return $classeG;
    }
    
}
