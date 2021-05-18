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

    /**
     * Create new or edit existing Locale
     * @param null $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create($id = null)
    {
        if (!empty($id)) {
            $locale = Locale::find($id);
            if ($locale) {
                return view('admin.partials.locale._locale_edit_create', [
                    'locale' => $locale,
                ]);
            }

            return redirect('/admin/locales/list');
        }

        return view('admin.partials.locale._locale_edit_create');
    }

    /**
     * Store Locale function in controller
     * @param null $id
     * @param StoreLocaleRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store($id = null, StoreLocaleRequest $request)
    {
        $locale = Locale::find($id);

        if (!$locale) {
            $locale = new Locale();
        }
        $this->localeRepository->storeLocale($locale, $request);
        //(new LocaleStoreService())->storeLocale($locale, $request);

        return redirect('/admin/locales/list');
    }


    public function destroy($id)
    {
        $locale = Locale::find($id);

        if ($locale) {
            $locale->delete();
        }

        return redirect('/admin/locales/list');
    }
}
