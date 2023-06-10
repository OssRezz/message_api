<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessageRequest;
use App\Models\History;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::all();
        return response()->json([
            'status' => 200,
            'message' => "List of messages",
            'data' => $messages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMessageRequest $request, Message $message, History $history)
    {
        $data = $request->validated();
        $data['number'] = $request->number === null ? '3193270780' : $request->number;
        $message->create($data);
        // $history->message_id = $message->id;
        // $history->date = date('Y-m-d h:i:s');
        // $history->save();
        return response()->json([
            'status' => 200,
            'message' => "Message created successfully",
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!Message::find($id)) {
            return response()->json([
                'status' => 404,
                'message' => "The resource is not here",
                'data' => []
            ]);
        }
        return response()->json([
            'status' => 200,
            'message' => "Show message",
            'data' => Message::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Message::find($id)) {
            return response()->json([
                'status' => 404,
                'message' => "The resource is not here",
                'data' => []
            ]);
        }
        return response()->json([
            'status' => 200,
            'message' => "Edit message",
            'data' => Message::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Message::find($id)) {
            return response()->json([
                'status' => 404,
                'message' => "The resource is not here",
                'data' => []
            ]);
        }
        $msg = Message::find($id);

        $msg->delete();
        return response()->json([
            'status' => 200,
            'message' => "Message delete",
        ]);
    }
}
