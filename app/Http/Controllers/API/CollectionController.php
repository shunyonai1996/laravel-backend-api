<?php
/**
 * POPUP表示グループ情報を登録、削除処理
 * 
 * 
 * @version 1.0
 * @author 米内
 */

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class CollectionController extends Controller
{
    /**
     * グループ一覧取得
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = Collection::all();
        return response([ 'collections' => $collections, 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * グループ登録
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => ['required']
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $collection = Collection::create($data);

        return response([ 'collection' => $collection, 'message' => 'Created successfully'], 200);
    }

    /**
     * グループ削除
     * 
     * @param \Models\Model\Collection $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        $collection->delete();
        return response(['message' => 'Deleted']);
    }
}
