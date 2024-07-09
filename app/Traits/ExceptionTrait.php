<?php

namespace App\Traits;

use DateTime;
use Normalizer;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

trait ExceptionTrait {

    public static function validateMontantPositif($montant)
    {
        if ($montant <= 0) {
            throw new \Exception('Le montant doit être positif');
        }
    }

    public static function validateMontantInferieurAuMontantMax($montant, $montantMax)
    {
        if ($montant > $montantMax) {
            throw new \Exception('Le montant doit être inférieur ou égal au montant du devis');
        }
    }

    public static function validateMontantMinimum30Pourcent($montant, $montantMax)
    {
        $montant30 = ($montantMax * 30) / 100;
        if ($montant <= $montant30) {
            throw new \Exception('Le montant doit représenter au moins 30% du montant');
        }
    }

    public static function validateDate($datePaiement)
    {
        $datePaiement = Carbon::parse($datePaiement);
        $today = Carbon::now();
        if ($datePaiement->lt($today)) {
            throw new \Exception('La date ne peut pas être inférieure à la date d\'aujourd\'hui');
        }
    }
    public static function validateDateArrivee($date_heure_depart, $date_heure_arrivee)
    {
        $date_heure_arrivee = Carbon::parse($date_heure_arrivee);
        if ($date_heure_arrivee->lt($date_heure_depart)) {
            throw new \Exception('La date ne peut pas être inférieure à la date depart');
        }
    }

    public static function checkCoureurExists($id_etape,$id_coureur)
    {
        $existingCoureur = DB::select('select * from etape_details where coureur_id=? and etape_id=?',[$id_coureur,$id_etape]);
        // $existingCoureur = DB::table('coureurs')->where('id', $id_coureur)->exists();
        $existingCoureurNom = DB::select('select nom from coureurs where id=?',[$id_coureur]);
        

        if ($existingCoureur) {
            throw new Exception("Le coureur " . $existingCoureurNom[0]->nom . " existe déjà.");
        }
    }

    public static function checkCoureurExistEtape($id_etape,$id_coureur)
    {
        $equipe_query = DB::select('select equipe_id from coureurs where id=?',[$id_coureur]);
        $equipe_id = $equipe_query[0]->equipe_id;

        $existingCoureur = DB::select('SELECT etape_id, nb_coureur,equipe_id,  count(equipe_id) nb_coureur_equipe
        from etape_details ed
        join v_etapes e on e.id = ed.etape_id
        join v_coureurs c on c.id = ed.coureur_id
        where equipe_id=? and etape_id=?
        group by etape_id, nb_coureur, equipe_id 
        ',[$equipe_id,$id_etape]);

        if ($existingCoureur[0]->nb_coureur == $existingCoureur[0]->nb_coureur_equipe) {
            throw new Exception("Il y a deja " . $existingCoureur[0]->nb_coureur . " coureur(s) pour cette etape");
        }
    }

}