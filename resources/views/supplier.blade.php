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

<div id="supplierApp">
    <h1>@{{name}}</h1>
    <form>
        <div class="form-group">
            <label>name</label>
            <input type="text" v-model="newSupplier.name" name="name" class="form-control" placeholder="name">
        </div>

        <div class="form-group">
            <label>Address</label>
            <textarea v-model="newSupplier.address" class="form-control" name="address"></textarea>
        </div>

        <button v-on:click="submitSupplier" type="submit" class="btn btn-default">Submit</button>
    </form>

    <article v-for="supplier in suppliers">
        <h3>@{{ supplier.name }}</h3>
        <pre>@{{ supplier.address }}</pre>
    </article>


</div>

<script type="text/javascript">
    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
    console.log(Vue.http.headers.common['X-CSRF-TOKEN']);

    new Vue({
        el: '#supplierApp',
        data: {
            name: "Supplier Application",
            suppliers: [],
            newSupplier: {
                name: '',
                address: ''
            }
        },
        ready: function () {
            console.log("supplierApp ready");
            this.getSuppliers();
        },
        methods: {
            getSuppliers: function () {
                this.$http.get('/api/supplier', function (response) {
                    this.suppliers = response;
                })
            },
            submitSupplier: function (event) {
                event.preventDefault();
                this.$http.post('/api/supplier', this.newSupplier, function (response) {
                    console.log(response);
                    this.suppliers.push(response);

                    this.newSupplier = {name: '', address: ''}
                })
            }
        }
    })

</script>

</body>
</html>

