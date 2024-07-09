<?php

namespace App\Models;

use App\Traits\ValidationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ImportResultat extends Model
{
    use HasFactory;
    use ValidationTrait;
    public $timestamps = false;

    public static function getHeader()
    {
        $expectedHeader = ['etape_rang', 'numero dossard', 'nom', 'genre', 'date naissance', 'equipe', 'arrivée'];
        return $expectedHeader;
    }

    public function importFromCSV($filePath)
    {
        $fileContent = file_get_contents($filePath);
        $rows = explode("\r", $fileContent);
        $header = array_map('trim', explode(',', $rows[0]));
        $expectedHeader = $this->getHeader();

        if ($header !== $expectedHeader) {
            return ['success' => false, 'message' => 'La structure du fichier "Resultat" est incorrecte.'];
        }

        $rows = array_slice($rows, 1);
        $rows = array_map('trim',$rows);
        if (!self::all()->isEmpty()) {
            self::truncate();
        }

        foreach ($rows as $row) {
            $data = str_getcsv($row, ',');
            // dump($data);

            if (!empty($data[0])) {
                $model = new self();
                $model->etape_rang = $this->convertToInt($data[0]);
                $model->numero_dossard = $this->convertToInt($data[1]);
                $model->nom = $data[2];
                $model->genre = $data[3];
                $model->date_naissance = $this->convertToDate($data[4]);
                $model->equipe = $data[5];
                $model->arrivee = $this->convertToDateTime($data[6]);
                $model->save();
            }
        }

        return ['success' => true];
    }

    public function importData()
    {

        DB::insert('INSERT into equipes (nom, login, mdp)
            select DISTINCT equipe, equipe,equipe 
            from import_resultats
            where (equipe, equipe, equipe) not in (select nom,login, mdp from equipes)
                ');

        DB::insert('INSERT into coureurs (nom,numero, genre, date_naissance, equipe_id)
            select distinct i.nom nomcoureur, numero_dossard, genre, date_naissance, e.id equipe_id
            from import_resultats i
            join equipes e on e.nom = i.equipe
            where (i.nom, numero_dossard, genre, date_naissance, e.id) not in (select nom,numero, genre, date_naissance, equipe_id from coureurs)
            ');

        DB::insert("INSERT into etape_details (etape_id,coureur_id, depart,arrivee)
            select e.id etape_id, c.id coureur_id, CONCAT(ie.date_départ,' ',ie.heure_départ) date_heure_depart, ir.arrivee
            from import_etapes ie
            join import_resultats ir on ie.rang = ir.etape_rang
            join coureurs c on  c.nom = ir.nom and c.numero = ir.numero_dossard and c.date_naissance = ir.date_naissance
            join etapes e on  e.nom = ie.etape and e.longueur = ie.longueur and e.nb_coureur = ie.nb_coureur and e.rang = ie.rang
            where (e.id , c.id, CONCAT(ie.date_départ,' ',ie.heure_départ), ir.arrivee) not in(select etape_id,coureur_id, depart,arrivee from etape_details)
        ");

    }
}
