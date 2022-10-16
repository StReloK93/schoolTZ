<template>
    <div class="bg-gray-100 shadow">
        <div v-for="route in navigatorRoutes" :key="route">
            <router-link class="underline" :to="{name: route.path}">
                {{route.name}}
            </router-link>
        </div>
    </div>
</template>

<script setup>
const { navigatorRoutes } = defineProps(["navigatorRoutes"]);
</script>