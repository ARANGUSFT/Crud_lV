<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Chirps') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('chirps.update', $chirp ) }}" method="POST">
                        @csrf @method('PUT')


                        <input type="text" name="task" value="{{ old('task', $chirp->task) }}" placeholder="{{ __('Insert task name') }}">
                        
                        {{-- Muestra la validacion --}}
                        <x-input-error :messages="$errors->get('task')" class="mt-2" />



                        {{-- Tiene el name, y tambien el old que hace que una vez la validacion no se borre el contenido --}}
                        <textarea name="message" placeholder="{{ __('Whats on your mind?') }}"  
                          class="block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 dark:focus:ring-indigo200 dark:focus:ring-opacity-50"
                          >{{ old('message', $chirp->message) }}
                        </textarea>

                        {{-- Muestra la validacion --}}
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />



                        {{-- Muestra el boton --}}
                        <x-primary-button class="mt-4">
                            {{ __('Chirp') }}
                        </x-primary-button>

                    </form>

                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
