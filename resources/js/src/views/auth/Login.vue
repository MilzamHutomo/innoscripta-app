<template>
  <div
    class="loginwrapper bg-cover bg-no-repeat bg-center"
    :style="{
      backgroundImage:
        'url(' + loginBg + ')',
    }"
  >
    <div class="lg-inner-column">
      <div class="left-columns lg:w-1/2 lg:block hidden">
        
      </div>
      <div class="lg:w-1/2 w-full flex flex-col items-center justify-center">
        <div class="auth-box-3">
          <div class="mobile-logo text-center mb-6 lg:hidden block">
            <router-link to="/"
              ><img :src="logo" alt="" class="mx-auto"
            /></router-link>
          </div>
          <div class="text-center 2xl:mb-10 mb-5">
            <h4 class="font-medium">Sign In</h4>
            <div class="text-slate-500 dark:text-slate-400 text-base">
              Sign in for using CRM TeamX
            </div>
          </div>
          <Signin />
          <div
            className=" relative border-b-[#9AA2AF] border-opacity-[16%] border-b pt-6"
          >
            <div
              className=" absolute inline-block  bg-white dark:bg-slate-800 dark:text-slate-400 left-1/2 top-1/2 transform -translate-x-1/2 px-4 min-w-max text-sm  text-slate-500  dark:text-slate-400font-normal "
            >
              Or continue with
            </div>
          </div>
          <div class="max-w-[242px] mx-auto mt-8 w-full">
            <Social />
          </div>
          <div
            class="mx-auto font-normal text-slate-500 dark:text-slate-400 2xl:mt-12 mt-6 uppercase text-sm text-center"
          >
            Already registered?
            <router-link
              to="/register"
              class="text-slate-900 dark:text-white font-medium hover:underline"
            >
              Sign In</router-link
            >
          </div>
        </div>
      </div>
      <div class="auth-footer3 text-white py-5 px-5 text-xl w-full">
        TeamX Development
      </div>
    </div>
  </div>
</template>

<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { reactive } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter()

    let form = reactive({
        email :'',
        password:''
    });
    

    let notif = ref(null);

    const login = async () => {
        await axios.post('/login', form)
            .then(response => {
                let btnlogin = document.getElementById('btn-login');
                btnlogin.innerHTML='<div class="inline-block h-4 w-4 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status"><span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]" >Loading...</span> </div>';
                if(response.data.success){
                    localStorage.setItem('token', response.data.data.token)
                    return response.data;
                }else{
                    notif.value = response.data.message
                    btnlogin.innerHTML='Log in';
                    return response.data;
                }
            });
            router.replace({
                name:'home'
            });
    }
</script>

<script>

import Signin from "./common/Signin.vue";
import Social from "./common/Social.vue";
// Image Import
import loginBg from "@/assets/images/all-img/page-bg.png"
import logoWhite from "@/assets/images/logo/teamxlogo.png"
import logo from "@/assets/images/logo/teamxlogo.png"

export default {
    name: "Login",
    data () {
    return {
      logoWhite,logo,loginBg
    }
  },
  components: {
    Social,
    Signin,
  },
};
</script>
