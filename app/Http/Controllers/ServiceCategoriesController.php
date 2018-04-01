<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\ServiceCategories;


class ServiceCategoriesController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $categories = ServiceCategories::orderBy('title')->get();
        }
        catch(QueryException $e)
        {
            $message = 'cannot connect to database';
            $myerrors = array($message);
            return redirect('/home')->withErrors($myerrors);
        }

        return view ('servicescategories.show')->with('categories',$categories);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:service_categories'
        ]);

        //create new servicescategories
        $servicescategory= new ServiceCategories;

        //store the information from the input
        $servicescategory->title = $request->input('title');

        try
        {
            //save the servicescategories in the data base
            $servicescategory->save();
        }
        catch (QueryException $e)
        {
            $message = "please check that the information is valid";
            $myerrors = array($message);
            return redirect('/servicescategories')->withErrors($myerrors);
        }

        //redirect to the page of servicescategories
         return redirect('/servicescategories')->with('success', $servicescategory->title.' was added successfully as a category');
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

        $this->validate($request, [
            'title' => 'required'
        ]);

        try
        {
            //get the specific categoryservices
            $servicescategory= ServiceCategories::find($id);
        }
        catch (QueryException $e)
        {
            $message = "problem connecting to database";
            $myerrors = array($message);
            return redirect('/home')->withErrors($myerrors);
        }

        //if there is no client with this id return that there is no client
        if ($servicescategory == [])
        {
            return redirect('/servicescategories')->withErrors('url is not correct');
        }

        //store the information from the input
        $servicescategory->title = $request->input('title');
        try
        {
            //save the servicescategories in the data base
            $servicescategory->save();
        }
        catch (QueryException $e)
        {
            $message = "please check that the information is valid and that the title of the category is unique";
            $myerrors = array($message);
            return redirect('/servicescategories')->withErrors($myerrors);
        }
        //redirect to the page of servicescategories
         return redirect('/servicescategories')->with('success', 'information was edited successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            //find category with the specific id
            $category = ServiceCategories::find($id);

            //if there is no client with this id return that there is no client
            if ($servicescategory == [])
            {
                return redirect('/servicescategories')->withErrors('url is not correct');
            }

            //remove servicescategory from database
            $category->delete();
        }
        catch (QueryException $e)
        {
            $message = 'Category cannot be deleted as there are services associated with it';
            $myerrors = array($message);
            return redirect('/servicescategories')->withErrors($myerrors);
        }

        return redirect('/servicescategories')->with('success', 'Category was removed successfully');
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
         return redirect('/servicescategories')->withErrors('url is not correct');
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
        return redirect('/servicescategories')->withErrors('url is not correct');
    }
}
