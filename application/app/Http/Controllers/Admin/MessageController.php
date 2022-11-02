<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MessageDataTable;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(MessageDataTable $dataTable)
    {
        $vaccines = Message::all();
        return $dataTable->render('admin.message.index', compact('vaccines'));
    }
}
