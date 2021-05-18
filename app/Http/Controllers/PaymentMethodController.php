<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationQuantityHelper;
use App\Http\Requests\StorePaymethodRequest;
use App\PaymentMethod;
use App\Repository\PaymentMethodRepositoryInterface;
use App\Services\PaymentMethodStoreService;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    private $paymentMethodRepository;

    public function __construct(PaymentMethodRepositoryInterface $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    /**
     * Create new or edit existing PaymentMethod
     * @param null $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
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

    /**
     * Store PaymentMethod function in controller
     * @param null $id
     * @param StorePaymethodRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store($id = null, StorePaymethodRequest $request)
    {
        $paymentMethod = PaymentMethod::find($id);

        if (!$paymentMethod) {
            $paymentMethod = new PaymentMethod();
        }

        $this->paymentMethodRepository->store($paymentMethod, $request);
        //(new PaymentMethodStoreService())->store($paymentMethod, $request);

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
