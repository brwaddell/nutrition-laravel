<?php

namespace App\Http\Controllers;

use App\User;
use App\Events\TestEvent;
use Illuminate\Http\Request;

class RealtimeController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        broadcast(new TestEvent($user))->toOthers();

        return 'ok';
    }
}
