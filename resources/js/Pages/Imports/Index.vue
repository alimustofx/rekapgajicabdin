<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    periods: Array,
});

const page = usePage();

const form = useForm({
    period_id: '',
    type: 'PNS',
    zip_file: null,
});

function submit() {
    form.post(route('imports.store'), {
        forceFormData: true,
    });
}
</script>

<template>
    <Head title="Import Gaji" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="text-xl font-bold text-slate-900">
                    Import Gaji
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Import data gaji secara massal melalui file ZIP.
                </p>
            </div>
        </template>

        <div class="min-h-[calc(100vh-65px)] bg-slate-50 py-8 sm:py-10">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Page Intro -->
                <div class="mb-8">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-11 h-11 rounded-xl bg-[#28558f] flex items-center justify-center shadow-sm"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="w-5 h-5 text-white"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 16V4m0 0l-4 4m4-4l4 4"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 12v6a2 2 0 002 2h10a2 2 0 002-2v-6"
                                />
                            </svg>
                        </div>

                        <div>
                            <h1 class="text-2xl font-bold text-slate-950">
                                Import Data Gaji
                            </h1>

                            <p class="text-sm text-slate-500 mt-0.5">
                                Pilih periode dan jenis data, kemudian unggah
                                file ZIP.
                            </p>
                        </div>
                    </div>
                </div>


                <!-- Import Success -->
                <div
                    v-if="page.props.flash?.summary"
                    class="mb-6 rounded-2xl border border-emerald-200 bg-white shadow-sm overflow-hidden"
                >
                    <div class="px-5 py-4 bg-emerald-50/70 border-b border-emerald-100">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-9 h-9 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    class="w-5 h-5 text-emerald-600"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5 12l4 4L19 6"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-sm font-bold text-emerald-900">
                                    Import selesai
                                </h3>

                                <p class="text-sm text-emerald-700 mt-1 leading-6">
                                    Data berhasil diproses dan sistem telah
                                    melakukan pencocokan file secara otomatis.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-slate-100">
                        <div class="px-5 py-4">
                            <p class="text-xs font-medium text-slate-500">
                                File ditemukan
                            </p>

                            <p class="text-xl font-bold text-slate-900 mt-1">
                                {{ page.props.flash.summary.total }}
                            </p>
                        </div>

                        <div class="px-5 py-4">
                            <p class="text-xs font-medium text-slate-500">
                                Cocok otomatis
                            </p>

                            <p class="text-xl font-bold text-emerald-600 mt-1">
                                {{ page.props.flash.summary.matched }}
                            </p>
                        </div>

                        <div class="px-5 py-4">
                            <p class="text-xs font-medium text-slate-500">
                                Perlu pencocokan manual
                            </p>

                            <p class="text-xl font-bold text-amber-600 mt-1">
                                {{ page.props.flash.summary.unmatched }}
                            </p>
                        </div>
                    </div>
                </div>


                <!-- Main Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

                    <!-- Form -->
                    <div class="lg:col-span-3">
                        <form
                            @submit.prevent="submit"
                            class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden"
                        >
                            <!-- Form Header -->
                            <div class="px-6 py-5 border-b border-slate-100">
                                <h3 class="text-base font-bold text-slate-900">
                                    Detail Import
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    Tentukan data yang akan dimasukkan ke sistem.
                                </p>
                            </div>

                            <div class="p-6 space-y-6">

                                <!-- Periode -->
                                <div>
                                    <label
                                        for="period"
                                        class="block text-sm font-semibold text-slate-700 mb-2"
                                    >
                                        Periode Gaji
                                    </label>

                                    <select
                                        id="period"
                                        v-model="form.period_id"
                                        class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-[#28558f] focus:ring-[#28558f]"
                                    >
                                        <option value="" disabled>
                                            Pilih periode
                                        </option>

                                        <option
                                            v-for="p in periods"
                                            :key="p.id"
                                            :value="p.id"
                                        >
                                            {{ p.label }}
                                        </option>
                                    </select>

                                    <p
                                        v-if="form.errors.period_id"
                                        class="text-xs text-red-600 mt-2"
                                    >
                                        {{ form.errors.period_id }}
                                    </p>
                                </div>


                                <!-- Jenis -->
                                <div>
                                    <label
                                        class="block text-sm font-semibold text-slate-700 mb-2"
                                    >
                                        Jenis Data
                                    </label>

                                    <div class="grid grid-cols-2 gap-3">
                                        <label
                                            class="relative cursor-pointer"
                                        >
                                            <input
                                                v-model="form.type"
                                                type="radio"
                                                value="PNS"
                                                class="peer sr-only"
                                            />

                                            <div
                                                class="rounded-xl border border-slate-200 bg-white px-4 py-3.5 transition-all peer-checked:border-[#28558f] peer-checked:bg-blue-50/60"
                                            >
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-9 h-9 rounded-lg bg-blue-50 text-[#28558f] flex items-center justify-center"
                                                    >
                                                        <svg
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="1.8"
                                                            class="w-5 h-5"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                                                            />
                                                            <circle
                                                                cx="9"
                                                                cy="7"
                                                                r="4"
                                                            />
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                                            />
                                                        </svg>
                                                    </div>

                                                    <div>
                                                        <div class="text-sm font-bold text-slate-900">
                                                            PNS
                                                        </div>

                                                        <div class="text-xs text-slate-500 mt-0.5">
                                                            Pegawai Negeri Sipil
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>


                                        <label
                                            class="relative cursor-pointer"
                                        >
                                            <input
                                                v-model="form.type"
                                                type="radio"
                                                value="PPPK"
                                                class="peer sr-only"
                                            />

                                            <div
                                                class="rounded-xl border border-slate-200 bg-white px-4 py-3.5 transition-all peer-checked:border-[#28558f] peer-checked:bg-blue-50/60"
                                            >
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center"
                                                    >
                                                        <svg
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="1.8"
                                                            class="w-5 h-5"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M12 12a4 4 0 100-8 4 4 0 000 8z"
                                                            />
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M4 21a8 8 0 0116 0"
                                                            />
                                                        </svg>
                                                    </div>

                                                    <div>
                                                        <div class="text-sm font-bold text-slate-900">
                                                            PPPK
                                                        </div>

                                                        <div class="text-xs text-slate-500 mt-0.5">
                                                            Pegawai Pemerintah
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>


                                <!-- File -->
                                <div>
                                    <label
                                        class="block text-sm font-semibold text-slate-700 mb-2"
                                    >
                                        File ZIP
                                    </label>

                                    <label
                                        class="relative flex flex-col items-center justify-center w-full min-h-40 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/50 hover:bg-blue-50/30 hover:border-[#28558f]/40 transition-colors cursor-pointer"
                                    >
                                        <input
                                            type="file"
                                            accept=".zip"
                                            class="sr-only"
                                            @input="form.zip_file = $event.target.files[0]"
                                        />

                                        <div
                                            class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center mb-3"
                                        >
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.7"
                                                class="w-6 h-6 text-[#28558f]"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M4 7a2 2 0 012-2h4l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H6a2 2 0 01-2-2V7z"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M12 10v5m0 0l-2-2m2 2l2-2"
                                                />
                                            </svg>
                                        </div>

                                        <p class="text-sm font-semibold text-slate-700">
                                            Klik untuk memilih file ZIP
                                        </p>

                                        <p class="text-xs text-slate-400 mt-1">
                                            Format file yang didukung: .zip
                                        </p>

                                        <p
                                            v-if="form.zip_file"
                                            class="text-xs font-medium text-[#28558f] mt-3 px-3 py-1.5 rounded-lg bg-blue-50"
                                        >
                                            {{ form.zip_file.name }}
                                        </p>
                                    </label>

                                    <p
                                        v-if="form.errors.zip_file"
                                        class="text-xs text-red-600 mt-2"
                                    >
                                        {{ form.errors.zip_file }}
                                    </p>
                                </div>


                                <!-- Submit -->
                                <div class="pt-2">
                                    <button
                                        type="submit"
                                        :disabled="form.processing"
                                        class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-[#28558f] hover:bg-[#1f4678] text-white px-5 py-3.5 text-sm font-semibold shadow-sm hover:shadow-md disabled:opacity-50 disabled:cursor-not-allowed transition-all"
                                    >
                                        <svg
                                            v-if="!form.processing"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="w-4 h-4"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 16V4m0 0l-4 4m4-4l4 4"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 12v6a2 2 0 002 2h10a2 2 0 002-2v-6"
                                            />
                                        </svg>

                                        <svg
                                            v-else
                                            class="w-4 h-4 animate-spin"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                        >
                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="9"
                                                stroke="currentColor"
                                                stroke-width="3"
                                                class="opacity-30"
                                            />

                                            <path
                                                d="M21 12a9 9 0 00-9-9"
                                                stroke="currentColor"
                                                stroke-width="3"
                                                stroke-linecap="round"
                                            />
                                        </svg>

                                        {{
                                            form.processing
                                                ? 'Memproses import...'
                                                : 'Proses Import'
                                        }}
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>


                    <!-- Information -->
                    <div class="lg:col-span-2 space-y-6">

                        <!-- How it works -->
                        <div
                            class="bg-[#0d1e35] rounded-2xl p-6 text-white overflow-hidden relative"
                        >
                            <div
                                class="absolute -right-16 -top-16 w-40 h-40 rounded-full border border-white/10"
                            ></div>

                            <div
                                class="absolute -right-10 -bottom-20 w-48 h-48 rounded-full border border-white/5"
                            ></div>

                            <div class="relative">
                                <div
                                    class="w-10 h-10 rounded-xl bg-white/10 border border-white/10 flex items-center justify-center mb-5"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="w-5 h-5 text-blue-200"
                                    >
                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="9"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            d="M12 11v5"
                                        />

                                        <circle
                                            cx="12"
                                            cy="7.5"
                                            r=".5"
                                            fill="currentColor"
                                        />
                                    </svg>
                                </div>

                                <h3 class="font-bold text-base">
                                    Cara Import
                                </h3>

                                <div class="mt-5 space-y-5">

                                    <div class="flex gap-3">
                                        <div
                                            class="w-7 h-7 rounded-lg bg-white/10 border border-white/10 flex items-center justify-center shrink-0"
                                        >
                                            <span class="text-[10px] font-bold text-blue-200">
                                                01
                                            </span>
                                        </div>

                                        <div>
                                            <p class="text-sm font-semibold">
                                                Pilih periode
                                            </p>

                                            <p class="text-xs text-blue-100/55 mt-1 leading-5">
                                                Tentukan periode gaji yang sesuai
                                                dengan data yang akan diimport.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex gap-3">
                                        <div
                                            class="w-7 h-7 rounded-lg bg-white/10 border border-white/10 flex items-center justify-center shrink-0"
                                        >
                                            <span class="text-[10px] font-bold text-blue-200">
                                                02
                                            </span>
                                        </div>

                                        <div>
                                            <p class="text-sm font-semibold">
                                                Pilih jenis data
                                            </p>

                                            <p class="text-xs text-blue-100/55 mt-1 leading-5">
                                                Pilih PNS atau PPPK sesuai dengan
                                                isi file ZIP.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex gap-3">
                                        <div
                                            class="w-7 h-7 rounded-lg bg-white/10 border border-white/10 flex items-center justify-center shrink-0"
                                        >
                                            <span class="text-[10px] font-bold text-blue-200">
                                                03
                                            </span>
                                        </div>

                                        <div>
                                            <p class="text-sm font-semibold">
                                                Unggah file ZIP
                                            </p>

                                            <p class="text-xs text-blue-100/55 mt-1 leading-5">
                                                Pilih file ZIP berisi dokumen
                                                gaji yang akan diproses.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex gap-3">
                                        <div
                                            class="w-7 h-7 rounded-lg bg-white/10 border border-white/10 flex items-center justify-center shrink-0"
                                        >
                                            <span class="text-[10px] font-bold text-blue-200">
                                                04
                                            </span>
                                        </div>

                                        <div>
                                            <p class="text-sm font-semibold">
                                                Sistem melakukan pencocokan
                                            </p>

                                            <p class="text-xs text-blue-100/55 mt-1 leading-5">
                                                File yang cocok akan diproses
                                                otomatis. Data yang tidak cocok
                                                memerlukan pencocokan manual.
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <!-- Security -->
                        <div
                            class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm"
                        >
                            <div class="flex items-start gap-3">
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
                                            d="M12 3l7 3v5c0 4.5-2.8 7.7-7 10-4.2-2.3-7-5.5-7-10V6l7-3z"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 12l2 2 4-4"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <h3 class="text-sm font-bold text-slate-800">
                                        Periksa data sebelum import
                                    </h3>

                                    <p class="text-xs text-slate-500 leading-5 mt-1">
                                        Pastikan periode, jenis data, dan file
                                        ZIP sudah sesuai sebelum proses dimulai.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>