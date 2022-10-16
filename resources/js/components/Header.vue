<template>
    <header class="flex justify-between items-center py-4 px-8 -mx-4 bg-gray-50 shadow">
        <div v-if="$store.state.user">
            <span class="pr-4 capitalize font-medium">|{{$store.state.user.role.name}}|</span>
            <span class="pr-4">{{$store.state.user.name}}</span>
        </div>
        <button class="bg-gray-200 text-gray-600 px-2 py-1" @click="$store.dispatch('logout')">
            Logout
        </button>
    </header>
</template>

<script setup></script>