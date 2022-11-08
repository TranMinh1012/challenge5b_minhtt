<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '<>', Auth::user()->id)->orderByDesc('id')->get();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $request->image->storeAs('/public/images/avatars', $request->image->getClientOriginalName());
                User::create([
                    'username' => $request->username,
                    'phone' => $request->phone,
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'avatar' => '/storage/images/avatars/' . $request->image->getClientOriginalName(),
                    'role' => 1
                ]);
            }
        }

        return redirect()->route('user.list')->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $messages = Message::where([['sender_id', Auth::user()->id], ['receiver_id', $id]])->orderByDesc('id')->get();

        return view('users.show', compact('user', 'messages', 'id'));
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
        
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $request->image->storeAs('/public/images/avatars', $request->image->getClientOriginalName());
                $user->avatar = '/storage/images/avatars/' . $request->image->getClientOriginalName();
            }
        }
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $user->password == $request->password ? $request->password : bcrypt($request->password);
        $user->role = 1;
        $user->save();

        return redirect()->route('user.list')->with('success', 'Cập nhật thành công');
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
        $user->delete();

        return redirect()->back()->with('success','Xóa thành công.');
    }

    public function addMsg(Request $request, $id)
    {
        Message::create([
            'receiver_id' => $id,
            'sender_id' => Auth::user()->id,
            'msg' => $request->message
        ]);

        return redirect()->back()->with('success','Gửi thành công.');
    }

    public function deleteMsg($id)
    {
        Message::find($id)->delete();

        return redirect()->back()->with('success','Xóa thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile($id)
    {
        $user = User::find($id);
        
        return view('users.update-profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $request->image->storeAs('/public/images/avatars', $request->image->getClientOriginalName());
                $user->avatar = '/storage/images/avatars/' . $request->image->getClientOriginalName();
            }
        }
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $user->password == $request->password ? $request->password : bcrypt($request->password);
        $user->avatar = '/storage/images/avatars/' . $request->image->getClientOriginalName();
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thành công');
    }

    public function showProfile($id)
    {
        $user = User::find($id);
        $messages = Message::where('receiver_id', $id)->orderByDesc('id')->get();

        return view('users.profile', compact('user', 'messages', 'id'));
    }
}
