<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Article extends Model
{
    // SoftDeletes トレイトを使う
    use SoftDeletes;

    // 対象テーブルのプライマリキーのカラム名を指定する。デフォルトは 'id' というカラム名が想定されている。
    protected $primaryKey = 'id';

    // 「複数代入」を利用するときに指定する。追加・編集可能なカラム名のみを指定する。
    // $guarded プロパティを利用すると、逆に、追加・編集不可能なカラムを指定できる。
    protected $fillable = ['title', 'content'];
    
    // $dates プロパティには、日時が入るカラムを設定する（日付ミューテタ）
    // そうすると、その値が自動的に Carbon インスタンスに変換される
    protected $dates = ['created_at', 'updated_at'];

    /**
     * 記事リストを取得する
     *
     * @param  int $num_per_page 1ページ当たりの表示件数
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getArticleList($num_per_page = 10)
    {
        // Eloquent モデルはクエリビルダとしても動作するので、orderBy メソッドも paginate メソッドも利用できる
        // paginate メソッドを使うと、ページネーションに必要な全件数の取得やオフセットの指定などは全部やってくれる
        return $this->orderBy('id', 'desc')->paginate($num_per_page);
    }
}
