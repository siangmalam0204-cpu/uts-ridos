
<script setup>
import { reactive } from 'vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

const form = useForm({
    kode_barang: '',
    nama_barang: '',
    kategori: '',
    jumlah: 0,
    lokasi_simpan: '',
})

function simpanBarang() {
    form.post('/barang', {
        onSuccess: () => form.reset(),
    })
}
</script>

<template>
    <Head title="Tambah Barang" />

    <div class="min-h-screen bg-slate-100 px-4 py-10">
        <div class="mx-auto max-w-3xl rounded-2xl bg-white p-8 shadow-lg">
            <h1 class="mb-2 text-3xl font-bold text-blue-700">
                Tambah Barang
            </h1>

            <p class="mb-8 text-gray-500">
                Isi formulir berikut untuk menambahkan inventaris baru.
            </p>

            <form @submit.prevent="simpanBarang" class="space-y-5">
                <div>
                    <label class="mb-2 block font-semibold">Kode Barang</label>
                    <input
                        v-model="form.kode_barang"
                        type="text"
                        placeholder="Contoh: BRG001"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3"
                        required
                    />
                    <p v-if="form.errors.kode_barang" class="mt-1 text-sm text-red-600">
                        {{ form.errors.kode_barang }}
                    </p>
                </div>

                <div>
                    <label class="mb-2 block font-semibold">Nama Barang</label>
                    <input
                        v-model="form.nama_barang"
                        type="text"
                        placeholder="Masukkan nama barang"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3"
                        required
                    />
                    <p v-if="form.errors.nama_barang" class="mt-1 text-sm text-red-600">
                        {{ form.errors.nama_barang }}
                    </p>
                </div>

                <div>
                    <label class="mb-2 block font-semibold">Kategori</label>
                    <input
                        v-model="form.kategori"
                        type="text"
                        placeholder="Contoh: Elektronik"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3"
                        required
                    />
                    <p v-if="form.errors.kategori" class="mt-1 text-sm text-red-600">
                        {{ form.errors.kategori }}
                    </p>
                </div>

                <div>
                    <label class="mb-2 block font-semibold">Jumlah</label>
                    <input
                        v-model.number="form.jumlah"
                        type="number"
                        min="0"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3"
                        required
                    />
                    <p v-if="form.errors.jumlah" class="mt-1 text-sm text-red-600">
                        {{ form.errors.jumlah }}
                    </p>
                </div>

                <div>
                    <label class="mb-2 block font-semibold">Lokasi Penyimpanan</label>
                    <input
                        v-model="form.lokasi_simpan"
                        type="text"
                        placeholder="Contoh: Gudang A"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3"
                        required
                    />
                    <p v-if="form.errors.lokasi_simpan" class="mt-1 text-sm text-red-600">
                        {{ form.errors.lokasi_simpan }}
                    </p>
                </div>

                <div class="flex flex-wrap gap-3 pt-4">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700 disabled:opacity-50"
                    >
                        {{ form.processing ? 'Menyimpan...' : 'Simpan Barang' }}
                    </button>

                    <Link
                        href="/barang"
                        class="rounded-lg bg-gray-200 px-6 py-3 font-semibold text-gray-700 hover:bg-gray-300"
                    >
                        Kembali
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>
