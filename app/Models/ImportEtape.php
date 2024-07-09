<?php

namespace App\Models;

use App\Traits\ValidationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ImportEtape extends Model
{
    use HasFactory;
    use ValidationTrait;
    public $timestamps = false;

    public static function getHeader()
    {
        $expectedHeader = ['etape', 'longueur', 'nb coureur', 'rang', 'date départ', 'heure départ'];
        return $expectedHeader;
    }

    public function importFromCSV($filePath)
    {
        $fileContent = file_get_contents($filePath);
        $rows = explode("\r", $fileContent);
        $header = array_map('trim', explode(',', $rows[0]));
        $expectedHeader = $this->getHeader();

        if ($header !== $expectedHeader) {
            return ['success' => false, 'message' => 'La structure du fichier "Etape" est incorrecte.'];
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
                $model->etape = $data[0];
                $model->longueur = $this->convertToDouble($data[1]);
                $model->nb_coureur = $this->convertToInt($data[2]);
                $model->rang = $this->convertToInt($data[3]);
                $model->date_départ = $this->convertToDate($data[4]);
                $model->heure_départ = $this->convertToTime($data[5]);
                $model->save();
            }
        }

        return ['success' => true];
    }

    public function importData()
    {

        DB::insert('INSERT into etapes (nom,longueur,nb_coureur,rang)
            select distinct etape,longueur,nb_coureur,rang
            from import_etapes
            where (etape,longueur,nb_coureur,rang) not in (select nom,longueur,nb_coureur,rang from etapes)
                ');
    }

}

    