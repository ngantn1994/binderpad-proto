import Vue from 'vue';
import Vuex from 'vuex';

import auth from './auth';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    isLoading: true,
  },
  mutations: {
    updateLoadingStatus(state, value) {
      state.isLoading = value;
    },
  },
  getters: {
    isLoading(state) {
      return state.isLoading;
    },
  },
  actions: {
    setLoadingStatus({ commit }, payload) {
      commit('updateLoadingStatus', payload.value);
    },
  },
  modules: {
    auth,
  },
});
