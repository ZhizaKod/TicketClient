@extends('layouts.default')
@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/vue.js') }}"></script>

@stop

@section('content')

    <style>
        div#places{
            /*left: 600px;*/
            /*position: absolute;*/
        }
        div#places > div.reserved  > div.badge {
            display: inline-block;
            height: 20px;
            width: 20px;
            padding: 2px;
            border: 1px solid darkblue;
        }

        div#places > div.places  > div {
            position:absolute;
            text-align: center;
            border: 1px solid black;

        }
        div#places> div  > div:hover {
            color: darkgreen;
            cursor: pointer;
        }

        div#places div  > div.disabled {
            background: grey;
            cursor:auto;
        }
        div#places div  > div.highlight {
            background: darkseagreen;
        }

        h2 {
            margin-bottom: 0px;
        }

    </style>
    <div id="places" class="row pt-4">
        <div class="col-4 reserved"><h4>Pick places for event #{{$eventId}}:</h4>
            <h5>
                <div v-if="renderComponent" v-for="item in selectedPlaces" class="badge badge-info m-1 "
                >
                    @{{item.id}}
                </div>
            </h5>
            <input v-if="renderComponent" v-model="userName" class="form-control mb-1" type="text" placeholder="Your Name">
            <input type="hidden" name="token" value="{{ csrf_token() }}">
            <button v-if="renderComponent"
                    :disabled="!isDisableComputed"
                    class="btn btn-primary mt-1"
                    @click="submitReserveEntry()"
            >Reserve</button>
            <div id="response" class="alert alert-success col-12 mt-2" role="alert" style="display:none;">

            </div>

        </div>
        <div class="col-4 places"  >
            <div
                v-for="item in items"
                :style="{
                    top: 1.5 * item.y + 'px',
                    left: 1.5 * item.x + 'px',
                    width: 1.5  * item.width + 'px',
                    height: 1.5 * item.height + 'px',
                 }"
                 :class="{
                     highlight:item.selected,
                     disabled: !item.is_available}"
                @click="
                    if (item.is_available) {
                     $set(item, 'selected', !item.selected);
                     toggleItem(item);
                    }
                "
                >@{{item.id}}
            </div>
        </div>
    </div>
    <script>
        var items = @json($eventDetails);
        var selectedPlaces = [];

        new Vue({
            el: '#places',
            data: {
                items,
                selectedPlaces: [],
                renderComponent: false,
                userName: '',
                ajaxResponse: ''

            },
            methods: {
                forceRerender(arg){
                    this.renderComponent = false;
                    this.$nextTick(() =>{
                        this.selectedPlaces = arg;
                        this.renderComponent = true;
                    })
                },
                toggleItem(item){
                    this.selectedPlaces.includes(item)  ? this.selectedPlaces.splice(selectedPlaces.indexOf(item), 1) : this.selectedPlaces.push(item) ;
                    window.selectedPlaces = this.selectedPlaces;
                    this.forceRerender(this.selectedPlaces);
                },
                submitReserveEntry: function() {

                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", '/reserve', true);
                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('input[name=token]').value);
                    xhr.onreadystatechange = (re) => { // Call a function when the state changes.
                        responseObj = JSON.parse(xhr.response);
                        document.getElementById('response').style.display = 'block'
                        document.getElementById('response').innerText = 'Reservation ID:  ' + responseObj.response.reservation_id;
                    };
                    xhr.send(JSON.stringify({
                        event_id: {{$eventId}},
                        name: userName,
                        places: selectedPlaces.map(x => x.id),

                    }));
                }

            },
            computed: {
                isDisableComputed() {
                    window.userName = this.userName;
                    return this.userName.length > 0;
                }
            },

        })

    </script>



@stop




