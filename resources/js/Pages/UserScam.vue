<template>
    <Head title="Dashboard" />
    <!-- Header -->
    <header class="bg-orange-600 py-4">
      <div
        class="container mx-auto flex flex-col items-center w-full md:flex-row md:justify-between"
      >
        <Link href="/">
          <div class="flex items-center">
            <img src="/OS.png" alt="logo" class="h-16 w-16 object-contain" />
            <h1 class="font-bold text-green-500 text-3xl uppercase ml-2 mb-0">
              Open<span class="text-black">Score</span>
            </h1>
          </div>
        </Link>
        <h2 class="text-white text-lg font-mono text-3xl uppercase">Scam Reports Forum</h2>
        <nav class="space-x-4 md:flex md:items-center md:space-x-4 mt-4 md:mt-0">
          <Link :href="route('profile.show')" class="text-black hover:text-white"
            >Profile Settings</Link
          >
          <Link
            :href="route('logout')"
            method="post"
            as="button"
            class="text-black hover:text-white"
            >Sign out</Link
          >
        </nav>
      </div>
    </header>
  
    <!-- Forum Content -->
    <main
      class="container mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-2 gap-2 lg:gap-8"
    >
      <!-- Second Column -->
      <div>
        <div class="grid grid-rows-2 gap-2">
          <h1 class="font-semibold text-2xl leading-5 uppercase text-gray-500">
            Scam Report
          </h1>
  
          <!-- 1st row -->
          <div class="row-span-1">
          </div>
  
          <!-- Second row -->
          <div class="row-span-1">
            <!-- Scams List -->
            <div
              v-for="scam in scams.data"
              :key="scam.id"
              class="py-2 flex flex-wrap md:flex-nowrap"
            >
              <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                <span class="font-semibold title-font text-gray-700 uppercase">{{
                  scam.user.name
                }}</span>
                <span class="mt-1 text-gray-500 text-sm">{{
                  formatDate(scam.created_at)
                }}</span>
              </div>
              <div class="md:flex-grow">
                <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">
                  {{ hideMiddleFour(scam.contact) }}
                  <span
                    class="inline-flex text-xs px-3 bg-yellow-200 text-gray-800 rounded-full"
                  >
                    {{ scam.country }}</span
                  >
                </h2>
                <p
                  v-if="scam.description"
                  class="leading-relaxed p-4 bg-gray-200 text-red-700 font-semibold"
                >
                  {{ scam.description }}
                </p>
  
                <!--Name of scammer-->
                <div v-if="scam.scammer_name" class="flex items-center mt-2">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-4 h-4"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"
                    />
                  </svg>
                  <span class="ml-2">{{ scam.scammer_name }}</span>
                </div>
  
                <!-- Scam platform -->
                <div
                  v-if="scam.platform || scam.scam_activity"
                  class="flex items-center mt-2"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-4 h-4"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"
                    />
                  </svg>
                  <span class="ml-2">{{ scam.platform }}, {{ scam.scam_activity }}</span>
                </div>
  
                <!-- Payment method icon -->
                <div v-if="scam.payment" class="flex items-center mt-3">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-4 h-4"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"
                    />
                  </svg>
                  <span class="ml-2">{{ scam.payment }}</span>
                </div>
  
                <!--Amount conned-->
                <div v-if="scam.amount" class="flex items-center mt-3">
                  <div class="flex items-center w-full">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="w-4 h-4 text-yellow-800"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                      />
                    </svg>
                    <span class="ml-1">Amount lost in USD:</span>
                    <span
                      class="ml-1 bg-yellow-900 text-gray-200 px-2 py-1 rounded font-bold"
                      >{{ scam.amount }}</span
                    >
                  </div>
                </div>
  
                <!-- File attachment icon -->
                <div v-if="scam.file" class="flex items-center mt-2">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-4 h-4"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"
                    />
                  </svg>
                  <span class="ml-2">{{ scam.file }}</span>
                </div>
  
                <div class="flex items-center ml-60 mt-3">
                  <!-- Delete icon -->
                  <button
                    v-if="scam.user_id === user.id"
                    @click="deletePost(scam.id)"
                    class="focus:outline-none ml-2"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="w-6 h-6"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                      />
                    </svg>
                  </button>
                </div>
              </div>
              <!-- Comments Modal -->
              <div
                v-if="showCommentBox && selectedPostId === scam.id"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
              >
                <div class="bg-white p-4 rounded-lg w-96 relative mt-8 mx-auto my-auto">
                  <!--Modal close button -->
                  <button
                    class="absolute top-0 right-0 -mt-3 -mr-3 text-black text-3xl hover:text-3xl focus:outline-none bg-transparent"
                    @click="closeModal"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      class="h-6 w-6 transition-transform transform-gpu hover:scale-125"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                      ></path>
                    </svg>
                  </button>
  
                  <!-- Comment box form -->
                  <form @submit.prevent="sendComment(selectedPostId)">
                    <textarea
                      v-model="newComment"
                      cols="20"
                      rows="3"
                      class="w-full border border-gray-300 p-2 rounded-lg mb-2"
                    ></textarea>
                    <button
                      type="submit"
                      class="bg-orange-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg mb-3"
                    >
                      Comment
                    </button>
                  </form>
  
                  <!-- Display existing comments or "No comments" message -->
                  <div v-if="comments && comments.length > 0">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                      <div
                        v-for="comment in comments"
                        :key="comment.id"
                        class="relative bg-white border border-gray-300 p-4 shadow-md rounded-lg mb-4"
                      >
                        <div class="flex justify-between items-center">
                          <p class="text-xs text-gray-400">
                            {{ comment.user.name }}
                          </p>
                          <p class="text-xs">
                            {{ formatDate(comment.updated_at) }}
                          </p>
                        </div>
                        <p class="text-gray-800 mt-2 font-bold">
                          {{ comment.content }}
                        </p>
                        <!-- Delete comment -->
                        <div class="flex justify-end mt-3 absolute bottom-0 right-0">
                          <button
                            v-if="comment.user_id === user.id"
                            @click="deleteComment(comment.id)"
                            class="focus:outline-none"
                          >
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke-width="1.5"
                              stroke="currentColor"
                              class="w-5 h-5"
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"
                              />
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
          </div>
        </div>
      </div>
    </main>
  </template>
  
  <script>
  import axios from "axios";
  import { Head } from "@inertiajs/vue3";
  import { useForm } from "@inertiajs/vue3";
  import moment from "moment";
  import { Link } from "@inertiajs/vue3";
  import _ from "lodash";
  import { countries } from "countries-list";
  
  export default {
    components: {
      Head,
      Link,
    },
    props: {
      user: Object,
      errors: Object,
      scams: Object,
      scamPost: Object,
      myScams: Number,
      comments: Object,
    },
    data() {
      return {
          showCommentBox: true,
          selectedPostId: null,
          newComment: "",
      };
    },
    watch: {
      search_term(newVal) {
        // Focus the search input if there is any value
        if (newVal !== "") {
          this.$refs.searchInput.focus();
        }
      },
    },
    methods: {
      hideMiddleFour(contact) {
        if (contact.includes("@")) {
          const [username, domain] = contact.split("@");
          const hiddenUsername = `${username.substring(
            0,
            Math.floor(username.length / 2)
          )}*${username.substring(Math.ceil(username.length / 2))}`;
          // return '${hiddenUsername}@${domain}';
          return contact;
        } else {
          const length = contact.length;
          const hiddenDigits = length > 6 ? "*" : "**";
          return (
            contact.substring(0, length - 4) + hiddenDigits + contact.substring(length - 1)
          );
        }
      },
      closeModal() {
        this.showCommentBox = false;
        this.selectedPostId = null;
        this.newComment = ""; // Clear the form input
        this.$inertia.get(this.route("dashboard"));
      },
      formatDate(date) {
        return moment(date).fromNow();
      },
      onFileChange(event) {
        this.form.file = event.target.files[0];
      },
  
      async sharePost(postId, scammersname, description) {

        // Get the URL for the scam
        const url = `/scams/${postId}`;
        
        const shareData = {
          title: `Scammed by ${scammersname}`,
          text: `${description}`,
          url: url,
        };

        alert("running data");
        try {
          await navigator.share(shareData);
          resultPara.textContent = "the scam post shared successfully";
        } catch (err) {
          resultPara.textContent = `Error: ${err}`;
        }

        shareData(shareData)
  
        // Open a new browser window with the URL for the scam
        // window.open(url, '_blank');
      },
      async shareData(shareData) {
        alert("running data");
        try {
          await navigator.share(shareData);
          resultPara.textContent = "the scam post shared successfully";
        } catch (err) {
          resultPara.textContent = `Error: ${err}`;
        }
      },
      formatDate(date) {
        return moment(date).fromNow();
      },
      deletePost(postId) {
        const confirmed = confirm("Are you sure you want to delete the resource?");
        if (confirmed) {
          this.$inertia
            .delete(this.route("scams.destroy", { scam: postId }))
            .then(() => {
              // Handle successful deletion
              alert("Scam deleted successfully!");
            })
            .catch((error) => {
              // Handle error during deletion
              alert("An error occurred while deleting the post", error);
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
          this.$inertia.visit(this.route("comments", { id: postId }), {
            preserveScroll: true,
            preserveState: true,
            only: ["comments"],
            onSuccess: (response) => {
              const comments = response.props.comments;
              console.log(comments);
              //this.comments = comments;
            },
            onError: (error) => {
              console.error("Er ror loading comments:", error);
            },
          });
        } catch (error) {
          console.error("Error loading method:", error);
        }
      },
      sendComment(postId) {
        if (this.selectedPostId === postId) {
          this.$inertia.post('/scams/${postId}/comments', {
            content: this.newComment,
            scam_id: postId,
            user_id: this.user.id,
          });
          this.newComment = "";
        } else {
          console.log("Not the right post!");
        }
      },
      deleteComment(postId) {
        const confirmed = confirm("Are you sure you want to delete this comment?");
  
        if (confirmed) {
          this.$inertia
            .delete(this.route("comments.destroy", { id: postId }))
            .then(() => {
              // Handle successful deletion
              alert("Comment deleted successfully!");
            })
            .catch((error) => {
              // Handle error during deletion
              alert("An error occurred while deleting the comment", error);
            });
        }
      },
    },
  };
  </script>