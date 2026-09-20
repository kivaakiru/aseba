<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Team;
use App\Exports\PlayersExport;


use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PlayerController extends Controller
{
    public function index(Request $request)
    {
        $query = Player::with('team');

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where('full_name', 'like', '%' . $search . '%')
                    ->orWhere('jersey_name', 'like', '%' . $search . '%')
                    ->orWhere('jersey_number', 'like', '%' . $search . '%');

            });
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER TEAM
        |--------------------------------------------------------------------------
        */

        if ($request->filled('team_id')) {

            $query->where(
                'team_id',
                $request->team_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER POSITION
        |--------------------------------------------------------------------------
        */

        if ($request->filled('position')) {

            $query->where(
                'position',
                $request->position
            );
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }
        if ($request->filled('age_sort')) {
            $query->orderBy('age', $request->age_sort === 'desc' ? 'desc' : 'asc');
        }

        /*
        |--------------------------------------------------------------------------
        | PER PAGE
        |--------------------------------------------------------------------------
        */

        $allowedPerPage = [
            10,
            20,
            30,
            40,
            50
        ];

        $perPage = (int) $request->input(
            'per_page',
            10
        );

        if (!in_array(
            $perPage,
            $allowedPerPage,
            true
        )) {

            $perPage = 10;
        }

        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        $players = $query
        ->when(!$request->filled('age_sort'), function ($q) {
            $q->orderBy('full_name');
        })
        ->paginate($perPage)
        ->withQueryString();

        $teams = Team::orderBy('name')->get();

        return view(
            'admin.players.index',
            compact(
                'players',
                'teams'
            )
        );
    }

    public function export()
    {
        return Excel::download(
            new PlayersExport,
            'database-pemain-aseba.xlsx'
        );
    }

    public function create()
    {
        $teams = Team::orderBy('name')->get();

        return view(
            'admin.players.create',
            compact('teams')
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'team_id'        => 'nullable|exists:teams,id',
            'full_name'      => 'required|string|max:255',
            'jersey_name'    => 'required|string|max:255',
            'jersey_number'  => 'required|integer|min:0|max:999',
            'position'       => 'required|in:PG,SG,SF,PF,C',
            'date_of_birth'  => 'required|date',
            'height'             => 'nullable|integer|min:0|max:300',
            'weight'             => 'nullable|integer|min:0|max:300',
            'social_media_name'  => 'nullable|string|max:100',
            'social_media_url'   => 'nullable|url|max:500',
            'photo'              => 'nullable|image|max:10240',
        ], [
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'jersey_name.required' => 'Nama punggung wajib diisi.',
            'jersey_number.required' => 'Nomor punggung wajib diisi.',
            'position.required' => 'Posisi wajib diisi.',
            'date_of_birth.required' => 'Tanggal lahir wajib diisi.',
        ]);

        // HITUNG UMUR OTOMATIS
        $data['age'] = Carbon::parse($data['date_of_birth'])->age;

        // FOTO
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('players', 'public');
        }

        // default status
        $data['status'] = $data['status'] ?? 'active';

        Player::create($data);

        return redirect()->route('admin.players.index')
            ->with('success', 'Pemain berhasil ditambahkan.');
    }

    public function show(Player $player)
    {
        return view('admin.players.show', compact('player'));
    }

    public function edit(Player $player)
    {
        $teams = Team::orderBy('name')->get();

        return view(
            'admin.players.edit',
            compact(
                'player',
                'teams'
            )
        );
    }

    public function update(Request $request, Player $player)
    {

        $data = $request->validate([
            'team_id'        => 'nullable|exists:teams,id',
            'full_name'      => 'required|string|max:255',
            'jersey_name'    => 'required|string|max:255',
            'jersey_number'  => 'required|integer|min:0|max:999',
            'position'       => 'required|in:PG,SG,SF,PF,C',
            'status'         => 'required|in:active,inactive',
            'date_of_birth'  => 'required|date',
            'height'             => 'nullable|integer|min:0|max:300',
            'weight'             => 'nullable|integer|min:0|max:300',
            'social_media_name'  => 'nullable|string|max:100',
            'social_media_url'   => 'nullable|url|max:500',
            'photo'              => 'nullable|image|max:10240',

        ], [
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'jersey_name.required' => 'Nama punggung wajib diisi.',
            'jersey_number.required' => 'Nomor punggung wajib diisi.',
            'position.required' => 'Posisi wajib diisi.',
            'date_of_birth.required' => 'Tanggal lahir wajib diisi.',
        ]);

        // UPDATE AGE otomatis
        $data['age'] = Carbon::parse($data['date_of_birth'])->age;

        // FOTO
        if ($request->hasFile('photo')) {
            if ($player->photo && Storage::disk('public')->exists($player->photo)) {
                Storage::disk('public')->delete($player->photo);
            }

            $data['photo'] = $request->file('photo')->store('players', 'public');
        }

        $player->team_id       = $data['team_id'] ?? null;
        $player->full_name     = $data['full_name'];
        $player->jersey_name   = $data['jersey_name'];
        $player->jersey_number = $data['jersey_number'];
        $player->position      = $data['position'];
        $player->status        = $data['status'];
        $player->date_of_birth = $data['date_of_birth'];
        $player->age           = $data['age'];
        $player->height            = $data['height'];
        $player->weight            = $data['weight'];
        $player->social_media_name = $data['social_media_name'] ?? null;
        $player->social_media_url  = $data['social_media_url'] ?? null;

        if(isset($data['photo'])){
            $player->photo = $data['photo'];
        }

        $player->save();



        return redirect()->route('admin.players.index')
            ->with('success', 'Pemain berhasil diperbarui.');
    }

    public function destroy(Player $player)
    {
        if ($player->photo && Storage::disk('public')->exists($player->photo)) {
            Storage::disk('public')->delete($player->photo);
        }

        $player->delete();

        return redirect()->route('admin.players.index')
            ->with('success', 'Pemain berhasil dihapus.');
    }
}
