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
              <h6 class="replyer">{{ item.cName }} - {{ item.uName }}</h6>
              <!-- <h7 class="card-title">{{ item.uName }}</h7> -->
              <p class="card-text ellipsis">
                {{ item.content }}
              </p>
              <!-- data-bs-target="#singlePost" -->
              <button
                type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#staticBackdrop"
                v-bind:id="item.id"
                v-on:click="getSpecificPost(item.cId, item.id)"
              >
                繼續閱讀
              </button>
            </div>
          </div>

          <!-- modal start-->
          <div
            class="modal fade"
            id="staticBackdrop"
            tabindex="-1"
            aria-labelledby="staticBackdropLabel"
            aria-hidden="true"
            data-bs-backdrop="static"
            data-bs-keyboard="false"
          >
            <div
              class="
                modal-dialog
                modal-lg
                modal-dialog-centered
                modal-dialog-scrollable
              "
            >
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="modalLabel">
                    {{ specificPostData.title }}
                  </h4>

                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    v-on:click="clear()"
                  ></button>
                </div>
                <div class="modal-body">
                  <p class="replyer">
                    {{ specificPostData.categoryName }} -
                    {{ specificPostData.author }} <br />更新於
                    {{ timeLag(this.specificPostData.createdAt) }}
                  </p>
                  {{ specificPostData.content }}

                  <hr />
                  <div v-if="isLoggedIn === false">
                    <p>要先登入才能回應喔!</p>
                  </div>
                  <div v-if="isLoggedIn === true">
                    <div class="replyArea">
                      <!-- <form> -->
                      <div class="mb-3">
                        <label for="message-text" class="col-form-label"
                          >回覆:</label
                        >
                        <textarea
                          class="form-control"
                          id="message-text"
                          v-model.trim="replyArea.replyContent"
                        ></textarea>
                        <button
                          type="submit"
                          class="btn btn-primary replyButton"
                          v-on:click="reply()"
                        >
                          發送
                        </button>
                      </div>
                      <!-- </form> -->
                    </div>
                  </div>
                  <div>
                    <hr />
                    <!-- 留言區 -->
                    <ul>
                      <li
                        v-for="comments in replyData"
                        v-bind:key="comments.id"
                      >
                        <p class="replyer">
                          {{ comments.replyName }} -
                          {{ timeLag(comments.created_at) }}
                        </p>
                        {{ comments.content }}<br />
                        <p
                          class="heart"
                          v-on:click="likeit(comments.id, comments.heart)"
                        >
                          <!-- <i class="fa-regular fa-heart"></i
                          > -->
                          Do you like it? {{ comments.heart }}
                        </p>
                        <hr />
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                    v-on:click="clear()"
                  >
                    關閉
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- modale end -->
        <div v-else>還沒有文章喔!要新增嗎?</div>
      </div>
      <div class="col"></div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      // checked is loggin or not.
      isLoggedIn: sessionStorage.getItem("token") ? true : false,
      // 所有看板(只顯示現有看板)
      forumOptions: [],
      showForum: false,
      // 預設不分看板id為0。後面SQL會做顯示所有文章
      categoryId: 0,
      // 首頁文章，依據categoryId或forumOptions點擊，做SQL條件顯示對應文章
      wholeData: [],
      // modal顯示單一文章
      specificPostData: {
        id: "",
        title: "",
        author: "",
        content: "",
        categoryName: "",
        cid: "",
        createdAt: "",
      },
      // reply show with modal.
      replyData: [],
      // floor: [],
      // 回應區，insert into table.
      replyArea: {
        replyUserId: sessionStorage.getItem("id"),
        replyUserName: sessionStorage.getItem("name"),
        replyContent: "",
      },
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
          alert("無文章");
          console.log(error.message);
        });
    },
    // 取得特定看板內的某文章
    getSpecificPost(forumId, postId) {
      // call table comments.
      this.getPostComments(forumId, postId);
      axios
        .get("api/lel/f/" + forumId + "/post/" + postId)
        .then((response) => {
          // console.log(response.data.data_return);
          this.specificPostData.id = response.data.data_return.id;
          this.specificPostData.title = response.data.data_return.title;
          this.specificPostData.author = response.data.data_return.uName;
          this.specificPostData.content = response.data.data_return.content;
          this.specificPostData.cid = response.data.data_return.cId;
          this.specificPostData.categoryName = response.data.data_return.cName;
          this.specificPostData.createdAt =
            response.data.data_return.created_at;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // 取得文章留言
    getPostComments(categoryId, id) {
      axios
        .get("api/lel/f/" + categoryId + "/post/c/" + id)
        .then((response) => {
          // console.log(response.data.data_return.length);
          // let length = response.data.data_return.length;
          // for (let i = 1; i <= length; i++) {
          //   this.floor.push(i);
          // }
          // console.log(this.floor);
          this.replyData = response.data.data_return;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // 回覆該文章(需登入)
    reply() {
      if (
        this.replyArea.replyContent.length < 2 ||
        this.replyArea.replyContent.length > 200
      ) {
        alert("內容記得填寫。");
        return;
      }
      axios
        .post(
          "api/lel/f/" +
            this.specificPostData.cid +
            "/post/r/" +
            this.specificPostData.id,
          {
            postId: this.specificPostData.id,
            categoryId: this.specificPostData.cid,
            data: this.replyArea,
          }
        )
        .then((response) => {
          // console.log(response);
          document.location.href = "/";
        })
        .catch((error) => {
          console.log(error);
        });
    },
    likeit(commentId, heart) {
      // console.log(heart);
      if (this.isLoggedIn === false) {
        alert("請先登入");
      } else {
        const increase = heart + 1;
        axios
          .put(
            "api/lel/f/" +
              this.specificPostData.cid +
              "/post/r/" +
              this.specificPostData.id +
              "/l/" +
              commentId,
            {
              commentId: commentId,
              heart: increase,
            }
          )
          .then((response) => {
            // console.log(response);
            document.location.href = "/";
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    // 關閉modal時清除留言
    clear() {
      this.replyData = [];
    },
    // 時間
    timeLag(datetime) {
      const date = new Date(datetime);
      // 年份
      const year = date.getFullYear();
      // 月份
      const month =
        date.getMonth() + 1 < 10 ? date.getMonth() + 1 : date.getMonth() + 1;
      // 日期
      const day = date.getDate() < 9 ? "0" + date.getDate() : date.getDate();
      // 時
      const hours =
        date.getHours() < 9 ? "0" + date.getHours() : date.getHours();
      // 分
      const minutes =
        date.getMinutes() < 9 ? "0" + date.getMinutes() : date.getMinutes();
      // 秒
      const sec =
        date.getSeconds() < 9 ? "0" + date.getSeconds() : date.getSeconds();
      // 毫秒
      const millSec =
        date.getMilliseconds() < 9
          ? "0" + date.getMilliseconds()
          : date.getMilliseconds();

      return year + "-" + month + "-" + day + " " + hours + ":" + minutes;
    },
  },
};
</script>
