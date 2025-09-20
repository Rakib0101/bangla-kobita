<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AddaController extends Controller
{
    /**
     * Display the adda (group chat) page
     */
    public function index(): View
    {
        $messages = Message::with('user')
            ->orderBy('created_at', 'asc')
            ->paginate(50);
            
        return view('adda.index', compact('messages'));
    }

    /**
     * Store a new message
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message_bangla' => 'required|string|max:1000',
            'message_english' => 'nullable|string|max:1000',
        ]);

        Message::create([
            'user_id' => Auth::id(),
            'message_bangla' => $validated['message_bangla'],
            'message_english' => $validated['message_english'] ?? null,
            'message_type' => 'text',
        ]);

        return redirect()->route('adda.index')
            ->with('success', 'বার্তা পাঠানো হয়েছে।');
    }

}
