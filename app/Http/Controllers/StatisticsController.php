<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class StatisticsController extends Controller
{
    /**
     * @return Application|Factory|View
     * @author chaos
     */
    public function index()
    {
        return view('web.statistics.index');
    }

    /**
     * @param Request $request
     *
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     * @author chaos
     */
    public function get(Request $request)
    {
        $this->validate($request, [
            'q' => 'required|string|min:16|max:256',
        ]);
        $code = Str::of($request->q)->replace(env('APP_URL'), '')->ltrim('/');
        $link = Link::where('link', $request->q)
            ->orWhere('code', $code)
            ->first();
        if ($link) {
            return redirect(route('statistics-show', $link));
        }
        return redirect(route('statistics-index'))->with('error', 'Такого посилання не знайдено!');
    }

    /**
     * @param string $code
     *
     * @return Application|Factory|View
     * @author chaos
     */
    public function show(string $code)
    {
        /** @var Link $link */
        $link = Link::where('code', $code)->firstOrFail();
        return view('web.statistics.show', ['link' => $link]);
    }
}
