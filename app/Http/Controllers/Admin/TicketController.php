<?php

namespace App\Http\Controllers\Admin;

use App\c;
use App\Events\NewTicketEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TicketRequest;
use App\Models\Ticket;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:show tickets');
        $this->middleware('permission:create tickets', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit tickets', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete tickets', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Ticket::where('created_by', auth()->user()->id)->with('assignedTo');
            $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
            $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
            // dd($start_date, $end_date, request()->all());
            if ($start_date && $end_date) {
                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $query->whereRaw("date(tickets.dateline) >= '" . $start_date . "' AND date(tickets.dateline) <= '" . $end_date . "'");
            }
            $tickets = $query->select('*');
            return DataTables::of($tickets)
                ->addColumn('assigen', function (Ticket $ticket) {
                    return $ticket->assignedTo->name;

                })
                ->addColumn('actions', function (Ticket $ticket) {

                    return view("admin.tickets.datatables_actions", compact('ticket'));
                })
                ->addColumn('status', function (Ticket $ticket) {
                    return __(Ticket::STATUS[$ticket->status]);
                })

                ->make(true);
        }

        return view('admin.tickets.index-creator');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get()->pluck('name', 'id');
        $status = Ticket::STATUS;
        return view('admin.tickets.create', [
            'users' => $users,
            'status' => $status,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketRequest $request)
    {
        $ticket = Ticket::create([
            'name' => $request->name,
            'description' => $request->description,
            'dateline' => $request->finalDate,
            'assigned_to' => $request->user,
            'created_by' => auth()->user()->id,
            'status' => $request->status,
        ]);
        try {
            event(new NewTicketEvent($ticket));
        } catch (\Exception $e) {
            return redirect()->route('admin.ticket.index')->withSuccess(__('Ticket successfully created.But Email Not Send!'));
        }
        return redirect()->route('admin.ticket.index')->withSuccess(__('Ticket successfully created.'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {

        return view('admin.tickets.show', compact('ticket'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $ticket->created_by != auth()->user()->id ? abort(403) : '';

        $users = User::where('id', '!=', auth()->user()->id)->get()->pluck('name', 'id');
        $status = Ticket::STATUS;
        return view('admin.tickets.edit', [
            'ticket' => $ticket,
            'users' => $users,
            'status' => $status,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function update(TicketRequest $request, Ticket $ticket)
    {
        $ticket->created_by != auth()->user()->id ? abort(403) : '';
        $ticket->update([
            'name' => $request->name,
            'description' => $request->description,
            'dateline' => $request->finalDate,
            'assigned_to' => $request->user,
            'status' => $request->status,
        ]);
        return redirect()->route('admin.ticket.index')->withSuccess(__('Ticket successfully updated.'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->created_by != auth()->user()->id ? abort(403) : '';
        $ticket->delete();
        return redirect()->route('admin.ticket.index')->withSuccess(__('Ticket successfully deleted.'));
        //
    }
}
