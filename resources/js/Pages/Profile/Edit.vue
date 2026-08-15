<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profil" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2
                    class="text-xl font-bold tracking-tight text-slate-900"
                >
                    Profil
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Kelola informasi akun, keamanan, dan pengaturan profil
                    Anda.
                </p>
            </div>
        </template>

        <div class="min-h-[calc(100vh-65px)] bg-slate-50/70">
            <div
                class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8"
            >

                <!-- Intro -->
                <div class="mb-6">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 border border-blue-100 text-[#28558f] text-xs font-semibold"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="w-3.5 h-3.5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 19a6 6 0 00-6 0M12 13a4 4 0 100-8 4 4 0 000 8z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 21a8 8 0 0116 0"
                            />
                        </svg>

                        Pengaturan Akun
                    </div>

                    <h1
                        class="mt-3 text-2xl sm:text-3xl font-bold tracking-tight text-slate-950"
                    >
                        Kelola Profil Anda
                    </h1>

                    <p
                        class="mt-2 text-sm leading-6 text-slate-500 max-w-2xl"
                    >
                        Perbarui informasi pribadi, ubah password, dan kelola
                        keamanan akun Anda.
                    </p>
                </div>

                <div class="space-y-4">

                    <!-- Profile Information -->
                    <div
                        class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden"
                    >
                        <div
                            class="px-5 py-4 sm:px-6 border-b border-slate-100"
                        >
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0"
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
                                            d="M15 19a6 6 0 00-6 0M12 13a4 4 0 100-8 4 4 0 000 8z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M4 21a8 8 0 0116 0"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <h3
                                        class="text-base font-bold text-slate-900"
                                    >
                                        Informasi Profil
                                    </h3>

                                    <p
                                        class="mt-0.5 text-sm text-slate-500"
                                    >
                                        Perbarui nama dan alamat email akun
                                        Anda.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="p-5 sm:p-6">
                            <UpdateProfileInformationForm
                                :must-verify-email="mustVerifyEmail"
                                :status="status"
                                class="max-w-xl"
                            />
                        </div>
                    </div>

                    <!-- Password -->
                    <div
                        class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden"
                    >
                        <div
                            class="px-5 py-4 sm:px-6 border-b border-slate-100"
                        >
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="w-5 h-5 text-[#28558f]"
                                    >
                                        <rect
                                            x="4"
                                            y="10"
                                            width="16"
                                            height="10"
                                            rx="2"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M8 10V7a4 4 0 018 0v3"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            d="M12 14v2"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <h3
                                        class="text-base font-bold text-slate-900"
                                    >
                                        Keamanan Password
                                    </h3>

                                    <p
                                        class="mt-0.5 text-sm text-slate-500"
                                    >
                                        Gunakan password yang kuat untuk
                                        menjaga keamanan akun.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="p-5 sm:p-6">
                            <UpdatePasswordForm class="max-w-xl" />
                        </div>
                    </div>

                    <!-- Delete Account -->
                    <div
                        class="bg-white rounded-2xl border border-red-100 shadow-sm overflow-hidden"
                    >
                        <div
                            class="px-5 py-4 sm:px-6 border-b border-red-100 bg-red-50/40"
                        >
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-red-50 border border-red-100 flex items-center justify-center shrink-0"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="w-5 h-5 text-red-600"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M4 7h16M10 11v6M14 11v6M6 7l1 13h10l1-13M9 7V4h6v3"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <h3
                                        class="text-base font-bold text-slate-900"
                                    >
                                        Hapus Akun
                                    </h3>

                                    <p
                                        class="mt-0.5 text-sm text-slate-500"
                                    >
                                        Tindakan ini bersifat permanen dan
                                        tidak dapat dibatalkan.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="p-5 sm:p-6">
                            <DeleteUserForm class="max-w-xl" />
                        </div>
                    </div>

                </div>

                <!-- Security Note -->
                <div class="mt-6 flex items-start gap-3 px-1">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="w-4 h-4 text-slate-400 shrink-0 mt-0.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3l7 3v5c0 4.5-2.8 7.7-7 10-4.2-2.3-7-5.5-7-10V6l7-3z"
                        />
                    </svg>

                    <p class="text-xs leading-5 text-slate-400">
                        Pastikan informasi akun selalu diperbarui dan jangan
                        membagikan password kepada pengguna lain.
                    </p>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>