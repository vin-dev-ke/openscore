<template>
    <div class="flex justify-center items-center h-screen flex-col sm:justify-center sm:items-center pt-6 sm:pt-0">
        <div>
            <slot name="logo" />
        </div>

        <div class="w-full sm:max-w-md mt-4 px-6 py-4 bg-white drop-shadow-2xl overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
