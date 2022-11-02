<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Medication;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inventory;
use App\Suppliment;
use App\SupplimentOrder;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index(Patient $patient_id, Request $request)
    {
        $checkin_id = $request->checkin_id;
        $clinic_id = session()->get('clinic_id');
        $all_orders = Medication::where('patient_id', $patient_id->id)->where('clinic_id', $clinic_id)->with('drug')->orderBy('id', 'DESC')->paginate(10);
        $pending_orders = Medication::where('patient_id', $patient_id->id)->where('clinic_id', $clinic_id)->where('status', 0)->with('drug')->orderBy('id', 'DESC')->paginate(10);
        $confirm_orders = Medication::where('patient_id', $patient_id->id)->where('clinic_id', $clinic_id)->where('status', 1)->with('drug')->orderBy('id', 'DESC')->paginate(10);
        return view('front.order.index', compact('patient_id', 'all_orders', 'pending_orders', 'confirm_orders', 'checkin_id'));
    }

    public function update($order_id, Request $request)
    {
        $status = $request->store_type == 'Confirmed' ? 1 : 2;
        if($status == 1) {
                $drug = Inventory::where('id', $request->drug_id)->first();
                if($drug->qty < $request->drug_qty) {
                    $order_update = Medication::whereId($order_id)->update(['status' => 2]);
                    Session::flash('message', 'Order cancel for insufficient medicine!');

                    Toastr::success('', 'Order cancel for insufficient medicine!');

                    return redirect()->back()->with('success', 'Order cancel for insufficient medicine!');
                }
                else {
                    $new_qty = $drug->qty - $request->drug_qty;
                    Inventory::whereId($drug->id)->update(['qty' => $new_qty]);
                }
        }
        $order_update = Medication::whereId($order_id)->update(['status' => $status]);

        if($order_update) {
            Session::flash('message', 'Order Successfully Upated');

            Toastr::success('', 'Order Successfully Updated');

            return redirect()->back()->with('success', 'Order Successfully Updated');
        }
        return redirect()->back()->with('error', 'Order Not Updated');
    }

    public function supplimentOrdersShow(Patient $patient_id, Request $request)
    {
        $checkin_id = $request->checkin_id;
        $clinic_id = session()->get('clinic_id');
        $all_orders = SupplimentOrder::where('patient_id', $patient_id->id)->where('clinic_id', $clinic_id)->with('suppliment')->orderBy('id', 'DESC')->paginate(10);
        $pending_orders = SupplimentOrder::where('patient_id', $patient_id->id)->where('clinic_id', $clinic_id)->where('status', 0)->with('suppliment')->orderBy('id', 'DESC')->paginate(10);
        $confirm_orders = SupplimentOrder::where('patient_id', $patient_id->id)->where('clinic_id', $clinic_id)->where('status', 1)->with('suppliment')->orderBy('id', 'DESC')->paginate(10);
        return view('front.order.suppliment.index', compact('patient_id', 'all_orders', 'pending_orders', 'confirm_orders', 'checkin_id'));
    }

    public function supplimentOrderUpdate($order_id, Request $request)
    {
        $status = $request->store_type == 'Confirmed' ? 1 : 2;
        if($status == 1) {
                $suppliment = Suppliment::where('id', $request->suppliment_id)->first();
                if($suppliment->qty < $request->suppliment_qty) {
                    $order_update = SupplimentOrder::whereId($order_id)->update(['status' => 2]);
                    Session::flash('message', 'Order cancel for insufficient medicine!');

                    Toastr::success('', 'Order cancel for insufficient medicine!');

                    return redirect()->back()->with('success', 'Order cancel for insufficient medicine!');
                }
                else {
                    $new_qty = $suppliment->qty - $request->suppliment_qty;
                    Suppliment::whereId($suppliment->id)->update(['qty' => $new_qty]);
                }
        }
        $order_update = SupplimentOrder::whereId($order_id)->update(['status' => $status]);

        if($order_update) {
            Session::flash('message', 'Order Successfully Upated');

            Toastr::success('', 'Order Successfully Updated');

            return redirect()->back()->with('success', 'Order Successfully Updated');
        }
        return redirect()->back()->with('error', 'Order Not Updated');
    }
}
