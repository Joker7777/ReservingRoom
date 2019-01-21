<?php

namespace App\Http\Controllers;

use App\BookList;
use Illuminate\Http\Request;

class BookListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getList ($std_date)
    {
        // データ取得、条件もここで
        return response(BookList::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add (Request $request)
    {
        // テスト手順
        // $data = ['content' => 'ブログを書く'];
        // $response = $this->post('/api/items', $data);
        $data = json_decode($request['data'], true); // jsonから連想配列に
        $booklist = new BookList();

        $booklist->name = $data->name;
        $booklist->frame = $data->frame;
        $booklist->every_week = $data->everyWeek;
        if ($data->everyWeek) {
            $booklist->every_week_start_date = $data->everyWeekStartDate;
            $booklist->every_week_end_date = $data->everyWeekEndDate;
            $booklist->every_week_day = $data->everyWeekDay;
        } else {
            $booklist->one_time_date = $data->oneTimeDate;
        }
        $booklist->save();

        return response($request, 201);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookList  $bookList
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, BookList $bookList)
    {
        // テスト手順
        // $data = ['content' => 'ブログを書く'];
        // $response = $this->patch('/api/items/1', $data);

        // 毎週かどうか、変更があったらそれもなんとかした方がいい

        return response('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookList  $bookList
     * @return \Illuminate\Http\Response
     */
    public function destroy (BookList $bookList)
    {
        // テスト手順
        // $response = $this->delete('/api/items/1');

        return response('destroy');
    }
}
