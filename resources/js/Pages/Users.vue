<template>
    <Head title="Users" />
    <SideNav/>

    <div class="flex flex-col max-w-7xl ml-80 mt-20 justify-center items-center py-6 sm:px-6 lg:px-8">
      <h1 class="leading-5 font-bold text-green-400 mb-4 uppercase text-3xl">User management records</h1>

    <!-- Search field -->
    <div class="flex md:flex-nowrap flex-wrap justify-start items-end md:justify-start mb-3 mt-3">
      <div class="relative sm:w-64 w-40 sm:mr-4 mr-2">
        <input v-model="search_term" @keyup="search" name="search" type="text" autocomplete="off" placeholder="Search" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:ring-2 focus:bg-transparent focus:ring-indigo-200 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      </div>
    </div>

      <!-- Users datatable -->
      <table class="overflow-x-auto table-auto shadow-lg bg-white">
      <thead>
      <tr>
        <th class="bg-green-100 border text-left px-8 py-4">#</th>
        <th class="bg-green-100 border text-left px-8 py-4">Name</th>
        <th class="bg-green-100 border text-left px-8 py-4">Date created</th>
        <th class="bg-green-100 border text-left px-8 py-4">Status</th>
        <th class="bg-green-100 border text-left px-8 py-4">Actions</th>
      </tr>
    </thead>

    <tbody>
      <!-- table rows go here -->
      <tr v-for="(user,index) in users.data" :key="index">
        <td class="px-8 py-4">{{ user.id }}</td>
        <td class="px-8 py-4">{{ user.name }}</td>
        <td class="px-8 py-4">{{ formatDate(user.created_at) }}</td>
        <td class="px-8 py-4 whitespace-nowrap">
          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
            {{ user.deleted_at ? 'Deleted' : 'Active' }}
          </span>
        </td>
        <td class="px-8 py-4">
            <!-- <button class="ml-2 focus:outline-none" @click="showButtons = !showButtons">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                </svg>
            </button> -->

            <!-- Actions Buttons -->
            <!-- <div class="mt-2 bg-white" v-if="showButtons"> -->

          <div class="relative">
            <button @click="toggleSection(user)" class="bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </button>

            <!-- Section to show/hide -->
            <div class="absolute mt-4 mb-5 ml-12" v-show="showSection[user.id]">
              <div class="relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md shadow-green-400 transform -skew-y-2">
                <div class="p-6">
                  <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                    {{ user.name }}
                  </h5>
                  <p class="block font-sans text-base font-light leading-relaxed text-inherit antialiased">
                    No. of posts: <span class="font-bold">2</span>
                  </p>
                </div>
              </div>
            </div>
          </div>

              <!-- Restore user -->
              <Link v-if="user.deleted_at" :href="route('users.restore', {id: user.id})" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 w-full text-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
              </Link>

              <!-- Delete user -->
              <button @click="deleteUser(user)" v-else class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 w-full text-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
              </button>
            <!-- </div> -->
        </td>
      </tr>
    </tbody>
      </table>

      <!-- Paginator -->
      <div class="order-last mt-4 p-2">
        <Link 
          v-for="(link,key) in users.links" 
          :key="key"
          :href="link.url" 
          v-html="link.label"
          class="px-1"
          :class="link.url ? '' : 'text-gray-400'"
          />
      </div>

    </div>
</template>
<script>
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import SideNav from './SideNav.vue';
import moment from 'moment';
import _ from 'lodash';

export default {
    components: {
        Head, SideNav, Link
    },
    data() {
      return {
          search_term: '',
          showSection: {},
        };
    },
    props: {
        users: Object,
    },    
    methods: {
      search: _.throttle(function () {
          this.$inertia.replace(this.route('users.index',{search_term: this.search_term}))
      }, 200),
      formatDate(date) {
        return moment(date).fromNow();
      },
      deleteUser(user) {
        this.$inertia.delete(`/users/${user.id}`)
      },
      toggleSection(user) {
        this.showSection[user.id] = !this.showSection[user.id];
      }
    },
}
</script>