<template>
    <div>
      <Modal
        :activeModal="store.editModal"
        @close="store.closeEditModal"
        title="Update User " 
        centered
      >
        <form @submit.prevent="updateUser" class="space-y-4">
          <Textinput
            label="Name"
            type="text"
            placeholder="Name"
            name="name"
            v-model.trim="store.editName"
            :error="nameError"
          />
          <Textinput
            label="Email"
            type="email"
            placeholder="Insert Email"
            name="email"
            v-model.trim="store.editEmail"
            :error="emailError"
          />
          <div class="assagin space-y-4">
            <Select label="select Role" placeholder="Choose Role" v-model="store.editRole" :options="options" name="role" :error="roleError" />
          </div>
  
          <div class="text-right">
            <Button text="Update" btnClass="btn-dark"></Button>
          </div>
        </form>
      </Modal>
    </div>
  </template>
  <script setup>
  import Button from "../../components/Button/index.vue";
  import Modal from "../../components/Modal/index.vue";
  import Select from "../../components/Select/index.vue";
  import Textinput from "../../components/Textinput/index.vue";
  import { useField, useForm } from "vee-validate";
  import {useProjectStore} from "../../store/project";
  import * as yup from "yup";
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

  
  const { handleSubmit } = useForm();

  
  const updateUser = handleSubmit( async () => {
    let link = "/users/"+store.editId;
    axios.put(link, {
      name : store.editName,
      email: store.editEmail,
      role : store.editRole
    }).then(res => {
      console.log(res)
      emit('onRefreshed','Update');
      store.closeEditModal()
    }).catch(err => {
      console.log(err);
    })
  });


  const emit = defineEmits(['onRefreshed']);

  </script>


  <style lang=""></style>
  