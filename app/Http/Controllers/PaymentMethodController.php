<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationQuantityHelper;
use App\Http\Requests\StorePaymethodRequest;
use App\PaymentMethod;
use App\Services\PaymentMethodStoreService;
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

    public function store($id = null, StorePaymethodRequest $request)
    {
        $paymentMethod = PaymentMethod::find($id);

        if (!$paymentMethod) {
            $paymentMethod = new PaymentMethod();
        }

        (new PaymentMethodStoreService())->store($paymentMethod, $request);

        return redirect('/admin/paymethod/list');
    }

    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::find($id);
        if ($paymentMethod) {
            $paymentMethod->delete();
        }

        return redirect('/admin/paymethod/list');
    }

}
