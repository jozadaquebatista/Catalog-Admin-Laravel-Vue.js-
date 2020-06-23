<template>
    <div>
        <!-- <div class="picture">
            <img src="" alt="">
        </div> -->
        <!-- <croppa v-model="croppa"
        :width="250"
        :height="250"
        placeholder="Clique para escolher ou arraste"
        :placeholder-font-size="15"
        :disabled="false"
        :prevent-white-space="false"
        :show-remove-button="true">
        </croppa>
        <label>
            <span>Nome Produto</span>
            <input type="text" v-model="product.name" />
        </label>
        <label>
            <span>Valor</span>
            <input type="text" v-model.lazy="price" v-money="money" />
        </label>
        <label>
            <span>Informações Técnicas</span>
            <input type="text" v-model="product.info" />
        </label>
        <button @click="save">Salvar</button> -->

        <div class="grid-content">
            <div class="row">
                <div class="col sz6">
                    <croppa v-model="croppa"
                    :width="250"
                    :height="250"
                    placeholder="Clique para escolher ou arraste"
                    :placeholder-font-size="15"
                    :disabled="false"
                    :prevent-white-space="false"
                    :show-remove-button="true">
                        <img v-if="product.id" crossOrigin="anonymous" :src="product.picture" slot="initial">
                    </croppa>
                </div>
                <div class="col sz6 product-info">
                    <label>
                        <span>Nome Produto</span>
                        <input type="text" v-model="product.name" />
                    </label>
                    <!--
                    <label>
                        <span>Valor</span>
                        <money v-model="price" v-bind="money"></money>
                    </label>
                    <label>
                        <span>Categoria</span>
                        <select v-model="product.category">
                            <option value="1">Lácteos</option>
                            <option value="2">Congelados</option>
                            <option value="3">Limpeza</option>
                            <option value="4">Hortifrúti</option>
                            <option value="5">Padaria</option>
                            <option value="6">Frios</option>
                            <option value="7">Bebidas</option>
                            <option value="8">Açougue</option>
                            <option value="9">Grãos</option>
                            <option value="10">Higiene</option>
                            <option value="11">Beleza</option>
                            <option value="12">Utilidades</option>
                            <option value="13">Petshop</option>
                            <option value="14">Bebê</option>
                        </select>
                    </label>
                    -->
                </div>
            </div>
            <!--
            <div class="row">
                <div class="col sz12">
                    <label>
                        <span>Informações Técnicas</span>
                        <textarea cols="30" rows="5" v-model="product.info"></textarea>
                    </label>
                </div>
            </div>
            -->
            <div class="row">
                <div class="col sz12">
                    <button @click="save">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'

    export default {
        data: function() {
            return {
                croppa: {},
                price: 123.45,
                money: {
                    decimal: ',',
                    thousands: '.',
                    prefix: 'R$ ',
                    suffix: '',
                    precision: 2,
                    masked: false
                },
                product: {
                    id: this.$route.params.id,
                    picture: null,
                    name: '',
                    category: 1,
                    info: ''
                },
                form: {
                    method: 'post'
                },
            }
        },
        mounted() {
            if(this.product.id)
            {
                this.edit();
            }
        },
        methods: {
            edit() {
                axios.get(`/api/v1/products/${this.product.id}`).then(response => {
                    response = response.data.data.pop();

                    this.product.name = response.name;
                    this.product.picture = `/storage/images/${response.pictures.pop().title}`;
                }).catch(error => {
                    console.error(error.data);
                });
            },
            save() {

                this.croppa.generateBlob(blob => {

                    this.form.endpoint = `/api/v1/products${this.product.id ? `/${this.product.id}` : ''}`;

                    let payload = new FormData();

                    payload.append('_method', 'PUT');
                    payload.append('image', blob);
                    payload.append('name', this.product.name);
                    payload.append('price', this.price);
                    payload.append('category', this.product.category);
                    payload.append('info', this.product.info);

                    axios[this.form.method](this.form.endpoint, payload, {
                        headers: {
                            'content-type': 'multipart/form-data'
                        }
                    }).then(response => {
                        console.log(response.data);
                    }).catch(error => {
                        console.error('Não foi possível salvar o produto', error.toString());
                    });

                }, 'image/jpeg', 0.8);

            }
        },
    }
</script>

<style scoped>
    div {
        padding: 0 20px;
    }



    input[type="text"], input[type="tel"], select, textarea {
        text-indent: 10px;
        color: #333;
        font-size: 1.3em;
    }

    input[type="text"], input[type="tel"], button {
        height: 30px;
        width: 100%;
        outline: none;
        margin: 1px 0 10px;
    }

    select {
        height: 30px;
        width: 100%;
        outline: none;
        margin: 1px 0 10px;
    }

    textarea {
        width: 100%;
        outline: none;
        margin: 1px 0 10px;
    }

    button {
        height: 40px;
        width: 100%;
        outline: none;
        margin: 1px 0 10px;
        background: #f00;
        color: #fff;
        font-weight: bold;
        border: 1px solid #f00;
        border-radius: 5px;
        transition: background .2s ease-out;
    }

    button:hover {
        cursor: pointer;
        background: #f33;
    }

    button:hover {
        cursor: pointer;
        background: #f33;
    }

    button:active {
        cursor: pointer;
        background: #d00;
    }

    .grid-content {
        margin: 100px 100px;
    }

    label {
        color: #333;
        font-size: 1.2em;
    }

   .product-info {
        text-align: initial;
        font-weight: bold;
    }
</style>
