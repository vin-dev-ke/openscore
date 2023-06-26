<template>
    <Head title="Dashboard" />

    <!-- Header -->
    <header class="bg-orange-600 py-4">
    <div class="container mx-auto flex flex-col items-center w-full md:flex-row md:justify-between">
      <Link href="/">
        <div class="flex items-center">
          <img src="/OS.png" alt="logo" class="h-16 w-16 object-contain"/>
          <h1 class="font-bold text-green-500 text-3xl uppercase ml-2 mb-0">Open<span class="text-black">Score</span></h1>
        </div>
      </Link>
      <h2 class="text-white text-lg font-mono text-3xl uppercase">Scam Reports Forum</h2>
      <nav class="space-x-4 md:flex md:items-center md:space-x-4 mt-4 md:mt-0">
        <Link :href="route('profile.show')" class="text-black hover:text-white">Profile Settings</Link>
        <Link :href="route('logout')" method="post" as="button" class="text-black hover:text-white">Sign out</Link>
      </nav>
    </div>
    </header>

    <!-- Forum Content -->
    <main class="container mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-2 gap-2 lg:gap-8">
      
        <!-- First Column -->
        <div>
          <div class="grid grid-rows-2 gap-2">
            <div class="row-span-1">  
              <!-- User Profile -->
              <h2 class="text-xl font-semibold mb-4 uppercase inline-flex">
                <span class="underline">{{ user.name }}</span> 
                <span class="ml-2 lowercase">Profile</span>
              </h2>

              <span class="flex flex-wrap ml-2 inline-flex text-xs px-3 bg-green-200 text-gray-800 rounded-full">
                    {{ user.deleted_at ? 'Deactivated' : 'Active user' }}
              </span>
              <span class="flex flex-wrap ml-2 inline-flex text-xs px-3 bg-gray-200 text-gray-800 rounded-full">
                  <span class="font-bold mr-1">{{ myScams }}</span> posted scams
              </span>
            </div>
    
            <h1 class="mb-2 font-semibold text-2xl ml-2">Make a Quick Scam Report</h1>
            
            <div class="row-span-1 -mt-26">
              <div class="bg-green-200 shadow-lg rounded px-8 pt-2 pb-8 mb-4 flex flex-col">
                
                <!-- Display success message -->
                <div v-if="isFormSubmitted" class="bg-green-500 text-white px-4 py-2 rounded">
                  <p>{{ successMessage }}</p>
                </div>
                
                <!-- Display error message if there's an error -->
                <div v-if="errorMessage" class="bg-red-500 text-white px-4 py-2 rounded">
                  <p>{{ errorMessage }}</p>
                </div>
  
                <form @submit.prevent="submitScam">
                  <div class="-mx-3 md:flex mb-6">
    
                    <!-- Contact -->
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="inline-flex uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-contact">
                        Phone/Email used by scammer
                      </label><span class="text-red-500">*</span>
                      <input v-model="form.contact" name="contact" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-contact" type="text" placeholder="scammer's contact" autocomplete="OFF" required>
                      <div v-if="errors.contact" v-text="form.errors.contact" class="text-red-500 text-sm mt-2" required></div>      
                    </div>
    
                    <!-- Payment mode used -->
                    <div class="md:w-1/2 px-3">
                      <label class="inline-flex uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-payment">
                        Payment mode used
                      </label>
                      <input v-model="form.payment" name="payment" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-payment" type="text" placeholder="e.g PayPal" autocomplete="OFF">
                      <div v-if="errors.payment" v-text="form.errors.payment" class="text-red-500 text-sm mt-2" required></div>      
                    </div>
                  </div>
    
                  <!-- Content -->
                  <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-full px-3">
                      <label class="inline-flex uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-password">
                        Description
                      </label><span class="text-red-500">*</span>
                      <textarea v-model="form.content" name="content" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" id="grid-content" type="text" rows="3" required></textarea>
                      <p class="text-grey-dark text-xs italic">Tell us what happened in brief</p>
                      <div v-if="errors.content" v-text="form.errors.content" class="text-red-500 text-sm mt-2" required></div>      
                    </div>
                  </div>
    
                  <div class="-mx-3 md:flex mb-2">
                         
                    <!-- Country -->
                    <div class="mb-3 px-3">
                      <label class="inline-flex uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-country">
                        Country where scam happened
                      </label>
                      <input v-model="form.country" name="country" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-2" id="grid-country" type="text" placeholder="e.g Kenya" autocomplete="OFF">
                      <div v-if="errors.country" v-text="form.errors.country" class="text-red-500 text-sm mt-2" required></div>      
                    </div>
  
                      <!-- Upload file -->                  
                    <div class="mb-3">
                      <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-black" for="default_size">Upload single supporting document</label>
                      <input @input="form.file = $event.target.files[0]" type="file" name="file" class="block w-full mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="default_size"/>
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
          <div class="grid grid-rows-2 gap-2">
  
          <h1 class="font-semibold text-2xl leading-5 uppercase text-gray-500">Recent scam reports</h1>
  
            <!-- 1st row -->
            <div class="row-span-1">
              <!-- Search field -->
              <div class="flex md:flex-nowrap flex-wrap justify-start items-end md:justify-start mb-3 mt-1">
                <div class="relative sm:w-64 w-40 sm:mr-4 mr-2">
                  <input v-model="search_term" @keyup="search" name="search_term" type="text" autocomplete="off" placeholder="Search by scammer's phone/email" class="w-80 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:ring-2 focus:bg-transparent focus:ring-indigo-200 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
              </div>
            </div>
    
            <!-- Second row -->
            <div class="row-span-1">
    
              <!-- Scams List -->
              <div v-for="scam in scams.data" :key="scam.id" class="py-2 flex flex-wrap md:flex-nowrap">
                <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                  <span class="font-semibold title-font text-gray-700 uppercase">{{ scam.user.name }}</span>
                  <span class="mt-1 text-gray-500 text-sm">{{ formatDate(scam.created_at) }}</span>
                </div>
                <div class="md:flex-grow">
                  <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{ hideMiddleFour(scam.contact) }}
                    <span class="inline-flex text-xs px-3 bg-yellow-200 text-gray-800 rounded-full"> {{ scam.country }}</span>
                  </h2>
                  <p class="leading-relaxed">{{ scam.content }}</p>
                  
                  <!-- Payment method icon -->
                  <div class="flex items-center mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                    </svg> 
                    <span class="ml-2">{{ scam.payment }}</span>
                  </div>
      
                  <!-- File attachment icon -->
                  <div v-if="scam.file" class="flex items-center mt-2">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                      </svg>
                    <span class="ml-2">{{ scam.file }}</span>
                  </div>
      
                  <div class="flex items-center ml-60 mt-3">
                    <!-- Comment icon -->
                    <button @click="toggleComments(scam.id)" class="focus:outline-none">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                      </svg>
                    </button>
      
                    <!-- Delete icon -->
                    <button v-if="scam.user_id === user.id" @click="deletePost(scam.id)" class="focus:outline-none ml-2">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                      </svg>
                    </button>
      
                    <!-- Share icon -->
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                    </svg> -->
                  </div>
                </div>
                <!-- Comments Modal -->
                <div v-if="showCommentBox && selectedPostId === scam.id" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                  <div class="bg-white p-4 rounded-lg w-96 relative mt-8 mx-auto my-auto">
                    
                    <!--Modal close button -->
                    <button class="absolute top-0 right-0 -mt-3 -mr-3 text-black text-3xl hover:text-3xl focus:outline-none bg-transparent" @click="closeModal">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 transition-transform transform-gpu hover:scale-125">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                      </svg>
                    </button>
        
                    <!-- Comment box form -->
                    <form @submit.prevent="sendComment(selectedPostId)">
                      <textarea v-model="newComment" cols="20" rows="3" class="w-full border border-gray-300 p-2 rounded-lg mb-2"></textarea>
                      <button type="submit" class="bg-orange-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg mb-3">Comment</button>
                    </form>
        
                    <!-- Display existing comments or "No comments" message -->
                    <div v-if="comments && comments.length > 0">
                      <div class="grid grid-cols-3 gap-4">
                        <div v-for="comment in comments" :key="comment.id" class="relative border border-gray-300 p-2 rounded-lg mb-2">
                          <div class="flex justify-between items-center">
                            <p class="text-xs text-gray-400">{{ comment.user.name }}</p>
                            <p class="text-xs">{{ formatDate(comment.updated_at) }}</p>
                          </div>
                          <p class="text-gray-800 mt-2 font-bold">{{ comment.content }}</p> 
                          <!-- Delete comment -->
                          <div class="flex justify-end mt-3 absolute bottom-0 right-0">
                            <button v-if="comment.user_id === user.id" @click="deleteComment(comment.id)" class="focus:outline-none">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                              </svg>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div v-else>
                      <span class="text-gray-400 text-md">No comments for this post</span>
                    </div>
                  </div>
                </div>
              </div>
      
      
                <!-- Paginator -->
              <div class="order-last mt-4 p-2 flex items-center justify-center">
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
          </div>
        </div>
      
    </main>
