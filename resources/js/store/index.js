import Vue from 'vue';
import Vuex from 'vuex';

import userModule from './modules/user';



Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    user: userModule,
  },
  state:{
    authUser:false,

	},
	getters:{

		  isLoggedIn (state) {
	    	return !!state.authUser
	  	},
	  	getAuthUser(state){
	  		return state.authUser
		  },

	},
	mutations:{

		setAuthuser (state, data) {
      state.authUser = data
    },
	}
});