# 部室予約表

## 仕様まとめ
1. 全体
    * 表の大きさは完全に横幅に依存、%表記
    * divクリック、モーダル
    * 前後の週へ移動ボタン、月曜日を渡して再読み込み
    * モーダルで使う情報は全てstoreで管理したい
        1. 選択したindex、曜日
        1. 今日

    * 必ず他の予定とかぶらないようにする
1. モーダル
    * クリックした場所の日付と時間をデフォルト
    * 名前　input text
    * 毎週　input checkbox
    * ()日付　input date
    * ()曜日　select
    * 時間 select

## 環境構築
* 
    ### 手順
    1. MySQL(xampp)
        xamppのインストーラで
    1. PHP v7.2.3
        たぶん公式インストーラ
    1. Node.js v8.12.0
        公式インストーラ
    1. Composer v1.7.2
        公式インストーラ
        環境変数とかの設定なしで使えました
    1. Laravel Installer 1.5.0
        ```
        composer global require "laravel/installer=~1.1"
        ```
        環境変数などの登録をしなくても使えた。コマンドはGitHubディレクトリにて
    1. Laravelプロジェクト作成
        ```
        laravel new プロジェクト名
        cd プロジェクト名
        composer install            # この前に、php.iniを変更した(extension=fileinfoのコメントを外した)
        php artisan -v              # Laravel Framwork 5.7.11, 正常にインストールされたか確認のため
        php artisan key:generate    # 初期起動前にはkeyの生成が必要
        php artisan serve           # ようやく起動、started:<url>のurlにアクセスしてLaravelと出ればok
        ```
    1. Vue.js, ES2015=>ES5, Sass=>CSS
        よくわからんがインストールがいるらしい, package.jsonの下部分？
        ```
        npm install
        ```
        * resources/views/welcome.blade.php を編集、Vue.jsが使えているか確認
        2018/10/31 1:03 できない　->　2018/10/31/11:15 app.jsが読みこめてなかったらしい
        http://blog.asial.co.jp/1496


    ### サーバ起動
    ```
    php artisan serve   # server
    npm run watch       # compiler
    ```

    ### 参考
    1. LaravelインストールからVueまで, mix()の件
    https://qiita.com/fruitriin/items/e0f2c9aa035c3ff2c874
    1. Composer インストール後から？とても丁寧な気がしたがわからん
    http://blog.asial.co.jp/1496
    1. Laravel + Vue.js (Mac)
    https://qiita.com/A_zara/items/b552b4135006dc1e69f3
    1. Laravel + vue.js? (windows)
    https://qiita.com/somebody_gp/items/2d31471bebf9164425fe
    1. Laravel プロジェクト作成
    https://qiita.com/33yuki/items/5ee27163b603d7f68250https://qiita.com/A_zara/items/b552b4135006dc1e69f3
    1. autoload.php
    https://qiita.com/pugiemonn/items/3d000ac0486987dd92df
    1. fileinfo
    https://qiita.com/ms2sato/items/79a2bcfd90385a8484ac
    1. artisan key:generate
    https://qiita.com/pugiemonn/items/641718fd241320384972
    1. npm install
    https://qiita.com/somebody_gp/items/2d31471bebf9164425fe
    1. npm install の失敗について
    https://qiita.com/quotto/items/1357bfb91346535f40bf


## 開発メモ
### API
* モデルクラスとコントローラ作成 
    http://blog.asial.co.jp/1498
    ``` php artisan make:model {name} --controller --resource ```

* 接続順序
    フロントエンドからAPIリクエスト(ajax?)
    route/api.phpによってコントローラが呼ばれる
    1. Route::resource()の場合
        httpメソッドの種類によって呼ばれる関数が変わる

        * /api/{api.phpで指定した名前}/(index) --- index()
        * /api/{api.phpで指定した名前}/1 --- そのほか
            php artisan route:list でメソッドと関数の対応を確認
    1. Route::get()他
        urlごとに関数を指定('Controler@method')しているのでその通りにリクエストする。

* 引数追加の方法　オブジェクトできる？
    route/api.php Route::get()で指定するurlに。
    1. /{arg}
    1. ?argName=arg (ちゃんと調べてない)


### Routing
* app/Http/Controllers/Controller.php
    関数に対してview(name.blade.php)を指定する。'name'で呼び出せる。
* routes/web.php
    Route::get('/page', 'Controller@function')で、リクエストurlに対してコントローラの関数を呼び出す。
* ルートパラメータ
    ```Route::get('URI/{model}/', 'functionName')```
    ```functionName (EloquentModel $model) {$model}```
    ルートパラメータの名前と、関数の引数のEloquentModelの変数名が同じとき、{model}をIDに持つEloquentModelの要素(レコード)が$modelに定義されて使える

### DB
* マイグレーション
    ```
        php artisan make:model {TableName} --controller --resource
        php artisan migrate
        php artisan migrate:reset
        php artisan migration:status
    ```

    database/seed/DatabaseSeeder.phpに初期値を登録
    ``` php artisan db:seed ```
    注意！:
        テーブル名が勝手に(スネークケース&複数形)に修正される。防ぐために、Modelファイルに以下を記載することで、テーブル名を指定することができる。
        ``` protected $table = 'TableName' ```

* 文字コード
    デフォルトでutf8mb4
    utf-8で扱えない4バイト文字(絵文字)を取り扱う。特に理由がなければそのままで。

