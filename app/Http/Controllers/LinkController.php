<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LinkController extends Controller
{
    /**
     * @param string $code
     *
     * @return Application|Factory|View
     * @author chaos
     */
    public function show(string $code)
    {
        $link = Link::where('code', $code)->first();
        return view('web.link.show', ['link' => $link]);
    }

    /**
     * @param Request $request
     *
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     * @author chaos
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'link'         => 'required|url|unique:links',
            'code'         => 'string|min:8|max:128|nullable|unique:links',
            'expired_date' => 'required|date_format:"d.m.Y, H:i"',
        ]);
        $data = $request->all();
        if ($data['code'] === null) {
            $data['code'] = Str::substr(md5($data['link'] . random_int(4, 8)), 0, 16);
        } else {
            $data['code'] = Str::slug($data['code'], '-', 'ua');
        }
        $data['expired_date'] = Carbon::createFromFormat('d.m.Y, H:i', $data['expired_date'])
            ->format('Y-m-d H:i:s');
        $link = Link::create($data);
        return redirect(route('link-show', $link->code))->with('status', 'Ваше коротке посилання створено.');
    }

    /**
     * @param string $code
     *
     * @return Application|Factory|View|RedirectResponse|Redirector
     * @author chaos
     */
    public function visit(string $code)
    {
        /** @var Link $link */
        $link = Link::where('code', $code)->first();
        if ($link) {
            if ($link->expired_date->gte(Carbon::now())) {
                $link->increment('visited');
                return redirect($link->link);
            }

            $link->delete();
        }
        return view('web.link.visit');
    }
}
