<!-- paginacao --> 
<template>
  <div>
    <v-row class="fill-height">
      <v-col sm="10" offset-sm="1">

        <v-text-field v-model="search"
          :counter='100'
          label='Digite para Pesquisar'
          prepend-inner-icon='mdi-magnify'
          solo
          required
          @input="serverProductSearch"
        ></v-text-field>

        <!--card tabela de produtos -->
        <v-card>
          <v-card-text>
            <v-simple-table v-if="browserProductFiltered.length">
              <template v-slot:default>
                <thead>
                  <tr>
                    <th>Imagem</th>
                    <th>Produto</th>
                    <th>Avaliação</th>
                    <th>Status</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="product in browserProductFiltered">
                    <td>
                      <v-btn class="ma-2" tile large :color="status[Number(product.status)].color" icon>
                        <v-icon :color="product.pictures.length ? 'blue-grey darken-2' : 'blue-grey lighten-4'">{{product.pictures.length > 0 ? 'mdi-image' : 'mdi-image-off'}}</v-icon>
                      </v-btn>
                    </td>
                    <td>
                      {{product.name}}
                    </td>
                    <!-- if admin -->
                    <td v-if="Number(user.admin)">
                      <v-radio-group row @change="productStatus(product)" v-model="product.status">
                        <v-radio label="Aprovar" value="2"></v-radio>
                        <v-radio label="Reprovar" value="3"></v-radio>
                      </v-radio-group>
                    </td>
                    <td v-else>
                      <v-switch v-if="Number(product.status) === 0" value='0' @change="productStatus(product)"></v-switch>
                      <v-switch v-else v-model="product.status" :disabled="Number(product.status) !== 0"></v-switch>
                    </td>
                    <!-- if admin -->
                    <td>
                      <v-chip :color="status[Number(product.status)].color" dark>{{status[Number(product.status)].text}}</v-chip>
                    </td>
                    <td class="actions">
                      <v-btn class="ma-2" circle large :color="status[Number(product.status)].color" icon>
                        <v-icon @click="edit(product.id)">mdi-circle-edit-outline</v-icon>
                      </v-btn>
                      <v-btn class="ma-2" circle large :color="status[Number(product.status)].color" icon>
                        <v-icon @click="remove(product.id)" class="delete">mdi-delete-circle</v-icon>
                      </v-btn>
                    </td>
                  </tr>
                </tbody>
              </template>
            </v-simple-table>
            <p v-else class="text-center">Não há resultados para sua Pesquisa</p>
          </v-card-text>
        </v-card>
        <!--card tabela de produtos -->
      </v-col>
    </v-row>

    <!-- paginacao -->
    <div class="text-center">
      <v-pagination
        v-model="browser.page"
        :length="browser.lastPage"
        :total-visible="8"
        @input="next"
      ></v-pagination>
    </div>
    <!-- paginacao -->
  </div>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'

  export default {
      data() {
        return {
            status: {
              0: { text: 'pendente', color: 'amber' },
              1: { text: 'em análise', color: 'blue-grey darken-2' },
              2: { text: 'aprovado', color: 'green' },
              3: { text: 'reprovado', color: 'pink accent-3' },
            },
            form: {
              headers: {
                'content-type': 'application/json'
              },
              endpoint: null,
              payload: {}
            },
            search: '',
            timer: null,
            filteredProductList: [],
            products: [
              {name:'aguarde...',status:1,pictures:[]},
              {name:'aguarde...',status:1,pictures:[]},
              {name:'aguarde...',status:1,pictures:[]},
              {name:'aguarde...',status:1,pictures:[]},
              {name:'aguarde...',status:1,pictures:[]},
              {name:'aguarde...',status:1,pictures:[]},
              {name:'aguarde...',status:1,pictures:[]},
              {name:'aguarde...',status:1,pictures:[]},
              {name:'aguarde...',status:1,pictures:[]},
              {name:'aguarde...',status:1,pictures:[]},
            ],
            browser: {
              page: 1,
              itemsPerPage: 10,
              lastPage: 1,
            },
            server: {
              page: 1,
              lastPage: 1,
              perPage: 1,
              total: 1,
              from: 1,
              to: 1,
              firstPageUrl: '',
              lastPageUrl: '',
              nextPageUrl: ''
            }
        }
    },
    mounted() {
        this.show();
    },
    computed: {
      ...mapGetters({
          authenticated: 'authenticated',
          user: 'user',
      }),
      browserProductFiltered: {
        get()
        {
          let pagePiece = this.browser.page * this.browser.itemsPerPage; 
          let userSearched = this.search.length > 0;
          let searchEmpty = this.products.slice(pagePiece - this.browser.itemsPerPage, pagePiece);

          if(userSearched) return this.filteredProductList;

          return searchEmpty;
        },
        set(value)
        {
          this.filteredProductList = value;
        }
      },
      browserLastPage() {
        return Math.ceil(this.products.length / this.browser.itemsPerPage);
      }
    },
    methods: {
      loading() {
        this.filteredProductList = [
          {name:'aguarde...',status:1,pictures:[]},
          {name:'aguarde...',status:1,pictures:[]},
          {name:'aguarde...',status:1,pictures:[]},
          {name:'aguarde...',status:1,pictures:[]},
          {name:'aguarde...',status:1,pictures:[]},
          {name:'aguarde...',status:1,pictures:[]},
          {name:'aguarde...',status:1,pictures:[]},
          {name:'aguarde...',status:1,pictures:[]},
          {name:'aguarde...',status:1,pictures:[]},
          {name:'aguarde...',status:1,pictures:[]},
        ];
      },
      serverProductSearch() {
        clearTimeout(this.timer);
        this.loading();

        this.timer = setTimeout(() => {

          this.filteredProductList = this.products.filter(item => item.name.indexOf(this.search) > -1);

          let exception = this.filteredProductList.map(item => item.id).filter(id => typeof id !== "undefined");
          let encodedParams = [
            `search=${encodeURIComponent(this.search)}`,
            `except=${encodeURIComponent(exception)}`
          ].join('&');

          axios.get(`/api/v1/products?${encodedParams}`).then(response => {

              this.products = this.products.concat(response.data.data).sort((a,b) => (a.id < b.id) ? -1 : 1);

              // setting browser pagination configuration with a computed property
              this.browser.lastPage = this.filteredProductList.length;

              console.log('requesting more pages...');
          }).catch(error => {
              console.error(error);
          });          

        }, 1000);
      },
      show() {
          axios.get('/api/v1/products').then(response => {
              this.products = response.data.data;

              // setting server pagination configuration
              this.server.page = response.data.current_page;
              this.server.lastPage = response.data.last_page;
              this.server.perPage = response.data.per_page;
              this.server.total = response.data.total;
              this.server.from = response.data.from;
              this.server.to = response.data.to;
              this.server.firstPageUrl = response.data.first_page_url;
              this.server.lastPageUrl = response.data.last_page_url;
              this.server.nextPageUrl = response.data.nex_page_url;

              // setting browser pagination configuration with a computed property
              this.browser.lastPage = this.browserLastPage;

              console.warn(response);
          }).catch(error => {
              console.error(error);
          });
      },
      edit: function(id) {
          this.$router.push({name: 'products.edit', params: { id: id }});
      },
      remove(id) {
          axios.delete(`/api/v1/products/${id}`).then(response => {
              console.log(response.data);
              this.show();
          }).catch(error => {
              console.error(error);
          });
      },
      next() {

        if(this.browser.page === this.browser.lastPage - 1)
        {
          axios.get(`/api/v1/products?page=${++this.server.page}`).then(response => {
              this.products = this.products.concat(response.data.data);
              // setting browser pagination configuration
              this.browser.lastPage = this.browserLastPage;

              console.log('requesting more pages...');
          }).catch(error => {
              console.error(error);
          });
        }

      },
      productStatus(payload) {

        this.form.endpoint = `/api/v1/products${payload.id ? `/${payload.id}` : ''}`;

        if(this.authenticated && Number(this.user.admin))
        {
          for(let product of this.products)
          {
            if(Number(product.id) === Number(payload.id))
            {
              product.status = payload.status;
              this.form.payload.status = payload.status;
              this.form.payload.name = payload.name;
            }
          }
        }

        if(this.authenticated && !Number(this.user.admin))
        {
          this.products = this.products.map(item => {

            if(Number(item.id) === Number(payload.id))
            {
              item.status = 1;
              this.form.payload.status = item.status;
              this.form.payload.name = payload.name;
            }

            return item;
          }); 
        }

        axios.put(this.form.endpoint, this.form.payload).then(response => {
          console.log(response.status);
        }).catch(error => {
            console.error('Não foi possível salvar o produto - ', error.toString());
        });
      }
    },
  }
</script> 

<style scoped>
  .actions button {
    margin: 0 5px;
    color: #444;
  }

  .actions button:hover {
    color: #aa4;
  }
  
</style>