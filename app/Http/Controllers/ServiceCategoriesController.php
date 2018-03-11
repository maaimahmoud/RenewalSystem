<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ServiceCategories;
class ServiceCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
          $categories = ServiceCategories::all();
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
    	return view('servicescategories.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        } 
     
        //redirect to the page of servicescategories
         return redirect('/');
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
        //get the specific categoryservices
        $servicescategory= ServiceCategories::find($id);

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
        } 
        //redirect to the page of servicescategories
         return redirect('/servicescategories');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $category = ServiceCategories::find($id);

        //remove servicescategory from database
        $category->delete();
     return redirect('/servicescategories');
    }
}
