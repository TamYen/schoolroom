<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Room;
use App\RoomSession;
use App\Shift;
use App\Http\Requests\SearchRoom;

class RoomSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $now = Carbon::now()->format('Y-m-d');
        
        $roomsessions = DB::table('room_sessions')
                        ->join('rooms', 'room_sessions.room', '=', 'rooms.id')
                        ->select('room_sessions.*', 'rooms.name as roomname', 'rooms.seats as seats')
                        ->whereNull('subscriber')
                        ->whereDate('date', '>', Carbon::now())
                        ->get();
        return view('booking.show', compact('roomsessions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $now = Carbon::now()->format('Y-m-d');
        // get room
        // $rooms = Room::all()->toArray();
        // get shift
        $shifts = Shift::all()->toArray();

        $roomAvailable = null;
        //////////////////////////////////////
        // $rooms = DB::table('room_sessions')
        //                 ->select('room_sessions.room')
        //                 ->whereDate('room_sessions.date', $now)
        //                 ->where('room_sessions.shift', 3)->pluck('room_sessions.room');
        
        // $roomAvailable = Room::all()->toArray();
        if(isset($request->day)){
            $rooms = DB::table('room_sessions')
                        ->select('room_sessions.room')
                        ->whereDate('room_sessions.date', $request->day)
                        ->where('room_sessions.shift', $request->shift)->pluck('room_sessions.room');
            
            $roomAvailable = DB::table('rooms')
                                ->select('rooms.*')
                                ->whereNotIn('rooms.id', $rooms)->get();

            return view('booking.create', compact('now', 'shifts', 'roomAvailable'));
        }
        

        return view('booking.create', compact('now', 'shifts'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roomsession = new RoomSession([
            'room' => $request->get('room'),
            'shift' => $request->get('shift'),
            'date' => $request->get('date'),
            'creater' => Auth::user()->id
        ]);

        $roomsession->save();
        return redirect('booking/create');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $roomsession = RoomSession::find($id);
        $roomsession->subscriber = Auth::user()->id;
        $roomsession->save();
        return redirect('/booking');
    }

    /// dang ky phong
    public function subscribe($id)
    {
        $roomsession = RoomSession::find($id);
        $roomsession->subscriber = Auth::user()->id;
        $roomsession->save();
        return redirect('/booking');
    }

    /// huy dang ky
    public function removeSubscribe($id)
    {
        $roomsession = RoomSession::find($id);
        $roomsession->subscriber = null;
        $roomsession->status = null;
        $roomsession->save();
        return redirect('/history/subscribes');
    }

    /// duyet phong: chap nhan
    public function approve($id)
    {
        $roomsession = RoomSession::find($id);
        $roomsession->approver = Auth::user()->id;
        $roomsession->status = true;
        $roomsession->save();
        return redirect('/booking/approve');
    }

    /// duyet phong: ko chap nhan
    public function nonApprove($id)
    {
        $roomsession = RoomSession::find($id);
        $roomsession->approver = Auth::user()->id;
        $roomsession->status = false;
        $roomsession->save();
        return redirect('/booking/approve');
    }

    /// xem lich su dang ky
    public function showHistory(){
        $result = DB::table('room_sessions')
                    ->join('rooms', 'room_sessions.room', '=', 'rooms.id')
                    ->select('room_sessions.status','room_sessions.id','room_sessions.shift','room_sessions.date', 'rooms.name as roomname', 'rooms.seats as seats')
                    ->where('room_sessions.subscriber', Auth::user()->id)
                    ->get();
        return view('history', compact('result'));

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /// show roomsession duoc dang ky
    public function roomsessionSubscried(){
        $roomSubscrived = DB::table('room_sessions')
                            ->join('users', 'room_sessions.subscriber', '=', 'users.id')
                            ->join('rooms', 'room_sessions.room', '=', 'rooms.id')
                            ->select('room_sessions.id','room_sessions.shift','room_sessions.date', 'rooms.name as roomname', 'rooms.seats as seats', 'users.name as user')
                            ->whereNull('approver')
                            ->whereDate('date', '>=', Carbon::now())
                            ->get();
        return view('booking.approve', compact('roomSubscrived'));
    }
}
