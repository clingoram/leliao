<template>
  <!-- main Vue file -->

  <!-- 最上方navbar -->
  <header-component />

  <div class="container text-center mainarea">
    <div class="row">
      <div class="col">
        <forum-component />
      </div>
      <div class="col-6">
        <content-component />
      </div>
      <div class="col"></div>
    </div>
  </div>
  <!-- 註冊/登入頁面會出現在最下面 -->
  <!-- <router-view /> -->
  <!-- <router-view class="view one"></router-view> -->
  <!-- <router-view class="view two" name="a"></router-view>
  <router-view class="view three" name="b"></router-view> -->
</template>
<script>
import HeaderComponent from "./HeaderComponent.vue";
import ForumComponent from "./ForumComponent.vue";
import ContentComponent from "./ContentComponent.vue";

export default {
  name: "App",
  components: {
    HeaderComponent,
    ForumComponent,
    ContentComponent,
  },
};
</script>
