<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationQuantityHelper;
use App\Http\Requests\EditPayMethodRequest;
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

    public function create()
    {
        return view('admin.partials.paymethod._paymethod_edit_create');
    }

    public function edit(EditPayMethodRequest $request)
    {
        return view('admin.partials.paymethod._paymethod_edit_create', [
            'paymentMethod' => $this->paymentMethodRepository->findById($request->get('id')),
        ]);
    }

    public function store(StorePaymethodRequest $request)
    {
        $this->paymentMethodRepository->store($request);

        return redirect('/admin/paymethod/list');
    }

    public function update(StorePaymethodRequest $request)
    {
        $this->paymentMethodRepository->store($request);

        return redirect('admin/paymethod/list');
    }

    public function destroy(EditPayMethodRequest $request)
    {
        $this->paymentMethodRepository->destroy($request->get('id'));

        return redirect('/admin/paymethod/list');
    }

}
