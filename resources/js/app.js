import './bootstrap';

import {createApp} from 'vue'
import PostIndex from '.components/Post/Index'

const app =createApp({})
app.component ('post-index', PostIndex)
app.mount('#app')