<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromocodeRequest;
use App\Promocode;
use App\Services\PromocodeStoreService;
use Illuminate\Http\Request;

class PromocodeController extends Controller
{
    public function create($id = null)
    {
        if ($id) {
            $promocode = Promocode::find($id);
            if ($promocode) {
                return view('admin.partials.promocode._promocode_edit_create', [
                    'promocode' => $promocode,
                ]);
            }
            return redirect('/admin/promocodes/list');
        }

        return view('admin.partials.promocode._promocode_edit_create');
    }

    public function store($id = null, StorePromocodeRequest $request)
    {
        $promocode = Promocode::find($id);

        if (!$promocode) {
            $promocode = new Promocode();
        }

        (new PromocodeStoreService())->store($promocode, $request);

        return redirect('/admin/promocodes/list');
    }

    public function delete($id)
    {
        $promocode = Promocode::find($id);
        if ($promocode) {
            $promocode->delete();
        }

        return redirect()->back();
    }
}
