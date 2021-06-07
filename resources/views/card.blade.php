<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: table;
        transition: opacity 0.3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 300px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
        transition: all 0.3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-body {
        margin: 20px 0;
    }

    .modal-default-button {
        float: right;
    }

    /*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>

<body>
    <div class="container">
        <div id="app" class="justify-content-center align-items-center">
            <div class="row" style="margin-bottom: 60px;">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Card List</h5>
                            <div class="form-inline" v-for="(card, index) in cardData" :key="index"
                                style="height: 50px;">
                                <div class="form-group">
                                    <label>@{{ card.cardName }}:@{{ card.cardNumber }}</label>
                                    <div class="col">
                                        <small v-if="card.isUseCard" class="text-danger">卡片正使用中!</small>
                                        <input type="button" v-else class="btn btn-primary" id="delete" name="delete"
                                            value="刪除" v-on:click="deleteCardData(index)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <card-list v-for="(item, index) in items" :item="item" :product-index="index" :key="item.id"
                :card-data="cardItems" @save-new-card="saveCardData"></card-list>
            <card-message v-if="showErrorMessage" @close="showErrorMessage = false" :message="errorMessageText"></card-message>
        </div>
    </div>
    <script src="{{mix('js/app.js')}}"></script>
    <script src="{{mix('js/card.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{mix('/css/app.css')}}">
</body>

</html>