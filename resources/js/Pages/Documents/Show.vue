<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import ConfirmDialog from '@/Components/ConfirmDialog.vue';
import { ref } from 'vue';

const props = defineProps({
    document: Object,
    status: Object,
});

const showModal = ref(false);
const confirmFix = ref(false);

const revisionForm = useForm({
    category: 'Tunjangan Anak',
    description: '',
});

function submitFix() {
    confirmFix.value = true;
}

function doFix() {
    useForm({}).post(
        route('documents.fix', props.document.id),
        {
            onSuccess: () => {
                confirmFix.value = false;
            },
        }
    );
}

function submitRevision() {
    revisionForm.post(
        route('documents.request-revision', props.document.id),
        {
            onSuccess: () => (showModal.value = false),
        }
    );
}
</script>

<template>
    <Head title="Verifikasi Dokumen" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold tracking-tight text-slate-900">
                        Verifikasi Dokumen — {{ document.type }}
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Periksa dokumen gaji sebelum dikonfirmasi sebagai dokumen yang benar.
                    </p>
                </div>
            </div>
        </template>

        <div class="min-h-[calc(100vh-65px)] bg-slate-50/70">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 space-y-6">

                <!-- Page Intro -->
                <div>
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 border border-blue-100 text-[#28558f] text-xs font-semibold"
                    >
                        <span class="w-1.5 h-1.5 rounded-full bg-[#28558f]"></span>
                        Verifikasi Dokumen
                    </div>

                    <h1
                        class="mt-3 text-2xl sm:text-3xl font-bold tracking-tight text-slate-950"
                    >
                        Periksa Dokumen {{ document.type }}
                    </h1>

                    <p
                        class="mt-2 text-sm leading-6 text-slate-500 max-w-2xl"
                    >
                        Buka file dokumen untuk memeriksa data. Setelah selesai,
                        konfirmasi FIX jika seluruh data sudah benar atau ajukan
                        perbaikan jika terdapat kesalahan.
                    </p>
                </div>

                <!-- Document Card -->
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
                                            d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M14 2v6h6"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M8 13h8M8 17h5"
                                        />
                                    </svg>
                                </div>

                                <div class="min-w-0">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-blue-50 border border-blue-100 text-[11px] font-semibold text-[#28558f]"
                                        >
                                            {{ document.type }}
                                        </span>

                                        <span
                                            class="text-xs text-slate-400"
                                        >
                                            Dokumen #{{ document.id }}
                                        </span>
                                    </div>

                                    <h3
                                        class="mt-2 text-sm sm:text-base font-bold text-slate-900 break-all"
                                    >
                                        {{ document.filename }}
                                    </h3>
                                </div>
                            </div>

                            <!-- Status -->
                            <div
                                v-if="status?.status"
                                class="shrink-0"
                            >
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold"
                                    :class="
                                        status.status === 'FIX'
                                            ? 'bg-green-50 border border-green-100 text-green-700'
                                            : 'bg-amber-50 border border-amber-100 text-amber-700'
                                    "
                                >
                                    <span
                                        class="w-1.5 h-1.5 rounded-full"
                                        :class="
                                            status.status === 'FIX'
                                                ? 'bg-green-500'
                                                : 'bg-amber-500'
                                        "
                                    ></span>

                                    {{
                                        status.status === 'FIX'
                                            ? 'FIX'
                                            : 'Menunggu Verifikasi'
                                    }}
                                </span>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="my-5 border-t border-slate-100"></div>

                        <!-- File Information -->
                        <div
                            class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4"
                        >
                            <div>
                                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                    File Dokumen
                                </p>

                                <p class="mt-1 text-sm font-medium text-slate-800 break-all">
                                    {{ document.filename }}
                                </p>
                            </div>

                            <a
                                :href="
                                    route(
                                        'documents.download',
                                        document.id
                                    )
                                "
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-800 hover:bg-slate-900 text-white px-5 py-3 text-sm font-semibold shadow-sm transition-colors shrink-0"
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
                                        d="M12 3v12"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M7 10l5 5 5-5"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5 21h14"
                                    />
                                </svg>

                                Download & Buka File
                            </a>
                        </div>

                        <!-- Verification Actions -->
                        <div class="mt-5">
                            <div
                                v-if="status?.status !== 'FIX'"
                                class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4"
                            >
                                <div>
                                    <p class="text-sm font-semibold text-slate-800">
                                        Hasil Pemeriksaan
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-slate-500">
                                        Pilih tindakan sesuai hasil pemeriksaan dokumen.
                                    </p>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-2">
                                    <button
                                        @click="showModal = true"
                                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-600 hover:text-slate-800 px-5 py-3 text-sm font-semibold transition-colors"
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
                                                d="M12 20h9"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M16.5 3.5a2.1 2.1 0 013 3L8 18l-4 1 1-4L16.5 3.5z"
                                            />
                                        </svg>

                                        Ajukan Perbaikan
                                    </button>

                                    <button
                                        @click="submitFix"
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
                                                d="M5 13l4 4L19 7"
                                            />
                                        </svg>

                                        Konfirmasi FIX
                                    </button>
                                </div>
                            </div>

                            <!-- Sudah FIX -->
                            <div
                                v-else
                                class="flex items-center gap-3 rounded-xl bg-green-50 border border-green-100 px-5 py-4"
                            >
                                <div
                                    class="w-9 h-9 rounded-full bg-green-100 flex items-center justify-center shrink-0"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2.2"
                                        class="w-4 h-4 text-green-700"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 13l4 4L19 7"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-green-800">
                                        Dokumen sudah dikonfirmasi FIX
                                    </p>

                                    <p class="text-xs text-green-700 mt-0.5">
                                        Tidak perlu tindakan lagi. Anda tetap bisa
                                        membuka file kapan saja lewat tombol download
                                        di atas.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Verification Info -->
                <div class="flex items-start gap-3 px-1">
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
                        Pastikan dokumen telah diperiksa dengan teliti sebelum
                        dikonfirmasi FIX. Jika terdapat kesalahan, gunakan
                        tombol Ajukan Perbaikan dan berikan catatan yang jelas.
                    </p>
                </div>
            </div>
        </div>

        <!-- Revision Modal -->
        <div
            v-if="showModal"
            class="fixed inset-0 z-50 bg-slate-950/40 backdrop-blur-sm flex items-center justify-center p-4"
        >
            <div
                class="bg-white rounded-2xl shadow-xl border border-slate-200 w-full max-w-md overflow-hidden"
            >
                <!-- Modal Header -->
                <div
                    class="px-6 py-5 border-b border-slate-100"
                >
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-base font-bold text-slate-900">
                                Ajukan Perbaikan
                            </h3>

                            <p class="mt-1 text-xs leading-5 text-slate-500">
                                Jelaskan bagian dokumen yang perlu diperbaiki.
                            </p>
                        </div>

                        <button
                            @click="showModal = false"
                            class="w-8 h-8 rounded-lg hover:bg-slate-100 text-slate-400 hover:text-slate-600 flex items-center justify-center transition-colors"
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
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6 space-y-4">
                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-700 mb-2"
                        >
                            Kategori
                        </label>

                        <select
                            v-model="revisionForm.category"
                            class="w-full rounded-xl border-slate-200 bg-slate-50/70 text-sm text-slate-700 px-4 py-3 focus:border-[#28558f] focus:ring-[#28558f] focus:bg-white transition-colors"
                        >
                            <option>
                                Tunjangan Anak
                            </option>

                            <option>
                                Kenaikan Pangkat
                            </option>

                            <option>
                                Tunjangan Jabatan
                            </option>

                            <option>
                                Data Pribadi
                            </option>

                            <option>
                                Gaji Berkala
                            </option>

                            <option>
                                Lainnya
                            </option>
                        </select>

                        <p
                            v-if="revisionForm.errors.category"
                            class="mt-1 text-xs text-red-600"
                        >
                            {{ revisionForm.errors.category }}
                        </p>
                    </div>

                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-700 mb-2"
                        >
                            Catatan Perbaikan
                        </label>

                        <textarea
                            v-model="revisionForm.description"
                            rows="4"
                            class="w-full rounded-xl border-slate-200 bg-slate-50/70 text-sm text-slate-700 px-4 py-3 focus:border-[#28558f] focus:ring-[#28558f] focus:bg-white transition-colors resize-none"
                            placeholder="Jelaskan letak kesalahannya..."
                        ></textarea>

                        <p
                            v-if="revisionForm.errors.description"
                            class="mt-1 text-xs text-red-600"
                        >
                            {{ revisionForm.errors.description }}
                        </p>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div
                    class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex flex-col-reverse sm:flex-row sm:justify-end gap-2"
                >
                    <button
                        @click="showModal = false"
                        class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-white border border-transparent hover:border-slate-200 transition-colors"
                    >
                        Batal
                    </button>

                    <button
                        @click="submitRevision"
                        :disabled="revisionForm.processing"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-[#28558f] hover:bg-[#1f4678] disabled:opacity-50 text-white text-sm font-semibold shadow-sm transition-all"
                    >
                        <svg
                            v-if="!revisionForm.processing"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="w-4 h-4"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M22 2L11 13"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M22 2l-7 20-4-9-9-4 20-7z"
                            />
                        </svg>

                        {{
                            revisionForm.processing
                                ? 'Mengirim...'
                                : 'Kirim Perbaikan'
                        }}
                    </button>
                </div>
            </div>
        </div>
        <ConfirmDialog
            :show="confirmFix"
            title="Konfirmasi FIX"
            message="Apakah Anda yakin dokumen ini sudah benar dan dapat dikonfirmasi sebagai FIX?"
            confirmText="Ya, Konfirmasi FIX"
            @confirm="doFix"
            @cancel="confirmFix = false"
        />
    </AuthenticatedLayout>
</template>