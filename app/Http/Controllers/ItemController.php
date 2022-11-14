<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use Laravel\Ui\Presets\React;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item
            ::where('items.status', 'active')
            ->select()
            ->paginate(8);

        $type = Item::TYPE;

        return view('item.index',['items'=>$items, 'type' => $type, 'keyword'=>'']);
    }


    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
                'detail' => 'required',
            ]);
            
            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
            ]);

            return redirect('/items');
        }

        $type = Item::TYPE;

        return view('item.add',['type' => $type]);
    }


    /**
     * 商品編集
     */
    public  function edit(Request $request)
    {
        // 指定されたIDと同じレコードを取得して編集画面を表示する
        $items = Item::where('id', '=', $request->id)->first();
        $type = Item::TYPE;

        return view('item.edit')->with(['items' => $items, 'type' => $type]);
    }

    public function itemEdit(Request $request)
    {
        // バリデーション
        $this->validate($request, [
            'name' => 'required|max:100',
            'detail' => 'required',
        ]);
        
        // 既存のレコードを取得して、編集してから保存する
        $items = Item::where('id', '=', $request->id)->first();
        $items->id = $request->id;
        $items->name = $request->name;
        $items->type = $request->type;
        $items->detail = $request->detail;
        $items->save();

        return redirect('/items');
    }

    /**
     * 商品削除
     */
    public function itemDelete(Request $request)
    {
        // 編集画面で削除ボタンを押すとそのデータが削除される
        $items = Item::where('id', '=', $request->id)->first();
        $items->delete();

        return redirect('/items');
    }


    /**
     * 商品検索
     */
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Item::query();

        if(!empty($keyword)) {
            $query->where('id', 'LIKE', "%{$keyword}%")
                ->orWhere('name', 'LIKE', "%{$keyword}%");
        }
        $items = $query->paginate(8);
        return view('item.index',['items'=>$items, 'keyword'=>$keyword]);
    }
}
