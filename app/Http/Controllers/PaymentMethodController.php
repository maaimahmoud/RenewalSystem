<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\PaymentMethod;


class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //retrieve all payment methods 
        $payment_methods = PaymentMethod::all();

        //show them in the page
        return view('paymentmethods.index')->with('payment_methods', $payment_methods);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //just go to create payment method page
        return view('paymentmethods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create new payment method
        $payment_method = new PaymentMethod;

        //store the information from the input  
        $payment_method->title = $request->input('title');
        $payment_method->days = $request->input('days');

        try
        {
            //save the payment method in the data base
            $payment_method->save();
        }
        catch (QueryException $e)
        {
            $message = "please check that the information is valid";
        } 
        

        //redirect to the page of payment methods
        return redirect('/paymentmethods');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get a specific payment method with id
        $payment_method = PaymentMethod::find($id);

        //show the view of the payment method
        return view('paymentmethods.show')->with('payment_method', $payment_method);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get the payment method with a specific id
        $payment_method = PaymentMethod::find($id);

        //go to the edit payment method page
        return view('paymentmethods.edit')->with('payment_method', $payment_method);
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
        //get the specific payment method
        $payment_method = PaymentMethod::find($id);

        //update the info from the input request
        $payment_method->title = $request->input('title');
        $payment_method->days = $request->input('days');

        try
        {
            //save the payment method in the data base
            $payment_method->save();
        }
        catch (QueryException $e)
        {
            $message = "please check that the information is valid";
        }

        //return to the show page of this payment mehod
        return view('paymentmethods.show')->with('payment_method', $payment_method);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get the specific payment method
        $payment_method = PaymentMethod::find($id);

        //remove the payment method
        $payment_method->delete();

        //return to payment mehtods page
        return redirect('/paymentmethods');
    }
}
