// src/store.js
import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    user: null,
    token: localStorage.getItem('token') || null,
    permissions: []
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
    },
    SET_PERMISSIONS(state, permissions) {
      state.permissions = permissions;
    }
  },
  actions: {
    async fetchPermissions({ commit }) {
      try {
        const resU = await axios.get('http://127.0.0.1:8000/api/user_en_ligne_pro');
        if (resU.status === 200) {
          const permissions = resU.data.user.settings_roles.permissions;
          commit('SET_PERMISSIONS', permissions);
          console.log('Permissions:', permissions);
        }
      } catch (error) {
        console.error("Erreur lors de la récupération des permissions :", error);
      }
    },
    async login({ commit }, credentials) {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/login', credentials);
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
        await axios.post('http://127.0.0.1:8000/api/logout');
        localStorage.removeItem('token');
        delete axios.defaults.headers.common['Authorization'];

        commit('CLEAR_AUTH');
      } catch (error) {
        throw error;
      }
    },
    async fetchUser({ commit }) {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/user');
        commit('SET_USER', response.data);
      } catch (error) {
        throw error;
      }
    }
  },
  getters: {
    isAuthenticated: state => !!state.token,
    getUser: state => state.user,
    userPermissions: (state) => state.permissions
  }
});
