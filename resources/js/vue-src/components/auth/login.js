export default {
    props: {
        title: {
            required: true,
            default: "Without title",
        },
    },
    data() {
        return {
            email: "",
            password: "",
            error: null,
            authenticated: false,
        };
    },
    methods: {
        login(e) {
            e.preventDefault()
            if (this.password.length > 0) {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('api/login', {
                            email: this.email,
                            password: this.password
                        })
                        .then(response => {
                            console.log(response.data)
                            if (response.data.success) {
                                alert('logged');
                                this.authenticated = true;
                                this.$emit('authenticated', this.authenticated)
                                    // this.$router.go('/dashboard')
                            } else {
                                this.error = response.data.message
                            }
                        })
                        .catch(function(error) {
                            console.error(error);
                        });
                })
            }
        }
    },
    beforeRouteEnter(to, from, next) {
        if (window.Laravel.isLoggedin) {
            return next('dashboard');
        }
        next();
    }
};
