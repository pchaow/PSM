<!DOCTYPE html>
<html>
<head>
    <meta id="token" name="token" value="{{csrf_token()}}"/>


    <title>Laravel</title>

    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css"/>

    <script src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/bower_components/vue/dist/vue.min.js"></script>
    <script src="/bower_components/vue/dist/vue-resource.min.js"></script>

</head>
<body>
<div id="productApp">
    <h1>@{{name}}</h1>
    <form>
        <div class="form-group">
            <label>name</label>
            <input type="text" v-model="newProduct.name" name="name" class="form-control" placeholder="name">
        </div>

        <div class="form-group">
            <label>Address</label>
            <input type="number" v-model="newProduct.price" class="form-control" name="price"/>
        </div>

        <button v-on:click="submitProduct" type="submit" class="btn btn-default">Submit</button>
    </form>

    <article v-for="product in products">
        <h3><a href="/product/@{{ product.id }}">@{{ product.name }}</a></h3>
        <pre>@{{ product.price }}</pre>
    </article>


</div>

<script type="text/javascript">
    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
    console.log(Vue.http.headers.common['X-CSRF-TOKEN']);

    new Vue({
        el: '#productApp',
        data: {
            name: "Product Application",
            products: [],
            newProduct: {
                name: '',
                price: 0
            }
        },
        ready: function () {
            console.log("productApp ready");
            this.getProducts();
        },
        methods: {
            getProducts: function () {
                this.$http.get('/api/product', function (response) {
                    this.products = response;
                })
            },
            submitProduct: function (event) {
                event.preventDefault();
                this.$http.post('/api/product', this.newProduct, function (response) {
                    console.log(response);
                    this.products.push(response);

                    this.newProduct = {name: '', price: 0};
                })
            }
        }
    })

</script>

</body>
</html>
