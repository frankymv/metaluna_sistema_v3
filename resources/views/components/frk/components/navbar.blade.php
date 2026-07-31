<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>


<nav class="bg-white border-b border-gray-300">
    <div class="flex justify-between items-center px-9">
        <!-- Aumenté el padding aquí para añadir espacio en los lados -->
        <!-- Ícono de Menú -->
        <button id="menuBtn">
            <i class="fas fa-bars text-orange-500 text-lg"></i>
        </button>

        <div>

        </div>


        <div class="hidden sm:flex sm:items-center  sm:ml-6">


            <x-dropdown alig="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <div class="mr-2">
                            <i class="fas fa-user text-primaryColor text-lg"></i>
                        </div>


                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication -->

                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>

                </x-slot>
            </x-dropdown>
        </div>



    </div>



</nav>
