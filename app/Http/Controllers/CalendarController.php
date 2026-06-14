<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CalendarController extends Controller
{
    public function index(Request $request): View
    {
        $type = $request->get('type', 'tasks');
        if (! in_array($type, ['tasks', 'projects'], true)) {
            $type = 'tasks';
        }

        $month = ($request->filled('year') && $request->filled('month'))
            ? Carbon::createFromDate((int) $request->year, (int) $request->month, 1)->startOfMonth()
            : now()->startOfMonth();

        $gridStart = $month->copy()->startOfMonth()->startOfWeek(Carbon::MONDAY);
        $gridEnd = $month->copy()->endOfMonth()->endOfWeek(Carbon::MONDAY);

        $itemsByDate = collect();

        if ($type === 'tasks') {
            $itemsByDate = $request->user()->tasks()
                ->whereBetween('deadline', [$gridStart->toDateString(), $gridEnd->toDateString()])
                ->orderBy('deadline')
                ->get()
                ->map(fn ($item) => (object) [
                    'title' => $item->title,
                    'subject' => $item->subject,
                    'status' => $item->status,
                    'deadline' => $item->deadline,
                    'edit_url' => route('tasks.edit', $item),
                    'kind' => 'task',
                ])
                ->groupBy(fn ($item) => Carbon::parse($item->deadline)->toDateString());
        } else {
            $itemsByDate = Project::forUser($request->user())
                ->whereBetween('deadline', [$gridStart->toDateString(), $gridEnd->toDateString()])
                ->orderBy('deadline')
                ->get()
                ->map(fn ($item) => (object) [
                    'title' => $item->title,
                    'subject' => $item->subject,
                    'status' => $item->status,
                    'deadline' => $item->deadline,
                    'edit_url' => route('projects.edit', $item),
                    'kind' => 'project',
                ])
                ->groupBy(fn ($item) => Carbon::parse($item->deadline)->toDateString());
        }

        $weeks = [];
        $cursor = $gridStart->copy();

        while ($cursor->lte($gridEnd)) {
            $week = [];
            for ($i = 0; $i < 7; $i++) {
                $dateKey = $cursor->toDateString();
                $week[] = [
                    'date' => $cursor->copy(),
                    'isCurrentMonth' => $cursor->month === $month->month,
                    'isToday' => $cursor->isToday(),
                    'items' => $itemsByDate->get($dateKey, collect()),
                ];
                $cursor->addDay();
            }
            $weeks[] = $week;
        }

        $prevMonth = $month->copy()->subMonth();
        $nextMonth = $month->copy()->addMonth();

        return view('calendar.index', compact('month', 'weeks', 'prevMonth', 'nextMonth', 'type'));
    }
}
