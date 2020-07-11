<?php

namespace App\Http\Controllers\Admin;

use App\Events\TicketStatusChangedEvent;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class AssignedTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Ticket::where('assigned_to', auth()->user()->id)->with('createdBy');
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
                ->addColumn('creator', function (Ticket $ticket) {
                    return $ticket->createdBy->name;

                })
                ->addColumn('actions', function (Ticket $ticket) {

                    return view("admin.tickets.datatables_actions", compact('ticket'));
                })
                ->addColumn('status', function (Ticket $ticket) {
                    return __(Ticket::STATUS[$ticket->status]);
                })
                ->make(true);
        }

        return view('admin.tickets.index-owned');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit($ticket)
    {
        $ticket = Ticket::findOrFail($ticket);
        $ticket->assigned_to != auth()->user()->id ? abort(403) : '';
        $status = Ticket::STATUS;
        return view('admin.tickets.updatedStatus', [
            'ticket' => $ticket,
            'status' => $status,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ticket)
    {
        $ticket = Ticket::findOrFail($ticket);
        $ticket->assigned_to != auth()->user()->id ? abort(403) : '';
        $this->validate($request, [
            "comment" => "required|string|max:500|min:3",
            'status' => ['required', Rule::in(Ticket::STATUSIDS)],
        ]);
        if ($ticket->status != $request->status) {
            $ticket->update([
                'status' => $request->status,
            ]);
            $ticket->comments->create([
                'ticket_id' => $ticket->id,
                'commet' => $request->commet,
                'status' => $request->status,
                'created_by' => auth()->user()->id,
            ]);
            try {
                event(new TicketStatusChangedEvent($ticket));
            } catch (\Exception $e) {
                return redirect()->route('admin.ticket-owner.index')->withSuccess(__('Ticket successfully updated.But Email Not Send!'));
            }
        }
        return redirect()->route('admin.ticket-owner.index')->withSuccess(__('Ticket successfully updated.'));

    }

}
