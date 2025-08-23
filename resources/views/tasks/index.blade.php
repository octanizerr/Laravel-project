@extends('layouts.app')

@section('title','Tasks')

@section('content')
  <div class="flex items-center justify-between gap-4 mb-4">
    <form method="GET" action="{{ route('tasks.index') }}" class="flex gap-2 w-full">
      <input
        type="text"
        name="q"
        value="{{ $q ?? '' }}"
        placeholder="Search title or description..."
        class="flex-1 px-3 py-2 rounded-xl border"
      >
      <button class="px-4 py-2 rounded-xl bg-slate-800 text-white">Search</button>
      @if(!empty($q))
        <a href="{{ route('tasks.index') }}" class="px-3 py-2 rounded-xl border">Clear</a>
      @endif
    </form>
  </div>

  <div class="overflow-x-auto bg-white rounded-2xl shadow">
    <table class="min-w-full border-collapse">
      <thead class="bg-slate-100">
        <tr>
          <th class="text-left p-3">Title</th>
          <th class="text-left p-3">Due</th>
          <th class="text-left p-3">Status</th>
          <th class="text-right p-3">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($tasks as $task)
          <tr class="border-t">
            <td class="p-3">
              <a href="{{ route('tasks.show', $task) }}" class="font-medium hover:underline">
                {{ $task->title }}
              </a>
              @if($task->description)
                <div class="text-slate-500 text-sm line-clamp-1">{{ $task->description }}</div>
              @endif
            </td>
            <td class="p-3">{{ optional($task->due_date)->format('Y-m-d') ?? '—' }}</td>
            <td class="p-3">
              @if($task->is_completed)
                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Completed</span>
              @else
                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">Pending</span>
              @endif
            </td>
            <td class="p-3 text-right space-x-2">
              <a href="{{ route('tasks.edit', $task) }}" class="px-3 py-1 rounded-lg border">Edit</a>
              <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline"
                    onsubmit="return confirm('Delete this task?')">
                @csrf
                @method('DELETE')
                <button class="px-3 py-1 rounded-lg bg-red-600 text-white">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="p-6 text-center text-slate-500">No tasks found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $tasks->links() }}
  </div>
@endsection
