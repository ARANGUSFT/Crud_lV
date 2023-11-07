<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chirps') }}
        </h2>
    </x-slot>

    <style>
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
          background-color: rgb(204, 205, 206)
        }
        
        td{
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
        }

        th{
            border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
        }
        
        tr:nth-child(even) {
          background-color: #ffffff;
        }
        </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                       
                    <form action="{{ route('chirps.store') }}" method="POST">
                        @csrf


                        <input type="text" name="task" placeholder="{{ __('Insert task name') }}" >

                            {{-- Muestra la validacion --}}
                            <x-input-error :messages="$errors->get('task')" class="mt-2" />



                        {{-- Tiene el name, y tambien el old que hace que una vez la validacion no se borre el contenido --}}
                        <textarea name="message" 
                                  placeholder="{{ __('Whats on your mind?') }}"  
                                  class="block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 dark:focus:ring-indigo200 dark:focus:ring-opacity-50"
                        >{{ old('message') }}</textarea>

                            {{-- Muestra la validacion --}}
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />



                        {{-- Muestra el boton --}}
                        <x-primary-button class="mt-4">
                            {{ __('Chirp') }}
                        </x-primary-button>
                    </form>

                    
                </div>
            </div><br>


            <table>
              
                <tr>
                  <th>Usuario</th>
                  <th>Nombre Tarea</th>
                  <th>Mensaje</th>
                  <th>Acciones</th>
                </tr>

                @foreach($chirps as $datos )
                 <tr>
                    {{-- Para llamar el nombre se deben ajustar unas cosas en el modelo --}}
                    <th>{{ $datos->user->name }}</th>
                    <td>{{ $datos->task }}</td>
                    <td>{{ $datos->message }}</td>
                    <td><a href="{{ route('chirps.edit', $datos) }}">{{ __('Edit Tarea') }}</a>

                     <form method="POST" action="{{ route('chirps.destroy', $datos) }}">
                        @csrf @method('DELETE')
                        {{-- <td><a href="{{ route('chirps.destroy', $datos) }}" onclick="event.preventDefault(); this.closest('form').submit();" >{{ __('Delete Task') }}</a></td> --}}
                       <button type="submit" class="btn btn-danger">{{ __('Delete Task') }}</button>
                     </form>

                    </td>
                  
                    
                 </tr>
                @endforeach

            </table> 


        </div>
    </div>
</x-app-layout>
