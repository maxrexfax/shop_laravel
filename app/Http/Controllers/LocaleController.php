<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditLocaleRequest;
use App\Http\Requests\StoreLocaleRequest;
use App\Locale;
use App\Repository\LocaleRepositoryInterface;
use App\Services\LocaleStoreService;
use Illuminate\Database\Eloquent\Model;

class LocaleController extends Controller
{
    protected $localeRepository;

    public function __construct(LocaleRepositoryInterface $localeRepository)
    {
        $this->localeRepository = $localeRepository;
    }

    public function create()
    {
        return view('admin.partials.locale._locale_edit_create');
    }

    public function edit(EditLocaleRequest $request)
    {
        return view('admin.partials.locale._locale_edit_create', [
            'locale' => $this->localeRepository->findById($request->get('id')),
        ]);
    }

    public function store(StoreLocaleRequest $request)
    {
        $this->localeRepository->storeLocale($request);

        return redirect('/admin/locales/list');
    }

    public function update(StoreLocaleRequest $request)
    {
        $this->localeRepository->storeLocale($request);

        return redirect('admin/locales/list');
    }

    public function destroy($id)
    {
        $locale = $this->localeRepository->findById($id);

        if ($locale) {
            $this->localeRepository->destroy($id);
        }

        return redirect('/admin/locales/list');
    }
}
