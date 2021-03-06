<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\Http\Requests\EditDeliveryRequest;
use App\Http\Requests\StoreDeliveryRequest;
use App\Repository\DeliveryRepositoryInterface;
use App\Services\DeliveryStoreService;
use Illuminate\Database\Eloquent\Model;

class DeliveryController extends Controller
{
    protected $deliveryRepository;

    public function __construct(DeliveryRepositoryInterface $deliveryRepository)
    {
        $this->deliveryRepository = $deliveryRepository;
    }

    public function create()
    {
        return view ('admin.partials.delivery._delivery_edit_create');
    }

    public function edit(EditDeliveryRequest $request)
    {
        return view ('admin.partials.delivery._delivery_edit_create', [
            'delivery' => $this->deliveryRepository->findById($request->get('id')),
        ]);
    }

    public function store(StoreDeliveryRequest $request)
    {
        $this->deliveryRepository->store($request);

        return redirect('/admin/deliveries/list');
    }

    public function update(StoreDeliveryRequest $request)
    {
        $this->deliveryRepository->store($request);

        return redirect('admin/deliveries/list');
    }

    public function destroy(EditDeliveryRequest $request)
    {
        $this->deliveryRepository->destroy($request->get('id'));

        return redirect('/admin/deliveries/list');
    }
}
