<template>
    <nav>
        <ul class="flex space-x-6">
            <!-- <li><NavLink class="mr-4 text-black-500 hover:text-green-500 hover:text-2xl hover:underline hover:underline-offset-8" :active="$page.component === 'Welcome'" href="/">Home</NavLink></li> -->
            <li><NavLink class="mr-4 font-light text-black-500 hover:text-green-500 hover:text-2xl hover:underline hover:underline-offset-8" :active="$page.component === 'About'" href="/about">About</NavLink></li>
            <li><NavLink class="mr-4 font-light text-black-500 hover:text-green-500 hover:text-2xl hover:underline hover:underline-offset-8" :active="$page.component === 'HowItWorks'" href="/how-it-works">How it works</NavLink></li>
            <li><NavLink class="mr-4 font-light text-black-500 hover:text-green-500 hover:text-2xl hover:underline hover:underline-offset-8" :active="$page.component === 'Faq'" href="/faq">FAQ</NavLink></li>
            <li><NavLink class="mr-4 font-light text-black-500 hover:text-green-500 hover:text-2xl hover:underline hover:underline-offset-8" :active="$page.component === 'Contact'" href="/contact">Contact</NavLink></li>
            <!-- <li><NavLink class="mr-4 text-black-500 hover:text-green-500 hover:underline hover:decoration-3" href="/logout" method="post" as="button">Logout</NavLink></li> -->
        </ul>
    </nav>
</template>
<script>
import NavLink from '../Shared/NavLink.vue';
export default {
  components: {
    NavLink
  }  
};
</script>