<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->user()->tasks()->with('attachments');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->sort == 'deadline') {
            $query->orderBy('deadline');
        }

        $tasks = $query->latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'subject' => 'required',
            'deadline' => 'required|date',
            'pdfs' => 'nullable|array|max:10',
            'pdfs.*' => 'file|mimes:pdf|max:10240',
        ]);

        $task = $request->user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'subject' => $request->subject,
            'status' => 'pending',
            'deadline' => $request->deadline,
        ]);

        $this->storePdfs($task, $request->file('pdfs', []));

        return redirect('/tasks');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $task->load('attachments');

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'subject' => 'required',
            'deadline' => 'required|date',
            'pdfs' => 'nullable|array|max:10',
            'pdfs.*' => 'file|mimes:pdf|max:10240',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'subject' => $request->subject,
            'deadline' => $request->deadline,
        ]);

        $this->storePdfs($task, $request->file('pdfs', []));

        return redirect('/tasks/'.$task->id.'/edit')
            ->with('success', 'Task updated.');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->load('attachments');
        foreach ($task->attachments as $attachment) {
            $attachment->delete();
        }

        $task->delete();

        return redirect('/tasks');
    }

    public function toggleStatus(Task $task)
    {
        $this->authorize('update', $task);

        $task->status = $task->status === 'pending' ? 'done' : 'pending';
        $task->save();

        return redirect('/tasks');
    }

    /**
     * @param  array<int, \Illuminate\Http\UploadedFile>  $files
     */
    private function storePdfs(Task $task, array $files): void
    {
        foreach ($files as $file) {
            if ($file) {
                Attachment::storePdf($task, $file);
            }
        }
    }
}
