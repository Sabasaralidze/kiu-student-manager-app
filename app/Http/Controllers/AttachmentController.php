<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AttachmentController extends Controller
{
    public function download(Attachment $attachment): StreamedResponse
    {
        $this->authorize('view', $attachment->task);

        if (! Storage::disk('local')->exists($attachment->path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('local')->download(
            $attachment->path,
            $attachment->original_name,
            ['Content-Type' => 'application/pdf']
        );
    }

    public function destroy(Attachment $attachment)
    {
        $this->authorize('update', $attachment->task);

        $taskId = $attachment->task_id;
        $attachment->delete();

        return redirect('/tasks/'.$taskId.'/edit')
            ->with('success', 'PDF removed.');
    }
}
