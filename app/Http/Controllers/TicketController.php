<?php

namespace App\Http\Controllers;

use App\Models\PolicyDetail;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\TicketChat;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use PDO;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        if($request->input('category_id')) {
            $tickets = Ticket::where('category_id', $request->input('category_id'))->latest()->get();
        } else {
            $tickets = Ticket::latest()->get();
        }

        $ticket_categories = TicketCategory::all();
        $tickets = $tickets->map(function (Object $ticket) {
            if($ticket->category_id) {
                $ticket->category = TicketCategory::findOrFail($ticket->category_id);
            }

            return $ticket;
        });

        $count = $tickets->countBy('status');

        return view('ticket.index', [
            'tickets' => $tickets,
            'count'   => $count,
            'ticket_categories' => $ticket_categories,
        ]);
    }

    public function status(Request $request, $status)
    {
        $status = ucwords(str_replace('_', ' ', $status));

        if($request->input('category_id')) {
            $tickets = Ticket::where('category_id', $request->input('category_id'))->where('status', $status)->latest()->get();
            $all_tickets = Ticket::where('category_id', $request->input('category_id'))->latest()->get();
        } else {
            $tickets = Ticket::where('status', $status)->latest()->get();
            $all_tickets = Ticket::latest()->get();
        }

        $ticket_categories = TicketCategory::all();
        $tickets = $tickets->map(function (Object $ticket) {
            if($ticket->category_id) {
                $ticket->category = TicketCategory::findOrFail($ticket->category_id);
            }

            return $ticket;
        });

        $count = $all_tickets->countBy('status');

        return view('ticket.status', [
            'ticket_categories' => $ticket_categories,
            'tickets' => $tickets,
            'count'   => $count,
            'status'  => $status,
        ]);
    }

    public function create(Request $request)
    {
        $policy_details    = PolicyDetail::all();
        $ticket_categories = TicketCategory::all();

        return view('ticket.create', [
            'policy_details'    => $policy_details,
            'ticket_categories' => $ticket_categories,
        ]);
    }

    public function store(Request $request)
    {
        $ticketAttributes = $request->validate([
            'category_id' => ['nullable', 'exists:ticket_categories,id'],
            'title'       => ['required'],
            'description' => ['nullable'],
            'coc_no'      => ['nullable', 'exists:policy_details,coc_no'],
        ]);

        $ticketAttributes['user_id'] = Auth::user()->id;
        $ticketAttributes['status']  = 'CREATED';
        Ticket::create($ticketAttributes);

        return redirect('/ticket/create')->with([
            'message' => "Successfully created a ticket"
        ]);
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket_categories = TicketCategory::all();
        $policy_details    = PolicyDetail::all();

        return view('ticket.edit', [
            'ticket' => $ticket,
            'policy_details' => $policy_details,
            'ticket_categories' => $ticket_categories,
        ]);
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $rules = [
            'category_id' => ['nullable', 'string', 'exists:ticket_categories,id'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'coc_no'      => ['nullable', 'string', 'exists:policy_details,coc_no'],
        ];

        $ticketAttributes = $request->validate($rules);

        $ticket->update($ticketAttributes);

        return redirect("/ticket")->with([
            'message' => "Successfully updated the ticket"
        ]);
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect("/ticket")
            ->with([
                'message' => 'Successfully deleted the ticket',
            ]);
    }

    public function ticket($id)
    {
        $ticket = Ticket::findOrFail($id);
        if($ticket->category_id) {
            $ticket->category = TicketCategory::findOrFail($ticket->category_id);
        }

        $created_by = User::findOrFail($ticket->user_id);

        $pdo = DB::connection()->getPdo();
        $sql =
        "SELECT ticket_chats.*, users.first_name, users.last_name FROM ticket_chats
        INNER JOIN users
        ON ticket_chats.user_id=users.id
        WHERE ticket_chats.ticket_id=:ticket_id
        ORDER BY ticket_chats.created_at DESC";

        $query = $pdo->prepare($sql);
        $query->execute([
            'ticket_id' => $ticket->id,
        ]);
        $chats = $query->fetchAll(PDO::FETCH_CLASS, 'stdClass');

        return view('ticket.ticket', [
            'ticket' => $ticket,
            'chats'  => $chats,
            'created_by' => $created_by,
        ]);
    }

    public function chat(Request $request)
    {
        try {
            $chatAttributes = $request->validate([
                'message'   => ['required'],
                'ticket_id' => ['required', 'exists:tickets,id'],
                'file'      => ['nullable','file', 'mimes:jpg,png,pdf,docx','max:2048'],
            ]);

            if ($request->file('file')) {
                $fileName = time() . '-' . $request->file('file')->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');

                $chatAttributes['file'] = $fileName;
            }

            $chatAttributes['user_id'] = Auth::user()->id;
            TicketChat::create($chatAttributes);

            $ticket = Ticket::findOrFail($chatAttributes['ticket_id']);

            if($ticket->status=='CREATED') {
                $ticket->update([
                    'status' => 'OPEN',
                ]);
            }

            return response()->json([
                'status'  => 'success',
                'message' => 'Successfully sent message',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function status_update(Request $request)
    {
        try {
            $ticketAttributes = $request->validate([
                'ticket_status' => ['required'],
                'ticket_id'     => ['required', 'exists:tickets,id'],
            ]);

            $ticket = Ticket::findOrFail($ticketAttributes['ticket_id']);
            $ticket->update([
                'status' => $ticketAttributes['ticket_status'],
            ]);

            return response()->json([
                'status'  => 'success',
                'message' => 'Successfully updated the ticket status',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
