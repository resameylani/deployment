<script setup>
    import { onMounted, ref } from 'vue';
    import { useRouter } from 'vue-router';
    import axios from 'axios';

    const router = useRouter();
    let produk = ref([]);
    let message = ref('');

    onMounted(async () => {
        getProduk();
    });

    const getProduk = async () => {
        let response = await axios.get('/api/produk');
        produk.value = response.data;
    };

    const CreateProduk = () => {
        router.push('/produk_vue/create');
        message.value = 'Produk berhasil ditambahkan'; // Tambahkan ini jika logika pembuatan produk terjadi di sini
    };

    const EditProduk = (id) => {
        router.push('/produk_vue/edit/' + id);
        message.value = 'Produk berhasil diperbarui'; // Tambahkan ini jika logika pengeditan produk terjadi di sini
    };

    const DeleteProduk = async (id) => {
        if (confirm("Do you really want to delete?")) {
            await axios.delete('/api/produk/' + id);
            getProduk();
            message.value = 'Produk berhasil dihapus';
        }
    };
</script>

<template>
    <div class="container">
        <h1>List Produk</h1>
        <p v-if="message">{{ message }}</p> <!-- Tampilkan pesan di sini -->
        <button @click="CreateProduk" class="add-button">Add</button>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produk</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody v-for="item in produk" :key="item.id" v-if="produk.length > 0">
                <tr>
                    <td>{{ item.id }}</td>
                    <td>{{ item.produk }}</td>
                    <td>{{ item.price }}</td>
                    <td>{{ item.stock }}</td>
                    <td class="action-buttons">
                        <button @click="EditProduct(item.id)">Edit</button>
                        <button @click="DeleteProduct(item.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td colspan="5">Data Not Found</td>
                </tr>
            </tbody>
        </table>
    </div>

