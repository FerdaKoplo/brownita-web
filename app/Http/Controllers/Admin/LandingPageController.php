<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use Cache;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function landingPageIndex()
    {
        $sections = LandingPage::all()
            ->keyBy('section_key');

        return view('admin.LandingPageResource.Pages.viewLandingPage', compact('sections'));
    }

    public function landingPageUpdate(Request $request, string $section)
    {
        $request->validate([
            'content' => 'required|array',
        ]);

        LandingPage::updateOrCreate(
            ['section_key' => $section],
            ['content' => $request->input('content')]
        );
        Cache::forget('landing_sections');

        return back()->with('success', 'Section updated')->with('reloadPreview', true);

    }

    public function previewLandingPage()
    {
        $sections = LandingPage::all()
            ->keyBy('section_key')
            ->map(fn($s) => $s->content);

        return view(
            'admin.LandingPageResource.Pages.previewLandingPage',
            compact('sections')
        );
    }
}
