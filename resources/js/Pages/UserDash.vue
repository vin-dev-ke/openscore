<template>
    <Head title="Dashboard" />

    <!-- Forum -->
    <!-- Header -->
    <header class="bg-orange-600 text-white">
        <h1 class="font-bold text-green-500 text-3xl uppercase ml-2 mb-0">Open<span class="text-black">score</span></h1>
        <span class="ml-3 text-white text-2xl font-semibold flex items-center justify-center uppercase">Scam Reports Forum</span>
    </header>

    <!-- Forum Content -->
    <main class="container mx-auto px-4 py-8 grid grid-cols-2 gap-2 lg:gap-8">
      
      <!-- First Column -->
      <div>
        <div class="grid grid-rows-2 gap-2">
          <div class="row-span-1">  
            <!-- User Profile -->
            <h2 class="text-xl font-semibold mb-4 uppercase inline-flex">
              <span class="underline">{{ user.name }}</span> 
              <span class="ml-2 lowercase">Profile</span>
            </h2>
              <span class="ml-2 inline-flex text-xs px-3 bg-green-200 text-gray-800 rounded-full">
                    {{ user.deleted_at ? 'Deactivated' : 'Active user' }}
              </span>
          </div>
  
          <h1 class="mb-2 font-semibold text-2xl ml-2">Make a Quick Scam Report</h1>
          
          <div class="row-span-1 -mt-26">
            <div class="bg-white shadow-md rounded px-8 pt-2 pb-8 mb-4 flex flex-col">
            
              <form @submit.prevent="submit" enctype="multipart/form-data">
                <div class="-mx-3 md:flex mb-6">
  
                  <!-- Contact -->
                  <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="inline-flex uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-contact">
                      Phone/Email
                    </label><span class="text-red-500">*</span>
                    <input v-model="form.contact" name="contact" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-contact" type="text" placeholder="scammer's contact" autocomplete="OFF" required>
                    <div v-if="form.errors.contact" v-text="form.errors.contact" class="text-red-500 text-sm mt-2" required></div>      
                  </div>
  
                  <!-- Payment mode used -->
                  <div class="md:w-1/2 px-3">
                    <label class="inline-flex uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-payment">
                      Payment mode used
                    </label>
                    <input v-model="form.payment" name="payment" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-payment" type="text" placeholder="e.g PayPal" autocomplete="OFF">
                    <div v-if="form.errors.payment" v-text="form.errors.payment" class="text-red-500 text-sm mt-2" required></div>      
                  </div>
                </div>
  
                <!-- Content -->
                <div class="-mx-3 md:flex mb-6">
                  <div class="md:w-full px-3">
                    <label class="inline-flex uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-password">
                      Description
                    </label><span class="text-red-500">*</span>
                    <textarea v-model="form.content" name="content" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" id="grid-content" type="text" rows="3" required></textarea>
                    <p class="text-grey-dark text-xs italic">Tell us what happened</p>
                    <div v-if="form.errors.content" v-text="form.errors.content" class="text-red-500 text-sm mt-2" required></div>      
                  </div>
                </div>
  
                <!-- Upload file -->
                <div class="-mx-3 md:flex mb-2">
                    <div class="mb-3">
                    <label
                    for="formFile"
                    class="mb-2 inline-block text-neutral-700 dark:text-neutral-200"
                    >Upload supporting document:</label>
                    <input
                    @change="handleFileUpload"
                    class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                    type="file"
                    name="file_id"
                    id="formFile" />
                    </div>
                </div>
  
                <!-- Save/Cancel buttons -->
                <div class="flex justify-between">
                  <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                    Cancel
                  </button>
                  <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
                    Report scammer
                  </button>
                </div>
            </form>  
            </div>
          </div>
        </div>
      </div>
        
      <!-- Second Column -->
      <div>
        <h1 class="font-semibold text-2xl leading-5 uppercase text-gray-500">Recent scam reports</h1>
        <div v-for="(scam,index) in scams.data" :key="index" class="py-8 flex flex-wrap md:flex-nowrap">
          <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
            <span class="font-semibold title-font text-gray-700 uppercase">{{ scam.user.name }}</span>
            <span class="mt-1 text-gray-500 text-sm">{{ formatDate(scam.created_at) }}</span>
          </div>
          <div class="md:flex-grow">
            <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{ scam.contact }}</h2>
            <p class="leading-relaxed">{{ scam.content }}</p>
            
            <!-- Payment method & Attachments -->
            <div class="flex items-center mt-3">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
              </svg> 
              <span class="ml-2">{{ scam.payment }}</span>
            </div>

            <div class="flex items-center ml-40 mt-3">
              <!-- Comment icon -->
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
              </svg>
  
              <!-- Share icon -->
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
              </svg>
            </div>
          </div>
        </div>

        <!-- Paginator -->
      <div class="order-last mt-4 p-2">
        <Link 
          v-for="(link,key) in scams.links" 
          :key="key"
          :href="link.url" 
          v-html="link.label"
          class="px-1"
          :class="link.url ? '' : 'text-gray-400'"
          />
      </div>
      </div>

    </main>
</template>

<script>
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import moment from 'moment';
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        Head, Link
    },
    props: {
      user: Object,
      errors: Object,
      scams: Object,
      scamPost: Object,
    },
    setup() {
        const form = useForm({
            contact: '',
            content: '',
            payment: '',
            file_id: null,
        });

        return { form };
    },
    methods:{
      handleFileUpload (event) {
        this.form.file_id = event.target.files[0];
      },
      async submit () {
        try {
          const formData = new FormData();
          formData.append('contact', this.form.contact);
          formData.append('content', this.form.content);
          formData.append('payment', this.form.payment);
          formData.append('file_id', this.form.file_id);

        await this.form.post('/scams', formData);

        // Form submission successful, do any necessary redirects or show success message
      } catch (error) {
        // Handle any errors during form submission
      }      
      },
      formatDate(date) {
        return moment(date).fromNow();
      },
    }
}
</script>