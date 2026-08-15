<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    revisionRequest: Object,
});

const form = useForm({
    file: null,
});

function submit() {
    form.post(route('revisions.resolve', props.revisionRequest.id), {
        forceFormData: true,
    });
}
</script>

<template>
    <Head title="Detail Perbaikan" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold tracking-tight text-slate-900">
                        Detail Perbaikan
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Tinjau permintaan perbaikan dan unggah dokumen hasil
                        perbaikan untuk diproses kembali.
                    </p>
                </div>

                <div
                    class="hidden sm:flex items-center gap-2 rounded-xl bg-amber-50 border border-amber-100 px-3.5 py-2"
                >
                    <span
                        class="w-2 h-2 rounded-full bg-amber-500"
                    ></span>

                    <span class="text-sm font-semibold text-amber-700">
                        Perlu Perbaikan
                    </span>
                </div>
            </div>
        </template>

        <div class="min-h-[calc(100vh-65px)] bg-slate-50/70">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">

                <!-- Page Intro -->
                <div class="mb-6">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-50 border border-amber-100 text-amber-700 text-xs font-semibold"
                    >
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-amber-500"
                        ></span>

                        Permintaan Perbaikan
                    </div>

                    <h1
                        class="mt-3 text-2xl sm:text-3xl font-bold tracking-tight text-slate-950"
                    >
                        Perbaikan Dokumen
                    </h1>

                    <p
                        class="mt-2 text-sm leading-6 text-slate-500 max-w-2xl"
                    >
                        Periksa keterangan perbaikan dan gunakan dokumen lama
                        sebagai pembanding sebelum mengunggah file revisi.
                    </p>
                </div>

                <!-- Request Detail -->
                <div
                    class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden"
                >
                    <div class="p-5 sm:p-6">

                        <!-- Header -->
                        <div
                            class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4"
                        >
                            <div class="flex items-start gap-4 min-w-0">

                                <!-- Icon -->
                                <div
                                    class="w-11 h-11 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center shrink-0"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="w-5 h-5 text-amber-600"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 12h6m-6 4h4M7 3h7l4 4v14H7V3z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M14 3v5h5"
                                        />
                                    </svg>
                                </div>

                                <div class="min-w-0">
                                    <div
                                        class="flex flex-wrap items-center gap-2"
                                    >
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-blue-50 border border-blue-100 text-[11px] font-semibold text-[#28558f]"
                                        >
                                            {{ revisionRequest.type }}
                                        </span>

                                        <span
                                            class="text-xs text-slate-400"
                                        >
                                            Permintaan #{{
                                                revisionRequest.id
                                            }}
                                        </span>
                                    </div>

                                    <h3
                                        class="mt-2 text-base sm:text-lg font-bold text-slate-900"
                                    >
                                        {{
                                            revisionRequest.school
                                                .official_name
                                        }}
                                    </h3>
                                </div>
                            </div>

                            <span
                                class="inline-flex self-start items-center gap-1.5 px-3 py-1.5 rounded-full bg-amber-50 border border-amber-100 text-xs font-semibold text-amber-700"
                            >
                                <span
                                    class="w-1.5 h-1.5 rounded-full bg-amber-500"
                                ></span>

                                Menunggu Perbaikan
                            </span>
                        </div>

                        <!-- Meta -->
                        <div
                            class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-3"
                        >
                            <div
                                class="rounded-xl bg-slate-50 border border-slate-100 px-4 py-3"
                            >
                                <p
                                    class="text-[11px] font-semibold uppercase tracking-wide text-slate-400"
                                >
                                    Diajukan Oleh
                                </p>

                                <p
                                    class="mt-1 text-sm font-semibold text-slate-800"
                                >
                                    {{ revisionRequest.creator.name }}
                                </p>
                            </div>

                            <div
                                class="rounded-xl bg-slate-50 border border-slate-100 px-4 py-3"
                            >
                                <p
                                    class="text-[11px] font-semibold uppercase tracking-wide text-slate-400"
                                >
                                    Kategori
                                </p>

                                <p
                                    class="mt-1 text-sm font-semibold text-slate-800"
                                >
                                    {{ revisionRequest.category }}
                                </p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-5">
                            <p
                                class="text-xs font-semibold uppercase tracking-wide text-slate-400 mb-2"
                            >
                                Keterangan Perbaikan
                            </p>

                            <div
                                class="rounded-xl bg-amber-50 border border-amber-100 px-4 py-3.5"
                            >
                                <div class="flex items-start gap-3">
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="w-5 h-5 text-amber-600 shrink-0 mt-0.5"
                                    >
                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="9"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            d="M12 10v6"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            d="M12 7.5h.01"
                                        />
                                    </svg>

                                    <p
                                        class="text-sm leading-6 text-slate-700"
                                    >
                                        {{ revisionRequest.description }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Old File -->
                        <div
                            class="mt-5 pt-5 border-t border-slate-100"
                        >
                            <div
                                class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4"
                            >
                                <div class="flex items-start gap-3">
                                    <div
                                        class="w-9 h-9 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center shrink-0"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="w-4 h-4 text-slate-500"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M14 2v6h6"
                                            />
                                        </svg>
                                    </div>

                                    <div>
                                        <p
                                            class="text-sm font-semibold text-slate-800"
                                        >
                                            Dokumen Lama
                                        </p>

                                        <p
                                            class="mt-0.5 text-xs text-slate-500"
                                        >
                                            Gunakan sebagai pembanding sebelum
                                            mengunggah dokumen revisi.
                                        </p>
                                    </div>
                                </div>

                                <a
                                    :href="`/dokumen/${revisionRequest.document.id}/download`"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 px-4 py-2.5 text-sm font-semibold transition-colors"
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
                                            d="M12 3v12m0 0l-4-4m4 4l4-4M5 21h14"
                                        />
                                    </svg>

                                    Download File Lama
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upload Revision -->
                <form
                    @submit.prevent="submit"
                    class="mt-4 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden"
                >
                    <div class="p-5 sm:p-6">

                        <div class="flex items-start gap-4">
                            <div
                                class="w-11 h-11 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0"
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
                                        d="M12 16V4m0 0L8 8m4-4l4 4"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h3
                                    class="text-base font-bold text-slate-900"
                                >
                                    Upload File Revisi
                                </h3>

                                <p
                                    class="mt-1 text-sm text-slate-500 leading-6"
                                >
                                    Unggah dokumen yang sudah diperbaiki sesuai
                                    dengan catatan permintaan di atas.
                                </p>
                            </div>
                        </div>

                        <div class="mt-5">
                            <label
                                class="block text-xs font-semibold text-slate-700 mb-2"
                            >
                                File Revisi
                            </label>

                            <div
                                class="rounded-xl border border-dashed border-slate-300 bg-slate-50/70 p-5 hover:border-[#28558f] hover:bg-blue-50/30 transition-colors"
                            >
                                <input
                                    type="file"
                                    accept=".xlsx,.xls"
                                    @input="
                                        form.file =
                                            $event.target.files[0]
                                    "
                                    class="w-full text-sm text-slate-600 file:mr-4 file:rounded-lg file:border-0 file:bg-[#28558f] file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-[#1f4678]"
                                />

                                <p
                                    class="mt-2 text-xs text-slate-400"
                                >
                                    Format Excel (.xlsx atau .xls).
                                </p>
                            </div>

                            <p
                                v-if="form.errors.file"
                                class="text-sm text-red-600 mt-2"
                            >
                                {{ form.errors.file }}
                            </p>
                        </div>

                        <div
                            class="mt-5 pt-5 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3"
                        >
                            <div class="flex items-start gap-2">
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

                                <p
                                    class="text-xs leading-5 text-slate-400"
                                >
                                    Pastikan file yang diunggah sudah benar
                                    sebelum dikirim untuk diverifikasi.
                                </p>
                            </div>

                            <button
                                type="submit"
                                :disabled="
                                    form.processing || !form.file
                                "
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#28558f] hover:bg-[#1f4678] disabled:opacity-50 disabled:cursor-not-allowed text-white px-5 py-3 text-sm font-semibold shadow-sm hover:shadow-md transition-all"
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
                                        stroke-linejoin="round"
                                        d="M5 12h14m-6-6l6 6-6 6"
                                    />
                                </svg>

                                {{
                                    form.processing
                                        ? 'Mengirim...'
                                        : 'Kirim Revisi'
                                }}
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </AuthenticatedLayout>
</template>