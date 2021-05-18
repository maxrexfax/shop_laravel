<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromocodeRequest;
use App\Promocode;
use App\Repository\PromocodeRepositoryInterface;

class PromocodeController extends Controller
{
    private $promocodeRepository;

    public function __construct(PromocodeRepositoryInterface $promocodeRepository)
    {
        $this->promocodeRepository = $promocodeRepository;
    }
    /**
     * Create new or edit existing Promocode
     * @param null $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
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

    /**
     * Store Promocode function in controller
     * @param null $id
     * @param StorePromocodeRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store($id = null, StorePromocodeRequest $request)
    {
        $promocode = Promocode::find($id);

        if (!$promocode) {
            $promocode = new Promocode();
        }

        $this->promocodeRepository->store($promocode, $request);
        //(new PromocodeStoreService())->store($promocode, $request);

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
