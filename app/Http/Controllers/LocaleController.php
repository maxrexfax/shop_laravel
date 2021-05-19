<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocaleRequest;
use App\Locale;
use App\Repository\LocaleRepositoryInterface;
use App\Services\LocaleStoreService;

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

    public function edit($id = null)
    {
        if($id == null) {
            return redirect('admin/locales/list');
        }

        return view('admin.partials.locale._locale_edit_create', [
            'locale' => $this->localeRepository->findById($id),
        ]);
    }

    public function update($id = null, StoreLocaleRequest $request)
    {
        $locale = $this->localeRepository->findById($id);

        if($locale) {
            $this->localeRepository->storeLocale($request, $locale);
        }

        return redirect('admin/locales/list');
    }

    public function store(StoreLocaleRequest $request)
    {
        $locale = new Locale();

        $this->localeRepository->storeLocale($request, $locale);

        return redirect('/admin/locales/list');
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
