<template>
<div class="grid grid-cols-1">
    <!-- Header -->
    <section class="col-span-1 p-6 bg-white-500">
        <header class="container mx-auto flex justify-between fixed">
            <h1 class="font-bold text-3xl text-black uppercase"><span class="text-green-500">Open</span>Score</h1>
            <div class="flex space-x-4">
                <Nav />
            </div>
            <div class="flex space-x-8 mr-4">
                <button class="bg-green-400 py-2 px-6 text-white text-lg rounded-lg hover:border-4 hover:border-white-800">Register</button>
                <button class="bg-white py-2 px-4 text-green-500 text-lg rounded-lg hover:border-4 hover:border-green-300 border-green-300 border-2">Log in</button>
            </div>
        </header>
    </section>

    <!-- Main Content -->
    <section class="col-span-1 p-6">
        <div class="max-w-3xl mx-auto">
            <slot />
        </div>
    </section>

    <!-- Footer -->
    <section class="col-span-1 ">
        <footer
      class="bg-gray-100 text-center lg:text-left">
      <div class="p-4 text-center text-neutral-700">
        © 2023 Copyright:
        <a
          class="text-neutral-800"
          href="https://tailwind-elements.com/"
          >OpenScore</a
        >
      </div>
    </footer>
    </section>

</div>
</template>
<script>
import Nav from '../Shared/Nav.vue';
export default {
    components: { Nav }
};
</script>
