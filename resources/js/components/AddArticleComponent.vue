<template>
  <!-- 新增文章，登入才能看到 -->
  <div class="container" v-if="isLoggedIn">
    <div class="mb-3">
      <label for="articleTitle" class="form-label">文章標題</label>
      <input
        type="text"
        class="form-control"
        id="articleTitle"
        v-model="articleTitle"
        placeholder="這是文章標題喔!"
      />
    </div>
    <select v-model="selected">
      <option
        v-for="option in categoryOptions"
        v-bind:key="option.id"
        :value="option.id"
      >
        {{ option.name }}
      </option>
    </select>

    <div class="mb-3">
      <label for="articelContent" class="form-label">內容</label>
      <textarea
        class="form-control"
        id="articelContent"
        rows="3"
        v-model="articelContent"
      ></textarea>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary" v-on:click="save()">
        Submit
      </button>
    </div>
  </div>
  <div v-if="!isLoggedIn">你還沒登入喔!</div>
</template>
<script>
export default {
  data() {
    return {
      isLoggedIn: true,
      // post: {
      id: "",
      // 文章標題
      articleTitle: "",
      // 文章內容
      articelContent: "",
      // },
      // 分類
      selected: null,
      categoryOptions: [],
    };
  },
  created() {
    this.getAllForums();
  },
  async beforeMount() {
    if (sessionStorage.getItem("token") === null) {
      this.isLoggedIn = false;
    }
  },
  methods: {
    // 所有分類看板
    getAllForums() {
      axios
        .get("api/lel/f/all")
        .then((response) => {
          this.categoryOptions = response.data;
          // console.log(this.categoryOptions);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    save() {
      this.id = sessionStorage.getItem("id");
      console.log(this.id);
      console.log(this.selected);
      console.log(this.articleTitle);
      console.log(this.articelContent);
      axios
        .post("api/lel/add_post", {
          userId: this.id,
          title: this.articleTitle,
          content: this.articelContent,
          // post: this.post,
          category: this.selected,
        })
        .then((response) => {
          console.log(response);
          // console.log(response.data.user);
          confirm("新增成功");

          // redirect to home page.
          document.location.href = "/";
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>