<template>
    <section>
        <Head title="Welcome" />
        <header class="text-gray-600 body-font">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap p-5 flex-col md:flex-row items-center">
                <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-green-500 rounded-full"
                        viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                    <span class="ml-3 text-2xl uppercase text-green-500 font-bold"><span class="text-black">Open</span>Score</span>
                </a>
                <nav class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center">
                    <a class="mr-5 hover:text-green-500">About</a>
                    <a class="mr-5 hover:text-green-500">How it Works</a>
                    <a class="mr-5 hover:text-green-500">FAQ</a>
                    <a class="mr-5 hover:text-green-500">Contact us</a>
                </nav>
    
                <!-- <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"> -->
                <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                    <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                    Dashboard</Link>
    
                    <template v-else>
                        <Link :href="route('login')"
                            class="sm:mb-2 md:mb-2 px-5 py-3 border-green-500 bg-white text-green-500 border-2 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        Log in</Link>
    
                        <Link v-if="canRegister" :href="route('register')"
                            class="ml-4 text-white bg-green-500 px-5 py-3 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        Register</Link>
                    </template>
                </div>
                <!-- </div> -->
            </div>
        </header>
    </section>
</template>
<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>