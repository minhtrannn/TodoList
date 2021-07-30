<?php 
namespace App\Repositories;

use App\Models\Item;
use Illuminate\Support\Arr;


class ItemRepository extends BaseRepository
{
    const MODEL = Item::class;

    public function paginated($search_params, $limit, $order_by="created_at", $sort="desc") {
        $limit = Arr::get($search_params,'limit', $limit);
        $page = Arr::get($search_params,'page', 1);
        $title = Arr::get($search_params, 'title', '');
        $id = Arr::get($search_params, 'id', '');
        // $name = Arr::get($search_params, 'status', '');
        $status = Arr::get($search_params, 'status', '');
        $query = $this->query();
        if($title)
        {
            $query->where('title', 'LIKE', '%' . $title . '%');
        }
        if($id)
        {
            $query->where('id',$id);
        }
        if($status)
        {
            $query->where('status', $status);
        }
        $query->skip(($page-1)*$limit);
        $query->take($limit);
        $query->orderBy($order_by, $sort);
        return $query->get();
    }

    public function store($request)
    {
        $item = new Item();
        $item->title = $request->title;
        $item->due_date = $request->due_date;
        $item->save();
        return $item;
    }

    public function count($search_params){
        $id = Arr::get($search_params, 'id', '');
        $status = Arr::get($search_params, 'status', '');
        $query = $this->query();   $title = Arr::get($search_params, 'title', '');     
        if($title)
        {
            $query->where('title', 'LIKE', '%' . $title . '%');
        }
        if($id)
        {
            $query->where('items.id', $id);
        }
        if($status)
        {
            $query->where('item.status', $status);
        }
        return $query->count();
    }

}
?>