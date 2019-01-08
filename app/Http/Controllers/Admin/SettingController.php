<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Term;
use App\Models\Suggest;

class SettingController extends Controller
{
    public function index()
    {
        $abouts = AboutUs::all();
        return view('admin.settings.abouts.index', compact('abouts'));
    }

    public function edit()
    {
        $about = AboutUs::all()->first();
        return view('admin.settings.abouts.single', compact('about'));
    }

    public function update(Request $request)
    {
        $about = AboutUs::all()->first();
        $about->ar_text = $request->ar_text;
        $about->en_text = $request->en_text;
        $about->save();

        return redirect('admin/settings/about')->with('success', 'تم التعديل بنجاح');
    }

    public function terms()
    {
        $terms = Term::all();
        return view('admin.settings.terms.index', compact('terms'));
    }

    public function editterms()
    {
        $term = Term::all()->first();
        return view('admin.settings.terms.single', compact('term'));
    }

    public function updateterms(Request $request)
    {
        $term = Term::all()->first();
        $term->ar_text = $request->ar_text;
        $term->en_text = $request->en_text;
        $term->save();

        return redirect('admin/settings/term')->with('success', 'تم التعديل بنجاح');
    }

    public function suggestion()
    {
        $suggestions = Suggest::all();
        return view('admin.settings.suggestions.index', compact('suggestions'));
    }
}
