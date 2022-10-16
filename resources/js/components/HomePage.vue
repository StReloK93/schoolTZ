<template>
    <main class="h-full flex flex-col pb-4">
        <HeaderComponent></HeaderComponent>
        <section class="flex pt-4 flex-grow">
            <Navigator :navigatorRoutes="navigatorRoutes" class="w-1/6 p-4"></Navigator>
            <router-view class="w-5/6 px-4"></router-view>
        </section>
    </main>
</template>

<script setup>
import HeaderComponent from "./Header.vue";
import Navigator from "./Navigator.vue";
const { title , navigatorRoutes } = defineProps(["title" , 'navigatorRoutes']);
</script>