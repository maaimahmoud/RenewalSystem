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
     * Display a listing of the category.
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
            $my_errors = array($message);
            return redirect('/home')->withErrors($my_errors);
        }

        return view ('servicescategories.show')->with('categories',$categories);
    }
    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
    }
    /**
     * Store a newly created category in storage.
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
        $services_category= new ServiceCategories;

        //store the information from the input
        $services_category->title = $request->input('title');

        try
        {
            //save the servicescategories in the data base
            $services_category->save();
        }
        catch (QueryException $e)
        {
            $message = "please check that the information is valid";
            $my_errors = array($message);
            return redirect('/servicescategories')->withErrors($my_errors);
        }

        //redirect to the page of servicescategories
         return redirect('/servicescategories')->with('success', $services_category->title.' was added successfully as a category');
    }

    /**
     * Update the specified category in storage.
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
            $services_category= ServiceCategories::find($id);
        }
        catch (QueryException $e)
        {
            $message = "problem connecting to database";
            $my_errors = array($message);
            return redirect('/home')->withErrors($my_errors);
        }

        //if there is no client with this id return that there is no client
        if ($services_category == [])
        {
            return redirect('/servicescategories')->withErrors('url is not correct');
        }

        //store the information from the input
        $services_category->title = $request->input('title');
        try
        {
            //save the servicescategories in the data base
            $services_category->save();
        }
        catch (QueryException $e)
        {
            $message = "please check that the information is valid and that the title of the category is unique";
            $my_errors = array($message);
            return redirect('/servicescategories')->withErrors($my_errors);
        }
        //redirect to the page of servicescategories
         return redirect('/servicescategories')->with('success', 'information was edited successfully');
    }
    /**
     * Remove the specified category from storage.
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
            if ($category == [])
            {
                return redirect('/servicescategories')->withErrors('url is not correct');
            }

            //remove servicescategory from database
            $category->delete();
        }
        catch (QueryException $e)
        {
            $message = 'Category cannot be deleted as there are services associated with it';
            $my_errors = array($message);
            return redirect('/servicescategories')->withErrors($my_errors);
        }

        return redirect('/servicescategories')->with('success', 'Category was removed successfully');
    }
    /**
     * Display the specified category.
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
     * Show the form for editing the specified category.
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
