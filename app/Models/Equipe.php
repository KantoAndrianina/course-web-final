<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Equipe extends Model
{
    use HasFactory;
    public $timestamps = false; 
    
    public static function loginEquipe($login, $mdp)
    {
        $equipe = self::where('login', $login)->first();

        if (!$equipe) {
            throw new Exception('Login incorrect.');
        }

        // if (!Hash::check($mdp, $equipe->mdp)) {
        //     throw new Exception('Mot de passe incorrect.');
        // }

        if ($mdp !== $equipe->mdp) {
            throw new Exception('Mot de passe incorrect.');
        }

        return $equipe->id;
    }
   
}
