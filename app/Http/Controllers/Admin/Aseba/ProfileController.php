<?php

namespace App\Http\Controllers\Admin\Aseba;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\ClubHistory;
use App\Models\ManagementBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PROFILE INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $managementBoards = ManagementBoard::orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $historyCount = ClubHistory::count();

        $achievementCount = Achievement::count();

        return view('admin.profile.index', compact(
            'managementBoards',
            'historyCount',
            'achievementCount'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | CLUB HISTORY
    |--------------------------------------------------------------------------
    */

    public function history()
    {
        $histories = ClubHistory::orderByDesc('year')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.profile.history_edit', compact('histories'));
    }


    public function createHistory()
    {
        return view('admin.profile.history_edit');
    }


    public function storeHistory(Request $request)
    {
        $validated = $request->validate([
            'year' => [
                'required',
                'integer',
                'min:1900',
                'max:2100'
            ],

            'title' => [
                'required',
                'string',
                'max:150'
            ],

            'description' => [
                'nullable',
                'string'
            ],
        ]);

        $validated['sort_order'] =
            (ClubHistory::where('year', $validated['year'])
                ->max('sort_order') ?? -1) + 1;

        ClubHistory::create($validated);

        return redirect()
            ->route('admin.aseba.profile.history')
            ->with(
                'success',
                'History ASEBA berhasil ditambahkan.'
            );
    }


    public function editHistory($id)
    {
        $history = ClubHistory::findOrFail($id);

        $histories = ClubHistory::orderByDesc('year')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view(
            'admin.profile.history_edit',
            compact('history', 'histories')
        );
    }


    public function updateHistory(Request $request, $id)
    {
        $history = ClubHistory::findOrFail($id);

        $validated = $request->validate([
            'year' => [
                'required',
                'integer',
                'min:1900',
                'max:2100'
            ],

            'title' => [
                'required',
                'string',
                'max:150'
            ],

            'description' => [
                'nullable',
                'string'
            ],
        ]);

        $history->update($validated);

        return redirect()
            ->route('admin.aseba.profile.history')
            ->with(
                'success',
                'History ASEBA berhasil diperbarui.'
            );
    }


    public function destroyHistory($id)
    {
        $history = ClubHistory::findOrFail($id);

        $history->delete();

        return redirect()
            ->route('admin.aseba.profile.history')
            ->with(
                'success',
                'History ASEBA berhasil dihapus.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | MANAGEMENT BOARD
    |--------------------------------------------------------------------------
    */

    public function management()
    {
        $managementBoards = ManagementBoard::orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view(
            'admin.profile.manajemen_edit',
            compact('managementBoards')
        );
    }


    public function storeManagement(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100'
            ],

            'role' => [
                'required',
                'string',
                'max:255'
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20'
            ],

            'email' => [
                'nullable',
                'email',
                'max:150'
            ],

            'instagram' => [
                'nullable',
                'string',
                'max:150'
            ],

            'linkedin' => [
                'nullable',
                'string',
                'max:150'
            ],

            'description' => [
                'nullable',
                'string'
            ],
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('management', 'public');
        }

        $validated['sort_order'] =
            (ManagementBoard::max('sort_order') ?? 0) + 1;

        $validated['is_active'] = true;

        ManagementBoard::create($validated);

        return redirect()
            ->route('admin.aseba.profile')
            ->with(
                'success',
                'Management Board berhasil ditambahkan.'
            );
    }


    public function editManagement($id)
    {
        $management = ManagementBoard::findOrFail($id);

        $managementBoards = ManagementBoard::orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view(
            'admin.profile.manajemen_edit',
            compact(
                'management',
                'managementBoards'
            )
        );
    }


    public function updateManagement(Request $request, $id)
    {
        $management = ManagementBoard::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100'
            ],

            'role' => [
                'required',
                'string',
                'max:255'
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20'
            ],

            'email' => [
                'nullable',
                'email',
                'max:150'
            ],

            'instagram' => [
                'nullable',
                'string',
                'max:150'
            ],

            'linkedin' => [
                'nullable',
                'string',
                'max:150'
            ],

            'description' => [
                'nullable',
                'string'
            ],
        ]);

        if ($request->hasFile('photo')) {

            if (
                $management->photo &&
                Storage::disk('public')->exists(
                    $management->photo
                )
            ) {
                Storage::disk('public')->delete(
                    $management->photo
                );
            }

            $validated['photo'] = $request->file('photo')
                ->store('management', 'public');
        }

        $management->update($validated);

        return redirect()
            ->route('admin.aseba.profile')
            ->with(
                'success',
                'Management Board berhasil diperbarui.'
            );
    }


    public function destroyManagement($id)
    {
        $management = ManagementBoard::findOrFail($id);

        if (
            $management->photo &&
            Storage::disk('public')->exists(
                $management->photo
            )
        ) {
            Storage::disk('public')->delete(
                $management->photo
            );
        }

        $management->delete();

        return redirect()
            ->route('admin.aseba.profile')
            ->with(
                'success',
                'Management Board berhasil dihapus.'
            );
    }


    public function toggleManagement($id)
    {
        $management = ManagementBoard::findOrFail($id);

        $management->update([
            'is_active' => !$management->is_active,
        ]);

        return redirect()
            ->route('admin.aseba.profile')
            ->with(
                'success',
                'Status Management Board berhasil diubah.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ACHIEVEMENTS
    |--------------------------------------------------------------------------
    */

    public function achievements()
    {
        $achievements = Achievement::orderByDesc('year')
            ->orderByDesc('id')
            ->get();

        return view(
            'admin.profile.prestasi_edit',
            compact('achievements')
        );
    }


    public function createAchievement()
    {
        return view('admin.profile.prestasi_edit');
    }


    public function storeAchievement(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255'
            ],

            'competition' => [
                'required',
                'string',
                'max:255'
            ],

            'year' => [
                'required',
                'integer',
                'min:1900',
                'max:2100'
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],

            'description' => [
                'nullable',
                'string'
            ],
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('achievements', 'public');
        }

        Achievement::create($validated);

        return redirect()
            ->route('admin.aseba.profile.achievements')
            ->with(
                'success',
                'Prestasi ASEBA berhasil ditambahkan.'
            );
    }


    public function editAchievement($id)
    {
        $achievement = Achievement::findOrFail($id);

        $achievements = Achievement::orderByDesc('year')
            ->orderByDesc('id')
            ->get();

        return view(
            'admin.profile.prestasi_edit',
            compact(
                'achievement',
                'achievements'
            )
        );
    }


    public function updateAchievement(Request $request, $id)
    {
        $achievement = Achievement::findOrFail($id);

        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255'
            ],

            'competition' => [
                'required',
                'string',
                'max:255'
            ],

            'year' => [
                'required',
                'integer',
                'min:1900',
                'max:2100'
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],

            'description' => [
                'nullable',
                'string'
            ],
        ]);

        if ($request->hasFile('photo')) {

            if (
                $achievement->photo &&
                Storage::disk('public')->exists(
                    $achievement->photo
                )
            ) {
                Storage::disk('public')->delete(
                    $achievement->photo
                );
            }

            $validated['photo'] = $request->file('photo')
                ->store('achievements', 'public');
        }

        $achievement->update($validated);

        return redirect()
            ->route('admin.aseba.profile.achievements')
            ->with(
                'success',
                'Prestasi ASEBA berhasil diperbarui.'
            );
    }


    public function destroyAchievement($id)
    {
        $achievement = Achievement::findOrFail($id);

        if (
            $achievement->photo &&
            Storage::disk('public')->exists(
                $achievement->photo
            )
        ) {
            Storage::disk('public')->delete(
                $achievement->photo
            );
        }

        $achievement->delete();

        return redirect()
            ->route('admin.aseba.profile.achievements')
            ->with(
                'success',
                'Prestasi ASEBA berhasil dihapus.'
            );
    }
}