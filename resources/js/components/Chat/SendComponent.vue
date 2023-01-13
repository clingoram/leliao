<template>
  <!-- 發送訊息 -->
  <!-- <form>
    <input type="text" v-model="message" />
    <button type="button" @click="submit">點我送出</button>
  </form> -->
  <tr>
    <td>
      <div class="msg" id="msg">
        <input
          type="text"
          v-model="inputMessage"
          placeholder="輸入訊息"
          class="form-control"
        />
        <!-- <button type="button" v-on:click="submit">點我送出</button> -->
        <button type="button" v-on:click="submit">
          <i class="fa-regular fa-paper-plane"></i>
        </button>
        <!-- <input
                  type="text"
                  placeholder="輸入訊息"
                  class="form-control"
                  onchange="tt(this.value)"
                /> -->
      </div>
    </td>
  </tr>
</template>
<script>
// import io from "socket.io-client";
export default {
  data() {
    return {
      inputMessage: "",
    };
  },
  created() {},
  methods: {
    submit() {
      console.log("chat");

      let ip_address = "127.0.0.1";
      let socket_port = "3000";
      let socket = io(ip_address + ":" + socket_port);
      socket.on("connection");

      if (this.inputMessage !== null) {
        // 觸發事件，把訊息傳到server.js
        socket.emit("sendChatToServer", this.inputMessage);

        // socket.on("sendChatToClient", function (message) {
        //   $(".chat-content ul").append(`<li>${message}</li>`);
        // });
      }

      // axios.post("api/lel/message", {
      //   message: this.message,
      // });
    },
  },
};
</script>