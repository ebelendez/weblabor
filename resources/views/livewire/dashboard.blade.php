<div class="py-12">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Proyectos
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-3">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                Bienvenido(a) {{Auth::user()->name}}
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <section>
                    @if(session()->has('success'))
                        <div class="relative flex flex-col sm:flex-row sm:items-center bg-gray-200 dark:bg-green-700 shadow rounded-md py-5 pl-6 pr-8 sm:pr-6 mb-3 mt-3">
                            <div class="flex flex-row items-center border-b sm:border-b-0 w-full sm:w-auto pb-4 sm:pb-0">
                                <div class="text-green-500" dark:text-gray-500>
                                    <svg class="w-6 sm:w-5 h-6 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div class="text-sm font-medium ml-3">Success!.</div>
                            </div>
                            <div class="text-sm tracking-wide text-gray-500 dark:text-white mt-4 sm:mt-0 sm:ml-4"> {{ session('success') }}</div>
                            <div class="absolute sm:relative sm:top-auto sm:right-auto ml-auto right-4 top-4 text-gray-400 hover:text-gray-800 cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </div>
                        </div>
                    @endif
                    <div class="my-4">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:click="create">Add Post</button>
                    </div>
                    @if($isOpen)
                        <div class="fixed inset-0 flex items-center justify-center z-50">
                            <div class="absolute inset-0 bg-black opacity-50"></div>
                            <div class="relative bg-gray-200 p-8 rounded shadow-lg w-1/2">
                                <!-- Modal content goes here -->
                                <svg wire:click.prevent="$set('isOpen', false)"
                                     class="ml-auto w-6 h-6 text-gray-900 dark:text-gray-900 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                                </svg>
                                <h2 class="text-2xl font-bold mb-4">{{ $postId ? 'Modificar Proyecto' : 'Agregar Proyecto' }}</h2>
                                <form wire:submit.prevent="{{ $postId ? 'update' : 'store' }}">
                                    <div class="mb-4">
                                        <label for="titulo" class="block text-gray-700 font-bold mb-2">Título:</label>
                                        <input type="text" wire:model="titulo" id="titulo" class="w-full border border-gray-300 px-4 py-2 rounded">
                                        <span class="text-red-500">@error('titulo') {{ $message }} @enderror</span>
                                    </div>
                                    <div class="mb-4">
                                        <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripcion:</label>
                                        <textarea wire:model="descripcion" id="descripcion" rows="4" class="w-full border border-gray-300 px-4 py-2 rounded"></textarea>
                                        <span class="text-red-500">@error('descripcion') {{ $message }} @enderror</span>
                                    </div>
                                    <div class="mb-4">
                                        <label for="descripcion" class="block text-gray-700 font-bold mb-2">Estatus:</label>
                                        <select id="publico" wire:model="publico" class="w-full border border-gray-300 px-4 py-2 rounded">
                                            <option value="">Seleccionar</option>
                                            <option value="1">Público</option>
                                            <option value="0">Borrador</option>
                                        </select>
                                        <span class="text-red-500">@error('publico') {{ $message }} @enderror</span>
                                    </div>
                                    <div class="mb-4">
                                        <input type="file" wire:model="imagen">
                                        <span class="text-red-500">@error('imagen') {{ $message }} @enderror</span>
                                    </div>
                                    <div class="mb-4">
                                        @if($postId && $imagen)
                                        <a href="{{url('storage/imagenes/'.$imagen)}}" target="_blank">
                                            <img src="{{url('storage/imagenes/'.$imagen)}}" width="100">
                                        </a>
                                        @endif
                                    </div>
                                    <div class="flex justify-end">

                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">{{ $postId ? 'Modificar' : 'Agregar' }}</button>
                                        <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" wire:click="closeModal">Cancel</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    @endif
                </section>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-3">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Imagen
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Usuario
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Publico
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Body
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    @forelse ($posts as $post)
                        <tbody wire:key="{{ $post->id }}>
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$post->titulo}}
                        </th>
                        <td class="px-6 py-4">
                            @if($post->imagen)
                                <a href="{{url('storage/imagenes/'.$post->imagen)}}" target="_blank"><img src="{{url('storage/imagenes/'.$post->imagen)}}" width="50"></a>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{$post->user->name}}
                        </td>
                        <td class="px-6 py-4">
                            {{$post->publico}}
                        </td>
                        <td class="px-6 py-4">
                            {{$post->descripcion}}
                        </td>

                        <td class="px-6 py-4">
                            <button class="" wire:click="edit({{ $post->id }})" {{$post->user_id != Auth::id() ? 'disabled' : ''}}>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-2 mt-0 w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                            </button>

                            <button class="" onclick="return confirm('¿Está seguro de eliminar este Proyecto?') || event.stopImmediatePropagation()" wire:click="delete({{ $post->id }})" {{$post->user_id != Auth::id() ? 'disabled' : ''}}>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-2 mt-0 w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>

                            </button>

                        </td>
                        </tr>

                        </tbody>
                    @empty
                        <p>No existen registros.</p>
                    @endforelse
                </table>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>

