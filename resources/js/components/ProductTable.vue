<template>
    <table>
        <thead>
            <tr>
                <th>Imagem</th>
                <th>Produto</th>
                <th>Ações</th>
                <!--
                <th>Valor</th>
                <th>Informações Técnicas</th>
                -->
            </tr>
        </thead>
        <tbody>
            <tr v-for="product in productList">
                <!--
                <td>
                    <svg style="width: 40px;height: 80px;" id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><g><path d="m345.905 441.87h-327.292v-434.37h246.479l80.813 80.813z" fill="#f4fbff"/></g><g><path d="m265.092 7.5h-22.224v82.833c0 11.158 9.045 20.203 20.203 20.203h51.518c5.579 0 10.102 4.523 10.102 10.102v89.155c0 2.266-1.854 4.119-4.12 4.119h-.042c-79.095 0-143.443 64.349-143.443 143.443 0 31.575 10.263 60.795 27.618 84.514h141.2v-353.556z" fill="#e4f6ff"/></g><g><path d="m265.092 7.5v80.813h80.813z" fill="#d3effb"/></g><g><path d="m50.938 131.75h262.642v202.033h-262.642z" fill="#dd636e"/></g><g><path d="m313.58 333.783v-119.7c-67.943 3.258-123.637 54.008-134.545 119.699h134.545z" fill="#da4a54"/></g><g><path d="m50.938 377.22h262.642v32.325h-262.642z" fill="#407093"/></g><g><path d="m186.918 409.545h126.662v-32.325h-135.111c1.564 11.24 4.429 22.069 8.449 32.325z" fill="#365e7d"/></g><g><path d="m140.584 270.517v-75.502c0-7.845 8.552-12.696 15.285-8.67l63.147 37.751c6.558 3.92 6.558 13.42 0 17.341l-63.147 37.751c-6.733 4.025-15.285-.826-15.285-8.671z" fill="#fff"/></g><g><g><path d="m385.941 434.888h60.61v36.366h-60.61z" fill="#2b4d66" transform="matrix(.707 -.707 .707 .707 -198.454 427.031)"/></g><g><path d="m493.389 504.5h-51.429l-25.714-25.715 25.714-25.714z" fill="#4a80aa"/></g><g><circle cx="320.53" cy="357.356" fill="#95d6a4" r="121.22"/></g><g><path d="m393.837 260.815c15.483 20.358 24.679 45.757 24.679 73.307 0 66.948-54.272 121.22-121.22 121.22-27.55 0-52.948-9.197-73.307-24.679 22.141 29.113 57.143 47.913 96.54 47.913 66.948 0 121.22-54.272 121.22-121.22.001-39.398-18.799-74.4-47.912-96.541z" fill="#78c2a4"/></g><g><circle cx="320.53" cy="357.356" fill="#e4f6ff" r="88.894"/></g><g><path d="m374.212 286.501c11.319 14.916 18.04 33.513 18.04 53.682 0 49.095-39.799 88.894-88.894 88.894-20.169 0-38.766-6.721-53.682-18.04 16.233 21.393 41.929 35.212 70.855 35.212 49.095 0 88.894-39.799 88.894-88.894 0-28.925-13.82-54.621-35.213-70.854z" fill="#d3effb"/></g></g><g><path d="m159.718 179.907c-5.51-3.294-12.133-3.368-17.716-.202-5.584 3.168-8.917 8.891-8.917 15.311v75.501c0 6.42 3.333 12.143 8.917 15.311 2.731 1.55 5.712 2.323 8.689 2.323 3.108 0 6.212-.843 9.027-2.525l63.146-37.751c5.366-3.208 8.57-8.854 8.57-15.106s-3.203-11.9-8.569-15.109zm55.449 55.092-63.147 37.751c-1.132.679-2.126.309-2.618.03s-1.318-.945-1.318-2.264v-75.501c0-1.318.826-1.984 1.318-2.264.286-.162.741-.354 1.294-.354.399 0 .85.1 1.324.384l63.147 37.751c1.103.659 1.267 1.682 1.267 2.233 0 .552-.165 1.576-1.267 2.234z"/><path d="m498.692 499.196-46.126-46.125 3.268-3.268c1.407-1.407 2.197-3.314 2.197-5.304s-.79-3.896-2.197-5.304l-21.562-21.562c25.736-48.631 18.164-110.409-22.724-151.297-16.677-16.676-36.83-27.804-58.148-33.397v-144.629c0-1.989-.79-3.896-2.197-5.304l-80.81-80.81c-1.405-1.406-3.313-2.196-5.302-2.196h-246.48c-4.142 0-7.5 3.357-7.5 7.5v97.32c0 4.143 3.358 7.5 7.5 7.5s7.5-3.357 7.5-7.5v-89.82h231.481v73.313c0 4.143 3.358 7.5 7.5 7.5h73.309v134.126c-5.744-.799-11.531-1.211-17.32-1.235v-33.454c0-4.143-3.358-7.5-7.5-7.5s-7.5 3.357-7.5 7.5v34.262c-27.994 3.135-55.149 15.405-76.569 36.825-17.144 17.144-28.428 37.962-33.859 59.943h-137.212v-187.03h247.64v21c0 4.143 3.358 7.5 7.5 7.5s7.5-3.357 7.5-7.5v-28.5c0-4.143-3.358-7.5-7.5-7.5h-262.64c-4.142 0-7.5 3.357-7.5 7.5v202.03c0 4.143 3.358 7.5 7.5 7.5h141.935c-1.178 9.437-1.32 18.979-.415 28.439h-141.52c-4.142 0-7.5 3.357-7.5 7.5v32.32c0 4.143 3.358 7.5 7.5 7.5h155.532c3.133 5.996 6.776 11.792 10.917 17.33h-191.279v-294.549c0-4.143-3.358-7.5-7.5-7.5s-7.5 3.357-7.5 7.5v302.05c0 4.143 3.358 7.5 7.5 7.5h211.922c24.964 24.424 57.478 36.645 89.998 36.645 20.747 0 41.493-4.975 60.278-14.917l21.563 21.562c1.464 1.464 3.384 2.196 5.303 2.196s3.839-.732 5.303-2.196l3.268-3.268 20.411 20.412c1.464 1.464 3.384 2.196 5.303 2.196s3.839-.732 5.303-2.196c2.929-2.93 2.929-7.678 0-10.607l-20.411-20.411 15.107-15.107 46.126 46.126c1.464 1.464 3.384 2.196 5.303 2.196s3.839-.732 5.303-2.196c2.931-2.931 2.931-7.679.001-10.609zm-226.1-473.588 55.206 55.206h-55.206zm-214.151 376.432v-17.32h136.351c1.266 5.862 2.948 11.649 5.038 17.32zm181.677 35.728c-44.339-44.34-44.339-116.484 0-160.823 22.17-22.17 51.291-33.255 80.412-33.255s58.242 11.085 80.412 33.255c44.339 44.339 44.339 116.483 0 160.823-44.34 44.339-116.485 44.337-160.824 0zm153.875 25.301c6.175-4.295 12.055-9.193 17.556-14.694 5.502-5.502 10.399-11.382 14.695-17.557l13.682 13.681-32.251 32.251z"/><path d="m400.663 396.63c-3.553-2.133-8.159-.982-10.292 2.568-3.418 5.691-7.551 10.977-12.283 15.708-31.737 31.736-83.376 31.738-115.114 0-15.371-15.37-23.835-35.81-23.835-57.552 0-21.741 8.465-42.181 23.835-57.551 31.737-31.736 83.376-31.738 115.114 0 18.348 18.347 26.72 43.622 22.972 69.345-.598 4.1 2.241 7.906 6.34 8.504 4.101.584 7.906-2.242 8.503-6.34 4.439-30.456-5.478-60.386-27.208-82.116-37.585-37.584-98.742-37.584-136.327 0-18.204 18.204-28.229 42.41-28.229 68.158 0 25.749 10.025 49.955 28.229 68.159 18.795 18.794 43.475 28.19 68.164 28.188 24.682-.002 49.373-9.398 68.163-28.188 5.597-5.597 10.488-11.853 14.536-18.593 2.132-3.55.982-8.157-2.568-10.29z"/></g></g></svg>
                </td>
                -->
                <!--<td> {{product.description}} </td>
                <td> R$ {{product.price}} </td>
                <td> {{product.information}} </td>
                -->
                <td>
                    <img v-if="product.pictures.length" :src="product.pictures[0].title" />
                </td>
                <td>
                    {{product.name}}
                </td>
                <td>
                    <svg @click="edit(product.id)" style="width: 25px;height: 40px;" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title>writter, writte, content, create, text</title><path d="M9,15h3.81l8.7-8.69a2.7,2.7,0,0,0,0-3.82,2.77,2.77,0,0,0-3.82,0L9,11.19Zm2-3,8.11-8.1a.69.69,0,0,1,1,0h0a.68.68,0,0,1,0,1L12,13H11Z"/><path d="M20,19.07a.93.93,0,0,1-.93.93H4.93A.93.93,0,0,1,4,19.07V4.93A.93.93,0,0,1,4.93,4H15V2H4.93A2.93,2.93,0,0,0,2,4.93V19.07A2.93,2.93,0,0,0,4.93,22H19.07A2.93,2.93,0,0,0,22,19.07V10H20Z"/></svg>
                    <svg @click="remove(product.id)" style="width: 25px;height: 40px;" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title>spam, trash, close, garbage, delete</title><path d="M2.88,5,5.11,24H18.89L21.12,5ZM17.11,22H6.89L5.12,7H18.88Z"/><polygon points="21 2 15 2 15 1 13 1 13 0 11 0 11 1 9 1 9 2 3 2 3 4 21 4 21 2"/><polygon points="10.23 17.66 12 15.89 13.77 17.66 15.18 16.24 13.41 14.47 15.18 12.71 13.77 11.29 12 13.06 10.23 11.29 8.82 12.71 10.59 14.47 8.82 16.24 10.23 17.66"/></svg>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th colspan=5><< < 1,2,3...9,10 > >></th>
            </tr>
        </tfoot>
    </table>
