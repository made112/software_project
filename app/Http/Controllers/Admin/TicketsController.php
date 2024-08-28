<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\Group;
use App\Models\Products as MyModel;
use App\Models\Reply;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\Ticket;
use App\Models\TicketPriority;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Mpclarkson\Laravel\Freshdesk\Facades\Freshdesk;

class TicketsController extends Controller
{
    /**
     * @var \App\Models\Ticket;
     */
    protected $model;

    public function __construct(Ticket $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return String
     */
    public function index(Request $request)
    {
        $tickets = $this->model->filter( $request->all() );
        $status = TicketStatus::get();
        $priority = TicketPriority::get();
        $tags = Tag::get();
        $type = TicketType::get();

        $tickets = $tickets->with('client')
            ->orderBy('updated_at', 'desc')
            ->get();

        $company_tickets = Ticket::with('client')
            ->whereRaw('id IN (select MAX(id) FROM tickets GROUP BY client_id)')
            ->orderBy('updated_at', 'desc')
            ->get();

        if ( $request->created == 1 ) {
            $from = Carbon::now()->subDays(30);
            $to = Carbon::now();

            $tickets = $tickets->whereBetween('created_at', [$from, $to]);
        }elseif ( $request->created == 2 ){
            $from = Carbon::now()->subDays(7);
            $to = Carbon::now();

            $tickets = $tickets->whereBetween('created_at', [$from, $to]);
        }elseif( $request->created == 3 ){
            $from = Carbon::now()->subDay();
            $to = Carbon::now();

            $tickets = $tickets->whereBetween('created_at', [$from, $to]);
        }

        if ( $request->name ) {
            $clients = new Clients();
            $company_tickets = $clients->filter($request->all());

            $company_tickets = $company_tickets->where('name', $request->name);

            $company_tickets = $company_tickets->with(['tickets'])->select('*')->get();

            return view('admin.tickets.index', compact('company_tickets'));

        }

        $groups = Group::all();
        $companies = Clients::all();
        $admins = Setting::all();

        if( $request->ajax() ) {

            if( $request->id ) {
                $tickets = Ticket::with('client')->where('client_id', $request->id)->get();
            }

            return view('admin.tickets.tickets', compact('tickets','company_tickets', 'groups', 'companies', 'admins','status'))->render();
        }



        return view('admin.tickets.index', compact('tickets', 'company_tickets', 'groups', 'companies', 'admins','status','priority','type','tags'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $ticket = Ticket::query()->findOrFail($id);

        $replies = Reply::query()->where('ticket_id', $ticket->id)->get();

        $groups = Group::all();

        $admins = User::all();

        return view('admin.tickets.show', compact('ticket', 'replies', 'groups', 'admins'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $ticket = Ticket::query()->findOrFail($id);

        $request->validate([
            'type' => ['required', 'in:1,2,3,4,5'],
            'priority' => ['required', 'in:1,2,3,4'],
            'status' => ['required', 'in:1,2,3,4,5,6'],
            'group_id' => ['required', 'exists:groups,id'],
        ]);

        $ticket->update([
           'status' => $request->status,
           'priority' => $request->priority,
           'type' => $request->type,
           'group_id' => $request->group_id,
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $ticket = Ticket::query()->findOrFail($id);

        $ticket->delete();

        return redirect()->route('ticket.index');
    }

    public function noData()
    {
        return view('admin.tickets.no_data');
    }

    public function showTickets($id)
    {

    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function close(Request $request, $id): RedirectResponse
    {
        $ticket = Ticket::query()->findOrFail($id);

        $ticket->update([
            'status' => 4,
            'condition' => 4,
        ]);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function restore(Request $request, $id): RedirectResponse
    {
        $ticket = Ticket::query()->findOrFail($id);

        $ticket->update([
            'status' => 1,
            'condition' => 5,
        ]);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function forward(Request $request, $id): RedirectResponse
    {
        return redirect()->back();
    }

    public function select(Request $request)
    {
        $term = $request->get('term');
        $client_id = $request->get('client_id');

        $data = User::query();
        $i = 0;
        $data = $data->where(function ($query) use ($term) {
            $query->where('username', 'like', '%' . str_replace(' ', "%", $term) . '%');
        });

        $data = $data->get(['id', 'name', 'username as text', 'email']);
        echo json_encode($data);
    }

}
