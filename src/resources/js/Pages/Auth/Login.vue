<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import AppLayout from "../../Layouts/AppLayout.vue";

const form = useForm({
    email: "",
    password: "",
});

const submit = () => {
    form.post("/login");
};
</script>

<template>
    <AppLayout>
        <Head title="Inicia Sesión" />
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold">Inicia Sesión</h1>
                </div>
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"
                >
                    <form class="max-w-md mx-auto" @submit.prevent="submit">
                        <div class="mb-4">
                            <label
                                for="email"
                                class="block text-sm font-medium text-gray-700"
                                >Email</label
                            >
                            <input
                                v-model="form.email"
                                type="email"
                                placeholder="Email"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                :class="{ 'border-red-500': form.errors.email }"
                            />
                            <div
                                v-if="form.errors.email"
                                class="text-red-500 text-xs mt-1"
                            >
                                {{ form.errors.email }}
                            </div>
                        </div>

                        <div class="mb-6">
                            <label
                                for="password"
                                class="block text-sm font-medium text-gray-700"
                                >Contraseña</label
                            >
                            <input
                                id="password"
                                type="password"
                                v-model="form.password"
                                placeholder="Contraseña"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                :class="{
                                    'border-red-500': form.errors.password,
                                }"
                            />
                            <div
                                v-if="form.errors.password"
                                class="text-red-500 text-xs mt-1"
                            >
                                {{ form.errors.password }}
                            </div>
                        </div>
                        <div class="flex items-center justify-end space-x-4">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50"
                            >
                                <span v-if="form.processing">Espere...</span>
                                <span v-else>Entrar</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