</template>

<script>
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import moment from 'moment';
import { Link } from '@inertiajs/vue3';
import _ from 'lodash';

export default {
    components: {
        Head, Link
    },
    props: {
      user: Object,
      errors: Object,
      scams: Object,
      scamPost: Object,
      myScams: Number,
    },
    setup() {
        const form = useForm({
            contact: '',
            content: '',
            payment: '',
            country: '',
            file: null,
        });
        return { form };
    },
    data() {
      return {
        search_term: '',
        showCommentBox: true,
        comments: [],
        selectedPostId: null,
        postId: null,
        newComment: '',
        successMessage: '',
        errorMessage: '',
        isFormSubmitted: false,
      };
    },
    methods:{
      search: _.throttle(function () {
          this.$inertia.get(this.route('dashboard',{search_term: this.search_term}))
      }, 200),
      hideMiddleFour(contact) {
        if (contact.includes('@')) {
          const [username, domain] = contact.split('@');
          const hiddenUsername = `${username.substring(0, Math.floor(username.length / 2))}***${username.substring(Math.ceil(username.length / 2))}`;
          return `${hiddenUsername}@${domain}`;
        } else {
          const length = contact.length;
          const hiddenDigits = length > 6 ? '***' : '**';
          return contact.substring(0, length - 4) + hiddenDigits + contact.substring(length - 1);
        }
      },
      closeModal() {
        this.showCommentBox = false;
        this.selectedPostId = null;
        this.newComment = ''; // Clear the form input
        this.$inertia.get(this.route('dashboard'));
      },
      formatDate(date) {
        return moment(date).fromNow();
      },
      async submitScam () {
        try {
          const formData = new FormData();
          formData.append('contact', this.form.contact);
          formData.append('content', this.form.content);
          formData.append('payment', this.form.payment);
          formData.append('country', this.form.country);
          formData.append('file', this.form.file);

        await this.$inertia.post(route('scams.store'), formData);

          // Clear form fields
        this.form = {
          contact: '',
          content: '',
          payment: '',
          country: '',
          file: null,
        };

        // Set success message and flag
        this.successMessage = 'Form submitted successfully.';
        this.isFormSubmitted = true;

        // Clear success message after 3 seconds
        setTimeout(() => {
          this.successMessage = '';
          this.isFormSubmitted = false;
        }, 3000);

         // Reload the page
        this.$inertia.reload();

      } catch (error) {
        // Handle any errors during form submission
        this.errorMessage = 'An error occurred while submitting the form. Please try again!';
      }      
      },
      formatDate(date) {
        return moment(date).fromNow();
      },
      deletePost(postId){
        const confirmed = confirm('Are you sure you want to delete the resource?');
        
        if (confirmed) {
          this.$inertia.delete(this.route('scams.destroy', {scam : postId }))
          .then(() => {
            // Handle successful deletion
            alert('Scam deleted successfully!');
          })
          .catch((error) => {
            // Handle error during deletion
            alert('An error occurred while deleting the post', error);
          });
        }
      },
      toggleComments(postId) {
        if (this.selectedPostId === postId && this.showCommentBox) {
        // If comment box is already open for the selected post, close it
          this.showCommentBox = false;
          this.selectedPostId = null;
        } else {
        // Otherwise, load comments for the selected post
          this.selectedPostId = postId;
          this.showCommentBox = true;
          this.loadComments(postId);

          // Start the timer to call closeModal after 2 minutes (120000 milliseconds)
          setTimeout(this.closeModal, 120000);
        }
      },
      loadComments(postId) {
        try {
          this.$inertia.visit(this.route('comments', { id: postId }), {
            preserveScroll: true,
            preserveState: true,
            only: ['comments'],
            onSuccess: (response) => {
              const comments = response.props.comments;
              this.comments = comments;
            },
            onError: (error) => {
              console.error('Error loading comments:', error);
            },
          });
        } catch (error) {
          console.error('Error loading method:', error);
        }
      },
      sendComment(postId) {
        if (this.selectedPostId === postId) {
          this.$inertia.post(`/scams/${postId}/comments`, {
            content: this.newComment,
            scam_id: postId,
            user_id: this.user.id,
          })
          .then((response) => {
            console.log(response);
            //update comment data with the new comment
            this.comments = response.data.comments;
            //update the new comment field
            this.newComment = '';
          })
          .catch((error) => {
            console.log(error);
          });
        } else {
          console.log('Not the right post!');
        }
      },
      deleteComment(postId) {
        const confirmed = confirm('Are you sure you want to delete this comment?');
        
        if (confirmed) {
          this.$inertia.delete(this.route('comments.destroy', {id : postId }))
          .then(() => {
            // Handle successful deletion
            alert('Comment deleted successfully!');
          })
          .catch((error) => {
            // Handle error during deletion
            alert('An error occurred while deleting the comment', error);
          });
        }
      },
    }
}
</script>