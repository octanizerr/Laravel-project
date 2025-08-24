<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title','Tasks')</title>
  {{-- Simple styling via Tailwind CDN (fine for dev) --}}
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800">
  <nav class="bg-white border-b shadow-sm">
    <div class="max-w-5xl mx-auto p-4 flex items-center justify-between">
      <a href="{{ route('tasks.index') }}" class="font-semibold text-lg">Mini Task Manager</a>
      <a href="{{ route('tasks.create') }}"
         class="px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700">New Task</a>
         <li><a href="{{ route('home') }}">Tasks</a></li>
        <a href="{{ route('products.index') }}" class="font-semibold text-lg text-green-600 hover:text-green-800">Mini Market</a>

    </div>
  </nav>

  <main class="max-w-5xl mx-auto p-4">
    @if(session('success'))
      <div class="mb-4 rounded-xl border border-green-200 bg-green-50 p-3">
        {{ session('success') }}
      </div>
    @endif
    @yield('content')
  </main>
</body>
</html>
