<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{

    public function index()
{
    return view('reservations.index');
}

    public function create($shopId)
{
    $data = session()->get('reservation_data', []);
        return view('reservations.create', compact('shopId', 'data'));
}

public function confirm(Request $request)
    {
        $validated = $request->validate([
        'reservation_date' => 'required|date',
        'reservation_time' => 'required',
        'number_of_people' => 'required|integer|min:1',
    ]);

    $data = $validated;

    $data['shopId'] = $request->shopId;
    $request->session()->put('reservation_data', $data);

    return view('reservations.confirm', compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request->session()->get('reservation_data');
        $shopId = $data['shopId']; 

        Reservation::create([
            'user_id' => auth()->id(),
            'reservation_date' => $data['reservation_date'] . ' ' . $data['reservation_time'],
            'number_of_people' => $data['number_of_people'],
        ]);

        $request->session()->forget('reservation_data');

        return redirect()->route('reservations.create', ['shop' => $shopId])
                         ->with('success', '予約が完了しました！');
    }

}
