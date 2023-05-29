<template>
    <div>
      <Card noborder>
        <div
          class="md:flex justify-between pb-6 md:space-y-0 space-y-3 items-center"
        >
          <Button
            icon="heroicons-outline:plus"
            text="Add User"
            btnClass="btn-dark dark:bg-slate-800  h-min text-sm font-normal"
            iconClass=" text-lg"
            @click="openProject"
            :isLoading="store.isLoading"
          />
          <InputGroup
            v-model="searchTerm"
            placeholder="Search"
            type="text"
            prependIcon="heroicons-outline:search"
            merged
          />
        </div>
  
        <vue-good-table
          :columns="columns"
          styleClass=" vgt-table bordered centered"
          :rows="dataUser"
          :pagination-options="{
            enabled: true,
            perPage: perpage,
          }"
          :search-options="{
            enabled: true,
            externalQuery: searchTerm,
          }"
          :select-options="{
            enabled: true,
            selectOnCheckboxOnly: true, // only select when checkbox is clicked instead of the row
            selectioninfoClass: 'custom-class',
            selectionText: 'rows selected',
            clearSelectionText: 'clear',
            disableSelectinfo: true, // disable the select info-500 panel on top
            selectAllByGroup: true, // when used in combination with a grouped table, add a checkbox in the header row to check/uncheck the entire group
          }"
        >
          <template v-slot:table-row="props">
            <span v-if="props.column.field == 'name'" class="flex">
              <span
                class="text-sm text-slate-600 dark:text-slate-300 capitalize"
                >{{ props.row.name }}</span
              >
            </span>
            <span v-if="props.column.field == 'email'">
              {{ props.row.email }}
            </span>
            <span
              v-if="props.column.field == 'role'"
              class="text-slate-500 dark:text-slate-300"
            >
              {{ props.row.role }}
            </span>
            
            <span v-if="props.column.field == 'action'">
                <div class="flex space-x-3 rtl:space-x-reverse text-center">
                
                <Tooltip placement="top" arrow theme="dark">
                  <template #button>
                    <div class="action-btn" @click="editData(props.row.id, props.row.name, props.row.email, props.row.role)">
                      <Icon icon="heroicons:pencil-square" />
                    </div>
                  </template>
                  <span> Edit</span>
                </Tooltip>
                <Tooltip placement="top" arrow theme="danger-500">
                  <template #button>
                    <div class="action-btn" @click="deleteData(props.row.id)">
                      <Icon icon="heroicons:trash" />
                    </div>
                  </template>
                  <span>Delete</span>
                </Tooltip>
              </div>
            </span>
          </template>
          <template #pagination-bottom="props">
            <div class="py-4 px-3">
              <Pagination
                :total="20"
                :current="current"
                :per-page="perpage"
                :pageRange="pageRange"
                @page-changed="current = $event"
                :pageChanged="props.pageChanged"
                :perPageChanged="props.perPageChanged"
                enableSearch
                enableSelect
                :options="options"
              >
                >
              </Pagination>
            </div>
          </template>
        </vue-good-table>
      </Card>
      <UserAddmodal @onRefreshed="refreshData" />
      <UserEditmodal @onRefreshed="refreshData"  />
    </div>
  </template>

  <script setup>
    import { onMounted, ref} from 'vue';
    import axios from 'axios';
    import { useToast } from 'vue-toastification';
    import {useProjectStore} from "../../store/project";
    const store = useProjectStore();
    const openProject = () => {
      store.openProject();
    };
    const projects = computed(() => store.projects);

    const toast = useToast();
    let dataUser = ref([]);
    let updateId = '';
    onMounted(async() => {
      await getDataUser();
    })

    const getDataUser = async() => {
      await axios.get('/users').then(res => {
        dataUser.value = res.data.data;
      });
    }

    const refreshData = async(obj) => {
      if(obj == 'Update'){
        toast.success("User Successfuly Updated", {
                timeout: 2000,
            });
      }else{
        toast.success("New User Added", {
                timeout: 2000,
            });
      }
       
        await getDataUser();
    }

    const editData = async(ids, name, email, role) => {
      console.log('running');
      store.editId = ids;
      store.editName = name;
      store.editEmail = email;
      store.editRole = role;
      store.openEditModal();
    }

    const deleteData = async(id) => {
      let arr = [id];
      const payloadDelete = {
        ids : arr
      }
      await axios.delete('/users',{data : payloadDelete}).then(res => {
        console.log(res)
        toast.error("User Deleted", {
                timeout: 2000,
            });
        getDataUser();
      }).catch(err => {
        console.log(err)
      })
    }
  </script>

  <script>
  import Tooltip from "../../components/Tooltip/index.vue";
  import Card from "../../components/Card/index.vue";
  import Icon from "../../components/Icon/index.vue";
  import InputGroup from "../../components/InputGroup/index.vue";
  import Pagination from "../../components/Pagination/index.vue";
  import UserAddmodal from "./AddUser.vue";
  import UserEditmodal from "./EditUser.vue";
  import Button from "../../components/Button/index.vue";
  import { MenuItem } from "@headlessui/vue";
  import { advancedTable } from "../../constant/basic-tablle-data";
  import { computed, ref, watch, onMounted } from "vue";

  

  let fillter = ref("grid");
  

  const width = ref(0);
  const handleResize = () => {
    width.value = window.innerWidth;
  };
  onMounted(() => {
    window.addEventListener("resize", handleResize);
    handleResize();
  });

  

  const isSkeletion = ref(true);
  const isSkeletion2 = ref(null);
  setTimeout(() => {
    isSkeletion.value = false;
    isSkeletion2.value = false;
  }, 1000);

  // watch fillter with switch case
  watch(fillter, () => {
    switch (fillter.value) {
      case "grid":
        fillter.value = "grid";
        isSkeletion.value = true;
        setTimeout(() => {
          isSkeletion.value = false;
        }, 1000);

        break;
      case "list":
        fillter.value = "list";
        isSkeletion2.value = true;
        setTimeout(() => {
          isSkeletion2.value = false;
        }, 1000);
        break;
      default:
        fillter.value = "grid";
        break;
    }
  });

  export default {
    components: {
      Pagination,
      InputGroup,
      Tooltip,
      Icon,
      Card,
      MenuItem,
      Button,
      UserAddmodal,
      UserEditmodal
    },
  
    data() {
      return {
        advancedTable,
        current: 1,
        perpage: 10,
        pageRange: 5,
        searchTerm: "",
        actions: [
          {
            name: "view",
            icon: "heroicons-outline:eye",
          },
          {
            name: "edit",
            icon: "heroicons:pencil-square",
          },
          {
            name: "delete",
            icon: "heroicons-outline:trash",
          },
        ],
        options: [
          {
            value: "1",
            label: "1",
          },
          {
            value: "3",
            label: "3",
          },
          {
            value: "5",
            label: "5",
          },
        ],
        columns: [
          {
            label: "Id",
            field: "id",
          },
          {
            label: "Name",
            field: "name",
          },
          {
            label: "Email",
            field: "email",
          },
  
          {
            label: "Role",
            field: "role",
          },
          {
            label: "Action",
            field: "action",
          },
        ],
      };
    },
  };
  </script>
  <style lang="scss"></style>
  