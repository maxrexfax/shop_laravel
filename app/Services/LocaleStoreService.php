<?php

namespace App\Services;

class LocaleStoreService
{
    public function storeLocale($locale, $request)
    {
        $logo = null;

        if ($locale->locale_logo) {
            $logo = $locale->locale_logo;
        }

        $locale->fill($request->post());

        if ($request->has('locale_logo')) {
            $image = $request->file('locale_logo');
            $locale->locale_logo = $image->getClientOriginalName();
            $image->move(public_path('img/logo'), $image->getClientOriginalName());
        } else {
            $locale->locale_logo = $logo;
        }

        $locale->save();
    }
}
