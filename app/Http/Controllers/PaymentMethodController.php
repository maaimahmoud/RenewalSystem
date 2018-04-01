<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\PaymentMethod;


class PaymentMethodController extends Controller
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
            //retrieve all payment methods
            $paymentmethods = PaymentMethod::orderBy('title')->get();
        }
        catch(QueryException $e)
        {
            $message = 'cannot connect to database';
            $myerrors = array($message);
            return redirect('/home')->withErrors($myerrors);
        }

        //show them in the page
        return view('paymentmethods.show')->with('paymentmethods', $paymentmethods);
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
            'title' => 'required|unique:payment_methods',
            'months'=>'required|unique:payment_methods|numeric'
        ]);

        //create new payment method
        $payment_method = new PaymentMethod;

        //store the information from the input
        $payment_method->title = $request->input('title');
        $payment_method->months = $request->input('months');

        try
        {
            //save the payment method in the data base
            $payment_method->save();
        }
        catch (QueryException $e)
        {
            $message = "please check that the information is valid";
            $myerrors = array($message);
            return redirect('/paymentmethods')->withErrors($myerrors);
        }


        //redirect to the page of payment methods
        return redirect('/paymentmethods')->with('success', $payment_method->title.' was added successfully as a payment method');
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
            //get the specific payment method
            $payment_method = PaymentMethod::find($id);
        }
        catch(QueryException $e)
        {
            $message = 'cannot connect to database';
            $myerrors = array($message);
            return redirect('/paymentmethods')->withErrors($myerrors);
        }

        //if there is no client with this id return that there is no client
        if ($payment_method == [])
        {
            return redirect('/paymentmethods')->withErrors('no payment method exists with that id');
        }

        //update the info from the input request
        $payment_method->title = $request->input('title');
        $payment_method->months = $request->input('months');

        try
        {
            //save the payment method in the data base
            $payment_method->save();
        }
        catch (QueryException $e)
        {
            $message = "please check that the information is valid and that the title of payment method is unique";
            $myerrors = array($message);
            return redirect('/paymentmethods')->withErrors($myerrors);
        }

         //redirect to the page of servicescategories
         return redirect('/paymentmethods')->with('success', 'information was edited successfully');
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
            //get the specific payment method
            $payment_method = PaymentMethod::find($id);

            //if there is no client with this id return that there is no client
            if ($payment_method == [])
            {
                return redirect('/paymentmethod')->withErrors('no payment method with that id');
            }

            //remove the payment method
            $payment_method->delete();
        }
        catch(QueryException $e)
        {
            $message = 'cannot delete this payment method as it is currently in use';
            $myerrors = array($message);
            return redirect('/paymentmethods')->withErrors($myerrors);
        }

        //return to payment mehtods page
        return redirect('/paymentmethods')->with('success', 'payment method was removed successfully');
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return redirect('/paymentmethods')->withErrors('url is not correct');
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
        return redirect('/paymentmethods')->withErrors('url is not correct');
    }
}
