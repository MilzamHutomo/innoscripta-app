<template>
    <div
    class="loginwrapper bg-cover bg-no-repeat bg-center"
    :style="{
      backgroundImage:
        'url(' + pageBg + ')',
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
            <h4
              class="font-medium text-2xl text-slate-900 dark:text-white mb-3"
            >
              Sign up
            </h4>
            <div class="text-slate-500 dark:text-slate-400 text-base">
              Create an account for TeamX CRM
            </div>
          </div>
          <Signup />
          <div
            className=" relative border-b-[#9AA2AF] border-opacity-[16%] border-b pt-6"
          >
            <div
              className=" absolute inline-block  bg-white dark:bg-slate-800 left-1/2 top-1/2 transform -translate-x-1/2 px-4 min-w-max text-sm  text-slate-500  dark:text-slate-400font-normal "
            >
              Or continue with
            </div>
          </div>
          <div class="max-w-[242px] mx-auto mt-8 w-full">
            <Social />
          </div>
          <div
            class="max-w-[215px] mx-auto font-normal text-slate-500 dark:text-slate-400 2xl:mt-12 mt-6 uppercase text-sm"
          >
            Already registered?
            <router-link
              to="/"
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
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';
import Signup from "./common/Signup.vue";
import Social from "./common/Social.vue";
import pageBg from "@/assets/images/all-img/page-bg.png"
import logoWhite from "@/assets/images/logo/teamxlogo.png"
import logo from "@/assets/images/logo/teamxlogo.png"
    const router = useRouter();


    const user = reactive({
        'name' : '',
        'email' : '',
        'password' : ''
    });
    let error = ref([]);
    let notif = ref(null);

    const register = async () => {
        await axios.post('/register', user)
            .then(response => {
                if(response.data.success){
                    localStorage.setItem('token', response.data.data.token)
                    router.replace({
                        name: 'home'
                    })
                }else{
                    console.log(response.data)
                    notif.value = response.data.message;
                }
            }).catch(err => {
               console.log(err.response.data);
            })
    }
</script>

<script>
    export default {
        name : 'Register',
        data () {
        return {
          logoWhite,logo,pageBg
        }
      },
      components: {
        Social,
        Signup,
      },
    }
</script>