<?php

namespace App\Http\Controllers;

use App\Board;
use App\Pin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PinController extends Controller
{
    /**
     * Show a list of all of the application's pins.
     *
     * @return JsonResponse
     */
    public function all()
    {
        Log::info('Retrieving all pins');
        return response()->json(Pin::all());
    }

    /**
     * Create a new pin instance.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        // Validate the request...

        $pin = Pin::create([
            'note' => $request->note,
            'color' => $request->color,
            'media_url' => $request->media_url,
            'board_id' => $request->board_id,
        ]);

        $pin->save();
        return response()->json("Created", 201);
    }

    /**
     * Return a given pin by id.
     *
     * @param $id
     * @return JsonResponse
     */
    public function getById($id)
    {
        Log::info('Retrieving pin with id: '.$id);
        return response()->json(Pin::findOrFail($id));
    }

    /**
     * Return a collection of pins given a board id.
     *
     * @param $boardId
     * @return JsonResponse
     */
    public function GetByBoard($boardId)
    {
        Log::info('Retrieving pins with board id: '.$boardId);
        $pins = Pin::where('board_id', $boardId)->get();
        return response()->json($pins);
    }
}