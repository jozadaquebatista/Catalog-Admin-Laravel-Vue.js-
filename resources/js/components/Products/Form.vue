<template>
    <div>
        <!--card cadastro de produtos -->
        <v-card>
          <v-card-text>
            <v-row justify="space-around">

              <v-col cols="12" md="6">
                <v-card>
                  <v-img aspect-ratio="1">
                    <croppa class="cropper"
                        v-model="croppa"
                        placeholder="Clique para escolher a imagem ou arraste alguma"
                        canvas-color="transparent"
                        :zoom-speed="20"
                        :width="500"
                        :height="500"
                        :placeholder-font-size="15"
                        :disabled="false"
                        :prevent-white-space="false"
                        :show-remove-button="true"
                        :accept="'image/*'"
                    >
                        <img v-if="product.id" crossOrigin="anonymous" :src="product.picture" slot="initial">
                    </croppa>
                  </v-img>
                </v-card>
              </v-col>

              <v-col cols="12" md="6">

                <form>
                  <v-text-field v-model="product.name"
                    :counter="150"
                    label="Nome do Produto"
                    required
                  ></v-text-field>

                  <v-btn class="mr-4" @click="save">salvar</v-btn>
                  <v-btn @click="clear">limpar</v-btn>
                </form>

              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
        <!--card cadastro de produtos -->
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
            clear() {
                this.product.name = '';
                this.croppa.remove();
            },
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

                    let method = this.product.id ? 'put' : 'post';

                    payload.append('_method', method);
                    payload.append('image', blob);
                    payload.append('name', this.product.name);

                    axios[method](this.form.endpoint, payload, {
                        headers: {
                            'content-type': 'multipart/form-data'
                        }
                    }).then(response => {
                        console.log(response.status);
                        this.$router.push({path: '/products'});
                    }).catch(error => {
                        console.error('Não foi possível salvar o produto', error.toString());
                    });

                }, 'image/jpeg', 0.8);

            }
        },
    }
</script>

<style scoped>
    .croppa-container.cropper {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        background: #fff;
        border: 2px solid #888;
    }

    .croppa-container.cropper canvas {
        width: 100%;
        border: 2px solid #ccc;
    }
</style>