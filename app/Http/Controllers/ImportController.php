<?php

namespace App\Http\Controllers;

use App\Models\ImportEtape;
use App\Models\ImportPoint;
use App\Models\ImportResultat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImportController extends Controller
{
    public function importCSVEtape(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'csvfile1' => 'required_without_all:csvfile2|file|mimes:csv,txt',
                'csvfile2' => 'required_without_all:csvfile1|file|mimes:csv,txt',
            ], [
                'csvfile1.required_without_all' => 'Au moins le fichier "maison et travaux" est requis',
                'csvfile2.required_without_all' => 'ou le fichier "devis"',
                'csvfile1.mimes' => 'Le fichier "maison et travaux" doit être un fichier CSV.',
                'csvfile2.mimes' => 'Le fichier "devis" doit être un fichier CSV.',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            if ($request->hasFile('csvfile1')) {
                $file1 = $request->file('csvfile1');
                $importEtape = new ImportEtape();
                $result = $importEtape->importFromCSV($file1->getPathname());

                if (!$result['success']) {
                    return back()->withErrors(['csvfile1' => $result['message']])->withInput();
                }
                $model = new ImportEtape;
                $model->importData();
            }

            if ($request->hasFile('csvfile2')) {
                $file2 = $request->file('csvfile2');
                $importResultat = new ImportResultat();
                $result = $importResultat->importFromCSV($file2->getPathname());

                if (!$result['success']) {
                    return back()->withErrors(['csvfile2' => $result['message']])->withInput();
                }
                $model = new ImportResultat();
                $model->importData();
            }

            return redirect()->route('form.import.point');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function importCSVPoint(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'csvfile3' => 'required_without_all:csvfile1|file|mimes:csv,txt',
            ], [
                'csvfile3.required_without_all' => 'ou le fichier "devis"',
                'csvfile3.mimes' => 'Le fichier "maison et travaux" doit être un fichier CSV.',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            if ($request->hasFile('csvfile3')) {
                $file1 = $request->file('csvfile3');
                $importEtape = new ImportPoint();
                $result = $importEtape->importFromCSV($file1->getPathname());

                if (!$result['success']) {
                    return back()->withErrors(['csvfile3' => $result['message']])->withInput();
                }
                $model = new Importpoint;
                $model->importData();
            }
            // echo "ok";

            return redirect()->route('confirm.categorie');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

}
