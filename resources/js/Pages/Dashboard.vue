<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template> -->
    <div class="py-12">
        <!-- Content for admin role -->
        <div v-if="role === 'admin'">
          <h1>Welcome Admin!</h1>
        </div>

        <!-- Content for other roles -->
        <div v-else>
          <h1>Welcome User!</h1>
        </div>
    </div>
    </AppLayout>
</template>
<script>
export default {
    props: {
        role: String,
    },
}
</script>
