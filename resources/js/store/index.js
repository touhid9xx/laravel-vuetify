import Vue from 'vue';
import Vuex from 'vuex';
import UIModule from './modules/ui';
import {auth} from './modules/auth.module';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        ui: UIModule,
        auth
    }
});