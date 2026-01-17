<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
const props = defineProps({
    seller: Object,
    lotes: Object,
});

const form = useForm({
    name:  props.seller.name,
    username: props.seller.username,
    email: props.seller.email,
    phone: props.seller.phone,
    lote_id: props.seller.lote_id,
});

const submit = () => {
    form.put(`/seller/${props.seller.id}`,{
        onFinish: () => form.reset('name', 'username', 'email', 'phone', 'lote_id'),
    });
    
};
</script>

<template>
    <AppLayout>
        <Head title="Actualizar Vendedor" />
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form @submit.prevent="submit" class="max-w-md mx-auto">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Vendedor</label>
                            <input
                                id="name"
                                type="text"
                                v-model="form.name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                :class="{ 'border-red-500': form.errors.name }"
                            />
                            <div v-if="form.errors.name" class="text-red-500 text-xs mt-1">
                                {{ form.errors.name }}
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                             <input
                                id="username"
                                type="text"
                                v-model="form.username"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                :class="{ 'border-red-500': form.errors.username }"
                            />
                            <div v-if="form.errors.username" class="text-red-500 text-xs mt-1">
                                {{ form.errors.username }}
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="email" class="block text-sm font-medium text-gray-700">Correo Electronico</label>
                             <input
                                id="email"
                                type="email"
                                v-model="form.email"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                :class="{ 'border-red-500': form.errors.email }"
                            />
                            <div v-if="form.errors.email" class="text-red-500 text-xs mt-1">
                                {{ form.errors.email }}
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Telefono</label>
                             <input
                                id="phone"
                                type="text"
                                v-model="form.phone"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                :class="{ 'border-red-500': form.errors.phone }"
                            />
                            <div v-if="form.errors.phone" class="text-red-500 text-xs mt-1">
                                {{ form.errors.phone }}
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="lote_id" class="block text-sm font-medium text-gray-700">Lote</label>
                             <select 
                                id="lote_id"
                                v-model="form.lote_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" >
                                <option 
                                    v-for="lote in props.lotes" 
                                    :key="lote.id"
                                    :value="lote.id"

                                    >
                                    {{ lote.name }}
                                </option>
                            </select>
                            <div v-if="form.errors.phone" class="text-red-500 text-xs mt-1">
                                {{ form.errors.lote_id }}
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <Link href="/seller" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                Cancelar
                            </Link>
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50"
                            >
                                <span v-if="form.processing">Guardando...</span>
                                <span v-else>Actualizar Vendedor</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>