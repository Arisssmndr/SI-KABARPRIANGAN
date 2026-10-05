<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IklanPriangan extends Model
{
    use HasFactory;

    protected $table = 'iklanpriangan';

    protected $fillable = [
        'kode_iklanpriangan',
        'jenis_iklanpriangan',
    ];

    public function transaksipriangan()
    {
        return $this->hasMany(TransaksiPriangan::class, 'id_iklanpriangan');
    }

    public static function createCode(){
        $latestCode = self::orderBy('kode_iklanpriangan','desc')->value('kode_iklanpriangan');
        $latestCodeNumber = intval(substr($latestCode,3));
        $nextCodeNumber = $latestCodeNumber ? $latestCodeNumber + 1 : 1;
        $formattedCodeNumber = sprintf("%03d", $nextCodeNumber);
        return 'PTV' . $formattedCodeNumber;
    }
}
