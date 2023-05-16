<template>
    <section class="bg-green-500">
            <div class="sidebar fixed top-0 bottom-0 lg:order-1 lg:left-0 p-2 sm:w-auto md:w-20 md:flex-col sm:flex-col lg:w-[300px] overflow-y-auto text-center bg-green-500">
                <div class="text-gray-100 text-xl">
                    <Link href="/">
                        <div class="p-2.5 mt-1 flex items-center">
                            <h1 class="font-bold text-black text-3xl uppercase">Open<span class="text-white">score</span></h1>
                        </div>
                    </Link>
                </div>
    
                <!-- Dashboard -->
                <Link :href="route('dashboard')">
                    <div class="p-2.5 mt-5 flex items-center rounded-md py-3 px-4 duration-300 cursor-pointer text-white hover:bg-orange-500">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span class="text-black font-bold text-lg ml-4">Dashboard</span>
                    </div>
                </Link>
    
                <!-- Users -->
                <Link href="/users">                
                    <div class="p-2.5 mt-5 flex items-center rounded-md py-3 px-4 duration-300 cursor-pointer text-white hover:bg-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>
                        <span class="text-black font-bold text-lg ml-4">Users</span>
                    </div>
                </Link>
    
                <!-- Con Posts -->
                <Link href="/scams">  
                    <div class="p-2.5 mb-2 mt-5 flex items-center rounded-md py-3 px-4 duration-300 cursor-pointer text-white hover:bg-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                        </svg>
                        <span class="text-black font-bold text-lg ml-4">Scams</span>
                    </div>
                </Link>
    
                <!-- Media files -->
                <!-- <Link href="/media"> 
                    <div class="p-2.5 mt-5 flex items-center rounded-md py-3 px-4 duration-300 cursor-pointer text-white hover:bg-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 004.5 9.75v7.5a2.25 2.25 0 002.25 2.25h7.5a2.25 2.25 0 002.25-2.25v-7.5a2.25 2.25 0 00-2.25-2.25h-.75m0-3l-3-3m0 0l-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 012.25 2.25v7.5a2.25 2.25 0 01-2.25 2.25h-7.5a2.25 2.25 0 01-2.25-2.25v-.75" />
                        </svg>
                        <span class="text-black font-bold text-lg ml-4">Media files</span>
                    </div>
                </Link> -->
                
                <div class="border-b border-gray-200 opacity-50"></div>
    
                 <!-- Profile -->
                 <Link :href="route('profile.show')">
                    <div class="p-2.5 mt-5 flex items-center rounded-md py-3 px-4 duration-300 cursor-pointer text-white hover:bg-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-black font-bold text-lg ml-4">Profile settings</span>
                    </div>
                </Link>

                <!-- Logout -->
            <div class="flex justify-start">
                <Link :href="route('logout')" method="post" as="button">
                    <div class="mt-5 flex items-center rounded-md py-3 px-4 duration-300 cursor-pointer text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                        <span class="text-black font-bold text-lg ml-4">Sign out</span>
                    </div>
                </Link>
            </div>
            </div>
    </section>
</template>
<script>
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        Link
    }, 
}
</script>