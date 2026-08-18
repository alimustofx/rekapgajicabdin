<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import ConfirmDialog from '@/Components/ConfirmDialog.vue';

defineProps({
    documents: Array,
    schools: Array,
});

const selected = ref({});

const ignoreDocumentId = ref(null);

// State untuk notifikasi validasi
const showSchoolNotification = ref(false);

function assign(docId) {
    if (!selected.value[docId]) {
        showSchoolNotification.value = true;
        return;
    }

    router.post(
        route('unmatched.assign', docId),
        {
            school_id: selected.value[docId],
        }
    );
}

function ignore(id) {
    ignoreDocumentId.value = id;
}

function doIgnore() {
    router.post(
        route('unmatched-documents.ignore', ignoreDocumentId.value)
    );

    ignoreDocumentId.value = null;
}
</script>

<template>
    <Head title="Pencocokan Manual" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold tracking-tight text-slate-900">
                        Pencocokan Manual
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Cocokkan dokumen gaji yang belum berhasil dikenali
                        dengan sekolah yang sesuai.
                    </p>
                </div>

                <div
                    v-if="documents.length > 0"
                    class="hidden sm:flex items-center gap-2 rounded-xl bg-blue-50 border border-blue-100 px-3.5 py-2"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="w-4 h-4 text-[#28558f]"
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

                    <span class="text-sm font-semibold text-[#28558f]">
                        {{ documents.length }} dokumen
                    </span>
                </div>
            </div>
        </template>

        <div class="min-h-[calc(100vh-65px)] bg-slate-50/70">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">

                <!-- Page Intro -->
                <div class="mb-6">
                    <div
                        class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4"
                    >
                        <div>
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-50 border border-amber-100 text-amber-700 text-xs font-semibold"
                            >
                                <span
                                    class="w-1.5 h-1.5 rounded-full bg-amber-500"
                                ></span>

                                Membutuhkan Tindakan
                            </div>

                            <h1
                                class="mt-3 text-2xl sm:text-3xl font-bold tracking-tight text-slate-950"
                            >
                                Pencocokan Dokumen
                            </h1>

                            <p
                                class="mt-2 text-sm leading-6 text-slate-500 max-w-2xl"
                            >
                                Beberapa file tidak dapat dicocokkan otomatis
                                dengan sekolah. Pilih sekolah yang sesuai atau
                                abaikan file jika memang bukan milik sekolah
                                manapun.
                            </p>
                        </div>

                        <div
                            class="sm:hidden inline-flex self-start items-center gap-2 rounded-xl bg-blue-50 border border-blue-100 px-3.5 py-2"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="w-4 h-4 text-[#28558f]"
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

                            <span class="text-sm font-semibold text-[#28558f]">
                                {{ documents.length }} dokumen
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div
                    v-if="documents.length === 0"
                    class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden"
                >
                    <div
                        class="flex flex-col items-center justify-center text-center px-6 py-16 sm:py-20"
                    >
                        <div
                            class="w-16 h-16 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="w-8 h-8 text-emerald-600"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                        </div>

                        <h3
                            class="mt-5 text-base font-bold text-slate-900"
                        >
                            Semua dokumen sudah diproses
                        </h3>

                        <p
                            class="mt-2 text-sm leading-6 text-slate-500 max-w-md"
                        >
                            Tidak ada file yang membutuhkan pencocokan manual
                            saat ini.
                        </p>
                    </div>
                </div>

                <!-- Documents -->
                <div v-else class="space-y-4">

                    <!-- Info -->
                    <div
                        class="rounded-2xl bg-blue-50 border border-blue-100 px-5 py-4"
                    >
                        <div class="flex items-start gap-3">
                            <div
                                class="w-9 h-9 rounded-xl bg-white border border-blue-100 flex items-center justify-center shrink-0"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="w-5 h-5 text-[#28558f]"
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
                            </div>

                            <div>
                                <p
                                    class="text-sm font-semibold text-slate-800"
                                >
                                    Pencocokan diperlukan
                                </p>

                                <p
                                    class="mt-0.5 text-xs leading-5 text-slate-500"
                                >
                                    Periksa nama file dan periode sebelum
                                    menentukan sekolah tujuan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Document Card -->
                    <div
                        v-for="(d, index) in documents"
                        :key="d.id"
                        class="group bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200 overflow-hidden"
                    >
                        <div class="p-5 sm:p-6">

                            <!-- Top -->
                            <div
                                class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4"
                            >
                                <div class="flex items-start gap-4 min-w-0">

                                    <!-- Number -->
                                    <div
                                        class="w-11 h-11 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center shrink-0"
                                    >
                                        <span
                                            class="text-sm font-bold text-slate-500"
                                        >
                                            {{
                                                String(index + 1).padStart(
                                                    2,
                                                    '0'
                                                )
                                            }}
                                        </span>
                                    </div>

                                    <div class="min-w-0">
                                        <div
                                            class="flex flex-wrap items-center gap-2"
                                        >
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-amber-50 border border-amber-100 text-[11px] font-semibold text-amber-700"
                                            >
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full bg-amber-500"
                                                ></span>

                                                Belum Cocok
                                            </span>

                                            <span
                                                class="text-xs text-slate-400"
                                            >
                                                Dokumen #{{ d.id }}
                                            </span>
                                        </div>

                                        <h3
                                            class="mt-2 text-sm sm:text-base font-bold text-slate-900 break-all"
                                        >
                                            {{ d.filename }}
                                        </h3>

                                        <div
                                            class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-1.5 text-xs text-slate-500"
                                        >
                                            <span
                                                class="inline-flex items-center gap-1.5"
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
                                                        d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"
                                                    />
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M14 2v6h6"
                                                    />
                                                </svg>

                                                {{ d.type }}
                                            </span>

                                            <span
                                                v-if="d.import?.period?.label"
                                                class="inline-flex items-center gap-1.5"
                                            >
                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                    class="w-3.5 h-3.5"
                                                >
                                                    <rect
                                                        x="3"
                                                        y="4"
                                                        width="18"
                                                        height="17"
                                                        rx="2"
                                                    />
                                                    <path
                                                        stroke-linecap="round"
                                                        d="M16 2v4M8 2v4M3 10h18"
                                                    />
                                                </svg>

                                                {{ d.import.period.label }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Divider -->
                            <div
                                class="my-5 border-t border-slate-100"
                            ></div>

                            <!-- Action Area -->
                            <div
                                class="flex flex-col lg:flex-row lg:items-end gap-4"
                            >
                                <div class="flex-1">
                                    <label
                                        class="block text-xs font-semibold text-slate-700 mb-2"
                                    >
                                        Sekolah tujuan
                                    </label>

                                    <select
                                        v-model="selected[d.id]"
                                        class="w-full rounded-xl border-slate-200 bg-slate-50/70 text-sm text-slate-700 px-4 py-3 focus:border-[#28558f] focus:ring-[#28558f] focus:bg-white transition-colors"
                                    >
                                        <option value="" disabled>
                                            Pilih sekolah yang sesuai...
                                        </option>

                                        <option
                                            v-for="s in schools"
                                            :key="s.id"
                                            :value="s.id"
                                        >
                                            {{ s.official_name }}
                                        </option>
                                    </select>
                                </div>

                                <div
                                    class="flex flex-col sm:flex-row gap-2 lg:shrink-0"
                                >
                                    <button
                                        @click="assign(d.id)"
                                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#28558f] hover:bg-[#1f4678] text-white px-5 py-3 text-sm font-semibold shadow-sm hover:shadow-md transition-all duration-200"
                                    >
                                        <svg
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

                                        Cocokkan
                                    </button>

                                    <button
                                        @click="ignore(d.id)"
                                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-500 hover:text-slate-700 px-5 py-3 text-sm font-semibold transition-colors"
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
                                                d="M6 6l12 12M18 6L6 18"
                                            />
                                        </svg>

                                        Abaikan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Bottom Note -->
                <div
                    v-if="documents.length > 0"
                    class="mt-6 flex items-start gap-3 px-1"
                >
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
                        Pastikan sekolah yang dipilih sudah sesuai dengan
                        dokumen sebelum melakukan pencocokan.
                    </p>
                </div>

            </div>
        </div>
        <ConfirmDialog
            :show="!!ignoreDocumentId"
            title="Abaikan Dokumen"
            message="Apakah Anda yakin ingin mengabaikan dokumen ini?"
            confirmText="Ya, Abaikan"
            @confirm="doIgnore"
            @cancel="ignoreDocumentId = null"
        />
        <ConfirmDialog
            :show="showSchoolNotification"
            title="Sekolah Belum Dipilih"
            message="Silakan pilih sekolah tujuan terlebih dahulu sebelum melakukan pencocokan dokumen."
            confirmText="Mengerti"
            @confirm="showSchoolNotification = false"
            @cancel="showSchoolNotification = false"
        />
    </AuthenticatedLayout>
</template>