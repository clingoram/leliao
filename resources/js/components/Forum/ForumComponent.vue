<template>
  <!-- 首頁 左邊論壇分類看板 -->
  <div v-if="forumOptions.length !== 0">
    <div
      class="forums"
      v-for="category in forumOptions"
      v-bind:key="category.id"
    >
      <router-link :to="`/f/${category.id}`">{{ category.name }}</router-link>
    </div>
  </div>
  <div v-else>
    <div v-show="(showForum = false)">
      <p>目前沒有可用看板喔!</p>
    </div>
  </div>
  <!-- <router-view /> -->
</template>
<script>
export default {
  // setup() {},
  data() {
    return {
      // for forums
      forumOptions: [],
      showForum: false,
    };
  },
  async beforeMount() {
    // get all forums.
    axios
      .get("api/lel/f/all")
      .then((response) => {
        this.forumOptions = response.data;
        this.showForum = true;
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>