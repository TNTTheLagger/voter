<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    // Method to determine which page to show
    public function dashboard()
    {
        $userVote = Vote::where('user_id', auth()->id())->first();

        if ($userVote) {
            // User has voted, show dashboard with statistics
            $votesForRed = Vote::where('color', 'red')->count();
            $votesForBlue = Vote::where('color', 'blue')->count();

            return view('dashboard', [
                'userVote' => $userVote,
                'votesForRed' => $votesForRed,
                'votesForBlue' => $votesForBlue,
            ]);
        }

        // User hasn't voted, redirect to voting page
        return redirect()->route('vote');
    }

    // Method to show the voting page
    public function vote()
    {
        $userVote = Vote::where('user_id', auth()->id())->first();
        if ($userVote) {
            return redirect()->route('dashboard');
        }
        return view('vote');  // Return the vote blade view
    }

    // Handle the voting form submission
    public function store(Request $request)
    {
        $data = $request->validate([
            'color' => 'required|in:blue,red',
        ]);

        // Check if the user has already voted
        if (!Vote::where('user_id', auth()->id())->exists()) {
            Vote::create([
                'user_id' => auth()->id(),
                'color' => $data['color'],
            ]);

            return redirect()->route('dashboard')->with('status', 'Vote successfully recorded.');
        }

        return redirect()->route('dashboard')->with('error', 'You have already voted!');
    }
}
