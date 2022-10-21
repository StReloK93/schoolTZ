<template>
    <home-page
        :navigatorRoutes="[
            { name: 'Timetable', path: 'schedulestudent' },
            { name: 'Grades', path: 'subjectlist' },
        ]"
    />
</template>

<script setup>
import axios from "axios";
import {useStore} from 'vuex'
const store = useStore()
</script>