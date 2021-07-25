<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Properties;
use App\Models\Customer;
use App\Models\Owner;
use App\Models\Property_type;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::with(['owner','apartment','customer'])->get();
//        dd($transactions);
        return view('dashboard.transaction.index',compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $owners = Owner::all();
        $apartments = Property_type::all();
        $customers = Customer::all();
        return view('dashboard.transaction.create',compact('owners','apartments','customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Transaction::create($request->all());

        session()->flash('success','Add Successfully');
        return redirect()->route('dashboard.transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        // dd($transaction);

        $owners = Owner::all();
        $apartments = Properties::all();
        $customers = Customer::all();
        return view('dashboard.transaction.edit',compact('transaction','owners','apartments','customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $transaction->update($request->all());

        session()->flash('success','update Successfully');
        return redirect()->route('dashboard.transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $Transaction = Transaction::findOrFail($id);
            $Transaction->delete();

            session()->flash('success','Data Trashed Successfully');
            return redirect()->route('dashboard.transaction.index');

        } catch (\Throwable $th) {
            return redirect()->route('dashboard.transaction.index')->with('error', 'Something went wrong!');
        }
    }
}
