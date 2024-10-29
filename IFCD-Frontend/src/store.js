// src/store.js
import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    user: null,
    token: localStorage.getItem('token') || null,
  },
  mutations: {
    SET_USER(state, user) {
      state.user = user;
    },
    SET_TOKEN(state, token) {
      state.token = token;
    },
    CLEAR_AUTH(state) {
      state.user = null;
      state.token = null;
    }
  },
  actions: {
    async login({ commit }, credentials) {
      try {
        const response = await axios.post('https://api.queenbloh.com/api/login', credentials);
        const token = response.data.token;
        const user = response.data.user;

        localStorage.setItem('token', token);
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

        commit('SET_USER', user);
        commit('SET_TOKEN', token);
        return user;
      } catch (error) {
        throw error;
      }
    },
    async logout({ commit }) {
      try {
        await axios.post('https://api.queenbloh.com/api/logout');
        localStorage.removeItem('token');
        delete axios.defaults.headers.common['Authorization'];

        commit('CLEAR_AUTH');
      } catch (error) {
        throw error;
      }
    },
    async fetchUser({ commit }) {
      try {
        const response = await axios.get('https://api.queenbloh.com/api/user');
        commit('SET_USER', response.data);
      } catch (error) {
        throw error;
      }
    }
  },
  getters: {
    isAuthenticated: state => !!state.token,
    getUser: state => state.user,
  }
});
