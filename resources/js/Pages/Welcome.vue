<template>
    <!-- Header section -->
    <section>
        <Head title="Welcome" />
        <header class="text-gray-600 body-font top-0">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap p-5 flex-col md:flex-row items-center">
                <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                  <!-- Logo -->
                  <img src="/OS.png" alt="logo" class="h-12 w-12"/>

                  <span class="ml-2 text-2xl uppercase text-green-500 font-bold">
                    <span class="text-black">Open</span>Score
                  </span>
                </a>
                <nav class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center">
                    <Link class="mr-5 hover:text-green-500" href="#about">About</Link>
                    <Link class="mr-5 hover:text-green-500" href="#how-it-works">How it Works</Link>
                    <Link class="mr-5 hover:text-green-500" href="#faq">FAQ</Link>
                    <Link class="mr-5 hover:text-green-500" href="#contact">Contact us</Link>
                </nav>

                <div v-if="canLogin" class="top-0 sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                    <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                    Dashboard</Link>

                    <template v-else>
                        <Link :href="route('login')"
                            class="font-bold sm:mb-2 md:mb-2 px-5 py-3 border-green-500 bg-white text-black border-2 hover:text-gray-900 dark:text-green-400 dark:hover:text-green-500 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        Log in</Link>

                        <Link v-if="canRegister" :href="route('register')"
                            class="ml-4 text-white bg-green-500 px-5 py-3 hover:text-gray-900 dark:text-white dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        Register</Link>
                    </template>
                </div>
                </div>
        </header>
    </section>
    <!-- End Header section -->

    <!-- About section -->
    <section class="text-gray-600 body-font" id="about">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-20">
                <h1 class="sm:text-3xl text-2xl font-bold title-font mb-4 text-gray-900">About <span class="uppercase"> OpenScore</span></h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Use the power of the crowd to fight fraud. Share what you know about scammers.</p>
            </div>
            <div class="flex flex-wrap -m-4 text-center">
                <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
                    <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" class="text-green-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
                            <path d="M8 17l4 4 4-4m-4-5v9"></path>
                            <path d="M20.88 18.09A5 5 0 0018 9h-1.26A8 8 0 103 16.29"></path>
                        </svg>
                        <h2 class="title-font font-medium text-3xl text-gray-900">{{ scamsCount }}</h2>
                        <p class="leading-relaxed">Scam reports</p>
                    </div>
                </div>
                <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
                    <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" class="text-green-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 00-3-3.87m-4-12a4 4 0 010 7.75"></path>
                        </svg>
                        <h2 class="title-font font-medium text-3xl text-gray-900">{{ usersCount }}</h2>
                        <p class="leading-relaxed">Users</p>
                    </div>
                </div>
                <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
                    <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" class="text-green-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
                            <path d="M3 18v-6a9 9 0 0118 0v6"></path>
                            <path
                                d="M21 19a2 2 0 01-2 2h-1a2 2 0 01-2-2v-3a2 2 0 012-2h3zM3 19a2 2 0 002 2h1a2 2 0 002-2v-3a2 2 0 00-2-2H3z">
                            </path>
                        </svg>
                        <h2 class="title-font font-medium text-3xl text-gray-900">{{ filesCount }}</h2>
                        <p class="leading-relaxed">Files</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About section -->

    <!-- How it works section -->
    <section class="text-gray-600 body-font" id="how-it-works">
    <h1 class="sm:text-4xl text-2xl text-center font-semibold title-font mb-4 text-green-500">How it works</h1>
    <div class="container px-5 py-10 mx-auto flex flex-wrap">
        <div class="flex relative pt-10 pb-20 sm:items-center md:w-2/3 mx-auto">
          <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
            <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
          </div>
          <div class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center bg-green-500 text-white relative z-10 title-font font-medium text-sm">1</div>
          <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
            <div class="flex-shrink-0 w-24 h-24 bg-green-100 text-indigo-500 rounded-full inline-flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="gray" class="w-12 h-12">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
              </svg>
            </div>
            <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
              <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">Create an account</h2>
              <p class="leading-relaxed">You can choose to <Link :href="route('register')" class="text-green-500 underline font-semibold text-lg">register</Link> with Google, Facebook, or a username and password.</p>
            </div>
          </div>
        </div>
        <div class="flex relative pb-20 sm:items-center md:w-2/3 mx-auto">
          <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
            <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
          </div>
          <div class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center bg-green-500 text-white relative z-10 title-font font-medium text-sm">2</div>
          <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
            <div class="flex-shrink-0 w-24 h-24 bg-green-100 text-indigo-500 rounded-full inline-flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="gray" class="w-12 h-12">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
              </svg>
            </div>
            <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
              <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">Share your information</h2>
              <p class="leading-relaxed">Once you are logged in, you can enter all the details you know about a scammer, including their contact details. You can also upload documents or screenshots to support your claims.</p>
            </div>
          </div>
        </div>
        <div class="flex relative pb-20 sm:items-center md:w-2/3 mx-auto">
          <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
            <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
          </div>
          <div class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center bg-green-500 text-white relative z-10 title-font font-medium text-sm">3</div>
          <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
            <div class="flex-shrink-0 w-24 h-24 bg-green-100 text-green-500 rounded-full inline-flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="gray" class="w-12 h-12">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
            <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
              <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">Publicize your information</h2>
              <p class="leading-relaxed">Once you have submitted your information, it will be published on our website.</p>
            </div>
          </div>
        </div>
    </div>
    </section>
    <!-- End How it works section -->

    <!-- FAQ section -->
    <section id="faq" class="dark:bg-gray-800 dark:text-gray-100">
      <div class="container flex flex-col justify-center items-center px-4 py-8 mx-auto md:p-8">
        <h2 class="text-2xl font-semibold sm:text-4xl text-green-500">Frequently Asked Questions</h2>
        <p class="mt-4 mb-8 dark:text-gray-400">Find answers to your questions about our service here.</p>
        <div class="space-y-4">
          <details class="w-full border rounded-lg" open>
            <summary class="px-4 py-6 focus:outline-none focus-visible:ring-violet-400">Is the service free?</summary>
            <p class="px-4 py-6 pt-0 ml-4 -mt-4 text-gray-500 dark:text-gray-400">Yes, our service is free to use. We do not charge any fees for registering an account, sharing information, or accessing our resources.</p>
          </details>
          <details class="w-full border rounded-lg">
            <summary class="px-4 py-6 focus:outline-none focus-visible:ring-violet-400">Are there physical tracking, reporting, and legal services offered?</summary>
            <p class="px-4 py-6 pt-0 ml-4 -mt-4 text-gray-500 dark:text-gray-400">Yes, we offer physical tracking, reporting, and legal services through our partner third parties. </p>
          </details>
          <details class="w-full border rounded-lg">
            <summary class="px-4 py-6 focus:outline-none focus-visible:ring-violet-400">Is payment intervention offered? </summary>
            <p class="px-4 py-6 pt-0 ml-4 -mt-4 text-gray-500 dark:text-gray-400">Yes, we offer payment intervention services through our third party partners. If the parties in dispute want to try to reach a settlement, we can link them to a negotiator. </p>
          </details>
        </div>
      </div>
    </section>
    <!-- End FAQ section -->

    <!-- Contact Section -->
    <section class="text-gray-600 body-font relative" id="contact">
      <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-col text-center w-full mb-12">
          <h1 class="sm:text-4xl text-2xl font-semibold title-font mb-4 text-green-500">Reach to us</h1>
          <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Have any concerns? We are here to help.</p>
        </div>
        <div class="lg:w-1/2 md:w-2/3 mx-auto">
          <div class="flex flex-wrap -m-2">
            <div class="p-2 w-1/2">
              <div class="relative">
                <label for="name" class="leading-7 text-sm text-gray-600">Name</label>
                <input type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-orange-500 focus:bg-white focus:ring-2 focus:ring-orange-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
              </div>
            </div>
            <div class="p-2 w-1/2">
              <div class="relative">
                <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                <input type="email" id="email" name="email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-orange-500 focus:bg-white focus:ring-2 focus:ring-orange-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
              </div>
            </div>
            <div class="p-2 w-full">
              <div class="relative">
                <label for="message" class="leading-7 text-sm text-gray-600">Message</label>
                <textarea id="message" name="message" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-orange-500 focus:bg-white focus:ring-2 focus:ring-orange-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
              </div>
            </div>
            <div class="p-2 w-full">
              <button class="flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">Send Message</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Contact Section -->

    <!-- Footer Section-->
    <section>
    <footer class="footer bg-gray-800 relative pt-1 border-b-2 border-green-700">
        <div class="container mx-auto px-6">
            <div class="mt-16 border-t-2 border-gray-400 flex flex-col items-center">
                <div class="text-center py-6">
                    <p class="text-sm text-green-700 font-bold mb-2">
                        © 2023 OPENSCORE
                    </p>
                </div>
            </div>
        </div>
    </footer>
    </section>
    <!-- End Footer Section -->

</template>
<script>
import { Head, Link } from '@inertiajs/vue3';
export default {
    components: {
        Head, Link
    },
    props: {
      canLogin: Boolean,
      canRegister: Boolean,
      laravelVersion: String,
      phpVersion: String,
      usersCount: Number,
      scamsCount: Number,
      filesCount: Number,
    }
  }
// defineProps({
// });
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6499caf9cc26a871b024cc19/1h3sc1o0m';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>