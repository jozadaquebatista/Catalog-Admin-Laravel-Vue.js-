<template>
    <div id="app">
        <img src=""/>
        <div class="login-box">
            <label class="login-message">
                Por favor, logue-se
            </label>
            <hr/>
            <label class="email">
                E-mail
                <input type="text" v-model="user.email" />
            </label>
            <label class="password">
                Senha
                <input type="password" v-model="user.password" />
            </label>
            <div class="remember-field">
                <label>
                <input type="checkbox"> Lembrar
                </label>
            </div>
            <button @click="login">
                <span v-if="habilitado">Entrar</span>
                <svg v-else xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="40px" height="40px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                <g transform="rotate(359.581 50.0021 50.0021)">
                    <path d="M50 15A35 35 0 1 0 74.74873734152916 25.251262658470843" fill="none" stroke="#f4f4f4" stroke-width="13"></path>
                    <path d="M49 6L49 24L58 15L49 6" fill="#f4f4f4"></path>
                    <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                </g>
                </svg>
            </button>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'

    export default {
        data: function() {
            return {
                user: {
                    email: 'admin@dbzmail.com',
                    password: '456789'
                },
                habilitado: true
            }
        },
        methods: {
            ...mapActions({
                signIn: 'signIn'
            }),
            login() {
                this.habilitado = false;

                this.signIn(this.user).then(() => {
                    this.habilitado = true;
                    this.$router.push({ path: '/products' });
                }).catch((e) => {
                    this.habilitado = true;
                    alert('authentication failed!');
                });
            },
            desabilitar: function() {
                this.habilitado = false;

                setTimeout(() => {
                    this.habilitado = true;
                    this.$router.push('/');
                }, 3000);
            }
        },
    }
</script>

