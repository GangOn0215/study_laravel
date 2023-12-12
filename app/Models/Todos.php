<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Todos extends Model
{
    private static $mainTableName = 'todos';
    use HasFactory;

    protected $fillable = [
        'created_member',
        'date',
        'subject',
        'content',
        'is_check'
    ];

    public static function getColumnList() {
        return Schema::getColumnListing(self::$mainTableName);
    }

    public static function count($params) {
        return Todos::where('')->count();
    }

    public static function row() {

    }

    public static function lists() {

    }

}
