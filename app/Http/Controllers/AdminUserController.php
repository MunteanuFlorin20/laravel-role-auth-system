<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Page;

class AdminUserController extends Controller
{
    public $folder = 'admin/users'; 
    public $link = '/admin/users';
    public $pags = 25; 

    public function index() 
    {
        return view($this->folder.'.index')
                ->with('items', User::orderBy('email')->paginate($this->pags))
                ->with('folder', $this->folder)
                ->with('link', $this->link);
    }

    public function create()
    {
        return view($this->folder.'.create')
                ->with('link', $this->link);
    }

    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email|unique:users',
                'name' => 'required',
                'forename' => 'required',
                'password' => 'required',
                'repassword' => 'required',
                'activ' => 'required',
                'access_level' => 'required',
            ]);

        if($request->password != $request->repassword)
            $validator->after(function($validator){
            $validator->errors()->add('NotEqualPass', 'Parolele nu se potrivesc!');
        });

        if($validator->fails())
            return redirect()->route('admin.users.index')
                            ->withErrors($validator);

            $user = new User();
            $user->name = $request->name;
            $user->forename = $request->forename;
            $user->email = $request->email;
            $user->password = bcrypt(e($request->password));
            $user->access_level = $request->access_level;
            $user->activ = $request->has('activ') ? 1 : 0;
            $user->pending = null;
            $user->save();

            return redirect()->route('admin.users.index')
                            ->with('success', 'User creat cu succes!')
                            ->with('reload', true);
    }

    public function edit($id)
    {
        $item = User::find($id);

        $accessLevels = Page::access();

        return view($this->folder.'.edit')
                ->with(compact('item', 'accessLevels'))
                ->with('link', $this->link);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'email',
                'name' => 'required',
                'forename' => 'required',
            ]);

            if($request->password != '') {
                if($request->password != $request->repassword) {
                    $validator->after(function ($validator) {
                        $validator->errors()->add(
                            'NotEqualPass',
                            'Parolele nu se potrivesc!',
                        );
                    });
                }
            }

            if($validator->fails()) {
                return redirect()->back()
                        ->withInput()
                        ->withErrors($validator);
            }

            $user = User::find($id);
            $user->name     = $request->name;
            $user->forename = $request->forename;
            $user->phone    = $request->phone;

            if(Auth::user()->access_level > 2) {
                $user->email = $request->email;
                $user->activ = $request->has('active') ? 1 : 0;

                if(isset($request->pending)) {
                    $user->pending = null;
                }

                $user->access_level = $request->access_level;

                if($request->password != '') {
                    $user->password = bcrypt(e($request->password));
                }
            }

            $user->save();

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'User modificat cu succes!')
                ->with('reload', true);
    }

    public function delete($id)
    {
        $url = $this->link.'/'.$id;

        return view('admin/partials.delete')
                ->with(compact('url'));
    } 

    public function destroy($ids)
    {
        $ids = explode(',', $ids);

        foreach($ids as $id) {
            User::destroy($id);
        }

        return redirect()->route('admin.users.index')
                        ->with('success', 'User-ul a fost șters cu success!')
                        ->with('reload', true);
    }

    public function visibility($id)
    {
        $user = User::findOrFail($id);
        $user->activ = ! $user->activ;
        $user->save();

        return response()->json([
            'activ' => $user->activ
        ]);
    }
}