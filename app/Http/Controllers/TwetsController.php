<?php

namespace App\Http\Controllers;

use App\Models\Twet;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class TwetsController extends Controller
{
   public function index(){
    
        return view('dashboard',[
            'twets' => Twet::latest()->get()
        ]);
    }

   public function mytwets(){
     return view('mytwets',[
        'posts' => Twet::latest()->where('user_id',auth()->id())->get()
     ]);
   }

   public function show($slug){
    $twets = Twet::with('user')->where('slug',$slug)->get();
   
    $comment = Comment::with('user')->where('twets_id',$twets[0]->id)->get();
    $coment_length = count($comment);
    return view('showTwets',[
      'twets' => $twets,
      'comments' => $comment,
      'coment_length' => $coment_length,
    
    ]);
   }

   public function created(Request $request){
    $this->validate($request,[
        'content' => ['required']
    ]);
    
    // generate slug
    $user = User::where('id',auth()->id())->get();
    $url = 'twets '.$user[0]->name.' '.Str::random(5);;
    $slug = Str::slug($url, '-');
    $imageName = null;
    if($request->hasFile('image')){
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->storeAs('public/images', $imageName);
        
    }
     
  
   
    
     Twet::create([
        'user_id' => auth()->id(),
        'slug' => $slug,
        'image' => $imageName,
        'content' => $request->content,
     ]);
     
     session()->flash('success', 'Berhasil Membuat Twets....');
     return to_route('dashboard');
   }

   public function edit($id){
    
     return view('twets.edit',[
        'twets' => Twet::find($id)
     ]);
   }

   public function update(Request $request,$id){
     $request->validate([
        'content' => ['required']
     ]);

     $updated = Twet::where('id', $id)->update([
            'content' => $request->content,
        ]);
    if($updated){
        $sesion_message = 'Twets Berhasil di Update';
    }

     session()->flash('success', $sesion_message);
     return to_route('mytwets');
   }

   public function destroy($id){
    $twets = Twet::find($id);

    if(!$twets){
        session()->flash('error','Twets Gagal Di Hapus');

        return to_route('mytwets');
    }
     
    $twets->delete();
    session()->flash('success', 'Twets berhasil di Hapus');
    return to_route('mytwets');
   }

   public function coba(){
    return view('coba');
   }

   
}