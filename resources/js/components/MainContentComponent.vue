<template>
  <!-- 下方看板區塊和文章區塊 -->
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
</template>
<script>
import ForumComponent from "./Forum/ForumComponent.vue";
import ContentComponent from "./Post/PostsComponent.vue";

export default {
  components: {
    ForumComponent,
    ContentComponent,
  },
};
</script>
