<template>
    <main class="main" id="top">
      <div class="container-fluid">
        <div class="row min-vh-100 flex-center g-0">
          <div class="col-lg-8 col-xxl-5 py-3 position-relative"><img class="bg-auth-circle-shape" src="https://prium.github.io/falcon/v3.16.0/assets/img/icons/spot-illustrations/bg-shape.png" alt="" width="250"><img class="bg-auth-circle-shape-2" src="https://prium.github.io/falcon/v3.16.0/assets/img/icons/spot-illustrations/shape-1.png" alt="" width="150">
            <div class="card overflow-hidden z-1">
              <div class="card-body p-0">
                <div class="row g-0 h-100">
                  <div class="col-md-5 text-center bg-card-gradient">
                    <div class="position-relative p-4 pt-md-5 pb-md-7" data-bs-theme="light">
                      <div class="bg-holder bg-auth-card-shape" style="background-image:url(https://prium.github.io/falcon/v3.16.0/assets/img/icons/spot-illustrations/half-circle.png);"></div>
                      <!--/.bg-holder-->
                      <div class="z-1 position-relative"><router-link class="link-light mb-4 font-sans-serif fs-4 d-inline-block fw-bolder" to="#">TeamX</router-link>
                        <p class="opacity-75 text-white">Our Custom CRM With INNOSCRIPTA</p>
                      </div>
                    </div>
                    <div class="mt-3 mb-4 mt-md-4 mb-md-5" data-bs-theme="light">
                      <p class="text-white">Don't have an account?<br><router-link class="text-decoration-underline link-light" to="/register">Get started!</router-link></p>
                      
                    </div>
                  </div>
                  <div class="col-md-7 d-flex flex-center">
                    <div class="p-4 p-md-5 flex-grow-1">
                      <div class="row flex-between-center">
                        <div class="col-auto">
                          <h3>Account Login</h3>
                          <small class="text-danger">{{ notif }}</small>
                        </div>
                      </div>
                      <form @submit.prevent="login">
                        <div class="mb-3">
                            <label class="form-label" for="card-email">Email address</label>
                            <input class="relative block w-full rounded-t-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.email" required id="card-email" type="email" placeholder="Insert Email Address" /></div>
                        <div class="mb-3">
                          <div class="d-flex justify-content-between">
                            <label class="form-label" for="card-password">Password</label>
                        </div>
                        <input class="relative block w-full rounded-b-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Insert Password" v-model="form.password" required id="card-password" type="password" />
                        </div>
                        
                        <div class="mb-3">
                            <button type="submit" id="btn-login" class="group relative flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Log in</button>
                        </div>
                      </form>
                      <div class="position-relative mt-4">
                        <hr />
                        <div class="divider-content-center">or log in with</div>
                      </div>
                      <div class="row g-2 mt-2">
                        <div class="col-sm-12"><router-link class="btn btn-outline-google-plus btn-sm d-block w-100" to="#"><span class="fab fa-google-plus-g me-2" data-fa-transform="grow-8"></span> google</router-link></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
</template>

<style scoped>
  /* @import "https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap";
  @import "https://prium.github.io/falcon/v3.16.0/vendors/simplebar/simplebar.min.css";
  @import "https://prium.github.io/falcon/v3.16.0/assets/css/theme-rtl.min.css";
  @import "https://prium.github.io/falcon/v3.16.0/assets/css/theme.min.css";
  @import "https://prium.github.io/falcon/v3.16.0/assets/css/user-rtl.min.css";
  @import "https://prium.github.io/falcon/v3.16.0/assets/css/user.min.css"; */
</style>

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
export default {
    name: "Login",
};
</script>
