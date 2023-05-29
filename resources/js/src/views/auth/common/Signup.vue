<template>
  <form @submit.prevent="onSubmit" class="space-y-4">
    <Textinput
      label="Full name"
      type="text"
      placeholder="Full Name"
      name="name"
      v-model="name"
      :error="nameError"
      classInput="h-[48px]"
    />
    <Textinput
      label="Email"
      type="email"
      placeholder="Type your email"
      name="emil"
      v-model="email"
      :error="emailError"
      classInput="h-[48px]"
    />
    <Textinput
      label="Password"
      type="password"
      placeholder="8+ characters, 1 capitat letter "
      name="password"
      v-model="password"
      :error="passwordError"
      hasicon
      classInput="h-[48px]"
    />

    <label class="cursor-pointer flex items-start">
      <input
        type="checkbox"
        class="hidden"
        @change="() => (checkbox = !checkbox)"
      />
      <span
        class="h-4 w-4 border rounded inline-flex mr-3 relative flex-none top-1 transition-all duration-150"
        :class="
          checkbox
            ? 'ring-2 ring-black-500 dark:ring-offset-slate-600 dark:ring-slate-900  dark:bg-slate-900 ring-offset-2 bg-slate-900'
            : 'bg-slate-100 dark:bg-slate-600 border-slate-100 dark:border-slate-600 '
        "
      >
        <img
          src="@/assets/images/icon/ck-white.svg"
          alt=""
          class="h-[10px] w-[10px] block m-auto"
          v-if="checkbox"
        />
      </span>
      <span class="text-slate-500 dark:text-slate-400 text-sm leading-6"
        >You accept our Terms and Conditions and Privacy Policy</span
      >
    </label>

    <button type="submit" class="btn btn-dark block w-full text-center">
      Create an account
    </button>
  </form>
</template>
<script>
import Textinput from "../../../components/Textinput/index.vue";
import { useField, useForm } from "vee-validate";
import * as yup from "yup";
import axios from "axios";
import { inject } from "vue";
import { useRouter } from "vue-router";
import { useToast } from "vue-toastification";
export default {
  components: {
    Textinput,
  },
  data() {
    return {
      checkbox: false,
    };
  },
  setup() {
    // Define a validation schema
    const schema = yup.object({
      email: yup.string().required(" Email is required").email(),
      password: yup.string().required("Password is  required").min(8),
      name: yup.string().required("Full name is required"),
    });
    const swal = inject("$swal");
    const toast = useToast();
    const router = useRouter();

    // Create a form context with the validation schema
    const users = [];
    const { handleSubmit } = useForm({
      validationSchema: schema,
    });
    // No need to define rules for fields

    const { value: email, errorMessage: emailError } = useField("email");
    const { value: name, errorMessage: nameError } = useField("name");
    const { value: password, errorMessage: passwordError } =
      useField("password");

    const onSubmit = handleSubmit( async(values) => {
      await axios.post('/register', values)
            .then(response => {
                if(response.data.success){
                    localStorage.setItem('token', response.data.data.token)
                    router.replace({
                        name: 'home'
                    })
                }else{
                    console.log(response.data)
                    swal.fire({
                    title: "Error",
                    text: "Try Again",
                    icon: "error",
                    confirmButtonText: "Ok",
                  });
                    // notif.value = response.data.message;
                }
            }).catch(err => {
               console.log(err.response.data);
               swal.fire({
                title: "Email already exists",
                text: "Please try another email",
                icon: "error",
                confirmButtonText: "Ok",
              });
            })
      // add value into user array if same email not found
    });

    return {
      email,
      name,
      nameError,
      emailError,
      password,
      passwordError,
      onSubmit,
    };
  },
};
</script>
<style lang="scss"></style>
