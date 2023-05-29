<template>
    <div>
      <Modal
        :activeModal="store.addmodal"
        @close="store.closeModal"
        title="Create New User"
        centered
      >
        <form @submit.prevent="addUser" class="space-y-4">
          <Textinput
            label="Name"
            type="text"
            placeholder="Name"
            name="name"
            v-model.trim="nameText"
            :error="nameError"
          />
          <Textinput
            label="Email"
            type="email"
            placeholder="Insert Email"
            name="email"
            v-model.trim="emailText"
            :error="emailError"
          />
          <div class="assagin space-y-4">
            <Select label="select Role" placeholder="Choose Role" v-model="role" :options="options" name="role" :error="roleError" />
          </div>
  
          <div class="text-right">
            <Button text="Add" btnClass="btn-dark"></Button>
          </div>
        </form>
      </Modal>
    </div>
  </template>
  <script setup>
  import Button from "../../components/Button/index.vue";
  import FromGroup from "../../components/FromGroup/index.vue";
  import Modal from "../../components/Modal/index.vue";
  import VueSelect from "../../components/Select/VueSelect.vue";
  import Textarea from "../../components/Textarea/index.vue";
  import Select from "../../components/Select/index.vue";
  import Textinput from "../../components/Textinput/index.vue";
  import { v4 as uuidv4 } from "uuid";
  import { useField, useForm } from "vee-validate";
  import vSelect from "vue-select";
  import {useProjectStore} from "../../store/project";
  import * as yup from "yup";
  import { assignOption } from "../../constant/data";
  import axios from 'axios';
  let store = useProjectStore();
  
  const options = [
    {
      value: "MANAGER",
      label: "MANAGER",
    },
    {
      value: "REPRESENTATIVE",
      label: "REPRESENTATIVE",
    },
    {
      value: "ADMIN",
      label: "ADMIN",
    },
  ];

  
  const schema = yup.object({
    nameText: yup.string().required("Name is required"),
    emailText: yup.string().required("Email is required"),
    role: yup.mixed().nullable().required("Please select role"),
  });
  const { handleSubmit } = useForm({
    validationSchema: schema,
  });
  const { value: nameText, errorMessage: nameError } =
    useField("nameText");
  const { value: emailText, errorMessage: emailError } = useField("emailText");
  
  const { value: role, errorMessage: roleError } = useField("role");
  
  const addUser = handleSubmit( async () => {
    // store.addProject({
    //   id: uuidv4(),
    //   name: newTodoText.value,
    //   des: desc.value,
    //   assignto: assign.value,
    //   category: category.value.map((item) => item.value),
    //   startDate: startDate.value,
    //   endDate: endDate.value,
    //   progress: 40,
    // });
    axios.post('/users', {
      name : nameText.value,
      email: emailText.value,
      role : role.value
    }).then(res => {
      console.log(res)
      emit('onRefreshed','Success');
      store.closeModal()
    }).catch(err => {
      console.log(err);
    })
  });


  const emit = defineEmits(['onRefreshed']);

  </script>
  <style lang=""></style>
  