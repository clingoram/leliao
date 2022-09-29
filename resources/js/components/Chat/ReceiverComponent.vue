<template>
  <!-- 訊息顯示 -->
  <template v-for="message in messages" v-bind:key="message">
    <tr>
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
    </tr>
  </template>
</template>

<script>
export default {
  data() {
    return {
      messages: ["Hello"],
      // messages: [],
    };
  },
  created() {
    this.receiveMessages();
  },
  methods: {
    receiveMessages() {
      let ip_address = "127.0.0.1";
      let socket_port = "3000";
      let socket = io(ip_address + ":" + socket_port);
      socket.on("connection");

      socket.on("sendChatToClient", function (message) {
        $(".chat-content ul").append(`<li>${message}</li>`);
        // this.messages = message;
      });
    },
  },
};
</script>