<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
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
        'image_hash_id',
        'image_name',
        'subject',
        'content',
        'is_check'
    ];

    public static function getColumnList()
    {
        return Schema::getColumnListing(self::$mainTableName);
    }

    public static function count($params)
    {
        return Todos::where('')->count();
    }

    public static function row()
    {

    }

    public static function lists(
        $params = array(
            'start' => 0, 'limit' => 0, 'searches' => array(),
        )
    ): Collection|array
    {
        \DB::enableQueryLog();

        $query = Todos::query();

        // 그룹핑 start, end 같은 경우 카운팅 해서 2번 도는거 막아버림
        $count = array(
            'default' => 0
        );

        if ($params['limit'] > 0) {
            $query->skip($params['start'])->take($params['limit']);
        }

        foreach ($params['searches'] as $k => $v) {
            if($v != '') {
                switch($k) {
                    case 'start_date':
                    case 'end_date':
                        if($count['default'] > 0) {
                            break;
                        }

                        if($params['searches']['start_date'] && $params['searches']['end_date']) {
                            $query->whereBetween('date', [$params['searches']['start_date'], $params['searches']['end_date']]);
                        } else if($params['searches']['start_date']) {
                            $query->where('date', '>=', $v);
                        } else if($params['searches']['end_date']) {
                            $query->where('date', '<=', $v);
                        }

                        $count['default'] += 1;
                        break;
                    case 'member_id':
                        $query->where($k, $v);
                        break;
                    default:
                        $query->where($k, 'like', "%{$v}%");
                        break;
                }
            }
        }

        $query->orderBy('id', 'DESC');

        $result = $query->get();

        $queries = \DB::getQueryLog();
        $last_query = end($queries);

//        var_dump($last_query); exit;

        return $result;
    }

}
