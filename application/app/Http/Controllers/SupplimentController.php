<?php

namespace App\Http\Controllers;

use App\Suppliment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SupplimentRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class SupplimentController extends Controller
{
    public function index()
    {
        $products = Suppliment::paginate(10);
        return view('front.suppliments.index', compact('products'));
    }

    public function foodInfo(Suppliment $suppliment)
    {
        return $suppliment;
    }

    public function store(SupplimentRequest $request)
    {
        $suppliment_add = Suppliment::create($request->all());

        if($suppliment_add) {
            Session::flash('message', 'Suppliment Successfully Added');

            Toastr::success('', 'Suppliment Successfully Added');

            return redirect()->back()->with('success', 'Suppliment Successfully Added');
        }
        return redirect()->back()->with('error', 'Suppliment Successfully Added');
    }

    public function update(SupplimentRequest $request, $suppliment_id)
    {
        $suppliment_update = Suppliment::whereId($suppliment_id)->update($request->except('_token'));

        if($suppliment_update) {
            Session::flash('message', 'Suppliment Successfully Updated');

            Toastr::success('', 'Suppliment Successfully Updated');
            
            return redirect()->back()->with('success', 'Suppliment Successfully Updated');
        }
        return redirect()->back()->with('error', 'Suppliment Successfully Updated');
    }

    public function destroy(Suppliment $product)
    {

        $product->delete();

        Session::flash('message', 'Suppliment Deleted Successfully');

        Toastr::success('', 'Suppliment Deleted Successfully');

        return redirect()->back()->with('success', 'Suppliment Deleted Successfully');
    }
}
