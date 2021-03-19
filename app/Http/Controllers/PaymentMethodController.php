<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationQuantityHelper;
use App\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function create($id = null)
    {
        if (!empty($id)) {
            $paymentMethod = PaymentMethod::find($id);
            if ($paymentMethod) {
                return view('admin.partials.paymethod._paymethod_edit_create', [
                    'paymentMethod' => $paymentMethod,
                ]);
            }

            return redirect('admin/category/list');
        }

        return view('admin.partials.paymethod._paymethod_edit_create');
    }

    public function store($id = null, Request $request)
    {
        $paymentMethod = PaymentMethod::find($id);

        if (!$paymentMethod) {
            $paymentMethod = new PaymentMethod();
        }

        $paymentMethod->pm_name = $request->post('pm_name');
        $paymentMethod->other_data = $request->post('other_data');
        $paymentMethod->save();

        return redirect('/admin/paymethod/list');
    }

}
