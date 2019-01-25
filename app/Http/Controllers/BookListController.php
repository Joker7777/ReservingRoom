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
        $booklist = new BookList();

        $booklist->name = $request->input('name');
        $booklist->frame = $request->input('frame');
        $booklist->every_week = $request->input('everyWeek');
        $booklist->representative = $request->input('representative');


        if ($request->input('everyWeek')) {
            $booklist->every_week_start_date = $request->input('everyWeekStartDate');
            $booklist->every_week_end_date = $request->input('everyWeekEndDate');
            $booklist->every_week_day = $request->input('everyWeekDay');
        } else {
            $booklist->one_time_date = $request->input('oneTimeDate');
        }
        if ($booklist->save()) {
            return response('saved', 200);
        } else {
            return response('error', 503);
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookList  $bookList
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, BookList $booklist)
    {
        $book = $booklist->where('id', $request->input('id'))->firstOrFail();
        $book->name = $request->input('name');
        $book->frame = $request->input('frame');
        $book->every_week = $request->input('everyWeek');
        $book->representative = $request->input('representative');

        if ($request->input('everyWeek')) {
            $book->one_time_date = null;
            $book->every_week_start_date = $request->input('everyWeekStartDate');
            $book->every_week_end_date = $request->input('everyWeekEndDate');
            $book->every_week_day = $request->input('everyWeekDay');
        } else {
            $book->one_time_date = $request->input('oneTimeDate');
            $book->every_week_start_date = null;
            $book->every_week_end_date = null;
            $book->every_week_day = null;
        }
        $book->save(); // error
        return 'aa';
        if (1) {
            return response('saved', 200);
        } else {
            return response('error', 503);
        }
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
