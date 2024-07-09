<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Import extends Model
{
    use HasFactory;

    public static function reinitialisationConfirm()
    {

        DB::table('etape_details')->delete();
        DB::table('categorie_coureurs')->delete();
        DB::table('penalites')->delete();
        DB::table('etapes')->delete();
        DB::table('coureurs')->delete();
        DB::table('equipes')->delete();
        DB::table('points')->delete();
        // echo "ok";

        return true;
    }
   
}