</template>

<script>
export default {
    data: function() {
        return {
            productList: [],
            currentPage: 1,
            itemsPerPage: 8,
        }
    },
    mounted() {
        this.listAll();
    },
    methods: {
        listAll() {
            axios.get('api/v1/products').then(response => {
                this.productList = response.data.data;
                console.warn(response);
            }).catch(error => {
                console.error(error);
            });
        },
        edit: function(id) {
            this.$router.push({name: 'products.edit', params: { id: id }});
        },
        remove(id) {
            axios.delete(`api/v1/products/${id}`).then(response => {
                console.log(response.data);
                this.listAll();
            }).catch(error => {
                console.error(error);
            });
        }
    },
    computed: {
        products: async function() {

            /*
            let produtos = ['meia', 'sapato', 'tênis', 'camiseta', 'colar', 'chinelo', 'boné', 'óculos', 'Roupa Bebê'];

            for(let i=0; i < 8; i++)
            {
                this.productList.push({
                    'description': `${produtos[i].toLocaleUpperCase()}`,
                    'price': String(`${Math.round(Math.random() * 50)}.99`).replace('.',','),
                    'image': 'https://placeimg.com/150/150/tech',
                    'information': 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'.slice(0,200).concat('...')
                });
            }*/

            let response = await axios.get('api/v1/products');

            this.productList = response.data.data;

            return this.productList;
        }
    }
}
</script>

<style scoped>
    table tr {
    border: 1px solid #ddd;
    border-left: none;
    border-right: none;
    }

    table {
    margin: 40px auto 0;
    width: 80%;
    height: 200px;
    text-align: center;
    }

    table td:first-child {
    width: 20px;
    }

    table td:nth-child(2) {
    width: 80px;
    }

    table td:nth-child(3) {
    width: 80px;
    }

    table td:nth-child(5) {
    width: 80px;
    }

    table td img {
    width: 100px;
    }

    table, tr, td, th {
        border: 1px solid #eee;
    }
</style>
