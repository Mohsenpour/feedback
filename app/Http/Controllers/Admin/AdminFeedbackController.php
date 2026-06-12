<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateFeedbackStatusRequest;
use App\Models\Feedback;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminFeedbackController extends Controller
{
    public function index(): View
    {
        $feedbacks = Feedback::query()
            ->latest()
            ->paginate(15);

        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    public function updateStatus(UpdateFeedbackStatusRequest $request, Feedback $feedback): RedirectResponse
    {
//        dd($request);
        $feedback->update($request->validated());

        return redirect()
            ->route('admin.feedbacks.index')
            ->with('success', 'Status updated successfully');
    }
}
