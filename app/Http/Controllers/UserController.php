<?php

namespace App\Http\Controllers;

use App\Mail\RegMail;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',
            ['except' => ['index', 'create', 'store', 'show', 'confirmEmailToken']]);
        $this->middleware('guest', [
            'only' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:5|confirmed',
        ]);
        $data['password'] = bcrypt($data['password']);
        //添加用户
        $user = User::create($data);
        \Mail::to($user)->send(new RegMail($user));
        session()->flash('success', '请查看邮箱完成验证');
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $blogs = $user->blogs()->paginate(5);
        if (\Auth::check()) {
            $followTitle = $user->isFollow(\Auth::user()->id) ? '取关' : '关注';
        }else
        {
            $followTitle = '';
        }
        return view('user.show', compact('user', 'blogs', 'followTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'password' => 'nullable|min:5|confirmed'
        ]);
        $user->name = $request->name;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        session()->flash('success', '密码修改成功');
        return redirect()->route('user.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        session()->flash('success', '删除成功');
        return redirect()->route('user.index');
    }

    public function confirmEmailToken($token)
    {
        $user = User::where('email_token', $token)->first();
        if ($user) {
            $user->email_active = true;
            $user->save();
            \Auth::login($user);
            session()->flash('success', '验证成功');
            return redirect('/');
        }
        session()->flash('danger', '邮箱验证失败');
        return redirect('/');
    }

    public function follow(User $user)
    {
        $user->followToggle(\Auth::user()->id);
        return back();
    }
}
