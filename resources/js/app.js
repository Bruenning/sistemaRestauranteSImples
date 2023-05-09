
import { createApp } from 'vue'
import VueAxios from 'vue-axios'


import './bootstrap';
import * as bootstrap from 'bootstrap'
import 'vee-validate/dist/vee-validate.js'

import 'bootstrap/dist/css/bootstrap.css'
import 'jquery/dist/jquery.js'


//helpers
import helpers from './helpers'

import api from './Axios.js'

import router from './router.js'
import App from './Layouts/App.vue'

//components
import Vrow from './Components/Vrow.vue'
import Vcol from './Components/Vcol.vue'
import Vform from './Components/Vform.vue'
import Vbutton from './Components/Vbutton.vue'
import Vinput from './Components/Vinput.vue'
import Login from './Components/Login.vue';
import Menu from './Components/Menu.vue'
import Bmodal from './Components/Bmodal.vue'
import Vsnackbar from './Components/Vsnackbar.vue'

import HomeVue from './Pages/Home.vue';
import NotFoundVue from './Pages/NotFound.vue';

// Vuetify
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'


const vuetify = createVuetify({
    components,
    directives,
})

const app = createApp(App)


app.component('Vcol', Vcol)
app.component('Vrow', Vrow)
app.component('Vform', Vform)
app.component('Vbutton', Vbutton)
app.component('Vinput', Vinput)
app.component('Menu', Menu)
app.component('Bmodal', Bmodal)
app.component('Login', Login)
app.component('Vsnackbar', Vsnackbar)

app.component('Home', HomeVue)
app.component('NotFound', NotFoundVue)


app
    .use(router)
    .use(vuetify)
    .use(bootstrap)
    .use(VueAxios, api)

app.config.globalProperties.$helpers = helpers
app.config.globalProperties.$api = api

app.mount('#app')

