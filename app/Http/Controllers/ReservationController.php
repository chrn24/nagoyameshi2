<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

 public function index()
{
    $reservations = Reservation::where('user_id', auth()->id())
        ->with('shop') // 店舗情報も取得
        ->orderBy('reservation_date', 'asc')
        ->get();

    return view('users.reservation', compact('reservations'));
}


    public function create($shopId)
{
    $data = session()->get('reservation_data', []);
        return view('reservations.create', compact('shopId', 'data'));
}

public function confirm(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
        'reservation_date' => 'required|date|after_or_equal:today',
        'reservation_time' => 'required',
        'number_of_people' => 'required|integer|min:1',

    ]);

    $data = $validated;

    $data['shopId'] = $request->shop_Id;
    $request->session()->put('reservation_data', $data);

    return view('reservations.confirm', compact('data'));
    }

    public function store(Request $request)
    {
        
        $data = $request->session()->get('reservation_data');
        $shopId = $data['shopId']; 

        Reservation::create([
            'user_id' => auth()->id(),
            'shop_id' => $shopId,
            'reservation_date' => $data['reservation_date'] . ' ' . $data['reservation_time'],
            'number_of_people' => $data['number_of_people'],
        ]);
        

        $request->session()->forget('reservation_data');

        return redirect()->route('reservations.complete', ['shop' => $shopId])
                         ->with('success', '予約が完了しました！');
    }

    public function complete()
   {
    return view('reservations.complete');
   }

   public function destroy(Reservation $reservation)
    {
        // ログインユーザーの予約か確認（不正防止）
        if ($reservation->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', '予約をキャンセルしました。');
    }

}
