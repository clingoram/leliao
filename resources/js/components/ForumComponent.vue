<template>
  <!-- 左邊論壇分類看板 -->
  <div class="forums" v-for="category in forumOptions" v-bind:key="category.id">
    <router-link :to="`/f/${category.id}`">{{ category.name }}</router-link>
  </div>
</template>
<script>
export default {
  // setup() {},
  data() {
    return {
      forumOptions: [],
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
          // console.log(response.data);
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