<?php

namespace App\Http\Controllers\Front;

use App\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\InventoryRequest;
use Illuminate\Support\Facades\Session;

class InventoryController extends Controller
{
    public function index()
    {
        $products = Inventory::paginate(10);
        return view('front.inventory.index', compact('products'));
    }

    public function drugInfo(Inventory $drug)
    {
        return $drug;
    }

    public function store(InventoryRequest $request)
    {
        $inventory_add = Inventory::create($request->all());

        if($inventory_add) {
            Session::flash('message', 'Product Successfully Added');

            Toastr::success('', 'Product Successfully Added');

            return redirect()->back()->with('success', 'Product Successfully Added');
        }
        return redirect()->back()->with('error', 'Product Successfully Added');
    }

    public function update(InventoryRequest $request, $inventory_id)
    {
        $inventory_update = Inventory::whereId($inventory_id)->update($request->except('_token'));

        if($inventory_update) {
            Session::flash('message', 'Product Successfully Updated');

            Toastr::success('', 'Product Successfully Updated');

            return redirect()->back()->with('success', 'Product Successfully Updated');
        }
        return redirect()->back()->with('error', 'Product Successfully Updated');
    }

    public function destroy(Inventory $product)
    {

        $product->delete();

        Session::flash('message', 'Product Deleted Successfully');

        Toastr::success('', 'Product Deleted Successfully');

        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }
}
