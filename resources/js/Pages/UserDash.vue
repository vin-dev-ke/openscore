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
      <!-- First Column -->
      <div>
        <div class="grid grid-rows-2 gap-2">
          <div class="row-span-1">
            <!-- User Profile -->
            <h2 class="text-xl font-semibold mb-4 uppercase inline-flex">
              <span class="underline">{{ user.name }}</span>
              <span class="ml-2 lowercase">Profile</span>
            </h2>
  
            <span
              class="flex flex-wrap ml-2 inline-flex text-xs px-3 bg-green-200 text-gray-800 rounded-full"
            >
              {{ user.deleted_at ? "Deactivated" : "Active user" }}
            </span>
            <span
              class="flex flex-wrap ml-2 inline-flex text-xs px-3 bg-gray-200 text-gray-800 rounded-full"
            >
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
                    <label
                      class="inline-flex uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                      for="grid-contact"
                    >
                      Phone/Email used by scammer
                    </label>
                    <span class="text-red-500">*</span>
                    <input
                      v-model="form.contact"
                      name="contact"
                      class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                      id="grid-contact"
                      type="text"
                      placeholder="scammer's contact"
                      autocomplete="OFF"
                      required
                    />
                    <div
                      v-if="errors.contact"
                      v-text="form.errors.contact"
                      class="text-red-500 text-sm mt-2"
                      required
                    ></div>
                  </div>
  
                  <!-- Payment mode used -->
                  <div class="md:w-1/2 px-3">
                    <label
                      class="inline-flex uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                      for="grid-payment"
                    >
                      Payment mode used
                    </label>
                    <input
                      v-model="form.payment"
                      name="payment"
                      class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4"
                      id="grid-payment"
                      type="text"
                      placeholder="e.g PayPal"
                      autocomplete="OFF"
                    />
                    <div
                      v-if="errors.payment"
                      v-text="form.errors.payment"
                      class="text-red-500 text-sm mt-2"
                      required
                    ></div>
                  </div>
                </div>
  
                <!--Amount and Con person name-->
                <div class="-mx-3 md:flex mb-6">
                  <!--Scammer name-->
                  <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label
                      class="inline-flex uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                      for="grid-scammers-name"
                    >
                      Name of Scammer
                    </label>
                    <input
                      v-model="form.scammer_name"
                      name="scammer_name"
                      class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                      id="grid-scammers-name"
                      type="text"
                      placeholder="scammer's name"
                      autocomplete="OFF"
                    />
                    <div
                      v-if="errors.scammer_name"
                      v-text="form.errors.scammer_name"
                      class="text-red-500 text-sm mt-2"
                    ></div>
                  </div>
  
                  <!--Amount conned-->
                  <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label
                      class="inline-flex uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                      for="grid-amount"
                    >
                      Amount conned
                    </label>
                    <div class="relative">
                      <span
                        class="font-bold absolute inset-y-0 left-0 flex items-center pl-3 pr-2 text-gray-600 bg-gray-300"
                      >
                        USD
                      </span>
                      <input
                        v-model="form.amount"
                        name="amount"
                        type="number"
                        class="appearance-none pl-14 pr-3 py-2 border border-gray-300 focus:outline-none block w-full rounded"
                        placeholder="Enter amount"
                        id="grid-amount"
                        autocomplete="OFF"
                      />
                      <div
                        v-if="errors.amount"
                        v-text="form.errors.amount"
                        class="text-red-500 text-sm mt-2"
                      ></div>
                    </div>
                  </div>
                </div>
  
                <!-- Select lists -->
                <div class="-mx-3 md:flex mb-6">
                  <!-- Type of fake -->
                  <div class="md:w-1/2 px-3">
                    <label
                      class="inline-flex uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                      for="grid-scamtype"
                    >
                      Type of Scam
                    </label>
                    <select
                      id="grid-scamtype"
                      name="scam_activity"
                      v-model="form.selectedActivity"
                      class="w-full appearance-none bg-white border border-gray-300 rounded px-4 py-2 leading-tight focus:outline-none focus:shadow-outline"
                    >
                      <option value="" disabled>Select a scam activity</option>
                      <option value="fakeProduct">Fake products seller</option>
                      <option value="fakeService">Fake service provider</option>
                      <option value="fakeEmployer">Con employer</option>
                      <option value="fakeEmployee">Con employee</option>
                    </select>
                  </div>
  
                  <!-- social media site -->
                  <div class="md:w-1/2 px-3">
                    <label
                      class="inline-flex uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                      for="grid-platform"
                    >
                      Where it happened
                    </label>
                    <select
                      id="grid-platform"
                      name="platform"
                      v-model="form.selectedPlatform"
                      class="w-full appearance-none bg-white border border-gray-300 rounded px-4 py-2 leading-tight focus:outline-none focus:shadow-outline"
                    >
                      <option value="" disabled>Select social media</option>
                      <option value="Instagram">Instagram</option>
                      <option value="Facebook">Facebook</option>
                      <option value="Whatsapp">Whatsapp</option>
                      <option value="Twitter">Twitter</option>
                      <option value="Telegram">Telegram</option>
                      <option value="Tinder">Tinder</option>
                    </select>
                  </div>
                </div>
  
                <!-- Content -->
                <div class="-mx-3 md:flex mb-6">
                  <div class="md:w-full px-3">
                    <label
                      class="inline-flex uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                      for="grid-description"
                    >
                      Description
                    </label>
                    <textarea
                      v-model="form.description"
                      name="description"
                      class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3"
                      id="grid-description"
                      type="text"
                      rows="3"
                      required
                    ></textarea>
                    <p class="text-grey-dark text-xs italic">
                      Tell us what happened in brief
                    </p>
                    <div
                      v-if="errors.description"
                      v-text="form.errors.description"
                      class="text-red-500 text-sm mt-2"
                      required
                    ></div>
                  </div>
                </div>
  
                <div class="-mx-3 md:flex mb-2">
                  <!-- Country -->
                  <div class="mb-3 px-3">
                    <label
                      class="inline-flex uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                      for="grid-country"
                    >
                      Country where scam happened
                    </label>
                    <select
                      v-model="form.country"
                      name="country"
                      class="w-full appearance-none bg-white border border-gray-300 rounded px-4 py-2 leading-tight focus:outline-none focus:shadow-outline"
                      id="grid-country"
                    >
                      <option value="" disabled>Select a country</option>
                      <option
                        v-for="(country, code) in countriesList"
                        :key="code"
                        :value="country"
                      >
                        {{ country }}
                      </option>
                    </select>
                    <div
                      v-if="errors.country"
                      v-text="form.errors.country"
                      class="text-red-500 text-sm mt-2"
                      required
                    ></div>
                  </div>
  
                  <!-- Upload file -->
                  <div class="mb-3">
                    <label
                      class="inline-flex uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                      for="file_id"
                      >Upload single supporting document</label
                    >
                    <input
                      @change="onFileChange"
                      type="file"
                      name="file"
                      class="block w-full mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                      id="file"
                    />
                  </div>
                </div>
                 <!-- Select lists -->
                 <div class="-mx-3 md:flex mb-6">
                  <!-- Type of fake -->
                  <div class="md:w-1/2 px-3">
                    <label
                      class="inline-flex uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                      for="grid-scamtype"
                    >
                      Extra Services
                    </label>
                    <select
                      id="grid-scamtype"
                      ref="legalService"
                      name="legal_service"
                      v-model="legalService"
                      class="w-full appearance-none bg-white border border-gray-300 rounded px-4 py-2 leading-tight focus:outline-none focus:shadow-outline"
                    >
                      <option value="" disabled>Legal Services</option>
                      <option value="fakeProduct">Private investor</option>
                      <option value="fakeService">Negotiator</option>
                      <option value="fakeEmployer">Cousellor</option>
                      <option value="fakeEmployee">Debt colloctor/Auctioneer</option>
                    </select>
                  </div>
  
                  <!-- contacts of the user -->
                  <div v-if="needLegalService" class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label
                      class="inline-flex uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                      for="grid-contact"
                    >
                      Leave your Email or contacts here
                    </label>
                    <span class="text-red-500">*</span>
                    <input
                      v-model="form.contact"
                      name="contact"
                      class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                      id="grid-contact"
                      type="text"
                      placeholder="Your contact"
                      autocomplete="OFF"
                      required
                    />
                    <div
                      v-if="errors.contact"
                      v-text="form.errors.contact"
                      class="text-red-500 text-sm mt-2"
                      required
                    ></div>
                  </div>
                </div>
                <!-- Save/Cancel buttons -->
                <div class="flex justify-between">
                  <button
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full"
                  >
                    Cancel
                  </button>
                  <button
                    type="submit"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full"
                  >
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
          <h1 class="font-semibold text-2xl leading-5 uppercase text-gray-500">
            Recent scam reports
          </h1>
  
          <!-- 1st row -->
          <div class="row-span-1">
            <!-- Search field -->
            <div
              class="flex md:flex-nowrap flex-wrap justify-start items-end md:justify-start mb-3 mt-1"
            >
              <div class="relative sm:w-64 w-40 sm:mr-4 mr-2">
                <input
                  v-model="search_term"
                  @keyup="searchAndFocus"
                  ref="searchInput"
                  name="search_term"
                  type="text"
                  autocomplete="off"
                  placeholder="Search by scammer's phone/email"
                  class="w-80 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:ring-2 focus:bg-transparent focus:ring-indigo-200 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                />
              </div>
            </div>
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
                  <!-- Comment icon -->
                  <button @click="toggleComments(scam.id)" class="focus:outline-none">
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
                        d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"
                      />
                    </svg>
                  </button>
  
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
  
                  <!-- Share icon -->
                  <button @click="sharePost(scam.id, scam.scammer_name, scam.description)" class="focus:outline-none ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
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
                      ref="newComment"
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
  
            <!-- Paginator -->
            <div class="order-last mt-4 p-2 flex items-center justify-center">
              <Link
                v-for="(link, key) in scams.links"
                :key="key"
                :href="link.url"
                v-html="link.label"
                class="px-1"
              />
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
    setup() {
      const form = useForm({
        contact: "",
        description: "",
        payment: "",
        scammer_name: "",
        amount: "",
        selectedActivity: "",
        selectedServices:"",
        selectedPlatform: "",
        country: "",
        file_id: null,
      }); 
  
      return { form };
    },
    data() {
      return {
          form: {
              country: "",
          },
          countriesList: Object.values(countries).map(country => country.name),
          search_term: "",
          showCommentBox: true,
          selectedPostId: null,
          postId: null,
          needLegalService: false,
          legalService: "",
          newComment: "",
          successMessage: "",
          errorMessage: "",
          isFormSubmitted: false,
      };
    },
    watch: {
      search_term(newVal) {
        // Focus the search input if there is any value
        if (newVal !== "") {
          this.$refs.searchInput.focus();
        }
      },
      legalService(newVal) {
        // Focus the search input if there is any value
        if (newVal !== "") {
          this.needLegalService = true;
        } else {
          this.needLegalService = false;
        }
      },
    },
    methods: {
      search: _.throttle(function () {
        // Store the search_term value in localStorage
        localStorage.setItem("search_term", this.search_term);
  
        //   this.$refs.searchInput.focus();
        //   this.$inertia.get(this.route("dashboard", { search_term: this.search_term }));
        //   this.$refs.searchInput.focus();
        this.$inertia.get(this.route("dashboard", { search_term: this.search_term }));
      }, 200),
      focusSearchInput() {
        if (this.$refs.searchInput) {
          this.$refs.searchInput.focus();
        }
      },
      searchAndFocus() {
        this.search();
        this.focusSearchInput();
      },
      hideMiddleFour(contact) {
        if (contact.includes("@")) {
          const [username, domain] = contact.split("@");
          const hiddenUsername = `${username.substring(
            0,
            Math.floor(username.length / 2)
          )}*${username.substring(Math.ceil(username.length / 2))}`;
          return contact
          //return '${hiddenUsername}@${domain}';
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
  
      async submitScam() {
        const formData = new FormData();
        formData.append("contact", this.form.contact);
        formData.append("payment", this.form.payment);
        formData.append("scammer_name", this.form.scammer_name);
        formData.append("amount", this.form.amount);
        formData.append("scam_activity", this.form.selectedActivity);
        formData.append("platform", this.form.selectedPlatform);
        formData.append("description", this.form.description);
        formData.append("country", this.form.country);
        formData.append("file_id", this.form.file_id);
  
        try {
          // Get the CSRF token from the meta tag
          const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
  
          // Set the CSRF token in the request headers
          axios.defaults.headers.common["X-CSRF-TOKEN"] = csrfToken;
  
          // Make the POST request using Axios
          await axios.post("/scams", formData);
  
          // Clear form fields
          this.form = {
            contact: "",
            payment: "",
            scammer_name: "",
            amount: "",
            selectedServices:"",
            selectedActivity: "",
            selectedPlatform: "",
            description: "",
            country: "",
            file_id: null,
          };
  
          // Set success message and flag
          this.successMessage = "Form submitted successfully.";
          this.isFormSubmitted = true;
  
          // Clear success message after 3 seconds
          setTimeout(() => {
            this.successMessage = "";
            this.isFormSubmitted = false;
          }, 3000);
  
          // Reload the page
          this.$inertia.reload();
        } catch (error) {
          // Handle any errors during form submission
          this.errorMessage =
            "An error occurred while submitting the form. Please try again!";
        }
      },
  
      formatDate(date) {
        return moment(date).fromNow();
      },
      
      async sharePost(postId, scammersname, description) {

        // Get the URL for the scam
        const url = `/scams/${postId}`;

        const shareData = {
          title: `Scammed by ${scammersname}`,
          text: `${description}`,
          url: url,
        };
        try {
          await navigator.share(shareData);
          resultPara.textContent = "the scam post shared successfully";
        } catch (err) {
          resultPara.textContent = `Error: ${err}`;
        }
      },
      deletePost(postId) {
        const confirmed = confirm("Are you sure you want to delete the resource?");
  
        if (confirmed) {
        this.$inertia.delete(this.route("comments.destroy", { id: commentId }), {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            // Remove the deleted comment from the comments array
            this.comments = this.comments.filter(comment => comment.id !== commentId);
            alert("Comment deleted successfully!");
          },
          onError: (error) => {
            console.error("Error deleting comment:", error);
            alert("An error occurred while deleting the comment.");
          }
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
              console.error("Error loading comments:", error);
            },
          });
        } catch (error) {
          console.error("Error loading method:", error);
        }
      },
      sendComment(postId) {
        if (this.selectedPostId === postId) {
        this.$inertia.post(`/scams/${postId}/comments`, {
          content: this.newComment,
          scam_id: postId,
          user_id: this.user.id,
        })
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