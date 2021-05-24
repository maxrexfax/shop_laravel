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

    public function create()
    {
        return view('admin.partials.paymethod._paymethod_edit_create');
    }

    public function edit($id = null)
    {
        if($id == null) {
            return redirect('admin/paymethod/list');
        }

        $paymentMethod = $this->paymentMethodRepository->findById($id);

        if ($paymentMethod) {
            return view('admin.partials.paymethod._paymethod_edit_create', [
                'paymentMethod' => $paymentMethod,
            ]);
        }

        return redirect('admin/paymethod/list');
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

    public function destroy($id)
    {
        $paymentMethod = $this->paymentMethodRepository->findById($id);

        if ($paymentMethod) {
            $this->paymentMethodRepository->destroy($id);
        }

        return redirect('/admin/paymethod/list');
    }

}
