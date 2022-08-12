<template>
  <!-- 左邊論壇分類看板 -->
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
      forumOptions: [],
      showForum: false,
    };
  },
  created() {
    this.getAllForums();
  },
  methods: {
    // 所有分類看板
    getAllForums() {
      axios
        .get("api/leliao/f/all")
        .then((response) => {
          this.forumOptions = response.data;
          this.showForum = true;
          // console.log(this.forumOptions.length);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // 取得特定看板的文章
    getSpecificForum() {
      axios
        .get("api/leliao/f", {
          params: {
            ID: category.id,
          },
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>