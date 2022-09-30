<template>
  <!-- 聊天，需登入 -->
  <div class="container text-center mainarea">
    <div class="row">
      <div class="col-3">
        <div class="messages" v-for="m in room" v-bind:key="m.id">
          <button
            class="messagesButton"
            name="{{m.text}}"
            type="submit"
            value="{{m.id}}"
            v-on:click="contactPerson(m.id)"
          >
            {{ m.name }}
          </button>
        </div>
      </div>
      <div class="col-6">
        <table class="chatTable" v-if="contactNames.length !== 0">
          <select
            class="form-select"
            aria-label="Default select example"
            v-for="user in contactNames"
            v-bind:key="user.id"
          >
            <option selected>聯絡人</option>
            <option value="1">{{ user.name }}</option>
          </select>
          <!-- 聊天視窗 -->
          <tr>
            <td>
              <div class="rightChatContent">
                <!-- <div class="other">
                  <div class="dialog"></div>
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
                </div> -->
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="msg" id="msg">
                <input
                  type="text"
                  placeholder="輸入訊息"
                  class="form-control"
                  v-model="inputMessage"
                />
                <button type="button" v-on:click="submit">
                  <i class="fa-regular fa-paper-plane"></i>
                </button>
              </div>
            </td>
            <!-- <sender></sender> -->
          </tr>
        </table>
      </div>
    </div>
    <div class="col-1"></div>
  </div>
</template>

<script>
// socket io - client side

import ReceiverComponent from "./ReceiverComponent.vue";
import Sender from "./SendComponent.vue";

export default {
  components: {
    // ReceiverComponent,
    // Sender,
  },
  data() {
    return {
      isLoggedIn: false,
      contactNames: [],
      inputMessage: "",
      room: [
        { id: 1, name: "私人訊息", text: "privateChat" },
        { id: 2, name: "群組", text: "groupChat" },
      ],
      chats: "",
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
    // this.contactPerson();
  },
  methods: {
    submit() {
      console.log("chat");

      let ip_address = "127.0.0.1";
      let socket_port = "3000";
      let socket = io(ip_address + ":" + socket_port);
      socket.on("connection");

      if (this.inputMessage !== null) {
        console.log("Me: " + this.inputMessage);

        // 觸發事件，把訊息傳到server.js
        socket.emit("sendChatToServer", this.inputMessage);
        // 清空
        this.inputMessage = "";
      }
      // receive
      socket.on("sendChatToClient", function (message) {
        // $(".rightChatContent ul").append(`<p>${message}</p>`);
        console.log("Other:" + message);
        // this.chats = message;
      });
    },
    /**
     * 聯絡人
     */
    contactPerson(chatRoomId) {
      if (chatRoomId !== 2) {
        axios
          .get(
            "api/lel/messages/privatechat/" +
              sessionStorage.getItem("id") +
              "/" +
              sessionStorage.getItem("name")
          )
          // .get("api/lel/messages/" + sessionStorage.getItem("id"))
          .then((response) => {
            console.log(response.data.data_return);
            this.contactNames = response.data.data_return;
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        console.log("群組");
        this.contactNames = "";
        // axios
        //   .get("api/lel/messages/public")
        //   // .get("api/lel/messages/" + sessionStorage.getItem("id"))
        //   .then((response) => {
        //     console.log(response.data.data_return);
        //     this.contactNames = response.data.data_return;
        //   })
        //   .catch((error) => {
        //     console.log(error);
        //   });
      }
    },
  },
};
</script>
