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

    /**
     * Create new or edit existing Delivery
     * @param null $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create($id = null)
    {
        if (!empty($id)) {
            $delivery = Delivery::find($id);
            if ($delivery) {
                return view ('admin.partials.delivery._delivery_edit_create', [
                    'delivery' => $delivery,
                ]);
            }

            return redirect('/admin/deliveries/list');
        }

        return view ('admin.partials.delivery._delivery_edit_create');
    }

    /**
     * Store Delivery function in controller
     * @param null $id
     * @param StoreDeliveryRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store($id = null, StoreDeliveryRequest $request)
    {
        $delivery = Delivery::find($id);
        if (!$delivery) {
            $delivery = new Delivery();
        }

        $this->deliveryRepository->store($delivery, $request);
        //(new DeliveryStoreService())->store($delivery, $request);

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
