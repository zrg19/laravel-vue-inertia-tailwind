<template>
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img
                class="mx-auto h-12 w-auto"
                src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                alt="Your Company"
            />
            <h2
                class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900"
            >
                Sign in to your account
            </h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form
                    class="space-y-6"
                    action="#"
                    method="POST"
                    @submit.prevent="submit"
                >
                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Email address</label
                        >
                        <div class="mt-2">
                            <input
                                id="email"
                                name="email"
                                type="email"
                                autocomplete="email"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                v-model="form.email"
                                @input="handleInput"
                            />
                        </div>
                        <ShowError :error="form.errors.email" />
                    </div>

                    <div>
                        <label
                            for="password"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Password</label
                        >
                        <div class="mt-2">
                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                v-model="form.password"
                                @input="handleInput"
                            />
                        </div>
                        <ShowError :error="form.errors.password" />
                    </div>

                    <div>
                        <!-- <Link
                            href="/auth/login"
                            method="post"
                            as="button"
                            type="button"
                            :data="form"
                            replace
                        > -->
                        <button
                            type="submit"
                            class="flex w-full justify-center rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                            :disabled="form.processing"
                        >
                            Sign in
                        </button>
                        <!-- </Link> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import ShowError from "@/components/ShowError.vue";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

const toast = useToast();

const form = useForm({
    email: "admin@admin.com",
    password: "password",
});

function submit() {
    form.post("/auth/login", {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Your are logged in!");
            form.reset("password");
        },
    });
}

function handleInput(e) {
    form.clearErrors(e.target.name);
}
</script>
