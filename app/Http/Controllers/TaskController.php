<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Show all + search (supports ?q= and keeps pagination)
    public function index(Request $request)
    {
        $q = trim($request->query('q', ''));

        $tasks = Task::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('title', 'like', "%{$q}%")
                        ->orWhere('description', 'like', "%{$q}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->appends(['q' => $q]);

        return view('tasks.index', compact('tasks', 'q'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_completed'=> ['sometimes', 'boolean'],
            'due_date'    => ['nullable', 'date'],
        ]);

        // checkbox may be missing if unchecked
        $data['is_completed'] = (bool) $request->boolean('is_completed');

        Task::create($data);

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_completed'=> ['sometimes', 'boolean'],
            'due_date'    => ['nullable', 'date'],
        ]);

        $data['is_completed'] = (bool) $request->boolean('is_completed');

        $task->update($data);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
}
