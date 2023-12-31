<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class TodosGroup extends Model
{
    private static $mainTableName = 'todos_groups';
    use HasFactory;

    protected $fillable = [
        'created_member',
        'name',
        'sequence',
        'color'
    ];

    public static function getColumnList()
    {
        return Schema::getColumnListing(self::$mainTableName);
    }

    public static function count($params)
    {
        return TodosGroup::where('')->count();
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

        $query = TodosGroup::query();

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
                    case 'create_member':
                        $query->where($k, $v);
                        break;
                    default:
                        $query->where($k, 'like', "%{$v}%");
                        break;
                }
            }
        }

        $query->orderBy('sequence', 'DESC');

        $result = $query->get();

        $queries = \DB::getQueryLog();
        $last_query = end($queries);

        // var_dump($last_query); exit;

        return $result;
    }

    public static function lists_join_todos(
        $params = array(
            'start' => 0, 'limit' => 0, 'searches' => array(),
        )
    ): Collection|array
    {
        \DB::enableQueryLog();

        $query = TodosGroup::query();

        // 그룹핑 start, end 같은 경우 카운팅 해서 2번 도는거 막아버림
        $count = array(
            'default' => 0
        );

        if ($params['limit'] > 0) {
            $query->skip($params['start'])->take($params['limit']);
        }

        $query->leftJoin('todos', 'todos.group_id', '=', 'todos_groups.id');


        $query->select('todos_groups.*');

        foreach ($params['searches'] as $k => $v) {
            if($v != '') {
                switch($k) {
                    case 'todos.start_date':
                    case 'todos.end_date':
                        if($count['default'] > 0) {
                            break;
                        }

                        if($params['searches']['todos.start_date'] && $params['searches']['todos.end_date']) {
                            $query->whereBetween('date', [$params['searches']['todos.start_date'], $params['searches']['todos.end_date']]);
                        } else if($params['searches']['todos.start_date']) {
                            $query->where('date', '>=', $v);
                        } else if($params['searches']['todos.end_date']) {
                            $query->where('date', '<=', $v);
                        }

                        $count['default'] += 1;
                        break;
                    case 'todos.created_member':
                    case 'todos.group_id':
                        $query->where($k, $v);
                        break;
                    default:
                        $query->where($k, 'like', "%{$v}%");
                        break;
                }
            }
        }

        $query->orderBy('sequence', 'DESC');

        $result = $query->get();

        $queries = \DB::getQueryLog();
        $last_query = end($queries);

//         var_dump($last_query); exit;

        return $result;
    }

}
