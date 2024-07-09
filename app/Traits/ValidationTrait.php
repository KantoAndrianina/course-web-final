<?php

namespace App\Traits;

use DateTime;
use Normalizer;

use Exception;
trait ValidationTrait {
    public function validerNom($nom) {
        // Logique de validation du nom
        return strlen($nom) >= 3 && strlen($nom) <= 50;
    }

    public function validerEmail($email) {
        // Logique de validation de l'email
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Convertit une chaîne d'heure au format HH:MM en objet DateTime.
     * @param string $timeString La chaîne d'heure à convertir (ex: "10:00").
     * @return DateTime|null Retourne un objet DateTime si la conversion réussit, sinon null.
     */
    public function convertirStringEnTime($timeString)
    {
        $time = DateTime::createFromFormat('H:i', $timeString);
        
        if ($time instanceof DateTime) {
            return $time;
        } else {
            return null;
        }
    }

    public function convertirCaracteresSpeciaux($chaine)
    {
        $search = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'à', 'á', 'â', 'ã', 'ä', 'å', 'È', 'É', 'Ê', 'Ë', 'è', 'é', 'ê', 'ë', 'Ì', 'Í', 'Î', 'Ï', 'ì', 'í', 'î', 'ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'ù', 'ú', 'û', 'ü', 'Ç', 'ç', 'Ý', 'ý', 'ÿ', 'Ñ', 'ñ');
        $replace = array('A', 'A', 'A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a', 'a', 'E', 'E', 'E', 'E', 'e', 'e', 'e', 'e', 'I', 'I', 'I', 'I', 'i', 'i', 'i', 'i', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'u', 'u', 'u', 'u', 'C', 'c', 'Y', 'y', 'y', 'N', 'n');

        return str_replace($search, $replace, $chaine);
    }

    public function cleanAccents($string)
    {
        // Convertissez les caractères spéciaux et les accents en caractères normaux
        $normalizedString = Normalizer::normalize($string, Normalizer::FORM_D);
        return preg_replace('/[^a-zA-Z0-9]/', '', $normalizedString); // Supprimez les caractères spéciaux restants si nécessaire
    }

    // public function convertToDate(string $dateString, string $format = 'Y-m-d')
    // {
    //     $time = strtotime($dateString);

    //     $newformat = date($format,$time);
    //     return $newformat;
    // }

    // public function convertToDate($dateString)
    // {
    //     $dateObj = \DateTime::createFromFormat('d/m/Y', $dateString);
    //     if ($dateObj && $dateObj->format('d/m/Y') === $dateString) {
    //         return $dateObj->format('Y-m-d');
    //     } else {
    //         throw new Exception("La date '$dateString' n'est pas valide.");
    //     }
    // }

    public function convertToDate($dateString)
    {
        $timestamp = strtotime(str_replace('/','-',$dateString));
        if($timestamp === false){
            throw new Exception("La date '$dateString' n'est pas valide");
            
        }
        return date('Y-m-d',$timestamp);
        
    }

    public function convertToDateTime($dateTimeString)
    {
        $timestamp = strtotime(str_replace('/', '-', $dateTimeString));
        if ($timestamp === false) {
            throw new Exception("La date et heure '$dateTimeString' n'est pas valide");
        }
        return date('Y-m-d H:i:s', $timestamp);
    }

    
    public function convertToTime($timeString)
    {
        $timestamp = strtotime($timeString);
        if ($timestamp === false) {
            throw new Exception("L'heure '$timeString' n'est pas valide");
        }
        return date('H:i:s', $timestamp);
    }

    public function convertToInt(string $stringValue)
    {
        return is_numeric($stringValue) ? (int)$stringValue : null;
    }

    public function convertToDouble(string $stringValue)
    {
        $stringValue = str_replace(',', '.', $stringValue);
        return is_numeric($stringValue) ? (float)$stringValue : null;
    }

    public function convertDescriMaisonToListHTML($phrase) 
    {
        $elements = explode(', ', $phrase);
        $html = '<ul>';
        foreach ($elements as $element) {
            $parts = explode(' ', $element);
            $nombre = $parts[0];
            $nom = implode(' ', array_slice($parts, 1));

            $html .= "<li>$nombre $nom</li>";
        }

        $html .= '</ul>';

        return $html;
    }

    public function convertPourcentageToDouble($pourcentage) 
    {
        $pourcentage = trim($pourcentage);
        if (substr($pourcentage, -1) === '%') {
            // Supprimer le % de la chaîne
            $pourcentage = rtrim($pourcentage, '%');
    
            // Transformer en nombre décimal
            $nombre_decimal = (double) str_replace(',', '.', $pourcentage);
            return $nombre_decimal;
        }
    
        return null;
    }

}