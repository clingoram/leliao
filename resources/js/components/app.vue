<template>
  <!-- main file-->
  <!-- 最上方navbar -->
  <header-component />

  <div class="container text-center mainarea">
    <div class="row">
      <!-- 左邊論壇看板 -->
      <div class="col">
        <forum-component />
      </div>
      <!-- 中間文章區塊 -->
      <div class="col-6">
        <content-component />
      </div>
      <div class="col"></div>
    </div>
  </div>
  <!-- <router-view /> -->
</template>
<script>
import HeaderComponent from "./HeaderComponent.vue";
import ForumComponent from "./ForumComponent.vue";
import ContentComponent from "./ContentComponent.vue";

export default {
  components: {
    HeaderComponent,
    ForumComponent,
    ContentComponent,
  },
};
</script>
