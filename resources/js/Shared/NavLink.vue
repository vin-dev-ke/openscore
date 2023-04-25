<template>
    <Link class="text-black text-lg uppercase" :class="{'font-bold':active}">
        <slot/>
    </Link>
</template>
<script>
import { Link } from '@inertiajs/vue3';
export default {
    props: {
        active: Boolean,
    },
    components: {
        Link,
    }
}
</script>