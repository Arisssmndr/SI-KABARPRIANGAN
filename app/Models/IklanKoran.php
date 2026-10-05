<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IklanKoran extends Model
{
    use HasFactory;

    protected $table = 'iklankoran';

    protected $fillable = [
        'kode_iklankoran',
        'jenis_iklankoran',
    ];

    public function transaksikoran()
    {
        return $this->hasMany(TransaksiKoran::class, 'id_iklankoran');
    }

    public static function createCode()
    {
        $latestCode = self::orderBy('kode_iklankoran', 'desc')->value('kode_iklankoran');
        $latestCodeNumber = $latestCode ? intval(substr($latestCode, 3)) : 0;
        $nextCodeNumber = $latestCodeNumber + 1;
        $formattedCodeNumber = sprintf("%03d", $nextCodeNumber);
        return 'KRN' . $formattedCodeNumber;
    }
}
