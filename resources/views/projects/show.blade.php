<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Projeto') }}
        </h2>
    </x-slot>
    <div class="max-w-2xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h3 class="text-lg font-bold mb-2">{{ $project->name }}</h3>
            <p class="mb-2"><span class="font-semibold">Status:</span> {{ ucfirst($project->status) }}</p>
            <p class="mb-2"><span class="font-semibold">Data de Início:</span> {{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}</p>
            <p class="mb-2"><span class="font-semibold">Descrição:</span> {{ $project->description ?? '-' }}</p>
            <div class="flex space-x-2 mt-4">
                <a href="{{ route('home') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">Voltar</a>
                <a href="{{ route('projects.edit', $project) }}" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-2 px-4 rounded">Editar</a>
                <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este projeto?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> 