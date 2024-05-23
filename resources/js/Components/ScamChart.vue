<template>
    <div>
      <chart :data="scamsData" type="bar"></chart>
    </div>
  </template>
  
  <script>
  import { Bar } from '@chartkick/chartkick';
  
  export default {
    name: 'ScamChart',
    components: {
      chart: Bar,
    },
    data() {
      return {
        scamsData: [],
      };
    },
    mounted() {
      this.fetchScams();
    },
    methods: {
      async fetchScams() {
        try {
          const response = await axios.get('/api/scams');
          this.scamsData = response.data.map(scam => ({
            scammer_name: scam.scammer_name,
            amount: scam.amount,
          }));
        } catch (error) {
          console.error('Failed to fetch scams:', error);
        }
      },
    },
  };
  </script>
  