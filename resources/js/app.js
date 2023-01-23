require('./bootstrap');

import { createApp } from 'vue'
import App from './components/App'
import List from './components/products/List'
import routes from './components/routes'

createApp(App).use(routes).mount('#app');