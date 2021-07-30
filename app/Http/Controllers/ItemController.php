<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Helpers\Response;
use App\Http\Resources\ItemResource;
use App\Repositories\ItemRepository;
use Illuminate\Support\Facades\Validator;
class ItemController extends Controller
{
    const ITEM_PER_PAGE = 10;
    protected $itemRepository;
    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = $this->itemRepository->paginated($request, static::ITEM_PER_PAGE);
        $data = ItemResource::collection($items);
        $total = $this->itemRepository->count($request);
        return Response::data($data, $total);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'due_date' => 'required',
        ]);
        if ($validation->fails()){
            return Response::dataError($validation->errors()->first());
        }
        $item = $this->itemRepository->store($request);
        return Response::data(new ItemResource($item));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = $this->itemRepository->find($id);
        if(!$item)
        {
            return Response::dataError('Todo Item không tồn tại');
        }

        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'due_date' => 'required',
            'status'=> 'required'
        ]);

        if ($validation->fails()){
            return Response::dataError($validation->errors()->first());
        };
        $item->title = $request['title'];
        $item->due_date = $request['due_date'];
        $item->status = $request['status'];
        $item->save();
        return Response::data(new ItemResource(($item)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = $this->itemRepository->find($id);
        if(!$item)
        {
            return Response::dataError('Todo Item không tồn tại');
        }

        $item->delete();
        return Response::data("Xoá thành công");
    }
}
