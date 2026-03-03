<?php

use Illuminate\Support\Facades\Route;
use App\Models\Player;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome', [
        'players' => Player::all()
    ]);
});

Route::post('/players/add', function (Request $request) {
    if ($request->name) {
        Player::create(['name' => $request->name]);
    }
    return back();
});

Route::post('/game/shuffle', function (Request $request) {
    $players = Player::all();
    $potentialRoles = $request->roles ?? ['Wolf', 'Villager', 'Seer', 'Healer', 'Witch'];
    
    // Shuffle players and slice roles to match
    $shuffledPlayers = $players->shuffle();
    
    foreach ($shuffledPlayers as $index => $player) {
         // Cycle roles if not enough
         $player->update([
             'role' => $potentialRoles[$index % count($potentialRoles)],
             'revealed' => false
         ]);
    }
    
    return back();
});

Route::post('/players/remove/{id}', function ($id) {
    \App\Models\Player::findOrFail($id)->delete();
    return back();
});

Route::post('/game/reset', function () {
    \App\Models\Player::truncate();
    return back();
});

Route::post('/players/reveal/{id}', function ($id) {
    $player = Player::findOrFail($id);
    $player->update(['revealed' => true]);
    return response()->json(['role' => $player->role]);
});
