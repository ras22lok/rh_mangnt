<?php

namespace App\Services;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class VerifyId
{
    // Verifica se é realmente um dado criptografado
    public static function checkCryptdado($dado) {
        try {
            return Crypt::decrypt($dado);
        } catch(DecryptException $e) {
            return redirect()->to('home');
            return $e->getMessage();
        }
    }
}
