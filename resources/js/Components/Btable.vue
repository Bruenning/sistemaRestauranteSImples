<template>
    <table class="container table">
        <thead>
            <tr>
                <th v-for="(header, index) in headers" :key="index" :cols="header.cols" scope="col">
                    <b>{{ header.title }}</b>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="items.length > 0" v-for="(item, index) in items" :key="index" >
                <td v-for="(header, index) in headers" :key="index">
                    <slot :item="item" :header="header">
                        <p>{{ item[header.key] }}</p>
                    </slot>
                    
                </td>
            </tr>
            <tr v-if="items.length === 0">
                <p>Nenhum registro encontrado</p>
            </tr>
        </tbody>
           
    </table>
</template>

<script>
    export default {
        props: {
            headers: {
                type: Array,
                required: true,
            },
            items: {
                type: Array,
                required: true,
            },
        },
        data() {
            return {
                isCols: {
                    is: false,
                    cols: 0,
                } 
            }
        },  
    }
</script>