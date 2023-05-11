<template>
    <Head title="Scam Reports" />
    <SideNav/>

    <h1 class="flex items-center justify-center mt-8 mb-4 text-2xl font-semibold text-green-400 uppercase">All scam posts</h1>
    <div class="flex max-w-7xl ml-80 mt-4 justify-center items-center py-6 sm:px-6 lg:px-8">
      <div class="flex justify-between text-gray-600 body-font" v-for="(scam,index) in scams.data" :key="index">
        <div class="bg-gray-100 bg-opacity-75 px-8 pt-16 pb-24 rounded-lg overflow-hidden text-center relative ml-4">
            <h1 class="title-font sm:text-2xl text-xl font-medium text-gray-900 mb-3">{{ scam.title }}</h1>
            <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">By Test user</h2>
                <p class="leading-relaxed mb-3">{{ scam.content }} </p>
          <div class="text-center mt-2 leading-none flex justify-center absolute bottom-0 left-0 w-full py-4">
            <span class="text-gray-400 mr-3 inline-flex items-center leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
              <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>1.2K
            </span>
            <span class="text-gray-400 inline-flex items-center leading-none text-sm">
              <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
              </svg>6
            </span>
          </div>
        </div>
      </div>
    </div>
    <!-- Paginator -->
    <div class="order-last mt-4 p-2 flex max-w-7xl ml-80 mt-4 justify-center items-center py-6 sm:px-6 lg:px-8">
     <Link 
       v-for="(link,key) in scams.links" 
       :key="key"
       :href="link.url" 
       v-html="link.label"
       class="px-1"
       :class="link.url ? '' : 'text-gray-400'"
       />
    </div>

</template>
<script>
import SideNav from './SideNav.vue';
import { Head, Link } from '@inertiajs/vue3';
export default {
    components: {
        SideNav, Head, Link
    },
    props: {
      scams: Object,
    }
}
</script>