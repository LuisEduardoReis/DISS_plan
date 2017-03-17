@extends('layouts.app')

@section('content')

    <!-- Topic Form -->
    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')

        <!-- New Topic Form -->
        <form action="/api/topic" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="topic" class="col-sm-2 control-label">New Topic</label>

                <div class="col-sm-6">
                    <textarea type="text" name="name" id="topic-name" class="form-control"></textarea>
                </div>

                <div class="col-sm-2">
                    <select name="type" id="topic-type" class="form-control">
                        <option value="game">Games</option>
                        <option value="prog">Programming</option>
                    </select>
                </div>

                <div class="col-sm-2">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Topic
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!--<button id="toggle-controls" onClick="$('.control').toggle(1000);">Show/Hide Controls</button>-->

    <!-- Current Topics -->
    @if (count($topics_game) + count($topics_prog) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Topics
            </div>

            <div class="panel-body">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse1">Programming</a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse">
                            <div class="panel-body">
                                @include('topic_list', ['topics'=>$topics_prog])
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse2">Games</a>
                            </h4>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">
                                @include('topic_list', ['topics'=>$topics_game])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <lable class="col-sm-2 control-label"> Select all: </lable>
            <input type="checkbox" onclick="
                if(this.checked) {
                    $('.topic_select').each(function() { this.checked = true; });
                } else {
                    $('.topic_select').each(function() { this.checked = false; });
                }
            ">
        </div>

        <div class="form-group">
            <button class="btn btn-default" onClick="
                var ids = [];
                $('.topic_select:checked').each(function(i, e) {
                    ids.push($(this).val());
                });
                if (ids.length > 0) {
                    $.ajax({
                        url: '/api/topic/'+ids.join(),
                        headers: {'X-CSRF-TOKEN': $('meta[name=\'csrf-token\']').attr('content')},
                        type: 'post',
                        data: {_method: 'delete'},
                        dataType: 'json',
                        complete: function(data) {document.open('text/html','replace').write(data.responseText);}
                     })
                };
            ">Delete Selected</button>
        </div>

        <div class="form-group" style="padding-bottom:30px;">

            <label for="activity" class="col-sm-3 control-label">New Activity with Selected</label>

            <div class="col-sm-7">
                <input type="text" name="name" id="activity-name" class="form-control">
            </div>

            <div class="col-sm-2">
                <button type="submit" class="btn btn-default" onclick="
                    var ids = [];
                    $('.topic_select:checked').each(function(i, e) {
                        ids.push($(this).val());
                    });

                    $.ajax({
                        url: '/api/activity/'+ids.join(),
                        headers: {'X-CSRF-TOKEN': $('meta[name=\'csrf-token\']').attr('content')},
                        type: 'post',
                        data: {
                            name: $('#activity-name').val()
                        },
                        dataType: 'json',
                        complete: function(data) {window.location='/activities';}
                     });
                ">
                    <i class="fa fa-plus"></i> Add Activity
                </button>
            </div>

        </div>
    @endif
@endsection