<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use JD\Cloudder\Facades\Cloudder;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        $posts = Post::where('user_id', $user->id)->paginate(20);

        return view('users.show',compact('user','posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if(Auth::id() !== $user->id){
            return abort(404);
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = new User();

        $user->image = $request->image;

        $user = User::find($id);

        $user_id = Auth::id();

        // $user = User::find($id); // ユーザを取得
        // $posts = $user->posts()->get(); // ユーザが持つ投稿一覧を取得

        if(Auth::id() !== $user->id){
            return abort(404);
        }
        if ($image = $request->file('image')) {
            $image_path = $image->getRealPath();
            Cloudder::upload($image_path, null);
            //直前にアップロードされた画像のpublicIdを取得する。
            $publicId = Cloudder::getPublicId();
            $logoUrl = Cloudder::secureShow($publicId, [
                'width'     => 200,
                'height'    => 200,
            ]);
            $user->image_path = $logoUrl;
            $user->public_id  = $publicId;
        }

        $user->save();
        $user->update($request->all());

        $posts = Post::where('user_id', $user->id)->paginate(20);

        return redirect()->route('users.show', compact('user', 'posts'))->with('success_message', 'ユーザー情報が変更されました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if(Auth::id() !== $user->id){
            return abort(404);
        }

        if(isset($user->public_id)){
            Cloudder::destroyImage($user->public_id);
        }

        $user -> delete();

        return redirect()->route('users.show');
    }

    public function like($id)
    {
        $user = Auth::user();
        // $user = User::find($id); // ユーザを取得
        // $posts = $user->posts()->get(); // ユーザが持つ投稿一覧を取得

        return view('likes.show',compact('user'));
    }
}
