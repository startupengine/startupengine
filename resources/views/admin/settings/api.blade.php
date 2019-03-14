@extends('layouts.shards_admin')

@section('title') Pages - <?php echo setting('site.title'); ?> @endsection

@section('css')
    <style>
        .card {
            margin-bottom: 15px;
        }

        a p.card-text {
            color: #000 !important;
        }

        a .card-title {
            color: #444 !important;
        }

        .modal-header .close {
            padding: 1.25rem 5px;
            margin: -1rem -1rem -1rem auto;
        }
        .modal-footer {
            padding-top: 20px;
            padding-bottom: 20px;
            padding-right: 25px;
            padding-left: 25px;
        }
    </style>
    <style scoped>
        .action-link {
            cursor: pointer;
        }

        .m-b-none {
            margin-bottom: 0;
        }

        code {
            padding:0px;
        }

        .card-header {
            border-bottom:1px solid #ddd;
        }

        .card-footer {
            padding-bottom:25px;
        }

    </style>
@endsection

@section('head')
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>
@endsection

@section('page-title') API Settings @endsection

@section('top-menu')
@endsection

@section('content')
    <div class="row" id="passport">

        <div class="col-md-12" id="passportClients">
            <template>
                <div>
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">OAuth Clients</h6>
                        </div>

                        <div class="card-body">
                            <!-- Current Clients -->
                            <p class="m-b-none" v-if="clients.length === 0">
                                You have not created any OAuth clients.
                            </p>

                            <table class="table table-borderless m-b-none" v-else="clients.length >= 0">
                                <thead>
                                <tr>
                                    <th class="hiddenOnMobile border-0">Client ID</th>
                                    <th class="border-0">Name</th>
                                    <th class="hiddenOnMobile border-0">Secret</th>
                                    <th class="border-0"></th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr v-for="client in clients" v-if="client.id != null">
                                    <!-- ID -->
                                    <td style="vertical-align: middle;min-width:100px;" class="hiddenOnMobile">
                                        @{{ client.id }}
                                    </td>

                                    <!-- Name -->
                                    <td style="vertical-align: middle;min-width:120px;">
                                        @{{ client.name }}
                                    </td>

                                    <!-- Secret -->
                                    <td style="vertical-align: middle;width:100%;" class="hiddenOnMobile">
                                        <code>@{{ client.secret }}</code>
                                    </td>

                                    <!-- Action Buttons -->
                                    <td style="vertical-align: middle;width:100px !important;">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Table row actions">
                                            <button type="button" class="btn btn-white"  @click="edit(client)"
                                            data-toggle="modal" data-target="#modal-edit-client">
                                                <i class="material-icons">edit</i>
                                            </button>
                                            <button type="button" class="btn btn-white"  @click="destroy(client)" >
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer" align="right">
                            <a class="btn btn-secondary text-white  " data-toggle="modal"
                               data-target="#modal-create-client">
                                New Client &nbsp;<i class="fa fa-fw fa-plus"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Create Client Modal -->
                    <div class="modal fade" id="modal-create-client" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" style="width:100%;">
                                        Create Client
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">&times;</button>
                                </div>

                                <div class="modal-body">
                                    <!-- Form Errors -->
                                    <div class="alert alert-danger" v-if="createForm.errors.length > 0">
                                        <p><strong>Whoops!</strong> Something went wrong!</p>
                                        <br>
                                        <ul>
                                            <li v-for="error in createForm.errors">
                                                @{{ error }}
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Create Client Form -->
                                    <form class="form-horizontal" role="form">
                                        <!-- Name -->
                                        <div class="form-group">
                                            <label class="col-md-6 control-label">Name</label>

                                            <div class="col-md-12">
                                                <input id="create-client-name" type="text" class="form-control"
                                                       @keyup.enter="store" v-model="createForm.name">

                                                <span class="help-block">
                                        Something your users will recognize and trust.
                                    </span>
                                            </div>
                                        </div>

                                        <!-- Redirect URL -->
                                        <div class="form-group">
                                            <label class="col-md-6 control-label">Redirect URL</label>

                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="redirect"
                                                       @keyup.enter="store" v-model="createForm.redirect">

                                                <span class="help-block">
                                        Your application's authorization callback URL.
                                    </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Modal Actions -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">
                                        Close
                                    </button>

                                    <button type="button" class="btn btn-primary" @click="store">
                                    Create
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Client Modal -->
                    <div class="modal fade" id="modal-edit-client" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">&times;</button>

                                    <h4 class="modal-title">
                                        Edit Client
                                    </h4>
                                </div>

                                <div class="modal-body">
                                    <!-- Form Errors -->
                                    <div class="alert alert-danger" v-if="editForm.errors.length > 0">
                                        <p><strong>Whoops!</strong> Something went wrong!</p>
                                        <br>
                                        <ul>
                                            <li v-for="error in editForm.errors">
                                                @{{ error }}
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Edit Client Form -->
                                    <form class="form-horizontal" role="form">
                                        <!-- Name -->
                                        <div class="form-group">
                                            <label class="col-md-6 control-label">Name</label>

                                            <div class="col-md-12">
                                                <input id="edit-client-name" type="text" class="form-control"
                                                       @keyup.enter="update" v-model="editForm.name">

                                                <span class="help-block">
                                        Something your users will recognize and trust.
                                    </span>
                                            </div>
                                        </div>

                                        <!-- Redirect URL -->
                                        <div class="form-group">
                                            <label class="col-md-6 control-label">Redirect URL</label>

                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="redirect"
                                                       @keyup.enter="update" v-model="editForm.redirect">

                                                <span class="help-block">
                                        Your application's authorization callback URL.
                                    </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Modal Actions -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">
                                        Close
                                    </button>

                                    <button type="button" class="btn btn-secondary" @click="update">
                                    Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <div class="col-md-12" id="authorizedClients">
            <template>
                <div>
                    <div>
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Authorized Applications</h6>
                            </div>

                            <div class="card-body">
                                <!-- Authorized Tokens -->
                                <table class="table table-borderless m-b-none" v-if="tokens.length > 0">
                                    <thead>
                                    <tr>
                                        <th class="border-0">Name</th>
                                        <th class="border-0">Scopes</th>
                                        <th class="border-0"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="token in tokens">
                                        <!-- Client Name -->
                                        <td style="vertical-align: middle;">
                                            @{{ token.client.name }}
                                        </td>

                                        <!-- Scopes -->
                                        <td style="vertical-align: middle;">
                                    <span v-if="token.scopes.length > 0">
                                        @{{ token.scopes.join(', ') }}
                                    </span>
                                        </td>

                                        <!-- Revoke Button -->
                                        <td style="vertical-align: middle;">
                                            <a class="action-link btn btn-sm btn-danger btn-simple btn-round text-danger" @click="revoke(token)">
                                            Revoke
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <p v-else>
                                    No applications have been authorized.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <div id="accessTokens" class="col-md-12">
            <template>
                <div>
                    <div>
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Personal Access Tokens</h6>
                            </div>

                            <div class="card-body">
                                <!-- No Tokens Notice -->
                                <p class="m-b-none" v-if="tokens.length === 0">
                                    You have not created any personal access tokens.
                                </p>

                                <!-- Personal Access Tokens -->
                                <table class="table table-borderless m-b-none">
                                    <thead>
                                    <tr>
                                        <th class="border-0"  style="min-width:150px;max-width:250px;">Token Name</th>
                                        <th class="border-0 hiddenOnMobile">User</th>
                                        <th class="border-0"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="token in tokens" v-if="token.user_id != null">
                                        <!-- Client Name -->
                                        <td style="vertical-align: middle;max-width:250px;">
                                            @{{ token.name }}
                                        </td>

                                        <td class="hiddenOnMobile" style="vertical-align: middle;width:100% !important;">
                                            @{{ token.user_id }}
                                        </td>

                                        <!-- Delete Button -->
                                        <td style="vertical-align: middle;">
                                            <button type="button" class="btn btn-white" @click="revoke(token)">
                                                Delete <i class="material-icons">delete</i>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer" align="right">
                                <a class="btn btn-secondary text-white" data-toggle="modal" data-target="#modal-create-token">
                                    New Token <i class="fa fa-fw fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Create Token Modal -->
                    <div class="modal fade" id="modal-create-token" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">
                                        Create Token
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>

                                <div class="modal-body">
                                    <!-- Form Errors -->
                                    <div class="alert alert-danger" v-if="form.errors.length > 0">
                                        <p><strong>Whoops!</strong> Something went wrong!</p>
                                        <br>
                                        <ul>
                                            <li v-for="error in form.errors">
                                                @{{ error }}
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Create Token Form -->
                                    <form class="form-horizontal" role="form" @submit.prevent="store">
                                        <!-- Name -->
                                        <div class="form-group">
                                            <label class="col-md-12 control-label">Name</label>

                                            <div class="col-md-12">
                                                <input id="create-token-name" type="text" class="form-control" name="name" v-model="form.name">
                                            </div>
                                        </div>

                                        <!-- Scopes -->
                                        <div class="form-group" v-if="scopes.length > 0">
                                            <label class="col-md-12 control-label">Scopes</label>

                                            <div class="col-md-12">
                                                <div v-for="scope in scopes">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"
                                                            @click="toggleScope(scope.id)"
                                                            :checked="scopeIsAssigned(scope.id)">

                                                            @{{ scope.id }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Modal Actions -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>

                                    <button type="button" class="btn btn-primary" @click="store">
                                    Create
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Access Token Modal -->
                    <div class="modal fade" id="modal-access-token" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                    <h4 class="modal-title">
                                        Personal Access Token
                                    </h4>
                                </div>

                                <div class="modal-body">
                                    <p>
                                        Here is your new personal access token. This is the only time it will be shown so don't lose it!
                                        You may now use this token to make API requests.
                                    </p>

                                    <pre><code>@{{ accessToken }}</code></pre>
                                </div>

                                <!-- Modal Actions -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

    </div>

@endsection

@section('scripts')

    <script>

        var clients = new Vue({
            el: '#passportClients',
            data() {
                return {
                    clients: [],

                    createForm: {
                        errors: [],
                        name: '',
                        redirect: ''
                    },

                    editForm: {
                        errors: [],
                        name: '',
                        redirect: ''
                    }
                };
            },
            /**
             * Prepare the component (Vue 1.x).
             */
            ready() {
                this.prepareComponent();
            },

            /**
             * Prepare the component (Vue 2.x).
             */
            mounted() {
                this.prepareComponent();
            },

            methods: {
                /**
                 * Prepare the component.
                 */
                prepareComponent() {
                    this.getClients();

                    $('#modal-create-client').on('shown.bs.modal', () => {
                        $('#create-client-name').focus();
                });

                    $('#modal-edit-client').on('shown.bs.modal', () => {
                        $('#edit-client-name').focus();
                });
                },

                /**
                 * Get all of the OAuth clients for the user.
                 */
                getClients() {
                    var clients = axios.get('/oauth/clients')
                        .then(response => {
                        this.clients = response.data;
                        console.log('TEST');
                        console.log(this.clients);
                });
                },

                /**
                 * Show the form for creating new clients.
                 */
                showCreateClientForm() {
                    $('#modal-create-client').modal('show');
                },

                /**
                 * Create a new OAuth client for the user.
                 */
                store() {
                    this.persistClient(
                        'post', '/oauth/clients',
                        this.createForm, '#modal-create-client'
                    );
                },

                /**
                 * Edit the given client.
                 */
                edit(client) {
                    console.log('edit');
                    this.editForm.id = client.id;
                    console.log(client.id);
                    this.editForm.name = client.name;
                    console.log(client.name);
                    this.editForm.redirect = client.redirect;
                    console.log(client.redirect);

                    /*$('#modal-edit-client').modal('show');*/
                },

                /**
                 * Update the client being edited.
                 */
                update() {
                    this.persistClient(
                        'put', '/oauth/clients/' + this.editForm.id,
                        this.editForm, '#modal-edit-client'
                    );
                },

                /**
                 * Persist the client to storage using the given form.
                 */
                persistClient(method, uri, form, modal) {
                    form.errors = [];

                    axios[method](uri, form)
                        .then(response => {
                        this.getClients();

                    form.name = '';
                    form.redirect = '';
                    form.errors = [];

                    $(modal).modal('hide');
                })
                .catch(error => {
                        if (typeof error.response.data === 'object') {
                        form.errors = _.flatten(_.toArray(error.response.data));
                    } else {
                        form.errors = ['Something went wrong. Please try again.'];
                    }
                });
                },

                /**
                 * Destroy the given client.
                 */
                destroy(client) {
                    axios.delete('/oauth/clients/' + client.id)
                        .then(response => {
                        this.getClients();
                });
                }
            }
        });
    </script>


    <script>
        var authorizedClients = new Vue({
            el: '#authorizedClients',
            data() {
                return {
                    tokens: []
                };
            },

            /**
             * Prepare the component (Vue 1.x).
             */
            ready() {
                this.prepareComponent();
            },

            /**
             * Prepare the component (Vue 2.x).
             */
            mounted() {
                this.prepareComponent();
            },

            methods: {
                /**
                 * Prepare the component (Vue 2.x).
                 */
                prepareComponent() {
                    this.getTokens();
                },

                /**
                 * Get all of the authorized tokens for the user.
                 */
                getTokens() {
                    axios.get('/oauth/tokens')
                        .then(response => {
                        this.tokens = response.data;
                });
                },

                /**
                 * Revoke the given token.
                 */
                revoke(token) {
                    axios.delete('/oauth/tokens/' + token.id)
                        .then(response => {
                        this.getTokens();
                });
                }
            }
        });

        var accessTokens = new Vue({
            el: '#accessTokens',
            data() {
                return {
                    accessToken: null,

                    tokens: [],
                    scopes: [],

                    form: {
                        name: '',
                        scopes: [],
                        errors: []
                    }
                };
            },

            /**
             * Prepare the component (Vue 1.x).
             */
            ready() {
                this.prepareComponent();
            },

            /**
             * Prepare the component (Vue 2.x).
             */
            mounted() {
                this.prepareComponent();
            },

            methods: {
                /**
                 * Prepare the component.
                 */
                prepareComponent() {
                    this.getTokens();
                    this.getScopes();

                    $('#modal-create-token').on('shown.bs.modal', () => {
                        $('#create-token-name').focus();
                });
                },

                /**
                 * Get all of the personal access tokens for the user.
                 */
                getTokens() {
                    axios.get('/oauth/personal-access-tokens')
                        .then(response => {
                        this.tokens = response.data;
                });
                },

                /**
                 * Get all of the available scopes.
                 */
                getScopes() {
                    axios.get('/oauth/scopes')
                        .then(response => {
                        this.scopes = response.data;
                });
                },

                /**
                 * Show the form for creating new tokens.
                 */
                showCreateTokenForm() {
                    $('#modal-create-token').modal('show');
                },

                /**
                 * Create a new personal access token.
                 */
                store() {
                    this.accessToken = null;

                    this.form.errors = [];

                    axios.post('/oauth/personal-access-tokens', this.form)
                        .then(response => {
                        this.form.name = '';
                    this.form.scopes = [];
                    this.form.errors = [];

                    this.tokens.push(response.data.token);

                    this.showAccessToken(response.data.accessToken);
                })
                .catch(error => {
                        if (typeof error.response.data === 'object') {
                        this.form.errors = _.flatten(_.toArray(error.response.data));
                    } else {
                        this.form.errors = ['Something went wrong. Please try again.'];
                    }
                });
                },

                /**
                 * Toggle the given scope in the list of assigned scopes.
                 */
                toggleScope(scope) {
                    if (this.scopeIsAssigned(scope)) {
                        this.form.scopes = _.reject(this.form.scopes, s => s == scope);
                    } else {
                        this.form.scopes.push(scope);
                    }
                },

                /**
                 * Determine if the given scope has been assigned to the token.
                 */
                scopeIsAssigned(scope) {
                    return _.indexOf(this.form.scopes, scope) >= 0;
                },

                /**
                 * Show the given access token to the user.
                 */
                showAccessToken(accessToken) {
                    $('#modal-create-token').modal('hide');

                    this.accessToken = accessToken;

                    $('#modal-access-token').modal('show');
                },

                /**
                 * Revoke the given token.
                 */
                revoke(token) {
                    axios.delete('/oauth/personal-access-tokens/' + token.id)
                        .then(response => {
                        this.getTokens();
                });
                }
            }
        });
    </script>
@endsection