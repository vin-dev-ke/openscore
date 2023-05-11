<template>
    <!-- <AppLayout title="Dashboard"> -->
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template> -->
        
    <!-- </AppLayout> -->
    <section>
    <Head title="Dashboard" />
        <!-- Content for admin role -->
        <div v-if="role === 'admin'">
          <AdminDash/>
        </div>

        <!-- Content for other roles -->
        <div v-else>
          <h1>Welcome User!</h1>
        </div>
    </section>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import AdminDash from './AdminDash.vue';
import { Head } from '@inertiajs/vue3';
export default {
    props: {
        role: String,
    },
    components: {
        AdminDash, Head
    }
}
</script>
