<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import ConfirmDialog from '@/Components/ConfirmDialog.vue';
import { ref } from 'vue';

defineProps({
    users: Array,
    schools: Array,
});

const form = useForm({
    name: '',
    email: '',
    password: '',
    role: 'OPERATOR',
    school_id: '',
});

function submit() {
    form.post(route('users.store'), {
        onSuccess: () => {
            form.reset('name', 'email', 'password', 'school_id');
        },
    });
}

// Buka dialog konfirmasi
function hapus(id) {
    deleteUserId.value = id;
}

// Jalankan penghapusan setelah user menekan "Ya, Lanjutkan"
function doDelete() {
    if (!deleteUserId.value) {
        return;
    }

    router.delete(
        route('users.destroy', deleteUserId.value),
        {
            onFinish: () => {
                deleteUserId.value = null;
            },
        }
    );
}

const roleLabel = {
    OPERATOR: 'Operator',
    ADMIN_CABDIN: 'Admin Cabdin',
    SUPER_ADMIN: 'Super Admin',
};

const deleteUserId = ref(null);
</script>

<template>
    <Head title="Manajemen User" />

    <ConfirmDialog
        :show="!!deleteUserId"
        title="Hapus Akun"
        message="Hapus akun ini? Tindakan tidak dapat dibatalkan."
        confirmText="Ya, Hapus"
        @confirm="doDelete"
        @cancel="deleteUserId = null"
    />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-3">

                <div>
                    <h2 class="text-xl font-bold tracking-tight text-slate-900">
                        Manajemen User
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Kelola akun Admin, Operator, dan Super Admin
                    </p>
                </div>
            </div>
        </template>

        <div class="min-h-[calc(100vh-72px)] bg-slate-50 py-8">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

                <!-- PAGE INTRO -->
                <div>
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 border border-blue-100 text-[#28558f] text-xs font-semibold"
                    >
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-blue-600"
                        ></span>

                        Administrasi Pengguna
                    </div>

                    <h1
                        class="mt-3 text-2xl sm:text-3xl font-bold tracking-tight text-slate-950"
                    >
                        Kelola Akun Sistem
                    </h1>

                    <p class="mt-2 text-sm leading-6 text-slate-500 max-w-2xl">
                        Buat akun baru dan kelola akses pengguna yang terhubung
                        dengan sekolah masing-masing.
                    </p>
                </div>


                <!-- CREATE USER -->
                <div
                    class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden"
                >

                    <!-- CARD HEADER -->
                    <div
                        class="px-5 sm:px-6 py-4 border-b border-slate-100 flex items-center gap-3"
                    >
                        <div
                            class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center shrink-0"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="w-5 h-5 text-[#28558f]"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                                />
                                <circle cx="9" cy="7" r="4" />
                                <path
                                    stroke-linecap="round"
                                    d="M19 8v6M16 11h6"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-sm font-bold text-slate-900">
                                Tambah Akun
                            </h3>

                            <p class="text-xs text-slate-500 mt-0.5">
                                Buat akun pengguna baru untuk mengakses sistem.
                            </p>
                        </div>
                    </div>


                    <!-- FORM -->
                    <form
                        @submit.prevent="submit"
                        class="p-5 sm:p-6"
                    >

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            <!-- NAME -->
                            <div>
                                <label
                                    for="name"
                                    class="block text-xs font-semibold text-slate-700 mb-2"
                                >
                                    Nama
                                </label>

                                <input
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    autocomplete="name"
                                    placeholder="Nama lengkap pengguna"
                                    class="block w-full rounded-xl border-slate-200 bg-slate-50/50 text-sm text-slate-700 placeholder:text-slate-400 focus:border-[#28558f] focus:ring-[#28558f]"
                                />

                                <p
                                    v-if="form.errors.name"
                                    class="text-xs text-red-600 mt-1.5"
                                >
                                    {{ form.errors.name }}
                                </p>
                            </div>


                            <!-- EMAIL -->
                            <div>
                                <label
                                    for="email"
                                    class="block text-xs font-semibold text-slate-700 mb-2"
                                >
                                    Email
                                </label>

                                <input
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    autocomplete="email"
                                    placeholder="nama@contoh.id"
                                    class="block w-full rounded-xl border-slate-200 bg-slate-50/50 text-sm text-slate-700 placeholder:text-slate-400 focus:border-[#28558f] focus:ring-[#28558f]"
                                />

                                <p
                                    v-if="form.errors.email"
                                    class="text-xs text-red-600 mt-1.5"
                                >
                                    {{ form.errors.email }}
                                </p>
                            </div>


                            <!-- PASSWORD -->
                            <div>
                                <label
                                    for="password"
                                    class="block text-xs font-semibold text-slate-700 mb-2"
                                >
                                    Password
                                </label>

                                <input
                                    id="password"
                                    v-model="form.password"
                                    type="password"
                                    autocomplete="new-password"
                                    placeholder="Masukkan password"
                                    class="block w-full rounded-xl border-slate-200 bg-slate-50/50 text-sm text-slate-700 placeholder:text-slate-400 focus:border-[#28558f] focus:ring-[#28558f]"
                                />

                                <p
                                    v-if="form.errors.password"
                                    class="text-xs text-red-600 mt-1.5"
                                >
                                    {{ form.errors.password }}
                                </p>
                            </div>


                            <!-- ROLE -->
                            <div>
                                <label
                                    for="role"
                                    class="block text-xs font-semibold text-slate-700 mb-2"
                                >
                                    Role
                                </label>

                                <select
                                    id="role"
                                    v-model="form.role"
                                    class="block w-full rounded-xl border-slate-200 bg-slate-50/50 text-sm text-slate-700 focus:border-[#28558f] focus:ring-[#28558f]"
                                >
                                    <option value="OPERATOR">
                                        Operator
                                    </option>

                                    <option value="ADMIN_CABDIN">
                                        Admin Cabdin
                                    </option>

                                    <option value="SUPER_ADMIN">
                                        Super Admin
                                    </option>
                                </select>
                            </div>


                            <!-- SCHOOL -->
                            <div
                                v-if="form.role === 'OPERATOR'"
                                class="md:col-span-2"
                            >
                                <label
                                    for="school_id"
                                    class="block text-xs font-semibold text-slate-700 mb-2"
                                >
                                    Sekolah
                                </label>

                                <select
                                    id="school_id"
                                    v-model="form.school_id"
                                    class="block w-full rounded-xl border-slate-200 bg-slate-50/50 text-sm text-slate-700 focus:border-[#28558f] focus:ring-[#28558f]"
                                >
                                    <option value="" disabled>
                                        Pilih sekolah
                                    </option>

                                    <option
                                        v-for="s in schools"
                                        :key="s.id"
                                        :value="s.id"
                                    >
                                        {{ s.official_name }}
                                    </option>
                                </select>

                                <p
                                    v-if="form.errors.school_id"
                                    class="text-xs text-red-600 mt-1.5"
                                >
                                    {{ form.errors.school_id }}
                                </p>
                            </div>

                        </div>


                        <!-- ACTION -->
                        <div
                            class="mt-6 pt-5 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4"
                        >
                            <div
                                class="flex items-start gap-2 text-xs text-slate-400"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="w-4 h-4 shrink-0 mt-0.5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 3l7 3v5c0 4.5-2.8 7.7-7 10-4.2-2.3-7-5.5-7-10V6l7-3z"
                                    />
                                </svg>

                                <span>
                                    Pastikan data akun sudah sesuai sebelum
                                    dibuat.
                                </span>
                            </div>

                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#28558f] hover:bg-[#1f4678] disabled:opacity-50 disabled:cursor-not-allowed text-white px-5 py-2.5 text-sm font-semibold shadow-sm hover:shadow-md transition-all duration-200"
                            >
                                <svg
                                    v-if="!form.processing"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    class="w-4 h-4"
                                >
                                    <path
                                        stroke-linecap="round"
                                        d="M12 5v14M5 12h14"
                                    />
                                </svg>

                                <svg
                                    v-else
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    class="w-4 h-4 animate-spin"
                                >
                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="9"
                                        class="opacity-30"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        d="M21 12a9 9 0 00-9-9"
                                    />
                                </svg>

                                {{
                                    form.processing
                                        ? 'Membuat...'
                                        : 'Buat Akun'
                                }}
                            </button>
                        </div>

                    </form>
                </div>


                <!-- USER LIST -->
                <div
                    class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden"
                >

                    <!-- HEADER -->
                    <div
                        class="px-5 sm:px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3"
                    >
                        <div>
                            <h3 class="text-sm font-bold text-slate-900">
                                Daftar Akun
                            </h3>

                            <p class="text-xs text-slate-500 mt-0.5">
                                Pengguna yang telah terdaftar dalam sistem.
                            </p>
                        </div>

                        <div
                            class="inline-flex items-center gap-2 text-xs text-slate-500"
                        >
                            <span
                                class="w-2 h-2 rounded-full bg-blue-500"
                            ></span>

                            {{ users.length }} akun
                        </div>
                    </div>


                    <!-- DESKTOP TABLE -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full text-sm text-left">

                            <thead>
                                <tr
                                    class="bg-slate-50/80 border-b border-slate-100"
                                >
                                    <th
                                        class="px-5 py-3.5 text-[11px] font-bold uppercase tracking-wider text-slate-500"
                                    >
                                        Pengguna
                                    </th>

                                    <th
                                        class="px-5 py-3.5 text-[11px] font-bold uppercase tracking-wider text-slate-500"
                                    >
                                        Role
                                    </th>

                                    <th
                                        class="px-5 py-3.5 text-[11px] font-bold uppercase tracking-wider text-slate-500"
                                    >
                                        Sekolah
                                    </th>

                                    <th
                                        class="px-5 py-3.5 text-[11px] font-bold uppercase tracking-wider text-slate-500 text-right"
                                    >
                                        Aksi
                                    </th>
                                </tr>
                            </thead>


                            <tbody>

                                <tr
                                    v-for="u in users"
                                    :key="u.id"
                                    class="border-b border-slate-100 last:border-0 hover:bg-slate-50/60 transition-colors"
                                >

                                    <!-- USER -->
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3">

                                            <div
                                                class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0"
                                            >
                                                <span
                                                    class="text-sm font-bold text-[#28558f]"
                                                >
                                                    {{ u.name?.charAt(0)?.toUpperCase() }}
                                                </span>
                                            </div>

                                            <div class="min-w-0">
                                                <div
                                                    class="font-semibold text-slate-900 truncate max-w-[220px]"
                                                >
                                                    {{ u.name }}
                                                </div>

                                                <div
                                                    class="text-xs text-slate-400 mt-0.5 truncate max-w-[240px]"
                                                >
                                                    {{ u.email }}
                                                </div>
                                            </div>

                                        </div>
                                    </td>


                                    <!-- ROLE -->
                                    <td class="px-5 py-4">

                                        <span
                                            v-if="u.role === 'SUPER_ADMIN'"
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-purple-50 border border-purple-100 text-purple-700 text-xs font-semibold"
                                        >
                                            <span
                                                class="w-1.5 h-1.5 rounded-full bg-purple-500"
                                            ></span>

                                            {{ roleLabel[u.role] }}
                                        </span>

                                        <span
                                            v-else-if="u.role === 'ADMIN_CABDIN'"
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-blue-50 border border-blue-100 text-[#28558f] text-xs font-semibold"
                                        >
                                            <span
                                                class="w-1.5 h-1.5 rounded-full bg-blue-500"
                                            ></span>

                                            {{ roleLabel[u.role] }}
                                        </span>

                                        <span
                                            v-else
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-700 text-xs font-semibold"
                                        >
                                            <span
                                                class="w-1.5 h-1.5 rounded-full bg-emerald-500"
                                            ></span>

                                            {{ roleLabel[u.role] }}
                                        </span>

                                    </td>


                                    <!-- SCHOOL -->
                                    <td class="px-5 py-4">

                                        <div
                                            v-if="u.school?.official_name"
                                            class="flex items-center gap-2"
                                        >
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                class="w-4 h-4 text-slate-400 shrink-0"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M3 21h18M5 21V10l7-5 7 5v11M9 21v-6h6v6M8 10h.01M12 10h.01M16 10h.01"
                                                />
                                            </svg>

                                            <span
                                                class="text-sm text-slate-600"
                                            >
                                                {{ u.school.official_name }}
                                            </span>
                                        </div>

                                        <span
                                            v-else
                                            class="text-sm text-slate-400"
                                        >
                                            -
                                        </span>

                                    </td>


                                    <!-- ACTION -->
                                    <td class="px-5 py-4 text-right">

                                        <button
                                            @click="hapus(u.id)"
                                            class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-xs font-semibold text-red-600 hover:bg-red-50 transition-colors"
                                        >
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                class="w-4 h-4"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M3 6h18M9 6V4h6v2M19 6l-1 15H6L5 6M10 11v6M14 11v6"
                                                />
                                            </svg>

                                            Hapus
                                        </button>

                                    </td>

                                </tr>


                                <!-- EMPTY -->
                                <tr v-if="users.length === 0">

                                    <td
                                        colspan="4"
                                        class="px-6 py-14 text-center"
                                    >

                                        <div
                                            class="w-14 h-14 mx-auto rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center"
                                        >
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                                class="w-7 h-7 text-slate-300"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                                                />
                                                <circle cx="9" cy="7" r="4" />
                                                <path
                                                    stroke-linecap="round"
                                                    d="M16 11a4 4 0 10-1-7.87"
                                                />
                                            </svg>
                                        </div>

                                        <p
                                            class="mt-4 text-sm font-semibold text-slate-700"
                                        >
                                            Belum ada akun
                                        </p>

                                        <p
                                            class="mt-1 text-xs text-slate-400"
                                        >
                                            Buat akun baru menggunakan form di
                                            atas.
                                        </p>

                                    </td>

                                </tr>

                            </tbody>

                        </table>
                    </div>


                    <!-- MOBILE CARDS -->
                    <div class="md:hidden divide-y divide-slate-100">

                        <div
                            v-for="u in users"
                            :key="u.id"
                            class="p-5"
                        >

                            <div class="flex items-start justify-between gap-4">

                                <div class="flex items-center gap-3 min-w-0">

                                    <div
                                        class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0"
                                    >
                                        <span
                                            class="text-sm font-bold text-[#28558f]"
                                        >
                                            {{ u.name?.charAt(0)?.toUpperCase() }}
                                        </span>
                                    </div>

                                    <div class="min-w-0">
                                        <div
                                            class="font-semibold text-slate-900 truncate"
                                        >
                                            {{ u.name }}
                                        </div>

                                        <div
                                            class="text-xs text-slate-400 mt-0.5 truncate"
                                        >
                                            {{ u.email }}
                                        </div>
                                    </div>

                                </div>

                            </div>


                            <div class="mt-4 space-y-3">

                                <!-- ROLE -->
                                <div>
                                    <div
                                        class="text-[10px] uppercase tracking-wider font-bold text-slate-400 mb-1.5"
                                    >
                                        Role
                                    </div>

                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold"
                                        :class="
                                            u.role === 'SUPER_ADMIN'
                                                ? 'bg-purple-50 border border-purple-100 text-purple-700'
                                                : u.role === 'ADMIN_CABDIN'
                                                    ? 'bg-blue-50 border border-blue-100 text-[#28558f]'
                                                    : 'bg-emerald-50 border border-emerald-100 text-emerald-700'
                                        "
                                    >
                                        <span
                                            class="w-1.5 h-1.5 rounded-full"
                                            :class="
                                                u.role === 'SUPER_ADMIN'
                                                    ? 'bg-purple-500'
                                                    : u.role === 'ADMIN_CABDIN'
                                                        ? 'bg-blue-500'
                                                        : 'bg-emerald-500'
                                            "
                                        ></span>

                                        {{ roleLabel[u.role] }}
                                    </span>
                                </div>


                                <!-- SCHOOL -->
                                <div>
                                    <div
                                        class="text-[10px] uppercase tracking-wider font-bold text-slate-400 mb-1.5"
                                    >
                                        Sekolah
                                    </div>

                                    <div
                                        v-if="u.school?.official_name"
                                        class="flex items-center gap-2 text-sm text-slate-600"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="w-4 h-4 text-slate-400 shrink-0"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3 21h18M5 21V10l7-5 7 5v11M9 21v-6h6v6M8 10h.01M12 10h.01M16 10h.01"
                                            />
                                        </svg>

                                        {{ u.school.official_name }}
                                    </div>

                                    <span
                                        v-else
                                        class="text-sm text-slate-400"
                                    >
                                        Tidak terhubung dengan sekolah
                                    </span>
                                </div>

                            </div>


                            <!-- DELETE -->
                            <button
                                @click="hapus(u.id)"
                                class="mt-5 w-full inline-flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl bg-red-50 hover:bg-red-100 text-red-600 text-xs font-semibold transition-colors"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="w-4 h-4"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 6h18M9 6V4h6v2M19 6l-1 15H6L5 6M10 11v6M14 11v6"
                                    />
                                </svg>

                                Hapus Akun
                            </button>

                        </div>


                        <!-- EMPTY MOBILE -->
                        <div
                            v-if="users.length === 0"
                            class="p-10 text-center"
                        >
                            <div
                                class="w-14 h-14 mx-auto rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    class="w-7 h-7 text-slate-300"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                                    />
                                    <circle cx="9" cy="7" r="4" />
                                    <path
                                        stroke-linecap="round"
                                        d="M16 11a4 4 0 10-1-7.87"
                                    />
                                </svg>
                            </div>

                            <p
                                class="mt-4 text-sm font-semibold text-slate-700"
                            >
                                Belum ada akun
                            </p>

                            <p
                                class="mt-1 text-xs text-slate-400"
                            >
                                Belum terdapat pengguna yang terdaftar.
                            </p>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>