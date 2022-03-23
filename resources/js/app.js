require('./bootstrap');

import { createApp } from 'vue'

import Login from './components/Login.vue';
import Lesson from './components/lesson/Lesson.vue';

const app = createApp({});

app.component('login', Login);
app.component('lesson', Lesson);

app.mount('#app');
