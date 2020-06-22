/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap'

import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import VueTheMask from 'vue-the-mask'
import Vuetify from 'vuetify'
import money from 'v-money'
import Croppa from 'vue-croppa'

import 'vuetify/dist/vuetify.min.css'

import App from './components/App'
import ProductForm from './components/ProductForm'
import Form from './components/Products/Form'
import ProductsHome from './components/Products/Home'

// app routing
Vue.use(VueRouter);
// app state manager
Vue.use(Vuex);
// front-end
Vue.use(Vuetify);
// mask for inputs
Vue.use(VueTheMask);
// mask for money
Vue.use(money, {precision: 2});
// Image cropper
Vue.use(Croppa);

const vuetify = new Vuetify({});

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      component: App,
      children: [
        {
          path: 'products',
          name: 'products.show',
          component: ProductsHome
        },
        {
          path: 'products/form',
          name: 'products.store',
          component: Form
        },
        {
          path: 'products/:id/form',
          name: 'products.edit',
          component: Form
        }
      ]
    }
  ]
});

// Code below will register all the application components at once
const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vuex state management
const store = new Vuex.Store({
  state: {
    auth: {
      token: null,
      user: null
    }
  },
  mutations: {

    SET_TOKEN(state, token)
    {
      state.auth.token = token;
    },

    SET_USER(state, user)
    {
      state.auth.user = user;
    }

  },
  actions: {

    async signIn({ dispatch }, credentials) {
      let response = await axios.post('api/auth/signin', credentials);
      return dispatch('attempt', response.data.token);
    },

    async attempt({ commit }, token) {

      if(!token) return;

      commit('SET_TOKEN', token);

      try {
        let response = await axios.get('api/auth/check');
        commit('SET_USER', response.data);
      } catch(e) {
        commit('SET_TOKEN', null);
        commit('SET_USER', null);
      }
    },

    signOut({ commit }) {

      return axios.post('api/auth/signout').then(() => {
        commit('SET_TOKEN', null);
        commit('SET_USER', null);
      });

    }

  },

  getters: {
    authenticated(state) {
      return state.auth.token && state.auth.user;
    },
    user(state) {
      return state.auth.user;
    }
  }
});

// middleware navigation guard
router.beforeEach((to, from, next) => {

  if(!store.getters['authenticated'])
  {
    if(to.path !== '/')
    {
      next('/');
    }

    next();

  } else {
    next();
  }

});

// sets all axios requests to have Authorization Header
store.subscribe(mutation => {

  switch(mutation.type) {
    case 'SET_TOKEN':
      if(mutation.payload)
      {
        axios.defaults.headers.common['Authorization'] = `Bearer ${mutation.payload}`;
        localStorage.token = mutation.payload;
      } else {
        axios.defaults.headers.common['Authorization'] = null;
        delete localStorage.token;
      }
      break;
  }

 });

// before instanciantes Vue, check if it has some previous stored token to eliminate flickering
store.dispatch('attempt', localStorage.token).then(() => {

  new Vue({
      vuetify,
      router,
      store,
      el: '#app'
  });

});
