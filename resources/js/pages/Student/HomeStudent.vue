<template>
    <home-page
        :navigatorRoutes="[
            { name: 'Schedule', path: 'schedulestudent' },
            { name: 'Grades', path: 'gradesstudent' },
        ]"
    />
</template>

<script setup>
import axios from "axios";
import {useStore} from 'vuex'
const store = useStore()
axios.get(`/studentgrades/${store.state.user.id}`)
</script>