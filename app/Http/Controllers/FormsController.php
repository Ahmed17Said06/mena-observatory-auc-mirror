<?php

namespace App\Http\Controllers;

use App\Models\static_content;
use App\Models\SubmittedEvent;
use App\Models\SubmittedWork;
use App\Models\WorkTogether;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class FormsController extends Controller
{
    public function workTogetherView()
    {
        return view('frontend.work_together')->with([
            'intro' => static_content::where('key', 'Contact Us Intro')->first(),
        ]);
    }

    public function submitYourWorkView()
    {
        return view('frontend.submit_your_work')->with([
            'intro' => static_content::where('key', 'Contact Us Intro')->first(),
        ]);
    }

    public function submitEventView()
    {
        return view('frontend.submit_an_event')->with([
            'intro' => static_content::where('key', 'Contact Us Intro')->first(),
        ]);
    }
    public function submitEvent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tel' => 'required|string|max:20',
            'bio' => 'required|string',
            'event_description' => 'required|string',
            'event_day' => 'required|date_format:Y-m-d\TH:i',
            'event_link' => 'required|url',
            'supporting_material' => 'file|mimes:pdf,docx,doc,ppt,pptx|max:4096',
        ]);

        $supportingMaterialPath = null;

        if ($request->hasFile('supporting_material')) {
            $supportingMaterialPath = $this->storeFileAsFormsDisk($request->file('supporting_material'));
        }

        SubmittedEvent::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('tel'),
            'bio' => $request->input('bio'),
            'event_description' => $request->input('event_description'),
            'event_day' => $request->input('event_day'),
            'event_link' => $request->input('event_link'),
            'supported_material_link' => $supportingMaterialPath,
        ]);

        return redirect()->back()->with('success', 'Your event has been submitted successfully.');
    }

    public function workTogether(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'bio' => 'required|string',
            'cv_link' => 'required|file|mimes:pdf,docx,doc,ppt,pptx|max:4096',
            'collaboration_link' => 'required|file|mimes:pdf,docx,doc,ppt,pptx|max:4096',
        ]);


        $cvLinkPath = $this->storeFileAsFormsDisk($request->file('cv_link'));
        $collaborationLinkPath = $this->storeFileAsFormsDisk($request->file('collaboration_link'));

        WorkTogether::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'bio' => $request->input('bio'),
            'cv_link' => $cvLinkPath,
            'collaboration_link' => $collaborationLinkPath,
        ]);

        return redirect()->back()->with('success', 'Your request has been submitted successfully.');
    }

    public function submitWork(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'bio' => 'required|string',
            'cv_uploads' => 'required|file|mimes:pdf,docx,doc,ppt,pptx|max:4096',
            'project_brief_uploads' => 'required|file|mimes:pdf,docx,doc,ppt,pptx|max:4096',
        ]);

        $cvLinkPath = $this->storeFileAsFormsDisk($request->file('cv_uploads'));
        $projectsLinkPath = $this->storeFileAsFormsDisk($request->file('project_brief_uploads'));

        SubmittedWork::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'bio' => $request->input('bio'),
            'cv_link' => $cvLinkPath,
            'projects_link' => $projectsLinkPath,
        ]);

        return redirect()->back()->with('success', 'Your work has been submitted successfully.');
    }

    private function storeFileAsFormsDisk(UploadedFile $file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('forms', $fileName, 'public');
    }
}
