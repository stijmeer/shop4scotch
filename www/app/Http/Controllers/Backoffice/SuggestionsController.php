<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Http\Controllers\Controller;
use App\Http\Requests;

class SuggestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suggestion = new Suggestion();

        $data = [
            'suggestion' => $suggestion,
        ];
        return view('backoffice.suggestions.create', $data);
    }

//    public function showForm()
//    {
//        return view('backoffice.suggestions.create_form');
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(/*Request $request*/)
    {
        $rules = [
            'title'    => 'required|unique:suggestions|max:255',
            'content' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
//            return Redirect::to('backoffice/products/create')
//                ->withErrors($validator)
//                ->withInput(Input::all());
        } else {
            // store
            $suggestion = new Suggestion();
            $suggestion->title   = Input::get('title');
            $suggestion->content = Input::get('content');
            $suggestion->save();

            //redirect
//            Session::flash('message', 'Successfully created new Suggestion: ' . Input::get('name') . ' !');
//            return redirect()->route('backoffice.products.index'); // $ artisan route:list
        }
//        $suggestion = new Suggestion($request->only(['title','content']));
//        $suggestion->save();

        //return redirect()->route('backoffice.suggestions.index'); // $ artisan route:list
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
