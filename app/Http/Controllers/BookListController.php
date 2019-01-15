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
    public function getList($std_date)
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
    public function add(Request $request)
    {
        // テスト手順
        // $data = ['content' => 'ブログを書く'];
        // $response = $this->post('/api/items', $data);

        $booklist = new BookList();
        // $item->name = $request->input('content');
        // $item->one_time_date = date('Y-m-d', time());
        // // $item->every_week_start_date = null;
        // // $item->every_week_end_date = null;
        // // $item->every_week_day = null;
        // $item->frame = 5;
        // // $item->every_week_id = null;
        // $item->save();

        return response($booklist, 201);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookList  $bookList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookList $bookList)
    {
        // テスト手順
        // $data = ['content' => 'ブログを書く'];
        // $response = $this->patch('/api/items/1', $data);

        return response('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookList  $bookList
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookList $bookList)
    {
        // テスト手順
        // $response = $this->delete('/api/items/1');

        return response('destroy');
    }
}
