<?php

namespace App\Models;

use App\Traits\ValidationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ImportPoint extends Model
{
    use HasFactory;
    use ValidationTrait;
    public $timestamps = false;

    public static function getHeader()
    {
        $expectedHeader = ['classement', 'points'];
        return $expectedHeader;
    }

    public function importFromCSV($filePath)
    {
        $fileContent = file_get_contents($filePath);
        $rows = explode("\r", $fileContent);
        $header = array_map('trim', explode(',', $rows[0]));
        $expectedHeader = $this->getHeader();

        if ($header !== $expectedHeader) {
            return ['success' => false, 'message' => 'La structure du fichier "Point" est incorrecte.'];
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
                $model->classement = $this->convertToInt($data[0]);
                $model->points = $this->convertToInt($data[1]);
                $model->save();
            }
        }

        return ['success' => true];
    }

    public function importData()
    {

        DB::insert('INSERT into points (classement, points)
            select  classement, points 
            from import_points
            where ( classement, points ) not in (select  classement, points from points)
            ');

    }
}
