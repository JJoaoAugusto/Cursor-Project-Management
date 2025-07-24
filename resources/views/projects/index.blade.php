<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Meus Projetos') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex justify-end mb-4">
            <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-900 transition shadow">Novo Projeto</a>
        </div>
        @if(session('success'))
            <div class="mb-4 font-medium text-sm text-green-600">{{ session('success') }}</div>
        @endif
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data de Início</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($projects as $project)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $project->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($project->status) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                                <a href="{{ route('projects.show', $project) }}" class="inline-flex items-center px-3 py-1 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 text-xs">Ver</a>
                                <a href="{{ route('projects.edit', $project) }}" class="inline-flex items-center px-3 py-1 bg-yellow-400 text-gray-900 rounded hover:bg-yellow-500 text-xs">Editar</a>
                                <button type="button" onclick="openDeleteModal('{{ $project->id }}')" class="inline-flex items-center px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs">Excluir</button>
                                <form id="delete-form-{{ $project->id }}" action="{{ route('projects.destroy', $project) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Nenhum projeto encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Modal de confirmação de exclusão -->
        <div id="delete-modal" class="fixed z-10 inset-0 overflow-y-auto hidden">
            <div class="flex items-center justify-center min-h-screen px-4 py-8">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-auto p-6 relative z-20">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900 text-center">Confirmar Exclusão</h3>
                    <div class="mt-2 text-center">
                        <p class="text-sm text-gray-500">Tem certeza que deseja excluir este projeto? Esta ação não poderá ser desfeita.</p>
                    </div>
                    <div class="mt-5 flex justify-center space-x-4">
                        <button type="button" id="confirm-delete-btn" class="inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-red-600 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">Excluir</button>
                        <button type="button" onclick="closeDeleteModal()" class="inline-flex justify-center rounded-md border border-gray-300 px-4 py-2 bg-white text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            let projectToDelete = null;
            function openDeleteModal(projectId) {
                projectToDelete = projectId;
                document.getElementById('delete-modal').classList.remove('hidden');
            }
            function closeDeleteModal() {
                projectToDelete = null;
                document.getElementById('delete-modal').classList.add('hidden');
            }
            document.getElementById('confirm-delete-btn')?.addEventListener('click', function() {
                if (projectToDelete) {
                    document.getElementById('delete-form-' + projectToDelete).submit();
                }
            });
        </script>
    </div>
</x-app-layout> 