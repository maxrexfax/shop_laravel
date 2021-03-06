<?php

namespace App\Repository\Eloquent;

use App\Locale;
use App\Repository\LocaleRepositoryInterface;

class LocaleRepository extends BaseRepository implements LocaleRepositoryInterface
{
    protected $model;

    public function __construct(Locale $model)
    {
        $this->model = $model;
    }

    public function paginateModel(int $numberToShow)
    {
        return Locale::paginate($numberToShow);
    }

    public function storeLocale($request)
    {
        $logo = null;
        $locale = $this->model->find($request->post('id'));

        if (empty($locale)) {
            $locale = new Locale();
        }

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
