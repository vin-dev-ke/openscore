<template>

  <Head title="Dashboard" />

  <SideNav v-bind:isAdmin="isAdmin" />
  <div class="grid grid-cols-2 gap-4 ml-80 mt-5 mb-5">  
      <!-- Users card -->
      <div v-if="isAdmin" class="px-5 py-3 mt-5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
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
  <!-- <BarChart /> -->
  <div>
    <!-- <chartkick :type="'bar'" :data="scamsData"></chartkick> -->
    <!-- <chartkick :type="'line'" :data="chartData"></chartkick> -->
    <canvas class="ml-96 mt-20" style="height:40vh; width:80vw" id="commentsOverTimeChart"></canvas>
  </div>
</template>

<script>
import SideNav from './SideNav.vue';
import { Head } from '@inertiajs/vue3';
import BarChart from './BarChart.vue';
import { Chart, registerables } from 'chart.js';
import Chartkick from 'chartkick';

export default {
  name: 'CommentsOverTimeChart',
  components: {
    SideNav, Head, BarChart, Chartkick,
  },
  props: {
    users_count: Number,
    scams_count: Number,
    isAdmin: Boolean,
    scams: Object,
    commentsData: {
      type: Array,
      required: true
    },
  },
  data() {
    return {
      scamsData: [],
      chartData: [
        ['Month', 'Sales'],
        ['Jan', 400],
        ['Feb', 450],
        ['Mar', 500],
        ['Apr', 480],
        ['May', 550],
        ['Jun', 600]
      ],
    };
  },
  mounted() {
    // this.fetchScams();
    const comments = [
      { date: '2023-05-01', count: 10 },
      { date: '2023-05-02', count: 15 },
      { date: '2023-05-03', count: 8 },
      { date: '2023-05-04', count: 12 },
      { date: '2023-05-05', count: 20 },
      { date: '2023-05-06', count: 25 },
      { date: '2023-05-07', count: 18 }
    ];
    this.renderChart(this.commentsData);
  },
  methods: {
    fetchScams() {
      try {
        this.scamsData = this.scams.data.map(scam => ({
          country: scam.country,
          amount: scam.amount,
        }));
      } catch (error) {
        console.error('Failed to fetch scams:', error);
      }
    },
    renderChart(data) {
      const labels = data.map(item => item.date);
      const counts = data.map(item => item.count);

      const ctx = document.getElementById('commentsOverTimeChart').getContext('2d');
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            label: 'Comments Over Time',
            data: counts,
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
          }]
        },
        options: {
          responsive: true,
          scales: {
            x: {
              type: 'time',
              time: {
                unit: 'day'
              }
            },
            y: {
              beginAtZero: true
            }
          }
        }
      });
    },
  },
}
</script>
