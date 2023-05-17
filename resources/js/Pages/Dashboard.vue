<template>
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> c5be46e (Fix conflicts)
    <!-- <AppLayout title="Dashboard"> -->
=======
    <AppLayout title="Dashboard">
>>>>>>> 45b0c05 (Set up google auth and auth screens)
<<<<<<< HEAD
=======
    <!-- <AppLayout title="Dashboard"> -->
>>>>>>> 4494bb2 (Add users and scams sections for admin)
=======
>>>>>>> c5be46e (Fix conflicts)
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template> -->
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 4494bb2 (Add users and scams sections for admin)
=======
>>>>>>> c5be46e (Fix conflicts)
        
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
<<<<<<< HEAD
=======
        <!-- Content for admin role -->
        <div v-if="role === 'admin'">
          <AdminDash/>
>>>>>>> 4494bb2 (Add users and scams sections for admin)
=======
>>>>>>> c5be46e (Fix conflicts)
        </div>

        <!-- Content for other roles -->
        <div v-else>
          <h1>Welcome User!</h1>
        </div>
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> c5be46e (Fix conflicts)
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
<<<<<<< HEAD
=======
    </section>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import AdminDash from './AdminDash.vue';
import { Head } from '@inertiajs/vue3';
>>>>>>> 4494bb2 (Add users and scams sections for admin)
=======
>>>>>>> c5be46e (Fix conflicts)
export default {
    props: {
        role: String,
    },
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> c5be46e (Fix conflicts)
    components: {
        AdminDash, Head
    }
=======
>>>>>>> 45b0c05 (Set up google auth and auth screens)
<<<<<<< HEAD
=======
    components: {
        AdminDash, Head
    }
>>>>>>> 4494bb2 (Add users and scams sections for admin)
=======
>>>>>>> c5be46e (Fix conflicts)
}
</script>
