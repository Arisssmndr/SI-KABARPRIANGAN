<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IklanOnline extends Model
{
    use HasFactory;

    protected $table = 'iklanonline';

    protected $fillable = [
        'kode_iklanonline',
        'jenis_iklanonline',
    ];

    public function transaksionline()
    {
        return $this->hasMany(TransaksiOnline::class, 'id_iklanonline');
    }

    public static function createCode(){
        $latestCode = self::orderBy('kode_iklanonline','desc')->value('kode_iklanonline');
        $latestCodeNumber = intval(substr($latestCode,3));
        $nextCodeNumber = $latestCodeNumber ? $latestCodeNumber + 1 : 1;
        $formattedCodeNumber = sprintf("%03d", $nextCodeNumber);
        return 'ONL' . $formattedCodeNumber;
    }
}
