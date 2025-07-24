<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Projeto') }}
        </h2>
    </x-slot>
    <div class="flex justify-center items-center min-h-[60vh] py-10">
        <form action="{{ route('projects.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 w-full max-w-md">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nome</label>
                <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('name') }}" required>
                @error('name')<div class="text-red-500 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Descrição</label>
                <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description') }}</textarea>
                @error('description')<div class="text-red-500 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Selecione</option>
                    <option value="andamento" {{ old('status') == 'andamento' ? 'selected' : '' }}>Andamento</option>
                    <option value="pendente" {{ old('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                    <option value="concluido" {{ old('status') == 'concluido' ? 'selected' : '' }}>Concluído</option>
                </select>
                @error('status')<div class="text-red-500 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-6">
                <label for="start_date" class="block text-gray-700 text-sm font-bold mb-2">Data de Início</label>
                <input type="date" name="start_date" id="start_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('start_date') }}" required>
                @error('start_date')<div class="text-red-500 text-xs mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Criar Projeto</button>
                <a href="{{ route('home') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout> 