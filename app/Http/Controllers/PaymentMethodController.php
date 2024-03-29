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
     * Display a listing of the payment method.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            //retrieve all payment methods
            $payment_methods = PaymentMethod::orderBy('title')->get();
        }
        catch(QueryException $e)
        {
            $message = 'cannot connect to database';
            $my_errors = array($message);
            return redirect('/home')->withErrors($my_errors);
        }

        //show them in the page
        return view('paymentmethods.show')->with('payment_methods', $payment_methods);
    }

    /**
     * Store a newly created payment method in storage.
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
            $my_errors = array($message);
            return redirect('/paymentmethods')->withErrors($my_errors);
        }


        //redirect to the page of payment methods
        return redirect('/paymentmethods')->with('success', $payment_method->title.' was added successfully as a payment method');
    }


    /**
     * Update the specified payment method in storage.
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
            $my_errors = array($message);
            return redirect('/paymentmethods')->withErrors($my_errors);
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
            $my_errors = array($message);
            return redirect('/paymentmethods')->withErrors($my_errors);
        }

         //redirect to the page of servicescategories
         return redirect('/paymentmethods')->with('success', 'information was edited successfully');
    }

    /**
     * Remove the specified payment method from storage.
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
            $my_errors = array($message);
            return redirect('/paymentmethods')->withErrors($my_errors);
        }

        //return to payment mehtods page
        return redirect('/paymentmethods')->with('success', 'payment method was removed successfully');
    }

    /**
     * Show the form for creating a new payment method.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }
    /**
     * Display the specified payment method.
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
     * Show the form for editing the specified payment method.
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
