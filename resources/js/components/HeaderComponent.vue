<template>
  <nav class="navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Leliao</a>
      <user-menu />
    </div>
  </nav>

  <router-view />
</template>
<script>
import UserMenu from "./User/UserMenu.vue";

export default {
  mounted() {
    console.log(
      "山前有個嚴圓眼，山後有個嚴眼圓，二人山前來比眼，不知是嚴圓眼的眼圓，還是嚴眼圓比嚴圓眼的眼圓?"
    );
  },
  components: {
    UserMenu,
  },
};
</script>