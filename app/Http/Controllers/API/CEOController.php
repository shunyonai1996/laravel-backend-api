<?php

/**
 * CEO情報を登録、表示、削除するための指令を行う
 * 
 * @version 1.0
 * @author 米内
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CEO;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\CEOResource;
use Illuminate\Support\Facades\Validator;

class CEOController extends Controller
{
    /**
     * 全てのCEO情報を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ceos = CEO::all();
        return response(['ceos' => CEOResource::collection($ceos), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * CEO情報登録
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'year' => 'required|max:255',
            'company_headquarters' => 'required|max:255',
            'what_company_does' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $ceo = CEO::create($data);

        return response(['ceo' => new CEOResource($ceo), 'message' => 'Created successfully'], 200);
    }

    /**
     * CEO詳細情報を取得
     *
     * @param  \App\Models\CEO  $ceo
     * @return \Illuminate\Http\Response
     */
    public function show(CEO $ceo)
    {
        return response(['ceo' => new CEOResource($ceo), 'message' => 'Retrived Successflly'], 200);
    }

    /**
     * CEO情報を更新
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CEO  $ceo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CEO $ceo)
    {
        $ceo->update($request->all());

        return response(['ceo' => new CEOResource($ceo), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * CEO情報を削除
     *
     * @param  \App\Models\CEO  $ceo
     * @return \Illuminate\Http\Response
     */
    public function destroy(CEO $ceo)
    {
        $ceo->delete();

        return response(['message' => 'Deleted']);
    }
}
