<?php

namespace App\Http\Controllers\Admins;

<<<<<<< Updated upstream
use App\Models\Comments;
=======
use App\Models\Comment;
>>>>>>> Stashed changes
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
<<<<<<< Updated upstream
        $listBinhLuan = Comments::with('product')->get();
      
=======
        $listBinhLuan = Comment::get();

>>>>>>> Stashed changes
        return view('admins.comments.index',compact('listBinhLuan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
<<<<<<< Updated upstream
        $binh_luan = Comments::findOrFail($id);
=======
        $binh_luan = Comment::findOrFail($id);
>>>>>>> Stashed changes

        if ($binh_luan) {
            # code...
            $binh_luan->delete();
            return redirect()->route('comment.index');
        }
    }
<<<<<<< Updated upstream
}
=======
}
>>>>>>> Stashed changes
