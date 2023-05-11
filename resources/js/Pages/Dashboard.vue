<template>
<<<<<<< HEAD
<<<<<<< HEAD
    <!-- <AppLayout title="Dashboard"> -->
=======
    <AppLayout title="Dashboard">
>>>>>>> 45b0c05 (Set up google auth and auth screens)
=======
    <!-- <AppLayout title="Dashboard"> -->
>>>>>>> 4494bb2 (Add users and scams sections for admin)
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template> -->
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 4494bb2 (Add users and scams sections for admin)
        
    <!-- </AppLayout> -->
    <section>
    <Head title="Dashboard" />
<<<<<<< HEAD
        <!-- Content for admin role -->
        <div v-if="role === 'admin'">
          <AdminDash/>
=======
    <div class="py-12">
        <!-- Content for admin role -->
        <div v-if="role === 'admin'">
          <h1>Welcome Admin!</h1>
>>>>>>> 45b0c05 (Set up google auth and auth screens)
=======
        <!-- Content for admin role -->
        <div v-if="role === 'admin'">
          <AdminDash/>
>>>>>>> 4494bb2 (Add users and scams sections for admin)
        </div>

        <!-- Content for other roles -->
        <div v-else>
          <h1>Welcome User!</h1>
        </div>
<<<<<<< HEAD
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
=======
    </section>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import AdminDash from './AdminDash.vue';
import { Head } from '@inertiajs/vue3';
>>>>>>> 4494bb2 (Add users and scams sections for admin)
export default {
    props: {
        role: String,
    },
<<<<<<< HEAD
<<<<<<< HEAD
    components: {
        AdminDash, Head
    }
=======
>>>>>>> 45b0c05 (Set up google auth and auth screens)
=======
    components: {
        AdminDash, Head
    }
>>>>>>> 4494bb2 (Add users and scams sections for admin)
}
</script>
