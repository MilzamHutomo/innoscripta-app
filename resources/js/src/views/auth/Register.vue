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
                        <p class="opacity-75 text-white">INNOSCRIPTA CHALENGGE</p>
                      </div>
                    </div>
                    <div class="mt-3 mb-4 mt-md-4 mb-md-5" data-bs-theme="light">
                      <p class="pt-3 text-white">Have an account?<br><router-link class="btn btn-outline-light mt-2 px-4" to="/login">Log In</router-link></p>
                    </div>
                  </div>
                  <div class="col-md-7 d-flex flex-center">
                    <div class="p-4 p-md-5 flex-grow-1">
                      <h3>Register</h3>
                      <form @submit.prevent="register">
                        <div class="mb-3"><label class="form-label" for="card-name">Name</label><input class="form-control" v-model="user.name" type="text" autocomplete="on" id="card-name" /></div>
                        <div class="mb-3"><label class="form-label" for="card-email">Email address</label><input class="form-control" type="email" autocomplete="on" required v-model="user.email" id="card-email" /></div>
                        <div class="row gx-2">
                          <div class="mb-3 col-sm-12"><label class="form-label" for="card-password">Password</label><input v-model="user.password" class="form-control" type="password" autocomplete="on" id="card-password" /></div>
                          
                        </div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" id="card-register-checkbox" /><label class="form-label" for="card-register-checkbox">I accept the <a href="#!">terms </a>and <a href="#!">privacy policy</a></label></div>
                        <div class="mb-3"><button class="group relative flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" type="submit" name="submit">Register</button></div>
                      </form>
                      <div class="position-relative mt-4">
                        <hr />
                        <div class="divider-content-center">or register with</div>
                      </div>
                      <div class="row g-2 mt-2">
                        <div class="col-sm-12"><a class="btn btn-outline-google-plus btn-sm d-block w-100" href="#"><span class="fab fa-google-plus-g me-2" data-fa-transform="grow-8"></span> google</a></div>
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
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

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
        name : 'Register'
    }
</script>