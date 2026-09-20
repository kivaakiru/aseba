<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Player;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::withCount('players')
            ->orderBy('category')
            ->orderBy('name')
            ->paginate(9);

        return view('admin.teams.index', compact('teams'));
    }

    public function create()
    {
        $players = Player::with('team')->orderBy('id', 'desc')->get();
        return view('admin.teams.create', compact('players'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:teams,name',
            'category' => 'required|string|max:50',
            'description' => 'nullable|string',
            'players' => 'nullable|array',
            'players.*' => 'exists:players,id',
        ]);

        $team = Team::create([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        if ($request->filled('players')) {
            Player::whereIn('id', $request->players)
                ->whereNull('team_id')
                ->update(['team_id' => $team->id]);
        }

        return redirect()->route('admin.teams.show', $team->id)
            ->with('success', 'Tim berhasil ditambahkan.');
    }

    public function show($id)
    {
        $team = Team::withCount('players')->findOrFail($id);

        $players = Player::where('team_id', $team->id)
            ->orderBy('full_name')
            ->get();

        return view('admin.teams.show', compact('team', 'players'));
    }

    public function edit($id)
    {
        $team = Team::with('players')->findOrFail($id);

        $players = Player::with('team')
            ->orderBy('full_name')
            ->get();

        return view('admin.teams.edit', compact(
            'team',
            'players'
        ));
    }

    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:teams,name,'.$team->id,
            'category' => 'required|string|max:50',
            'description' => 'nullable|string',
            'players' => 'nullable|array',
            'players.*' => 'exists:players,id',
        ]);

        $team->update([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        Player::where('team_id', $team->id)->update(['team_id' => null]);

        if ($request->filled('players')) {
            Player::whereIn('id', $request->players)
                ->update(['team_id' => $team->id]);
        }

        return redirect()->route('admin.teams.show', $team->id)
            ->with('success', 'Tim berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);

        Player::where('team_id', $team->id)->update(['team_id' => null]);

        $team->delete();

        return redirect()->route('admin.teams.index')
            ->with('success', 'Tim berhasil dihapus.');
    }
}
