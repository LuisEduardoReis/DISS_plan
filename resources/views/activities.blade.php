@extends('layouts.app')

@section('content')

    <!-- Topic Form -->
    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')

        <!-- New Activity Form -->
        <form action="/api/activity" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="activity" class="col-sm-2 control-label">New Activity</label>

                <div class="col-sm-8">
                    <input type="text" name="name" id="activity-name" class="form-control">
                </div>

                <div class="col-sm-2">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Activity
                    </button>
                </div>
            </div>

        </form>
    </div>

    <button id="toggle-controls" onClick="$('.control').toggle(1000);">Show/Hide Controls</button>

    <!-- Current Activities -->
    @if (count($activities) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Activities
            </div>

            <div class="panel-body">
                <ul id="activity-list">
                    @foreach($activities as $activity)
                        <li>
                            <div class="table-text">
                                <div>{{ $activity->name }}</div>
                            </div>

                            <div>
                                <ul>
                                    @foreach($activity->topics as $activity_topic)
                                        <li>
                                            {{$activity_topic->name}}
                                            <form action="/api/topic_activity/{{ $activity->id }}/{{ $activity_topic->id }}" method="POST" class="control" style="display:inline;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <button>Remove</button>
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                                <form action="/api/topic_activity" method="POST" class="control">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="activity_id" value="{{$activity->id}}">
                                    <select name="topic_id" id="topic_activity-topic">
                                        @foreach($topics as $topic)
                                            <option value="{{$topic->id}}"> {{$topic->name}} </option>
                                        @endforeach
                                    </select>

                                    <button type="submit">Add Topic</button>
                                </form>
                            </div>

                            <div>
                                <form action="/api/activity/{{ $activity->id }}" method="POST" class="control" >
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button>Delete Activity</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
@endsection