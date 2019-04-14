<?php

namespace App\Http\Controllers;

use App\BookList;
use Illuminate\Http\Request;

class BookListController extends Controller
{
    /** @var array $day_name 曜日の数値->文字列 */
    private $day_name = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getList ($std_date)
    {
        // データ取得、条件もここで
        return response(BookList::all(), 200);
    }

    /**
     * 何度も発生する代入操作
     * 
     * @param array $data 代入するデータ
     * @param array $booklist 
     * @return bool,string 結果 true: ok, false: DB error, 'date string': conflict
     */
    private function value_set ($data, $booklist)
    {
        // conflict check
        if (BookList::whereDate('book_date', $data['book_date'])
            ->where('frame', $data['frame'])
            ->count() > 0)
        {
            return $data['book_date'];
        }

        $booklist->name = $data['name'];
        $booklist->frame = $data['frame'];
        $booklist->every_week_id = $data['every_week_id'];
        $booklist->representative = $data['representative'];

        $booklist->every_week_start_date = $data['start_date'];
        $booklist->every_week_end_date = $data['end_date'];

        $booklist->book_date = $data['book_date'];
        
        return $booklist->save();
    }

    /**
     * mapping
     * 
     * @param array $request postパラメータ
     * @return array mapingした配列
     */
    private function mapping ($request)
    {
        return [
            'name'=>$request->input('name'),
            'frame'=>intval($request->input('frame')),
            'representative'=>$request->input('representative'),
            'start_date'=>$request->input('everyWeekStartDate'),
            'end_date'=>$request->input('everyWeekEndDate'),

            'book_date'=>$request->input('oneTimeDate'),
            'every_week_id'=>$request->input('everyWeekId'),

            'is_every_week'=>$request->input('everyWeek'), // ちゃんとboolになってる？
            'every_week_day'=>intval($request->input('everyWeekDay')),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add (Request $request)
    {
        $data = $this->mapping($request);
        $res = true;
        $fail_date = [];

        if ($data['is_every_week']) { // 期間分登録
            $num = BookList::max('every_week_id');
            $data['every_week_id'] = $num + 1;

            $first_datetime = strtotime( // $2から数えて最初の$1曜日のtimestamp
                $this->day_name[$data['every_week_day']], // Sunday ~ Saturday
                $data['start_date']
            );
            $end_datetime = strtotime($data['end_date']);

            for ($book_date = $first_datetime;
                $book_date <= $end_datetime;
                $book_date = strtotime('+7 days', $book_date))
            {
                $data['book_date'] = date('Y-m-d', $book_date);
                $r = $this->value_set($data, new BookList());
                if ($r !== true) {
                    $res = false;
                    if (is_string($r)) {
                        $fail_date[] = $book_date;
                    }
                }
            }
        } else {
            $r = $this->value_set($data, new BookList());
            if ($r !== true) {
                $res = false;
                if (is_string($r)) {
                    $fail_date[] = $data['book_date'];
                }
            }
        }

        if ($res) {
            return response('saved', 200);
        } else if (count($fail_date) > 0) {
            return response($fail_date, 409);
        } else {
            return response('error', 500);
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookList  $bookList
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request)
    {
        $res = true;
        $data = $this->mapping($request);
        $book = BookList::where('id', $request->input('id'))->firstOrFail();

        // 日付の変更：
        // 他の変更：単体変更はなかったことに

        if ($data['is_every_week'] && $data['set_all']) { // 全データの編集
            $books = BookList::where('every_week_id', $data['every_week_id']);

            foreach ($books as $b) {
                $data['book_date'] = date('Y-m-d', $book_date);
                $data['is_every_week'] = $num + 1;
                $r = $this->value_set($data, new BookList());
                if ($r !== true) {
                    $res = false;
                    if (is_string($r)) {
                        $fail_date[] = $book_date;
                    }
                }
            }
        } else {
            $r = $this->value_set($data, $book);
            if ($r !== true) {
                $res = false;
                if (is_string($r)) {
                    $fail_date[] = $data['book_date'];
                }
            }
        }

        if ($res) {
            return response('saved', 200);
        } else {
            return response('error', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookList  $bookList
     * @return \Illuminate\Http\Response
     */
    public function destroy (BookList $booklist)
    {
        if ($booklist->delete()) {
            return response('deleted', 202);
        } else {
            return response('error', 500);
        }
    }
}
