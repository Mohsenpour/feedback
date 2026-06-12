<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeedbackRequest;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function create()
    {
        return view('feedback.create');
    }

    public function store(StoreFeedbackRequest $request)
    {
        Feedback::create($request->validated());

        return redirect()
            ->route('feedback.create')
            ->with('success', 'Feedback submitted successfully');
    }
}
