<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\Http\Requests\StoreDeliveryRequest;
use App\Services\DeliveryStoreService;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
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

        return view ('admin.partials.delivery._delivery_edit_create', [

        ]);
    }

    public function store($id = null, StoreDeliveryRequest $request)
    {
        $delivery = Delivery::find($id);
        if (!$delivery) {
            $delivery = new Delivery();
        }

        (new DeliveryStoreService())->store($delivery, $request);

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
