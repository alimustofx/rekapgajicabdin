<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    payroll: Object,
    template: Object,
});

const form = useForm({
    file: null,
});

const statusLabels = {
    REQUIRED: 'Belum Upload',
    UPLOADED: 'Menunggu Review Cabdin',
    APPROVED: 'Disetujui',
    REVISION: 'Perlu Diperbaiki',
};

function submit() {
    if (!props.payroll) {
        return;
    }

    form.post(route('payroll.upload', props.payroll.id), {
        forceFormData: true,
        onSuccess: () => {
            form.reset('file');
        },
    });
}

function bisaUpload() {
    return (
        props.payroll &&
        ['REQUIRED', 'REVISION'].includes(props.payroll.status)
    );
}
</script>

<template>
    <Head title="Payroll" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <div>
                    <h2
                        class="text-xl font-bold tracking-tight text-slate-900"
                    >
                        Payroll
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Kelola dan unggah dokumen payroll untuk periode berjalan.
                    </p>
                </div>
            </div>
        </template>

        <div class="min-h-[calc(100vh-65px)] bg-slate-50/70">
            <div
                class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8"
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
                                d="M6 3h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5a2 2 0 012-2z"
                            />
                            <path
                                stroke-linecap="round"
                                d="M8 7h8M8 11h8M8 15h5"
                            />
                        </svg>

                        Dokumen Payroll
                    </div>

                    <h1
                        class="mt-3 text-2xl sm:text-3xl font-bold tracking-tight text-slate-950"
                    >
                        Pengelolaan Payroll
                    </h1>

                    <p
                        class="mt-2 text-sm leading-6 text-slate-500 max-w-2xl"
                    >
                        Periksa status payroll, gunakan template yang telah
                        disediakan, kemudian unggah file payroll untuk diproses.
                    </p>
                </div>

                <!-- Payroll Not Available -->
                <div
                    v-if="!payroll"
                    class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden"
                >
                    <div
                        class="flex flex-col items-center justify-center text-center px-6 py-16 sm:py-20"
                    >
                        <div
                            class="w-16 h-16 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="w-8 h-8 text-slate-400"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 3h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5a2 2 0 012-2z"
                                />
                                <path
                                    stroke-linecap="round"
                                    d="M8 7h8M8 11h5"
                                />
                            </svg>
                        </div>

                        <h3
                            class="mt-5 text-base font-bold text-slate-900"
                        >
                            Payroll belum tersedia
                        </h3>

                        <p
                            class="mt-2 text-sm leading-6 text-slate-500 max-w-md"
                        >
                            Payroll belum tersedia untuk periode ini. Payroll
                            baru dapat dibuat setelah dokumen PNS dan PPPK
                            dikonfirmasi FIX.
                        </p>
                    </div>
                </div>

                <!-- Payroll Content -->
                <div v-else class="space-y-4">

                    <!-- Status -->
                    <div
                        class="rounded-2xl border shadow-sm overflow-hidden"
                        :class="{
                            'border-amber-200 bg-amber-50':
                                payroll.status === 'REQUIRED',

                            'border-blue-200 bg-blue-50':
                                payroll.status === 'UPLOADED',

                            'border-emerald-200 bg-emerald-50':
                                payroll.status === 'APPROVED',

                            'border-red-200 bg-red-50':
                                payroll.status === 'REVISION',
                        }"
                    >
                        <div class="p-5 sm:p-6">
                            <div
                                class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4"
                            >
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 border"
                                        :class="{
                                            'bg-amber-100 border-amber-200 text-amber-600':
                                                payroll.status === 'REQUIRED',

                                            'bg-blue-100 border-blue-200 text-[#28558f]':
                                                payroll.status === 'UPLOADED',

                                            'bg-emerald-100 border-emerald-200 text-emerald-600':
                                                payroll.status === 'APPROVED',

                                            'bg-red-100 border-red-200 text-red-600':
                                                payroll.status === 'REVISION',
                                        }"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="w-5 h-5"
                                        >
                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="9"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                d="M12 7v5l3 2"
                                            />
                                        </svg>
                                    </div>

                                    <div>
                                        <p
                                            class="text-xs font-semibold uppercase tracking-wide"
                                            :class="{
                                                'text-amber-600':
                                                    payroll.status === 'REQUIRED',

                                                'text-blue-600':
                                                    payroll.status === 'UPLOADED',

                                                'text-emerald-600':
                                                    payroll.status === 'APPROVED',

                                                'text-red-600':
                                                    payroll.status === 'REVISION',
                                            }"
                                        >
                                            Status Payroll
                                        </p>

                                        <p
                                            class="mt-1 text-base font-bold"
                                            :class="{
                                                'text-amber-900':
                                                    payroll.status === 'REQUIRED',

                                                'text-blue-900':
                                                    payroll.status === 'UPLOADED',

                                                'text-emerald-900':
                                                    payroll.status === 'APPROVED',

                                                'text-red-900':
                                                    payroll.status === 'REVISION',
                                            }"
                                        >
                                            {{
                                                statusLabels[payroll.status] ??
                                                payroll.status
                                            }}
                                        </p>
                                    </div>
                                </div>

                                <span
                                    class="inline-flex items-center gap-2 self-start sm:self-auto px-3 py-1.5 rounded-full text-xs font-semibold border"
                                    :class="{
                                        'bg-amber-100 text-amber-700 border-amber-200':
                                            payroll.status === 'REQUIRED',

                                        'bg-blue-100 text-blue-700 border-blue-200':
                                            payroll.status === 'UPLOADED',

                                        'bg-emerald-100 text-emerald-700 border-emerald-200':
                                            payroll.status === 'APPROVED',

                                        'bg-red-100 text-red-700 border-red-200':
                                            payroll.status === 'REVISION',
                                    }"
                                >
                                    <span
                                        class="w-1.5 h-1.5 rounded-full"
                                        :class="{
                                            'bg-amber-500':
                                                payroll.status === 'REQUIRED',

                                            'bg-blue-500':
                                                payroll.status === 'UPLOADED',

                                            'bg-emerald-500':
                                                payroll.status === 'APPROVED',

                                            'bg-red-500':
                                                payroll.status === 'REVISION',
                                        }"
                                    ></span>

                                    {{
                                        statusLabels[payroll.status] ??
                                        payroll.status
                                    }}
                                </span>
                            </div>

                            <!-- Required Notice -->
                            <div
                                v-if="payroll.status === 'REQUIRED'"
                                class="mt-5 rounded-xl bg-white/70 border border-amber-200 p-4"
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
                                            d="M12 11v5"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            d="M12 8h.01"
                                        />
                                    </svg>

                                    <div>
                                        <p
                                            class="text-sm font-semibold text-amber-900"
                                        >
                                            Payroll belum diunggah
                                        </p>

                                        <p
                                            class="mt-1 text-sm leading-6 text-amber-800"
                                        >
                                            Silakan gunakan template payroll
                                            yang tersedia, isi data sesuai
                                            ketentuan, kemudian unggah file
                                            payroll melalui formulir di bawah.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Uploaded Notice -->
                            <div
                                v-if="payroll.status === 'UPLOADED'"
                                class="mt-5 rounded-xl bg-white/70 border border-blue-200 p-4"
                            >
                                <div class="flex items-start gap-3">
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="w-5 h-5 text-blue-600 shrink-0 mt-0.5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 12l4 4L19 6"
                                        />
                                    </svg>

                                    <div>
                                        <p
                                            class="text-sm font-semibold text-blue-900"
                                        >
                                            File berhasil dikirim
                                        </p>

                                        <p
                                            class="mt-1 text-sm leading-6 text-blue-800"
                                        >
                                            File payroll sudah terkirim dan
                                            sedang menunggu diperiksa oleh
                                            Cabdin. Tidak perlu mengunggah
                                            ulang sampai hasil review diterima.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Approved Notice -->
                            <div
                                v-if="payroll.status === 'APPROVED'"
                                class="mt-5 rounded-xl bg-white/70 border border-emerald-200 p-4"
                            >
                                <div class="flex items-start gap-3">
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 12l4 4L19 6"
                                        />
                                    </svg>

                                    <div>
                                        <p
                                            class="text-sm font-semibold text-emerald-900"
                                        >
                                            Payroll telah disetujui
                                        </p>

                                        <p
                                            class="mt-1 text-sm leading-6 text-emerald-800"
                                        >
                                            Payroll periode ini sudah selesai
                                            diproses dan tidak ada tindakan
                                            lain yang diperlukan.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Revision Notice -->
                            <div
                                v-if="
                                    payroll.status === 'REVISION' &&
                                    payroll.revision_notes
                                "
                                class="mt-5 rounded-xl bg-white/70 border border-red-200 p-4"
                            >
                                <div class="flex items-start gap-3">
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="w-5 h-5 text-red-500 shrink-0 mt-0.5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 9v4M12 17h.01"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M10.3 3.8L2.9 17a2 2 0 001.7 3h14.8a2 2 0 001.7-3L13.7 3.8a2 2 0 00-3.4 0z"
                                        />
                                    </svg>

                                    <div>
                                        <p
                                            class="text-sm font-semibold text-red-800"
                                        >
                                            Catatan Perbaikan dari Cabdin
                                        </p>

                                        <p
                                            class="mt-1 text-sm leading-6 text-red-700"
                                        >
                                            {{ payroll.revision_notes }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Revision Without Note -->
                            <div
                                v-if="
                                    payroll.status === 'REVISION' &&
                                    !payroll.revision_notes
                                "
                                class="mt-5 rounded-xl bg-white/70 border border-red-200 p-4"
                            >
                                <div class="flex items-start gap-3">
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="w-5 h-5 text-red-500 shrink-0 mt-0.5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 9v4M12 17h.01"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M10.3 3.8L2.9 17a2 2 0 001.7 3h14.8a2 2 0 001.7-3L13.7 3.8a2 2 0 00-3.4 0z"
                                        />
                                    </svg>

                                    <div>
                                        <p
                                            class="text-sm font-semibold text-red-800"
                                        >
                                            Payroll perlu diperbaiki
                                        </p>

                                        <p
                                            class="mt-1 text-sm leading-6 text-red-700"
                                        >
                                            Cabdin mengembalikan payroll untuk
                                            diperbaiki. Periksa kembali file
                                            payroll sebelum mengunggah ulang.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Template + Upload -->
                    <div
                        class="grid grid-cols-1 gap-4"
                        :class="{
                            'lg:grid-cols-2': bisaUpload(),
                        }"
                    >

                        <!-- Template -->
                        <div
                            class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden"
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
                                                d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M14 2v6h6M8 13h8M8 17h6"
                                            />
                                        </svg>
                                    </div>

                                    <div class="min-w-0">
                                        <h3
                                            class="text-base font-bold text-slate-900"
                                        >
                                            Template Payroll
                                        </h3>

                                        <p
                                            v-if="template"
                                            class="mt-1 text-sm leading-6 text-slate-500"
                                        >
                                            Gunakan template yang disediakan
                                            Cabdin untuk mengisi data payroll.
                                        </p>

                                        <p
                                            v-else
                                            class="mt-1 text-sm leading-6 text-slate-500"
                                        >
                                            Template payroll belum tersedia
                                            dari Cabdin.
                                        </p>
                                    </div>
                                </div>

                                <div
                                    v-if="template"
                                    class="mt-5 pt-4 border-t border-slate-100"
                                >
                                    <a
                                        :href="
                                            route(
                                                'payroll-templates.download',
                                                template.id
                                            )
                                        "
                                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-800 hover:bg-slate-900 text-white px-5 py-3 text-sm font-semibold transition-colors"
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

                                        Download Template
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Upload -->
                        <form
                            v-if="bisaUpload()"
                            @submit.prevent="submit"
                            class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden"
                        >
                            <div class="p-5 sm:p-6">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center shrink-0"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="w-5 h-5 text-emerald-600"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 16V4m0 0L7 9m5-5l5 5"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 14v5a2 2 0 002 2h10a2 2 0 002-2v-5"
                                            />
                                        </svg>
                                    </div>

                                    <div>
                                        <h3
                                            class="text-base font-bold text-slate-900"
                                        >
                                            {{
                                                payroll.status === 'REVISION'
                                                    ? 'Upload Ulang Payroll'
                                                    : 'Upload Payroll'
                                            }}
                                        </h3>

                                        <p
                                            class="mt-1 text-sm leading-6 text-slate-500"
                                        >
                                            {{
                                                payroll.status === 'REVISION'
                                                    ? 'Perbaiki file sesuai catatan Cabdin, kemudian unggah kembali.'
                                                    : 'Unggah file payroll yang telah selesai diisi.'
                                            }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <label
                                        class="block text-xs font-semibold text-slate-700 mb-2"
                                    >
                                        File Payroll
                                    </label>

                                    <input
                                        type="file"
                                        accept=".xlsx,.xls"
                                        @input="
                                            form.file =
                                                $event.target.files[0]
                                        "
                                        class="block w-full text-sm text-slate-600 file:mr-4 file:rounded-xl file:border-0 file:bg-blue-50 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-[#28558f] hover:file:bg-blue-100"
                                    />

                                    <p
                                        class="mt-2 text-xs text-slate-400"
                                    >
                                        Format Excel (.xlsx atau .xls),
                                        maksimal 10 MB.
                                    </p>

                                    <p
                                        v-if="form.errors.file"
                                        class="mt-2 text-sm text-red-600"
                                    >
                                        {{ form.errors.file }}
                                    </p>
                                </div>

                                <div
                                    class="mt-5 pt-4 border-t border-slate-100"
                                >
                                    <button
                                        type="submit"
                                        :disabled="
                                            form.processing || !form.file
                                        "
                                        class="inline-flex items-center justify-center gap-2 w-full rounded-xl bg-[#28558f] hover:bg-[#1f4678] disabled:opacity-50 disabled:cursor-not-allowed text-white px-5 py-3 text-sm font-semibold shadow-sm hover:shadow-md transition-all duration-200"
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
                                                d="M12 16V4m0 0L7 9m5-5l5 5"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 14v5a2 2 0 002 2h10a2 2 0 002-2v-5"
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
                                                ? 'Mengunggah...'
                                                : payroll.status === 'REVISION'
                                                    ? 'Upload Ulang Payroll'
                                                    : 'Upload Payroll'
                                        }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Bottom Note -->
                    <div class="flex items-start gap-3 px-1 pt-1">
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
                            Pastikan file payroll sudah sesuai dengan template
                            dan data yang diisi telah diperiksa sebelum
                            melakukan upload.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>