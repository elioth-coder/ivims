<?php

namespace App\Http\Controllers;

use App\Models\PolicyDetail;
use App\Models\Ticket;
use App\Models\TicketChat;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use PDO;

class CustomerController extends Controller
{
    public function index() {
        return view('customer.index');
    }

    public function tickets() {
        $tickets = Ticket::where('user_id', Auth::user()->id)->get();

        return view('customer.tickets', [
            'tickets' => $tickets,
        ]);
    }

    public function create_ticket(Request $request)
    {
        $pdo = DB::connection()->getPdo();
        $sql =
        "SELECT
            policy_details.*
        FROM policy_details
        INNER JOIN policy_holders
        ON policy_details.policy_holder_id = policy_holders.id
        WHERE policy_holders.email=:email
        ORDER BY policy_details.created_at DESC
        ";

        $query = $pdo->prepare($sql);
        $query->execute([
            'email' => Auth::user()->email
        ]);
        $policy_details = $query->fetchAll(PDO::FETCH_CLASS, 'stdClass');

        return view('customer.create_ticket', [
            'policy_details' => $policy_details,
        ]);
    }

    public function store_ticket(Request $request)
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

        return redirect('/customer/create_ticket')->with([
            'message' => "Successfully created a ticket"
        ]);
    }

    public function insurances()
    {
        $pdo = DB::connection()->getPdo();
        $sql =
        "SELECT
            policy_details.*,
            CONCAT(vehicle_details.make, ' ', vehicle_details.model, ' (', vehicle_details.color, ')') AS vehicle,
            CONCAT(users.first_name, ' ', users.last_name) AS agent_name,
            companies.code AS company_code,
            branches.code AS branch_code
        FROM policy_details
        INNER JOIN vehicle_details
        ON policy_details.vehicle_detail_id=vehicle_details.id
        INNER JOIN users
        ON policy_details.user_id=users.id
        INNER JOIN companies
        ON policy_details.company_id=companies.id
        INNER JOIN branches
        ON policy_details.branch_id=branches.id
        INNER JOIN policy_holders
        ON policy_details.policy_holder_id = policy_holders.id
        WHERE policy_holders.email=:email
        ORDER BY policy_details.created_at DESC
        ";

        $query = $pdo->prepare($sql);
        $query->execute([
            'email' => Auth::user()->email
        ]);
        $insurances = $query->fetchAll(PDO::FETCH_CLASS, 'stdClass');

        return view('customer.insurances', [
            'insurances' => $insurances,
        ]);
    }

    public function ticket_chat($id)
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

        return view('customer.ticket_chat', [
            'ticket' => $ticket,
            'chats'  => $chats,
            'created_by' => $created_by,
        ]);
    }

    public function store_chat(Request $request)
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
}
