<?php
namespace App\Http\Controllers;
use App\Models\Comment; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class CommentController extends Controller
{
    /**
     * Display a listing of the comments for a trip.
     */
    public function index(Request $request)
    {
        $trip_id = $request->input('trip_id');
        $comments = Comment::where('trip_id', $trip_id)->with('user')->latest()->get();
        return response()->json($comments);
    }

    /**
     * Show the form for creating a new comment.
     */
    public function create()
    {
        // Not usually needed for API, but you can return a view if using Blade
        return view('comments.create');
    }

    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'trip_id' => 'required|exists:trips,id',
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'trip_id' => $request->trip_id,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Comment added!');
    }

    /**
     * Display the specified comment.
     */
    public function show($id)
    {
        $comment = Comment::with('user')->findOrFail($id);
        return view('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified comment.
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        // Optionally check if the user is authorized to edit
        if (Auth::id() !== $comment->user_id) {
            abort(403);
        }
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        if (Auth::id() !== $comment->user_id) {
            abort(403);
        }
        $request->validate([
            'content' => 'required|string',
        ]);
        $comment->update([
            'content' => $request->content,
        ]);
        return redirect()->back()->with('success', 'Comment updated!');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if (Auth::id() !== $comment->user_id) {
            abort(403);
        }
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted!');
    }
}