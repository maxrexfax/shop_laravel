<?php

namespace App\Http\Controllers;

use App\Delivery;
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

    public function edit($id = null)
    {
        if($id == null) {
            return redirect('admin/deliveries/list');
        }

        return view ('admin.partials.delivery._delivery_edit_create', [
            'delivery' => $this->deliveryRepository->findById($id),
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

    public function destroy($id)
    {
        $delivery = $this->deliveryRepository->findById($id);

        if ($delivery) {
            $this->deliveryRepository->destroy($id);
        }

        return redirect('/admin/deliveries/list');
    }
}
