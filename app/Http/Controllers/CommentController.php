<?php

namespace App\Http\Controllers;

use App\Models\Twet;
use App\Models\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
   public function created($id , Request $request){
     $request->validate([
      'coment' => 'required'
     ]);
        $twet = Twet::find($id);
        // dd($request);
        Comment::create([
          'body' => $request->coment,
          'user_id' => Auth()->id(),
          'twets_id' => $id
        ]);

        return back();
   }

   public function destroy($id){
     $comment = Comment::find($id);

     $coment_balas = Comment::where('comments_id',$id)->get();

     if(!$coment_balas){
      dd($coment_balas);
     }

     $comment->delete();

     return back();
   }
}