<?php

namespace App\Http\Controllers;

use App\Models\TicketCategory;
use Illuminate\Http\Request;

class TicketCategoryController extends Controller
{
    public function index()
    {
        $ticket_categories = TicketCategory::latest()->get();

        return view('ticket_category.index', [
            'ticket_categories' => $ticket_categories,
        ]);
    }

    public function create()
    {
        return view('ticket_category.create');
    }

    public function edit($id)
    {
        $ticket_category = TicketCategory::findOrFail($id);

        return view('ticket_category.edit', [
            'ticket_category' => $ticket_category
        ]);
    }

    public function store(Request $request)
    {
        $ticketCategoryAttributes = $request->validate([
            'code' => ['required', 'string', 'unique:ticket_categories,code', 'max:255'],
            'name' => ['required', 'string', 'unique:ticket_categories,code', 'max:255'],
        ]);

        $ticket_category = TicketCategory::create($ticketCategoryAttributes);

        return redirect('/setting/ticket_category/create')->with([
            'message' => "Successfully added a ticket category"
        ]);
    }

    public function update(Request $request, $id)
    {
        $ticket_category = TicketCategory::findOrFail($id);

        $rules = [
            'code' => ['required', 'string', 'unique:ticket_categories,code', 'max:255'],
            'name' => ['required', 'string', 'unique:ticket_categories,code', 'max:255'],
        ];

        if($ticket_category->code==$request->input('code')) {
            unset($rules['code']);
        }

        $ticketCategoryAttributes = $request->validate($rules);

        $ticket_category->update($ticketCategoryAttributes);

        return redirect("/setting/ticket_category")->with([
            'message' => "Successfully updated the ticket category"
        ]);
    }

    public function destroy($id)
    {
        $ticket_category = TicketCategory::findOrFail($id);
        $ticket_category->delete();

        return redirect("/setting/ticket_category")
            ->with([
                'message' => 'Successfully deleted the ticket category',
            ]);
    }
}
