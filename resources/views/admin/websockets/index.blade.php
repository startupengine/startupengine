@extends('layouts.shards_admin')

@section('head')
    <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
@endsection

@section('title') <?php echo setting('site.title'); ?> @endsection

@section('page-title') Realtime Data @endsection

@section('alt_content')
<div class="card col-xs-12 mt-0 mb-4">
    <div class="card-header border-bottom">
        <form id="connect" class="form-inline mb-2" role="form">
            <div class="input-group mt-2">
                <div class="input-group-prepend">
                    <span class="input-group-text basic-addon d-inline-block text-dark" id="basic-addon1" style="z-index:1;width:90px;text-align:center;">App Name</span>
                </div>
                <select aria-describedby="basic-addon1" class="form-control custom-select mr-2" name="app" id="app" v-model="app" style="min-width:150px;">
                    <option v-for="app in apps" :value="app">@{{ app.name }}</option>
                </select>
            </div>
            <div class="input-group mt-2">
                <div class="input-group-prepend">
                    <span class="input-group-text basic-addon d-inline-block text-dark" id="basic-addon1" style="width:90px;text-align:center !important;">Port</span>
                </div>
                <input class="form-control form-control-sm mr-2 br-5" style="border-radius:0px 5px 5px 0px!important;" v-model="port" placeholder="Port">
            </div>
            <div class="input-group mt-2">
                <button v-if="! connected" type="submit" @click.prevent="connect" class="mr-2 btn btn-sm btn-primary">
                    Connect
                </button>
                <button v-if="connected" type="submit" @click.prevent="disconnect" class="btn btn-sm btn-danger">
                    Disconnect
                </button>
            </div>
        </form>
        <div id="status" class="d-none"></div>
    </div>
    <div class="card-body border-bottom" v-if="connected && app.statisticsEnabled">

            <h6>Live Statistics</h6>
            <div id="statisticsChart" style="width: 100%; height: 250px;"></div>

    </div>
    <div class="card-body border-bottom"  v-if="connected">
        <h6>Events</h6>
        <table id="events" class="table table-striped table-hover">
            <thead>
            <tr>
                <th class="border-bottom">Type</th>
                <th class="border-bottom">Socket</th>
                <th class="border-bottom">Details</th>
                <th class="border-bottom">Time</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="log in logs.slice().reverse()">
                <td><span class="badge" :class="getBadgeClass(log)">@{{ log.type }}</span></td>
                <td>@{{ log.socketId }}</td>
                <td>@{{ log.details }}</td>
                <td>@{{ log.time }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="card-body border-bottom" v-if="connected" >

        <h6>Event Creator</h6>
        <form>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" v-model="form.channel" placeholder="Channel">
                </div>
                <div class="col">
                    <input type="text" class="form-control" v-model="form.event" placeholder="Event">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="form-group">
                        <textarea placeholder="Data" v-model="form.data" class="form-control" id="data"
                                  rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="row text-right">
                <div class="col">
                    <button type="submit" @click.prevent="sendEvent" class="btn btn-sm btn-primary">Send event
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body"  v-else>
        Connect to view data.
    </div>
</div>
@endsection

@section('scripts')
    <script>
        new Vue({
            el: '#app',

            data: {
                connected: false,
                chart: null,
                pusher: null,
                port: 6001,
                app: null,
                apps: {!! json_encode($apps) !!},
                form: {
                    channel: null,
                    event: null,
                    data: null
                },
                logs: [],
            },

            mounted() {
                this.app = this.apps[0] || null;
            },

            methods: {
                connect() {
                    this.pusher = new Pusher(this.app.key, {
                        wsHost: this.app.host === null ? window.location.hostname : this.app.host,
                        wsPort: this.port,
                        wssPort: this.port,
                        disableStats: true,
                        authEndpoint: '/dev/websockets/auth',
                        auth: {
                            headers: {
                                'X-CSRF-Token': "{{ csrf_token() }}"
                            }
                        },
                        enabledTransports: ['ws', 'flash']
                    });

                    this.pusher.connection.bind('state_change', states => {
                        $('div#status').text("Channels current state is " + states.current);
                });

                    this.pusher.connection.bind('connected', () => {
                        this.connected = true;

                    this.loadChart();
                });

                    this.pusher.connection.bind('disconnected', () => {
                        this.connected = false;
                    this.logs = [];
                });

                    this.subscribeToAllChannels();

                    this.subscribeToStatistics();
                },

                disconnect() {
                    this.pusher.disconnect();
                },

                loadChart() {
                    $.getJSON('/dev/websockets/api/'+this.app.id+'/statistics', (data) => {

                        let chartData = [
                            {
                                x: data.peak_connections.x,
                                y: data.peak_connections.y,
                                type: 'lines',
                                name: '# Peak Connections'
                            },
                            {
                                x: data.websocket_message_count.x,
                                y: data.websocket_message_count.y,
                                type: 'bar',
                                name: '# Websocket Messages'
                            },
                            {
                                x: data.api_message_count.x,
                                y: data.api_message_count.y,
                                type: 'bar',
                                name: '# API Messages'
                            }
                        ];
                    let layout = {
                        margin: {
                            l: 50,
                            r: 0,
                            b: 50,
                            t: 50,
                            pad: 4
                        }
                    };

                    this.chart = Plotly.newPlot('statisticsChart', chartData, layout);
                });
                },

                subscribeToAllChannels() {
                    [
                        'disconnection',
                        'connection',
                        'vacated',
                        'occupied',
                        'subscribed',
                        'client-message',
                        'api-message',
                    ].forEach(channelName => this.subscribeToChannel(channelName))
                },

                subscribeToChannel(channel) {
                    this.pusher.subscribe('{{ \BeyondCode\LaravelWebSockets\Dashboard\DashboardLogger::LOG_CHANNEL_PREFIX }}' + channel)
                        .bind('log-message', (data) => {
                        this.logs.push(data);
                });
                },

                subscribeToStatistics() {
                    this.pusher.subscribe('{{ \BeyondCode\LaravelWebSockets\Dashboard\DashboardLogger::LOG_CHANNEL_PREFIX }}statistics')
                        .bind('statistics-updated', (data) => {
                        var update = {
                            x:  [[data.time], [data.time], [data.time]],
                            y: [[data.peak_connection_count], [data.websocket_message_count], [data.api_message_count]]
                        };

                    Plotly.extendTraces('statisticsChart', update, [0, 1, 2]);
                });
                },

                getBadgeClass(log) {
                    if (log.type === 'occupied' || log.type === 'connection') {
                        return 'badge-primary';
                    }
                    if (log.type === 'vacated') {
                        return 'badge-warning';
                    }
                    if (log.type === 'disconnection') {
                        return 'badge-error';
                    }
                    if (log.type === 'api_message') {
                        return 'badge-info';
                    }
                    return 'badge-secondary';
                },

                sendEvent() {
                    $.post('/dev/websockets/event', {
                        _token: '{{ csrf_token() }}',
                        key: this.app.key,
                        secret: this.app.secret,
                        appId: this.app.id,
                        channel: this.form.channel,
                        event: this.form.event,
                        data: this.form.data,
                    }).fail(() => {
                        alert('Error sending event.');
                });
                }
            }
        });
    </script>
    {!! renderResourceTableScriptsDynamically(['url' => 'http://127.0.0.1:8000/api/resources/event']) !!}
@endsection

