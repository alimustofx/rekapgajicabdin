<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Lupa Password - Sistem Monitoring Gaji Cabdin" />

    <div class="min-h-screen w-full flex bg-white">

        <!-- ========================================================= -->
        <!-- LEFT PANEL -->
        <!-- ========================================================= -->
        <div
            class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-[#0d1e35]"
        >
            <!-- Background -->
            <div
                class="absolute inset-0 bg-gradient-to-br from-[#17385f] via-[#28558f] to-[#0d1e35]"
            ></div>

            <!-- Decorative Circles -->
            <div
                class="absolute -top-40 -right-40 w-[560px] h-[560px] rounded-full border border-white/10"
            ></div>

            <div
                class="absolute -bottom-48 -left-40 w-[620px] h-[620px] rounded-full border border-white/5"
            ></div>

            <div
                class="absolute top-1/3 right-[-100px] w-80 h-80 rounded-full bg-blue-400/10 blur-3xl"
            ></div>

            <!-- Content -->
            <div
                class="relative z-10 flex flex-col justify-between w-full p-12 xl:p-16"
            >

                <!-- Brand -->
                <div class="flex items-center gap-3">

                    <div
                        class="w-11 h-11 rounded-xl bg-white/10 border border-white/15 flex items-center justify-center shrink-0"
                    >
                        <svg
                            viewBox="0 0 40 40"
                            fill="none"
                            class="w-8 h-8"
                        >
                            <path
                                d="M20 4L7 11.5V28.5L20 36L33 28.5V11.5L20 4Z"
                                stroke="white"
                                stroke-width="3"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M20 4V20M20 20L7 27.5M20 20L33 12.5"
                                stroke="white"
                                stroke-width="3"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </div>

                    <div class="leading-tight">
                        <div class="font-bold text-white text-lg">
                            Sistem Monitoring Gaji Cabdin
                        </div>

                        <div class="text-xs text-blue-100/70 mt-0.5">
                            Cabang Dinas Pendidikan
                        </div>
                    </div>

                </div>


                <!-- Main Content -->
                <div class="max-w-xl">

                    <!-- Badge -->
                    <div
                        class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/10 text-blue-100 text-xs font-semibold mb-6"
                    >
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-blue-300"
                        ></span>

                        Pemulihan Akun
                    </div>


                    <!-- Heading -->
                    <h1
                        class="text-4xl xl:text-5xl font-bold text-white leading-[1.08] tracking-tight"
                    >
                        Akses kembali
                        <span class="text-blue-200">
                            akun Anda.
                        </span>
                    </h1>


                    <!-- Description -->
                    <p
                        class="mt-6 text-base leading-7 text-blue-100/75 max-w-lg"
                    >
                        Gunakan alamat email yang terdaftar untuk menerima
                        tautan pengaturan ulang password dan mendapatkan
                        kembali akses ke Sistem Monitoring Gaji Cabdin.
                    </p>


                    <!-- Information Card -->
                    <div
                        class="mt-9 max-w-lg rounded-2xl bg-white/[0.07] border border-white/10 p-5"
                    >

                        <div class="flex items-start gap-4">

                            <!-- Icon -->
                            <div
                                class="w-10 h-10 rounded-xl bg-blue-400/10 border border-blue-200/10 flex items-center justify-center shrink-0"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="w-5 h-5 text-blue-200"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M4 6h16v12H4z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M4 7l8 6 8-6"
                                    />
                                </svg>
                            </div>


                            <!-- Text -->
                            <div>

                                <div
                                    class="text-sm font-semibold text-white"
                                >
                                    Tautan reset dikirim melalui email
                                </div>

                                <div
                                    class="mt-1 text-xs leading-5 text-blue-100/55"
                                >
                                    Masukkan email akun yang terdaftar.
                                    Sistem akan mengirimkan instruksi untuk
                                    membuat password baru.
                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- Process -->
                    <div class="mt-8 flex items-center gap-3">

                        <!-- Step 01 -->
                        <div class="flex items-center gap-2">

                            <div
                                class="w-7 h-7 rounded-lg bg-white/10 border border-white/10 flex items-center justify-center"
                            >
                                <span
                                    class="text-[10px] font-bold text-blue-200"
                                >
                                    01
                                </span>
                            </div>

                            <span class="text-[11px] text-blue-100/60">
                                Masukkan email
                            </span>

                        </div>


                        <div class="w-8 h-px bg-white/10"></div>


                        <!-- Step 02 -->
                        <div class="flex items-center gap-2">

                            <div
                                class="w-7 h-7 rounded-lg bg-white/10 border border-white/10 flex items-center justify-center"
                            >
                                <span
                                    class="text-[10px] font-bold text-blue-200"
                                >
                                    02
                                </span>
                            </div>

                            <span class="text-[11px] text-blue-100/60">
                                Buka email
                            </span>

                        </div>


                        <div class="w-8 h-px bg-white/10"></div>


                        <!-- Step 03 -->
                        <div class="flex items-center gap-2">

                            <div
                                class="w-7 h-7 rounded-lg bg-white/10 border border-white/10 flex items-center justify-center"
                            >
                                <span
                                    class="text-[10px] font-bold text-blue-200"
                                >
                                    03
                                </span>
                            </div>

                            <span class="text-[11px] text-blue-100/60">
                                Reset password
                            </span>

                        </div>

                    </div>

                </div>


                <!-- Bottom -->
                <div class="text-xs text-blue-100/45">
                    Sistem internal · Akses terbatas untuk Admin & Operator
                </div>

            </div>
        </div>


        <!-- ========================================================= -->
        <!-- RIGHT PANEL -->
        <!-- ========================================================= -->
        <div
            class="w-full lg:w-1/2 min-h-screen flex flex-col bg-white"
        >

            <!-- Mobile Brand -->
            <div
                class="lg:hidden px-6 py-5 border-b border-slate-100"
            >

                <div class="flex items-center gap-3">

                    <div
                        class="w-10 h-10 rounded-xl bg-[#28558f] flex items-center justify-center shrink-0"
                    >
                        <svg
                            viewBox="0 0 40 40"
                            fill="none"
                            class="w-7 h-7"
                        >
                            <path
                                d="M20 4L7 11.5V28.5L20 36L33 28.5V11.5L20 4Z"
                                stroke="white"
                                stroke-width="3"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M20 4V20M20 20L7 27.5M20 20L33 12.5"
                                stroke="white"
                                stroke-width="3"
                            />
                        </svg>
                    </div>


                    <div class="leading-tight">

                        <div class="font-bold text-slate-950">
                            Sistem Monitoring Gaji Cabdin
                        </div>

                        <div class="text-xs text-slate-500 mt-0.5">
                            Cabang Dinas Pendidikan
                        </div>

                    </div>

                </div>

            </div>


            <!-- Form Area -->
            <div
                class="flex-1 flex items-center justify-center px-6 py-10 sm:px-10"
            >

                <div class="w-full max-w-md">

                    <!-- Back To Login -->
                    <div class="mb-7">

                        <Link
                            :href="route('login')"
                            class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-[#28558f] transition-colors"
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
                                    d="M19 12H5"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 19l-7-7 7-7"
                                />
                            </svg>

                            Kembali ke login

                        </Link>

                    </div>


                    <!-- Heading -->
                    <div class="mb-8">

                        <div
                            class="inline-flex items-center px-3 py-1.5 rounded-full bg-blue-50 border border-blue-100 text-[#28558f] text-xs font-semibold mb-4"
                        >
                            Reset Password
                        </div>


                        <h2
                            class="text-3xl font-bold tracking-tight text-slate-950"
                        >
                            Lupa password?
                        </h2>


                        <p
                            class="mt-3 text-sm leading-6 text-slate-500 max-w-md"
                        >
                            Tidak masalah. Masukkan email yang terdaftar pada
                            sistem. Kami akan mengirimkan tautan untuk
                            mengatur ulang password Anda.
                        </p>

                    </div>


                    <!-- Success Status -->
                    <div
                        v-if="status"
                        class="mb-5 rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3.5"
                    >

                        <div class="flex items-start gap-3">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 12l4 4L19 6"
                                />
                            </svg>


                            <div>

                                <div
                                    class="text-xs font-semibold text-emerald-800"
                                >
                                    Permintaan berhasil diproses
                                </div>

                                <div
                                    class="mt-0.5 text-xs leading-5 text-emerald-700"
                                >
                                    {{ status }}
                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- Form -->
                    <form @submit.prevent="submit">

                        <!-- Email -->
                        <div>

                            <InputLabel
                                for="email"
                                value="Email"
                                class="!text-sm !font-semibold !text-slate-700"
                            />


                            <TextInput
                                id="email"
                                type="email"
                                class="mt-2 block w-full !rounded-xl !border-slate-200 !bg-slate-50/50 !px-4 !py-3 focus:!border-[#28558f] focus:!ring-[#28558f]"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="Masukkan email yang terdaftar"
                            />


                            <InputError
                                class="mt-2"
                                :message="form.errors.email"
                            />

                        </div>


                        <!-- Submit -->
                        <div class="mt-6">

                            <PrimaryButton
                                class="!w-full !justify-center !rounded-xl !bg-[#28558f] hover:!bg-[#1f4678] !py-3 !text-sm !font-semibold !shadow-sm hover:!shadow-md transition-all duration-200"
                                :class="{
                                    'opacity-50': form.processing
                                }"
                                :disabled="form.processing"
                            >

                                <span v-if="form.processing">
                                    Mengirim tautan...
                                </span>


                                <span
                                    v-else
                                    class="flex items-center justify-center gap-2"
                                >

                                    Kirim Tautan Reset

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
                                            d="M5 12h14"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M13 6l6 6-6 6"
                                        />
                                    </svg>

                                </span>

                            </PrimaryButton>

                        </div>


                        <!-- Security Note -->
                        <div
                            class="mt-6 flex items-start gap-3 rounded-xl bg-slate-50 border border-slate-100 px-4 py-3.5"
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="w-5 h-5 text-[#28558f] shrink-0 mt-0.5"
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


                            <div>

                                <div
                                    class="text-xs font-semibold text-slate-700"
                                >
                                    Akun tetap terlindungi
                                </div>

                                <div
                                    class="text-[11px] leading-5 text-slate-400 mt-0.5"
                                >
                                    Tautan reset hanya dapat digunakan melalui
                                    email yang terdaftar pada akun.
                                </div>

                            </div>

                        </div>

                    </form>


                    <!-- Footer -->
                    <div
                        class="mt-8 pt-6 border-t border-slate-100 text-center"
                    >

                        <p class="text-[11px] text-slate-400">
                            Sistem Monitoring Gaji Cabdin
                        </p>

                        <p class="text-[10px] text-slate-300 mt-1">
                            Cabang Dinas Pendidikan
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>
</template>