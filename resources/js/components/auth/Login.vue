<template>
    <div>
        <div
            class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"
        >
            <div
                class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
            >
                <form @submit.prevent="login">
                    <div>
                        <label
                            for="email"
                            value="email"
                            class="block font-medium text-sm text-gray-700"
                        >
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="email"
                                name="email"
                                v-model="form.email"
                                required
                                autofocus
                            />
                        </label>
                    </div>

                    <div class="mt-4">
                        <label
                            for="password"
                            value="password"
                            class="block font-medium text-sm text-gray-700"
                        >
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="password"
                                name="password"
                                v-model="form.password"
                                required
                            />
                        </label>
                    </div>

                    <div class="block mt-4">
                        <label
                            for="remember_me"
                            class="inline-flex items-center"
                        >
                            <input
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="checkbox"
                                name="remember"
                                v-model="form.remember"
                            />
                            <span class="ml-2 text-sm text-gray-600"
                                >Recordarme</span
                            >
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button
                            class="ml-3 justify-center inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150"
                        >
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            form: {
                email: '',
                password: '',
                remember: false
            }
        };
    },

    methods: {
        login() {
            axios.post('/api/login', {...this.form})
                .then(response => {
                    localStorage.setItem('token', response.data.token);
                    localStorage.setItem('user_id', response.data.user_id);
                });


        }
    }
};
</script>
