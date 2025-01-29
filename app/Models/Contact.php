<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'source'];

    public static function viewFormById($id)
    {
        $getall = DB::table('contacts')
            ->select('contacts.*')
            ->where('contacts.id', '=', $id)
            ->get();


        $result = $getall;
        $resultData = json_decode(json_encode($result), true);

        return $resultData;
    }

    public static function deleteContact($id)
    {

        DB::table('contacts')->where('id', '=', $id)->delete();
    }
}
