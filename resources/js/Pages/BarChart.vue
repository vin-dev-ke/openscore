<template>
  <h2 class="ml-80 text-2xl font-bold mb-4 mt-8">Scam Reports per month</h2>
  <div class="ml-96 mt-20" style="height:40vh; width:80vw">
    <Bar :data="data" :options="options"  />
  </div>
  </template>
  
  <script lang="ts">
  import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale
  } from 'chart.js'
  import { Bar } from 'vue-chartjs'
  
  ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend)
  
  export default {
    name: 'App',
    components: {
      Bar
    },
    data() {
      return {
        data: {
          labels: ['January', 'February', 'March'],
          datasets: [{ data: [40, 20, 12] }]
        },
        options: {
          responsive: true,
            scales: {
              y: {
                title: {
                  display: true,
                    text: 'No.of scam posts'
              }
            },
              x: {
                title: {
                  display: true,
                    text: 'Months of the year'
                }
              },
          } 
        }
      }
    }
  }
  </script>