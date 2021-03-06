<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Access-Control-Allow-Origin" content="*" />
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
            <div v-cloak id="app" class="content">
                <form action="" method="POST">
                    {{ csrf_field() }}
                    <h2 
                        id="title" 
                        class="text-center text-black font-weight-bold" 
                        style="margin-bottom:20px;">
                    ???????????????
                    </h2>
                    <div style="text-align:right">
                        <input type="button" id="btn_insert" class="btn btn-primary" @click="getAddKeyword()" value="??????" />
                    </div><br/>
                    <keyword-list
                        :keyword-data="keyword" 
                        :url-delete="urlDelete"
                        @update-keyword="updateKeyword"
                        @delete-keyword-data="deleteKeywordData"
                    >
                    </keyword-list>
                    <keyword-edit 
                        v-if="showEdit" 
                        @close="showEdit = false" 
                        :title="editTitle"
                        :is-add="isAdd"
                        :url-add="urlAdd"
                        :url-update="urlUpdate"
                        :params="params"
                        @update-keyword-data="updateKeywordData"
                        @is-show-message="isShowMessage"
                        
                    >
                    </keyword-edit>
                    <navbar-pagination 
                        @change-pagination="getPagination" 
                        :pagination-data="pagination"
                    >
                    </navbar-pagination>
                </form>
                <input type="hidden" id="data" value="{{ json_encode($data) }}">
            </div>
        </div>
        <script src="{{mix('js/app.js')}}"></script>
        <script src="{{mix('js/keyword.js')}}"></script>
        <link rel="stylesheet" type="text/css" href={{mix('css/app.css')}}>
    </body>
</html>