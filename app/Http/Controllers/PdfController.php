<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PdfDash;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;


class PdfController extends Controller
{
    public function genererPDF()
    {
        $etapes = PdfDash::genererPDF();

        $html = View::make('dash.certificat', ['devis' => $liste , 'somme' => $somme])->render();

        // Créer une instance de Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);

        // Charger le contenu HTML dans Dompdf
        $dompdf->loadHtml($html);

        // (Optionnel) Définir les options de rendu
        $dompdf->setPaper('A4', 'portrait');

        // Rendre le PDF
        $dompdf->render();

        // Retourner le PDF en réponse HTTP ou téléchargement
        return $dompdf->stream('Etudiants_notes.pdf');

        return view('dash.listeEtapes', ['etapes' => $etapes]);
    }
}
