<?php

namespace App\Http\Controllers;

use App\Models\ValidId;
use Illuminate\Http\Request;

class ValidIdController extends Controller
{
    public function index()
    {
        $valid_ids = ValidId::all();

        return view('valid_id.index', [
            'valid_ids' => $valid_ids,
        ]);
    }

    public function create()
    {
        return view('valid_id.create');
    }

    public function edit($id)
    {
        $valid_id = ValidId::findOrFail($id);

        return view('valid_id.edit', [
            'valid_id' => $valid_id
        ]);
    }
    public function store(Request $request)
    {
        $validIdAttributes = $request->validate([
            'code'        => ['required', 'unique:valid_ids,code'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $valid_id = ValidId::create($validIdAttributes);

        return redirect('/setting/valid_id/create')->with([
            'message' => "Successfully added a valid id"
        ]);
    }

    public function update(Request $request, $id)
    {
        $valid_id = ValidId::findOrFail($id);

        $rules = [
            'code'        => ['required', 'unique:valid_ids,code'],
            'description' => ['required', 'string', 'max:255'],
        ];

        if($valid_id->code==$request->input('code')) {
            unset($rules['code']);
        }

        $validIdAttributes = $request->validate($rules);

        $valid_id->update($validIdAttributes);

        return redirect("/setting/valid_id")->with([
            'message' => "Successfully updated the valid id"
        ]);
    }

    public function destroy($id)
    {
        $valid_id = ValidId::findOrFail($id);
        $valid_id->delete();

        return redirect("/setting/valid_id")
            ->with([
                'message' => 'Successfully deleted the valid id',
            ]);
    }
}
