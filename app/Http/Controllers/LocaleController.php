<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocaleRequest;
use App\Locale;
use App\Services\LocaleStoreService;

class LocaleController extends Controller
{
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

    public function store($id = null, StoreLocaleRequest $request)
    {
        $locale = Locale::find($id);

        if (!$locale) {
            $locale = new Locale();
        }

        (new LocaleStoreService())->storeLocale($locale, $request);

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