* timestamps()
    名前入れない。文法エラー。自動でupdated_atとcreated_atを作ってくれる。

### scss
* プロパティ記述順序
    https://qiita.com/mgn/items/6154ccd2e23b2e65c769

* lightenがきかなかった理由
    数字が大きくて明るくなりすぎ、白になってしまった？(rgbaが反応しなかった理由や変数を参照できなかった理由が不明)

* floatすると親要素からはみ出す
    clearfixをclassに設定するだけでうまくいった。回り込みの解除をするらしい
    https://qiita.com/sanstktkrsyhsk/items/8298a47683fd67ad6299#%E3%81%9F%E3%81%A0%E5%90%84%E8%A6%81%E7%B4%A0%E3%81%ABmargin-auto%E3%82%92%E4%BD%BF%E3%81%A3%E3%81%9F%E5%A0%B4%E5%90%88

### Vuex
* 導入参考
    https://qiita.com/_P0cChi_/items/ebf8fbf035b36218a37e

* オブジェクトの追加とDOMへの反映
    通常オブジェクトはリアクティブでない(Vue全体)
    Vue.set((this.$set)を用いることでリアクティブな配列更新が可能
    オブジェクトは作成し直すことでリアクティブにできる

### コンパイル
> 特定の環境のWebpackでは、ファイル変更時に更新されないことがあります。自分のシステムでこれが起きた場合は、watch-pollコマンドを使用してください。

``` npm run watch ```の代わりに、``` npm run watch-poll ```
https://readouble.com/laravel/5.4/ja/mix.html

### PHP
* date('Y-M-D', time())
    Y: 2018
    M: Jan,     m: 1
    D: 曜日,    d: 日付

### 進捗
* a
    * 20181031 21:57
        環境はよくわからないがVueは動いたので良しとする。
        データ構造とそれを表示する仕組みを考える。

        表示するのは週ごと、GoogleCalendar参照(予定がdivでした)
        ページアクセス->その週に該当する予定のみ取ってくる->週ごとの配列に突っ込む->週ごとにforeach

    * 20181107 0:09
    予約をテーブル内に表示したい。
    store.js L101: vuex, actions, stateが読みこめてない
    -> action からは state にアクセスしない仕様か？

    * 20181108 20:01
        カレンダの表示
        つまったところ
        1. computedは引数を取れないのでmethod(とる方法はあるが複雑、今回はいらない)

    * 20181109 14:00
        マイグレーションできない、エラーで検索
        1. not findに対して
            https://stackoverflow.com/questions/42557693/laravel-pdoexception-could-not-find-driver
            php.ini:
            extension=pdo_mysql のコメントを外した
        1. too longに対して
            https://laravel-news.com/laravel-5-4-key-too-long-error
            Schema::defaultStringLength(191);
        1. $table->charsetは使えない？？コメントアウトした

        DBアクセス
        1. CRUDをやるあれ

        モーダルウィンドウ
        Vue.jsの```<transition name="modal">```が大変便利そう
        https://jp.vuejs.org/v2/examples/modal.html
        情報の受け渡しなど大丈夫そう

    * 20181111
        連番のリスト(年生成)　携帯
        新規登録

    * 20190109
        DBのカラム、Vuexの概要を決定
        マイグレーションした
        API使用にする。使い方を調査中
        変数、関数名などをlowerCamelCaseに
        値が変化しないのはUpperCamelCaseにしよう

    * 20190110
        DBマイグレーション再度、初期値設定
        http://blog.asial.co.jp/1498
        モデルクラスとコントローラ作成
        コントローラを呼び出すルーティング作成 ``` php artisan route:list ```
        コントローラ編集
        http://localhost:8000/api/items でjsonゲット
        モデルクラスでテーブル参照する？
        バリデーション前まで読んだ(テストすっとばし)

    * 20190112
        API動作確認

    * 20190114
        Storeとcomponentの連携修正
        次回：APIの引数を調査

    * 20190115
        デザイン修正

    * 20190116
        入力フォームとVuexまわり
        チェックボックス入れるとなぜか入力した内容がリセットされる
        原因究明 & 他のフォームも適用

    * 20190119
        諦めてコンポーネント依存に、保存時に送信
        クリックした情報が反映されるように
        配列のキーについて：
        　arr.name: 文字列'name'がキー
        　arr[name]: 変数nameに入った文字列がキー
        　arr['name']: 文字列'name'がキー
        API jsonをpost

    * 20190121
        API json, postになった、正常に動作
        everyWeekId, everyWeekにした
        代表者名追加
        結果表示機能実装、後はAPIでtrue/falseを返せるようにしたい

    * 20190125
        API json post修正、前回までは送り先でどうなってたか不明
        連想配列を送るとjsonになる、request->input('[key name]')でアクセス

        not nullに値をsetしないと500エラー => バリデーションの実装
        strage/logs/でログが見れる、echo

    * 20190126
        バグ解決：
        * 移動させたのに、前の場所に残っちゃう :ok
            reset
        * 毎週予約、必ずチェック(DBは01, 判定はtrue, falseのせい？) :ok
            every_week_idのまま変更してなかった
        * 予約完了メッセージが消えない
            Createdは最初に読みこまれた時しか動かない => リスト生成後へ :ok
        * 予約更新ボタン表示 :ok
            emptyで分岐
        大体完了？：後はデータ取得の条件指定とバリデーション

    * 20190127
        * 削除機能の実装
            * 405: ルートパラメータを設定してなかった
