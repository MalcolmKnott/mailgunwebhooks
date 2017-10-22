@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">MailGun Log</div>

                    <div class="panel-body">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            @if($emails->count())
                                @foreach($emails as $email)
                                    <div class="panel panel-{{ $class_map[$email->event] }}">
                                        <div class="panel-heading" role="tab" id="email-{{ $loop->index }}">
                                            <div class="row">
                                                <div class="col-sm-1 text-left">
                                                    <strong>{{ ucwords($email->event) }}</strong>
                                                </div>
                                                <div class="col-sm-3">
                                                    {{ $email->recipient }}
                                                </div>
                                                <div class="col-sm-6">
                                                    {{ $email->subject }}
                                                </div>
                                                <div class="col-sm-2 text-right">
                                                    {{ $email->created_at->format('D d/m/Y') }}
                                                    &nbsp
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $loop->index }}" aria-expanded="false" aria-controls="collapse-{{ $loop->index }}">
                                                        <span class="badge">&nbsp{{ $email->trackingEvents->count() }}&nbsp</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse-{{ $loop->index }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="email-{{ $loop->index }}">
                                            @if($email->trackingEvents->count())
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-sm-1">Event</th>
                                                            <th class="col-sm-1">Country</th>
                                                            <th class="col-sm-1">Region</th>
                                                            <th class="col-sm-2">City</th>
                                                            <th class="col-sm-1">Device</th>
                                                            <th class="col-sm-1">Client OS</th>
                                                            <th class="col-sm-5">User Agent</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($email->trackingEvents as $event)
                                                            <tr>
                                                                <td>{{ $event->event }}</td>
                                                                <td>{{ $event->country }}</td>
                                                                <td>{{ $event->region }}</td>
                                                                <td>{{ $event->city }}</td>
                                                                <td>{{ $event->device_type }}</td>
                                                                <td>{{ $event->client_os }}</td>
                                                                <td>{{ $event->user_agent }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @elseif(in_array($email->event, ['dropped', 'bounced']))
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-sm-1">Code</th>
                                                            <th class="col-sm-5">Error</th>
                                                            <th class="col-sm-1">Reason</th>
                                                            <th class="col-sm-5">Description</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $email->code }}</td>
                                                            <td>{{ $email->error }}</td>
                                                            <td>{{ $email->reason }}</td>
                                                            <td>{{ $email->description }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            @else
                                                 <div class="panel-body">
                                                    No Events
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-info">
                                    <p>No email events found.</p>
                                </div>
                            @endif
                        </div>
                        {{ $emails->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
