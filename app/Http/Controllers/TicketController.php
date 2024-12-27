<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketChat;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDO;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();

        return view('ticket.index', [
            'tickets' => $tickets,
        ]);
    }

    public function ticket($id)
    {
        $ticket = Ticket::findOrFail($id);

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
        ]);
    }

    public function chat(Request $request)
    {
        try {
            $chatAttributes = $request->validate([
                'message'   => ['required'],
                'ticket_id' => ['required', 'exists:tickets,id'],
            ]);

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
