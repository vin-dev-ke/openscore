<template>
  <Head title="Dashboard" />

  <SideNav/>
  <div class="grid grid-cols-2 gap-4 ml-80 mt-5 mb-5">  
      <!-- Users card -->
      <div class="px-5 py-3 mt-5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <a href="#">
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white uppercase">total users</h5>
          </a>
          <a href="#" class="inline-flex mt-8 items-center px-7 py-5 text-sm font-medium text-center text-white bg-black rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-blue-800">
          {{ users_count }}
          </a>
      </div>
  
      <!-- Con Posts card -->
      <div class="mr-5 px-5 py-3 mt-5 bg-orange-200 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <a href="#">
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white uppercase">all scam posts</h5>
          </a>
          <a href="#" class="inline-flex mt-8 items-center px-7 py-5 text-sm font-medium text-center text-white bg-black rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-blue-800">
              {{ scams_count }}
          </a>
      </div>
  </div>
  <BarChart />
</template>

<script>
import SideNav from './SideNav.vue';
import { Head } from '@inertiajs/vue3';
import BarChart from './BarChart.vue';

export default {
  components: {
    SideNav, Head, BarChart
  },
  props:{
    users_count: Number,
    scams_count: Number,
  }
}
</script>
