require('./bootstrap');

import { createApp } from 'vue'

import Login from './components/auth/Login.vue';
import Lesson from './components/lesson/Lesson.vue';
import SummaryList from './components/disciplines/SummaryList.vue';

const app = createApp({});

app.component('login', Login);
app.component('lesson', Lesson);
app.component('summary-list', SummaryList);

app.mount('#app');

