<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::all();

        return view('announcement.index', [
            'announcements' => $announcements,
        ]);
    }

    public function create()
    {
        return view('announcement.create');
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);

        return view('announcement.edit', [
            'announcement' => $announcement
        ]);
    }
    public function store(Request $request)
    {
        $announcementAttributes = $request->validate([
            'title'   => ['required'],
            'content' => ['required'],
            'color'   => ['required'],
            'status'  => ['required'],
        ]);

        $announcement = Announcement::create($announcementAttributes);

        return redirect('/dashboard/announcement/create')->with([
            'message' => "Successfully added an announcement"
        ]);
    }

    public function update(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);

        $announcementAttributes = $request->validate([
            'title'   => ['required'],
            'content' => ['required'],
            'color'   => ['required'],
            'status'  => ['required'],
        ]);

        $announcement->update($announcementAttributes);

        return redirect("/dashboard/announcement")->with([
            'message' => "Successfully updated the announcement"
        ]);
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return redirect("/dashboard/announcement")
            ->with([
                'message' => 'Successfully deleted the announcement',
            ]);
    }
}
