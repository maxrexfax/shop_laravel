<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditPromocodeRequest;
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

    public function create()
    {
        return view('admin.partials.promocode._promocode_edit_create');
    }

    public function edit(EditPromocodeRequest $request)
    {
        return view('admin.partials.promocode._promocode_edit_create', [
            'promocode' => $this->promocodeRepository->findById($request->get('id')),
        ]);
    }

    public function store(StorePromocodeRequest $request)
    {
        $this->promocodeRepository->store($request);

        return redirect('/admin/promocodes/list');
    }

    public function update(StorePromocodeRequest $request)
    {
        $this->promocodeRepository->store($request);

        return redirect('/admin/promocodes/list');
    }

    public function delete($id)
    {
        $promocode = $this->promocodeRepository->findById($id);

        if ($promocode) {
            $this->promocodeRepository->destroy($id);
        }

        return redirect()->back();
    }
}
