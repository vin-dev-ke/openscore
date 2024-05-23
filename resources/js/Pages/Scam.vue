<template>
    <Head title="Scam Reports" />
    <SideNav />

    <div class="flex flex-col items-center justify-center mt-8 mb-2">
        <h1 class="mb-4 text-2xl font-semibold text-green-400 uppercase">
            All scam posts
        </h1>

        <!-- Search field -->
        <div
            class="flex md:flex-nowrap flex-wrap justify-start items-end md:justify-start mb-3 mt-3"
        >
            <div class="relative sm:w-64 w-40 sm:mr-4 mr-2">
                <input
                    v-model="search_term"
                    @keyup="search"
                    name="search"
                    type="text"
                    autocomplete="off"
                    placeholder="Search by email or phone"
                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:ring-2 focus:bg-transparent focus:ring-indigo-200 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                />
            </div>
        </div>
    </div>

    <div class="flex ml-80 py-6 max-w-7xl mx-auto mt-4 px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Iterate through scams.data -->
            <div v-for="(scam, index) in scams.data" :key="index">
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <!-- Scam Contact -->
                    <div class="bg-gray-900 text-white px-4 py-2">
                        <h1 class="text-xl font-medium">{{ scam.contact }}</h1>
                        <p class="text-xs">By {{ scam.user.name }}</p>
                    </div>
                    <!-- Scam Content -->
                    <div class="p-4">
                        <p class="text-gray-700 leading-relaxed">
                            {{ scam.description }}
                        </p>
                    </div>
                    <!-- Scam Comments Count -->
                    <div class="bg-gray-200 p-2 flex justify-end items-center">
                        <span class="text-gray-500 text-sm">
                            <svg
                                class="w-4 h-4 mr-1 inline-block"
                                stroke="currentColor"
                                stroke-width="2"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"
                                ></path>
                            </svg>
                            {{ scam.comments_count }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Paginator -->
    <div
        class="order-last mt-4 p-2 flex max-w-7xl ml-80 justify-center items-center py-6 sm:px-6 lg:px-8"
    >
        <Link
            v-for="(link, key) in scams.links"
            :key="key"
            :href="link.url"
            v-html="link.label"
            class="px-1"
            :class="link.url ? '' : 'text-gray-400'"
        />
    </div>
</template>
<script>
import SideNav from "./SideNav.vue";
import { Head, Link } from "@inertiajs/vue3";
import _ from "lodash";

export default {
    components: {
        SideNav,
        Head,
        Link,
    },
    props: {
        scams: Object,
    },
    data() {
        return {
            search_term: "",
        };
    },
    methods: {
        search: _.throttle(function () {
            this.$inertia.replace(
                this.route("scams.index", { search_term: this.search_term })
            );
        }, 200),
    },
};
</script>
