<template>
  <!-- 新增文章，登入才能看到 -->
  <div class="container" v-if="isLoggedIn">
    <!-- <div class="mb-3">
      <label for="articleTitle" class="form-label">文章標題</label>
      <input
        type="text"
        class="form-control"
        id="articleTitle"
        v-model="post.title"
        v-bind:max="max"
        v-bind:min="min"
        placeholder="這是文章標題喔!"
        required
      />
    </div> -->
    <div class="input-group mb-3">
      <span class="input-group-text" id="title">文章標題</span>
      <input
        type="text"
        class="form-control"
        aria-label="Sizing example input"
        aria-describedby="articleTitle"
        id="articleTitle"
        v-model="post.title"
        v-bind:max="max"
        v-bind:min="min"
        placeholder="這是文章標題喔!"
        required
      />
    </div>
    <!-- <div class="mb-3">
      <div>看板分類</div>
      <select v-model="post.category_id">
        <option disabled value="">請選擇看板分類</option>
        <option
          v-for="option in categoryOptions"
          v-bind:key="option.id"
          :value="option.id"
        >
          {{ option.name }}
        </option>
      </select>
    </div> -->

    <div class="input-group mb-3">
      <span class="input-group-text">看板分類</span>
      <select
        class="form-select"
        id="inputGroupSelect03"
        v-model="post.category_id"
      >
        <option disabled value="">請選擇看板分類</option>
        <option
          v-for="option in categoryOptions"
          v-bind:key="option.id"
          v-bind:value="option.id"
        >
          {{ option.name }}
        </option>
      </select>
    </div>

    <div class="mb-3">
      <label for="articelContent" class="form-label">內容</label>
      <textarea
        class="form-control"
        id="articelContent"
        rows="3"
        v-model="post.content"
        placeholder="在這打上內容!"
        required
      ></textarea>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary" v-on:click="savePost()">
        儲存
      </button>
    </div>
  </div>
  <div class="warning" v-if="!isLoggedIn">你還沒登入喔!</div>
</template>
<script>
export default {
  data() {
    return {
      max: 15,
      min: 5,
      isLoggedIn: true,
      post: {
        writer_id: sessionStorage.getItem("id"),
        // 文章標題
        title: "",
        // 文章內容
        content: "",
        // 分類
        category_id: null,
        categoryOptions: [],
      },
    };
  },
  async beforeMount() {
    if (
      sessionStorage.getItem("token") === null ||
      sessionStorage.getItem("token") === "undefined"
    ) {
      this.isLoggedIn = false;
    }
  },
  created() {
    this.allCategory();
  },
  methods: {
    allCategory() {
      axios
        .get("api/lel/f/all")
        .then((response) => {
          this.categoryOptions = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    savePost() {
      if (
        this.post.title === null ||
        this.post.title < 5 ||
        this.post.category_id === null ||
        this.post.content === null ||
        this.post.content.length < 5
      ) {
        return;
      }
      axios
        .post("api/lel/add_post", {
          post: this.post,
        })
        .then((response) => {
          // console.log(response);
          confirm("新增成功");
          document.location.href = "/";
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>