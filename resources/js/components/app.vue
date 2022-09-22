<template>
  <!-- main Vue file -->

  <!-- 最上方navbar -->
  <header-component />
</template>
<script>
import HeaderComponent from "./HeaderComponent.vue";

export default {
  name: "App",
  components: {
    HeaderComponent,
  },
};
</script>
