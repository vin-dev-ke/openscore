<template>
<<<<<<< HEAD
    <!-- <AppLayout title="Dashboard"> -->
=======
    <AppLayout title="Dashboard">
>>>>>>> 45b0c05 (Set up google auth and auth screens)
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template> -->
<<<<<<< HEAD
        
    <!-- </AppLayout> -->
    <section>
    <Head title="Dashboard" />
        <!-- Content for admin role -->
        <div v-if="role === 'admin'">
          <AdminDash/>
=======
    <div class="py-12">
        <!-- Content for admin role -->
        <div v-if="role === 'admin'">
          <h1>Welcome Admin!</h1>
>>>>>>> 45b0c05 (Set up google auth and auth screens)
        </div>

        <!-- Content for other roles -->
        <div v-else>
          <h1>Welcome User!</h1>
        </div>
<<<<<<< HEAD
    </section>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import AdminDash from './AdminDash.vue';
import { Head } from '@inertiajs/vue3';
=======
    </div>
    </AppLayout>
</template>
<script>
>>>>>>> 45b0c05 (Set up google auth and auth screens)
export default {
    props: {
        role: String,
    },
<<<<<<< HEAD
    components: {
        AdminDash, Head
    }
=======
>>>>>>> 45b0c05 (Set up google auth and auth screens)
}
</script>
