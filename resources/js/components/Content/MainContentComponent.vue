<template>
  <!-- 下方看板區塊和文章區塊 -->
  <div class="container text-center mainarea">
    <div class="row">
      <div class="col">
        <!-- 看板區 -->
        <div v-if="forumOptions.length !== 0">
          <button
            class="forumsButton"
            name="whole"
            type="submit"
            value="0"
            v-on:click="getPosts(0)"
          >
            全部
          </button>
          <div
            class="forums"
            v-for="category in forumOptions"
            v-bind:key="category.id"
          >
            <button
              class="forumsButton"
              name="{{category.name}}"
              type="submit"
              value="{{category.id}}"
              v-on:click="getPosts(category.id)"
            >
              {{ category.name }}
            </button>
          </div>
        </div>
        <div v-else>
          <div v-show="(showForum = false)">
            <p>目前沒有可用看板喔!</p>
          </div>
        </div>
      </div>
      <div class="col-6">
        <!-- 文章區 -->
        <div v-if="wholeData.length !== 0">
          <div class="card" v-for="item in wholeData" v-bind:key="item.cId">
            <div class="card-header">{{ item.title }}</div>
            <div class="card-body">
              <h6 class="card-title">分類: {{ item.cName }}</h6>
              <h7 class="card-title">{{ item.uName }}</h7>
              <p class="card-text ellipsis">
                {{ item.content }}
              </p>

              <!-- <router-link
                v-bind:to="{
                  name: 'post',
                  params: { categoryId: item.cId, id: item.id },
                }"
                tag="button"
                >繼續閱讀</router-link
              > -->

              <!-- <single-post-modal
                v-bind:id="item.id"
                v-bind:cId="item.cId"
                v-bind:openmodal="modalOpen"
                name="modal"
                >繼續閱讀</single-post-modal
              > -->

              <!-- modal -->

              <!-- <button
                type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#singlePost"
                v-bind:id="item.id"
                v-bind:openmodal="modalOpen"
                v-on:click="getSpecificPost(item.cId, item.id)"
              >
                繼續閱讀
              </button> -->
              <!-- <label>{{ clickChecked }}</label> -->
              <button
                type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#singlePost"
                v-bind:id="item.id"
                v-on:click="getSpecificPost(item.cId, item.id)"
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
        </div>
        <div v-else>還沒有文章喔!要新增嗎?</div>
      </div>
      <div class="col"></div>
    </div>
  </div>
</template>
<script>
import singlePostModal from "../Post/PostComponent.vue";
export default {
  // props: ["categoryId", "id", "openmodal"],
  props: {
    id: {
      tpye: Number,
    },
    categoryId: {
      type: Number,
    },
    openmodal: {
      type: Boolean,
    },
  },
  components() {
    singlePostModal;
  },
  data() {
    return {
      // for forums
      forumOptions: [],
      showForum: false,
      // for posts
      wholeData: [],
      categoryId: 0, // default all posts.
      // specific post.
      specificPost: [],
      // modalOpen: false,
    };
  },
  async beforeMount() {
    // get all forums.
    axios
      .get("api/lel/f/all")
      .then((response) => {
        // console.log(response.data);
        this.forumOptions = response.data;
        this.showForum = true;
      })
      .catch((error) => {
        console.log(error);
      });
  },
  created() {
    this.getPosts(this.categoryId);
  },
  methods: {
    // 取特定分類內所有文章
    getPosts(forumId) {
      axios
        .get("api/lel/f/" + forumId + "/posts")
        .then((response) => {
          // console.log(response.data.data_return);
          this.wholeData = response.data.data_return;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // 取得特定看板內的某文章
    getSpecificPost(forumId, postId) {
      axios
        .get("api/lel/f/" + forumId + "/post/" + postId)
        .then(function (response) {
          console.log(response.data.data_return);

          // this.specificPost = response.data.data_return;
          // console.log(this.specificPost);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    // 離開modal就清除
    // resetModal() {
    //   this.specificPost = null;
    // },
  },
};
</script>
