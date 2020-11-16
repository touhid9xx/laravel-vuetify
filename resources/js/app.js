import Vue from 'vue';
import App from './components/App';
import router from './routes';
import Vuetify from 'vuetify';
import store from './store';
import 'vuetify/dist/vuetify.min.css';





Vue.use(Vuetify);

Vue.config.productionTip = false
const app = new Vue({
    el: '#app',
    router: router,
    store: store,
    vuetify: new Vuetify(),
    ...App
});
