<template>
    <div class="space-y-5">
        <DataUser />
    </div>
  </template>

<script setup>
import DataUser from "./DataUser.vue";
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
</script>

  <script>
  export default {
    components: {
      DataUser,
    },
  };
  </script>
  <style lang="scss">
  .vgt-inner-wrap {
    @apply shadow-none;
  }
  </style>
  