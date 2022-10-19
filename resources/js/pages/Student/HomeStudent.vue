<template>
    <home-page
        :navigatorRoutes="[
            { name: 'Schedule', path: 'schedulestudent' },
            { name: 'Grades', path: 'subjectlist' },
        ]"
    />
</template>

<script setup>
import axios from "axios";
import {useStore} from 'vuex'
const store = useStore()
</script>