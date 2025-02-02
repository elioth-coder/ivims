<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketChat;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use PDO;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();

        $count = $tickets->countBy('status');

        return view('ticket.index', [
            'tickets' => $tickets,
            'count'   => $count,
        ]);
    }

    public function status($status)
    {
        $status = ucwords(str_replace('_', ' ', $status));

        $tickets = Ticket::where('status', $status)->get();
        $all_tickets = Ticket::all();

        $count = $all_tickets->countBy('status');

        return view('ticket.status', [
            'tickets' => $tickets,
            'count'   => $count,
            'status'  => $status,
        ]);
    }

    public function create(Request $request)
    {
        $pdo = DB::connection()->getPdo();
        $sql =
        "SELECT * FROM policy_details";

        $query = $pdo->prepare($sql);
        $query->execute();
        $policy_details = $query->fetchAll(PDO::FETCH_CLASS, 'stdClass');

        return view('ticket.create', [
            'policy_details' => $policy_details,
        ]);
    }

    public function store(Request $request)
    {
        $ticketAttributes = $request->validate([
            'coc_no'      => ['required', 'exists:policy_details,coc_no'],
            'title'       => ['required'],
            'description' => ['nullable'],
        ]);

        $ticket = Ticket::where('coc_no', $ticketAttributes['coc_no'])
            ->where('status', '!=', 'CLOSED')->first();

        if($ticket) {
            throw ValidationException::withMessages([
                'coc_no' => 'This policy already has an existing unresolved ticket',
            ]);
        }

        $ticketAttributes['user_id'] = Auth::user()->id;
        $ticketAttributes['status']  = 'CREATED';
        Ticket::create($ticketAttributes);

        return redirect('/ticket/create')->with([
            'message' => "Successfully created a ticket"
        ]);
    }

    public function ticket($id)
    {
        $ticket = Ticket::findOrFail($id);
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
