<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\Http\Requests\StoreDeliveryRequest;
use App\Repository\DeliveryRepositoryInterface;
use App\Services\DeliveryStoreService;

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

    public function edit($id = null)
    {
        if($id == null) {
            return redirect('admin/deliveries/list');
        }

        return view ('admin.partials.delivery._delivery_edit_create', [
            'delivery' => $this->deliveryRepository->findById($id),
        ]);
    }

    public function update($id = null, StoreDeliveryRequest $request)
    {
        $delivery = $this->deliveryRepository->findById($id);

        $this->deliveryRepository->store($request, $delivery);

        return redirect('admin/deliveries/list');
    }

    public function store(StoreDeliveryRequest $request)
    {
        $delivery = new Delivery();

        $this->deliveryRepository->store($request, $delivery);

        return redirect('/admin/deliveries/list');
    }

    public function destroy($id)
    {
        $delivery = Delivery::find($id);

        if ($delivery) {
            $delivery->delete();
        }

        return redirect('/admin/deliveries/list');
    }
}
