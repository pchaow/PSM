<!DOCTYPE html>
<html>
<head>
    <meta id="token" name="token" value="{{csrf_token()}}"/>
    <meta id="product_id" name="token" value="{{$product->id}}"/>


    <title>Laravel</title>
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css"/>
    <script src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/bower_components/vue/dist/vue.min.js"></script>
    <script src="/bower_components/vue/dist/vue-resource.min.js"></script>
</head>
<body>
<div id="productViewApp">
    <h1>@{{product.name}}</h1>
    <pre>@{{$product.price}}</pre>

    <article v-for="value in product.values">
        <h2>Supplier : @{{value.supplier.name}}</h2>
        <pre>@{{value.price}}</pre>
    </article>

    <form>
        <input type="hidden" name="product_id" v-model="newProductValue.product_id"/>
        <div class="form-group">
            <label>Supplier</label>
            <select class="form-control" name="supplier_id" v-model="newProductValue.supplier_id">
                @foreach($suppliers as $supplier)
                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>price</label>
            <input v-model="newProductValue.price" type="number" name="price" class="form-control" placeholder="price">
        </div>

        <button v-on:click="submitProduct" type="submit" class="btn btn-default">Submit</button>
    </form>


</div>


<script type="text/javascript">
    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
    console.log(Vue.http.headers.common['X-CSRF-TOKEN']);

    new Vue({
        el: '#productViewApp',
        data: {
            values: [],
            product: {},
            newProductValue: {}
        },
        ready: function () {
            console.log("productViewApp ready");
            this.getProduct();

        }
        ,
        methods: {
            factoryProductValue: function () {
                return {
                    product_id: this.product.id,
                    supplier_id: 0,
                    price: 0
                }
            },
            getProduct: function () {
                var id = document.querySelector('#product_id').getAttribute('value');
                this.$http.get('/api/product/' + id, function (response) {
                    this.product = response;

                    this.newProductValue = this.factoryProductValue();
                })
            }
            ,
            getProducts: function () {
                this.$http.get('/api/product', function (response) {
                    this.products = response;
                })
            }
            ,
            submitProduct: function (event) {
                event.preventDefault();
                console.log(this.newProductValue);
                this.$http.post('/api/product/' + this.product.id + '/value', this.newProductValue, function (r) {
                    this.product.values.push(r);
                })
                this.newProductValue = this.factoryProductValue();
            }
        }
    })

</script>


</body>
</html>
