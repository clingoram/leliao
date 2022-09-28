<template>
  <!-- 聊天，需登入 -->
  <div class="container chatarea">
    <div class="row">
      <div class="col-2 py-3 px-0 contact_person">
        <!-- 聯絡人 -->
        <table class="chatTable">
          <template v-for="user in contactNames" v-bind:key="user.id">
            <tr>
              <td>{{ user.name }}</td>
            </tr>
          </template>
        </table>
      </div>
      <div class="col-8 px-0 shadow">
        <!-- 聊天視窗 -->
        <table class="chatTable">
          <receiver-component></receiver-component>
          <!-- <tr>
            <td>
              <div class="rightChatContent">
                <div class="other">
                  <div class="dialog">對方說什麼</div>
                  <p>12:34</p>
                </div>
                <div class="self">
                  <div class="dialog">我說什麼</div>
                  <p>12:34</p>
                  <span class="read">已讀</span>
                </div>
                <div class="other">
                  <div class="dialog">對方再說甚麼</div>
                  <p>12:34</p>
                </div>
              </div>
            </td>
          </tr> -->
          <!-- <tr> -->
          <!-- <td>
              <div class="msg" id="msg">
                <input
                  type="text"
                  placeholder="輸入訊息"
                  class="form-control"
                />
              </div>
            </td> -->
          <sender></sender>
          <!-- </tr> -->
        </table>
      </div>
    </div>
  </div>
</template>

<script>
// socket io - client side
import ReceiverComponent from "./ReceiverComponent.vue";
import Sender from "./SendComponent.vue";
export default {
  components: {
    ReceiverComponent,
    Sender,
  },
  data() {
    return {
      isLoggedIn: false,
      contactNames: [],
    };
  },
  created() {
    if (
      sessionStorage.getItem("identity") !== null &&
      sessionStorage.getItem("identity") !== "undefined"
    ) {
      this.name = sessionStorage.getItem("name");
      this.isLoggedIn = true;
    } else {
      this.isLoggedIn = false;
    }
    this.contactPerson();
  },
  methods: {
    sendChat() {},
    /**
     * 聯絡人
     */
    contactPerson() {
      axios
        .get(
          "api/lel/messages/" +
            sessionStorage.getItem("id") +
            "/" +
            sessionStorage.getItem("name")
        )
        .then((response) => {
          // console.log(response.data.data_return);
          this.contactNames = response.data.data_return;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