<style scoped>
    #app {
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #ffffff;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 2000 1500'%3E%3Cdefs%3E%3Crect stroke='%23ffffff' stroke-width='0.72' width='1' height='1' id='s'/%3E%3Cpattern id='a' width='3' height='3' patternUnits='userSpaceOnUse' patternTransform='scale(49.3) translate(-979.72 -734.79)'%3E%3Cuse fill='%23fafafa' href='%23s' y='2'/%3E%3Cuse fill='%23fafafa' href='%23s' x='1' y='2'/%3E%3Cuse fill='%23f5f5f5' href='%23s' x='2' y='2'/%3E%3Cuse fill='%23f5f5f5' href='%23s'/%3E%3Cuse fill='%23f0f0f0' href='%23s' x='2'/%3E%3Cuse fill='%23f0f0f0' href='%23s' x='1' y='1'/%3E%3C/pattern%3E%3Cpattern id='b' width='7' height='11' patternUnits='userSpaceOnUse' patternTransform='scale(49.3) translate(-979.72 -734.79)'%3E%3Cg fill='%23ebebeb'%3E%3Cuse href='%23s'/%3E%3Cuse href='%23s' y='5' /%3E%3Cuse href='%23s' x='1' y='10'/%3E%3Cuse href='%23s' x='2' y='1'/%3E%3Cuse href='%23s' x='2' y='4'/%3E%3Cuse href='%23s' x='3' y='8'/%3E%3Cuse href='%23s' x='4' y='3'/%3E%3Cuse href='%23s' x='4' y='7'/%3E%3Cuse href='%23s' x='5' y='2'/%3E%3Cuse href='%23s' x='5' y='6'/%3E%3Cuse href='%23s' x='6' y='9'/%3E%3C/g%3E%3C/pattern%3E%3Cpattern id='h' width='5' height='13' patternUnits='userSpaceOnUse' patternTransform='scale(49.3) translate(-979.72 -734.79)'%3E%3Cg fill='%23ebebeb'%3E%3Cuse href='%23s' y='5'/%3E%3Cuse href='%23s' y='8'/%3E%3Cuse href='%23s' x='1' y='1'/%3E%3Cuse href='%23s' x='1' y='9'/%3E%3Cuse href='%23s' x='1' y='12'/%3E%3Cuse href='%23s' x='2'/%3E%3Cuse href='%23s' x='2' y='4'/%3E%3Cuse href='%23s' x='3' y='2'/%3E%3Cuse href='%23s' x='3' y='6'/%3E%3Cuse href='%23s' x='3' y='11'/%3E%3Cuse href='%23s' x='4' y='3'/%3E%3Cuse href='%23s' x='4' y='7'/%3E%3Cuse href='%23s' x='4' y='10'/%3E%3C/g%3E%3C/pattern%3E%3Cpattern id='c' width='17' height='13' patternUnits='userSpaceOnUse' patternTransform='scale(49.3) translate(-979.72 -734.79)'%3E%3Cg fill='%23e5e5e5'%3E%3Cuse href='%23s' y='11'/%3E%3Cuse href='%23s' x='2' y='9'/%3E%3Cuse href='%23s' x='5' y='12'/%3E%3Cuse href='%23s' x='9' y='4'/%3E%3Cuse href='%23s' x='12' y='1'/%3E%3Cuse href='%23s' x='16' y='6'/%3E%3C/g%3E%3C/pattern%3E%3Cpattern id='d' width='19' height='17' patternUnits='userSpaceOnUse' patternTransform='scale(49.3) translate(-979.72 -734.79)'%3E%3Cg fill='%23ffffff'%3E%3Cuse href='%23s' y='9'/%3E%3Cuse href='%23s' x='16' y='5'/%3E%3Cuse href='%23s' x='14' y='2'/%3E%3Cuse href='%23s' x='11' y='11'/%3E%3Cuse href='%23s' x='6' y='14'/%3E%3C/g%3E%3Cg fill='%23e0e0e0'%3E%3Cuse href='%23s' x='3' y='13'/%3E%3Cuse href='%23s' x='9' y='7'/%3E%3Cuse href='%23s' x='13' y='10'/%3E%3Cuse href='%23s' x='15' y='4'/%3E%3Cuse href='%23s' x='18' y='1'/%3E%3C/g%3E%3C/pattern%3E%3Cpattern id='e' width='47' height='53' patternUnits='userSpaceOnUse' patternTransform='scale(49.3) translate(-979.72 -734.79)'%3E%3Cg fill='%23ff4a24'%3E%3Cuse href='%23s' x='2' y='5'/%3E%3Cuse href='%23s' x='16' y='38'/%3E%3Cuse href='%23s' x='46' y='42'/%3E%3Cuse href='%23s' x='29' y='20'/%3E%3C/g%3E%3C/pattern%3E%3Cpattern id='f' width='59' height='71' patternUnits='userSpaceOnUse' patternTransform='scale(49.3) translate(-979.72 -734.79)'%3E%3Cg fill='%23ff4a24'%3E%3Cuse href='%23s' x='33' y='13'/%3E%3Cuse href='%23s' x='27' y='54'/%3E%3Cuse href='%23s' x='55' y='55'/%3E%3C/g%3E%3C/pattern%3E%3Cpattern id='g' width='139' height='97' patternUnits='userSpaceOnUse' patternTransform='scale(49.3) translate(-979.72 -734.79)'%3E%3Cg fill='%23ff4a24'%3E%3Cuse href='%23s' x='11' y='8'/%3E%3Cuse href='%23s' x='51' y='13'/%3E%3Cuse href='%23s' x='17' y='73'/%3E%3Cuse href='%23s' x='99' y='57'/%3E%3C/g%3E%3C/pattern%3E%3C/defs%3E%3Crect fill='url(%23a)' width='100%25' height='100%25'/%3E%3Crect fill='url(%23b)' width='100%25' height='100%25'/%3E%3Crect fill='url(%23h)' width='100%25' height='100%25'/%3E%3Crect fill='url(%23c)' width='100%25' height='100%25'/%3E%3Crect fill='url(%23d)' width='100%25' height='100%25'/%3E%3Crect fill='url(%23e)' width='100%25' height='100%25'/%3E%3Crect fill='url(%23f)' width='100%25' height='100%25'/%3E%3Crect fill='url(%23g)' width='100%25' height='100%25'/%3E%3C/svg%3E");
        background-attachment: fixed;
        background-size: cover;
    }

    .login-box {
        width: 340px;
        height: 380px;
        padding: 0 12px;
    }

    input[type="text"], input[type="password"] {
        text-indent: 10px;
        box-shadow: inset 4px 4px 7px 0px rgba(0, 0, 0, 0.28);
        color: #333;
        font-size: 1.3em;
        border: 2px solid #111;
        background: #fff;
    }

    button {
        background: #ff123e;
        border: 2px solid #ff123e;
        color: #fff;
        font-weight: bold;
        transition: background .6s cubic-bezier(0.14, 1.22, 0.25, 1.3);
        cursor: pointer;
    }

    button:active {
        background: #ff617e;
        border: 2px solid #ff4112;
    }

    button:focus { outline: none; }

    button:disabled {
        background: #632934;
    }

    input[type="text"], input[type="password"], button {
        height: 50px;
        width: 100%;
        outline: none;
        margin: 1px 0 10px;
    }

    .email, .password {
        font-weight: bolder;
    }

    .login-message {
        width: 100%;
        font-size: 30px;
        text-align: center;
        margin: 0 0 15px 0;
    }

    .remember-field {
        margin: 0 0 20px 0;
    }

    label {
        width: 100%;
    }

    hr {
        border: 0;
    }
</style>

