import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import './assets/main.css'

/* Bootstrap 5.2 */
import './assets/css/bootstrap.min.css'
import './assets/js/bootstrap.bundle.min'

const app = createApp(App)

app.use(router)

app.mount('#app')
