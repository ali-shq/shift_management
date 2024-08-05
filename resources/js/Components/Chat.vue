<template>
    <div class="container">
        <div class="row">
            <div
                v-for="message in messages"
                :key="message.id"
                class="col-md-8 offset-md-2 leading-1.5 w-full max-w-[320px] rounded-e-xl rounded-es-xl border-gray-200 bg-gray-100 p-4 dark:bg-gray-700"
            >
                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                    <span
                        class="text-sm font-semibold text-gray-900 dark:text-white"
                        >{{ message.user.name }}</span
                    >
                    <span
                        class="text-sm font-normal text-gray-500 dark:text-gray-400"
                        >{{ message.user.created_at }}</span
                    >
                </div>
                <p
                    class="py-2.5 text-sm font-normal text-gray-900 dark:text-white"
                >
                    {{ message.message }}
                </p>
                <span
                    class="text-sm font-normal text-gray-500 dark:text-gray-400"
                    >Delivered</span
                >
            </div>
            <button
                id="dropdownMenuIconButton"
                data-dropdown-toggle="dropdownDots"
                data-dropdown-placement="bottom-start"
                class="inline-flex items-center self-center rounded-lg bg-white p-2 text-center text-sm font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-50 dark:bg-gray-900 dark:text-white dark:hover:bg-gray-800 dark:focus:ring-gray-600"
                type="button"
            >
                <svg
                    class="h-4 w-4 text-gray-500 dark:text-gray-400"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 4 15"
                >
                    <path
                        d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"
                    />
                </svg>
            </button>
            <div
                id="dropdownDots"
                class="z-10 hidden w-40 divide-y divide-gray-100 rounded-lg bg-white shadow dark:divide-gray-600 dark:bg-gray-700"
            >
                <ul
                    class="py-2 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownMenuIconButton"
                >
                    <li>
                        <a
                            href="#"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            >Reply</a
                        >
                    </li>
                    <li>
                        <a
                            href="#"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            >Forward</a
                        >
                    </li>
                    <li>
                        <a
                            href="#"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            >Copy</a
                        >
                    </li>
                    <li>
                        <a
                            href="#"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            >Report</a
                        >
                    </li>
                    <li>
                        <a
                            href="#"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            >Delete</a
                        >
                    </li>
                </ul>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Chat Room</div>
                    <div
                        class="card-body"
                        style="height: 400px; overflow-y: scroll"
                    >
                        <ul class="list-unstyled">
                            <li v-for="message in messages" :key="message.id">
                                <strong>{{ message.user.name }}:</strong>
                                {{ message.message }}
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <input
                            type="text"
                            class="form-control"
                            v-model="newMessage"
                            @keyup.enter="sendMessage"
                        />
                        <button
                            class="btn btn-primary mt-2"
                            @click="sendMessage"
                        >
                            Send
                        </button>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            messages: [],
            newMessage: "",
        };
    },
    mounted() {
        this.fetchMessages();
        Echo.join("chat")
            .here((users) => {
                console.log("Users online:", users);
            })
            .joining((user) => {
                console.log(user.name + " joined.");
            })
            .leaving((user) => {
                console.log(user.name + " left.");
            })
            .listen("MessageSent", (e) => {
                this.messages.push(e.message);
            });
    },
    methods: {
        fetchMessages() {
            axios.get("/messages").then((response) => {
                this.messages = response.data
                    .sort((a, b) => a.created_at - b.created_at)
                    .reverse();
            });
        },
        sendMessage() {
            if (this.newMessage === "") {
                return;
            }
            axios
                .post("/messages", { message: this.newMessage })
                .then((response) => {
                    this.newMessage = "";
                });
        },
    },
};
</script>
