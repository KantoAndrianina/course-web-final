<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfDash extends Model
{
    public static function genererPDF()
    {
        $etapes = DB::select('select id_etape, rang_etape, nom_etape, id_coureur,nom_coureur, id_equipe, nom_equipe,id_categorie,nom_categorie, duree, points
        from v_classement_categorie_points
        where id_categorie='. $id_categorie .'
        ORDER BY rang_etape, points ASC');

        return $etapes;
    }
}
