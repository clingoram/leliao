<template>
  <!-- 首頁 中間 所有 文章區 -->
  <div class="card" v-for="item in posts" v-bind:key="item.id">
    <div class="card-header">{{ item.title }}</div>
    <div class="card-body">
      <h6 class="card-title">分類: {{ item.cName }}</h6>
      <h7 class="card-title">{{ item.uName }}</h7>
      <p class="card-text ellipsis">
        {{ item.content }}
      </p>
      <!-- <router-link v-bind:to="{ name: 'post' }"></router-link> -->

      <!-- <single-post-modal
        v-bind:id="item.id"
        v-bind:openmodal="modalOpen"
      ></single-post-modal> -->

      <!-- modal -->
      <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#singlePost"
        v-bind:id="item.id"
        v-bind:openmodal="modalOpen"
      >
        繼續閱讀
      </button>
      <div
        class="modal fade"
        id="singlePost"
        tabindex="-1"
        aria-labelledby="modalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel">
                {{ item.title }}
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">{{ item.content }}</div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                關閉
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <router-view /> -->
</template>
<script>
// import singlePostModal from "../Post/PostComponent.vue";

export default {
  components: {
    // singlePostModal,
  },
  props: {
    id: {
      tpye: Number,
    },
    openmodal: {
      type: Boolean,
    },
  },

  data() {
    return {
      posts: [],
      modalOpen: false,
    };
  },
  created() {
    this.getAllPosts();
    // this.$router.push({ path: `/${forumOptions}/${posts.id}` });
  },
  methods: {
    getAllPosts() {
      axios
        .get("api/lel/posts")
        .then((response) => {
          // console.log(response.data.data_return);
          this.posts = response.data.data_return;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
