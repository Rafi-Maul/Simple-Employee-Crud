<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
<div class="max-w-5xl mx-auto py-6 px-4">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Manajemen Pegawai</h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Tambah Pegawai --}}
    <form action="{{ route('employee.store') }}" method="POST" class="flex flex-wrap gap-4 items-end mb-6">
        @csrf
        <div class="w-full sm:w-1/2">
            <label class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm px-2 py-2" required>
        </div>
        <div class="w-full sm:w-1/2">
            <label class="block text-sm font-medium text-gray-700">Role</label>
            <input type="text" name="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm px-2 py-2" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Tambah Pegawai
        </button>
    </form>

    {{-- Tabel Pegawai --}}
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($employees as $employee)
                <tr>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900">{{ $employee->name }}</td>
                    <td class="px-4 py-2 text-sm text-gray-600">{{ $employee->role }}</td>
                    <td class="px-4 py-2 text-right text-sm space-x-2">
                        {{-- Form Update --}}
                        <form action="{{ route('employee.update', $employee->id) }}" method="POST" class="inline-flex gap-2 items-center">
                            @csrf
                            @method('PUT')
                            <input type="text" name="name" value="{{ $employee->name }}" class="border rounded px-2 py-1 text-sm w-24" required>
                            <input type="text" name="role" value="{{ $employee->role }}" class="border rounded px-2 py-1 text-sm w-24" required>
                            <button type="submit" class="text-indigo-600 hover:text-indigo-900 text-sm">Update</button>
                        </form>

                        {{-- Form Delete --}}
                        <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-3 text-center text-sm text-gray-500">Belum ada data pegawai.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>