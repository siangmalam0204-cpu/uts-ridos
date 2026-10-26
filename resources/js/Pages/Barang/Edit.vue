<script setup>
import BarangLayout from '@/Layouts/BarangLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    item: Object,
});

const form = useForm({
    kode_barang: props.item.kode_barang,
    nama_barang: props.item.nama_barang,
    kategori: props.item.kategori,
    jumlah: props.item.jumlah,
    lokasi_simpan: props.item.lokasi_simpan,
});

function submit() {
    form.put(`/barang/${props.item.id}`);
}
</script>

<template>
    <Head title="Edit Barang" />

    <BarangLayout>
        <div class="mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Edit Barang</h2>
            <p class="mt-2 text-gray-600">Perbarui informasi barang.</p>
        </div>

        <form @submit.prevent="submit" class="max-w-3xl space-y-5 rounded-xl bg-white p-6 shadow">
            <div>
                <label class="mb-1 block font-medium">Kode Barang</label>
                <input v-model="form.kode_barang" type="text" class="w-full rounded-lg border-gray-300" placeholder="Contoh: BRG001" required />
                <p v-if="form.errors.kode_barang" class="mt-1 text-sm text-red-600">{{ form.errors.kode_barang }}</p>
            </div>

            <div>
                <label class="mb-1 block font-medium">Nama Barang</label>
                <input v-model="form.nama_barang" type="text" class="w-full rounded-lg border-gray-300" placeholder="Masukkan nama barang" required />
                <p v-if="form.errors.nama_barang" class="mt-1 text-sm text-red-600">{{ form.errors.nama_barang }}</p>
            </div>

            <div>
                <label class="mb-1 block font-medium">Kategori</label>
                <input v-model="form.kategori" type="text" class="w-full rounded-lg border-gray-300" placeholder="Contoh: Elektronik" required />
                <p v-if="form.errors.kategori" class="mt-1 text-sm text-red-600">{{ form.errors.kategori }}</p>
            </div>

            <div>
                <label class="mb-1 block font-medium">Jumlah</label>
                <input v-model="form.jumlah" type="number" min="0" step="1" class="w-full rounded-lg border-gray-300" placeholder="Contoh: 10" required />
                <p v-if="form.errors.jumlah" class="mt-1 text-sm text-red-600">{{ form.errors.jumlah }}</p>
            </div>

            <div>
                <label class="mb-1 block font-medium">Lokasi Simpan</label>
                <input v-model="form.lokasi_simpan" type="text" class="w-full rounded-lg border-gray-300" placeholder="Contoh: Gudang A, Rak 2" required />
                <p v-if="form.errors.lokasi_simpan" class="mt-1 text-sm text-red-600">{{ form.errors.lokasi_simpan }}</p>
            </div>

            <div class="flex flex-wrap gap-3">
                <button type="submit" :disabled="form.processing" class="rounded-lg bg-blue-600 px-5 py-3 text-white hover:bg-blue-700 disabled:opacity-50">
                    {{ form.processing ? 'Memperbarui...' : 'Simpan Perubahan' }}
                </button>
                <Link href="/barang" class="rounded-lg bg-gray-200 px-5 py-3 text-gray-800 hover:bg-gray-300">Kembali</Link>
            </div>
        </form>
    </BarangLayout>
</template>
