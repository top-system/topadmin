@extends('admin::master')

@section('css')

    @include('admin::compass.includes.styles')

@stop

@section('page_header')
    <h1 class="page-title">
        <i class="admin-compass"></i>
        <p> {{ __('admin::generic.compass') }}</p>
        <span class="page-description">{{ __('admin::compass.welcome') }}</span>
    </h1>
@stop

@section('content')

    <div id="gradient_bg"></div>

    <div class="container-fluid">
        @include('admin::alerts')
    </div>

    <div class="page-content compass container-fluid">
        <ul class="nav nav-tabs">
          <li @if(empty($active_tab) || (isset($active_tab) && $active_tab == 'resources')){!! 'class="active"' !!}@endif><a data-toggle="tab" href="#resources"><i class="admin-book"></i> {{ __('admin::compass.resources.title') }}</a></li>
          <li @if($active_tab == 'commands'){!! 'class="active"' !!}@endif><a data-toggle="tab" href="#commands"><i class="admin-terminal"></i> {{ __('admin::compass.commands.title') }}</a></li>
          <li @if($active_tab == 'logs'){!! 'class="active"' !!}@endif><a data-toggle="tab" href="#logs"><i class="admin-logbook"></i> {{ __('admin::compass.logs.title') }}</a></li>
        </ul>

        <div class="tab-content">
            <div id="resources" class="tab-pane fade in @if(empty($active_tab) || (isset($active_tab) && $active_tab == 'resources')){!! 'active' !!}@endif">
                <h3><i class="admin-book"></i> {{ __('admin::compass.resources.title') }} <small>{{ __('admin::compass.resources.text') }}</small></h3>

                <div class="collapsible">
                    <div class="collapse-head" data-toggle="collapse" data-target="#links" aria-expanded="true" aria-controls="links">
                        <h4>{{ __('admin::compass.links.title') }}</h4>
                        <i class="admin-angle-down"></i>
                        <i class="admin-angle-up"></i>
                    </div>
                    <div class="collapse-content collapse in" id="links">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="https://admin-docs.devdojo.com/" target="_blank" class="admin-link" style="background-image:url('{{ admin_asset('images/compass/documentation.jpg') }}')">
                                    <span class="resource_label"><i class="admin-documentation"></i> <span class="copy">{{ __('admin::compass.links.documentation') }}</span></span>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="https://admin.devdojo.com/" target="_blank" class="admin-link" style="background-image:url('{{ admin_asset('images/compass/admin-home.jpg') }}')">
                                    <span class="resource_label"><i class="admin-browser"></i> <span class="copy">{{ __('admin::compass.links.admin_homepage') }}</span></span>
                                </a>
                            </div>
                        </div>
                    </div>
              </div>

              <div class="collapsible">

                <div class="collapse-head" data-toggle="collapse" data-target="#fonts" aria-expanded="true" aria-controls="fonts">
                    <h4>{{ __('admin::compass.fonts.title') }}</h4>
                    <i class="admin-angle-down"></i>
                    <i class="admin-angle-up"></i>
                </div>

                <div class="collapse-content collapse in" id="fonts">

                    @include('admin::compass.includes.fonts')

                </div>

              </div>
            </div>

          <div id="commands" class="tab-pane fade in @if($active_tab == 'commands'){!! 'active' !!}@endif">
            <h3><i class="admin-terminal"></i> {{ __('admin::compass.commands.title') }} <small>{{ __('admin::compass.commands.text') }}</small></h3>
            <div id="command_lists">
                @include('admin::compass.includes.commands')
            </div>

          </div>
          <div id="logs" class="tab-pane fade in @if($active_tab == 'logs'){!! 'active' !!}@endif">
            <div class="row">

                @include('admin::compass.includes.logs')

            </div>
          </div>
        </div>

    </div>

@stop
@section('javascript')
    <script>
        $('document').ready(function(){
            $('.collapse-head').click(function(){
                var collapseContainer = $(this).parent();
                if(collapseContainer.find('.collapse-content').hasClass('in')){
                    collapseContainer.find('.admin-angle-up').fadeOut('fast');
                    collapseContainer.find('.admin-angle-down').fadeIn('slow');
                } else {
                    collapseContainer.find('.admin-angle-down').fadeOut('fast');
                    collapseContainer.find('.admin-angle-up').fadeIn('slow');
                }
            });
        });
    </script>
    <!-- JS for commands -->
    <script>

        $(document).ready(function(){
            $('.command').click(function(){
                $(this).find('.cmd_form').slideDown();
                $(this).addClass('more_args');
                $(this).find('input[type="text"]').focus();
            });

            $('.close-output').click(function(){
                $('#commands pre').slideUp();
            });
        });

    </script>

    <!-- JS for logs -->
    <script>
      $(document).ready(function () {
        $('.table-container tr').on('click', function () {
          $('#' + $(this).data('display')).toggle();
        });
        $('#table-log').DataTable({
          "order": [1, 'desc'],
          "stateSave": true,
          "language": {!! json_encode(__('admin::datatable')) !!},
          "stateSaveCallback": function (settings, data) {
            window.localStorage.setItem("datatable", JSON.stringify(data));
          },
          "stateLoadCallback": function (settings) {
            var data = JSON.parse(window.localStorage.getItem("datatable"));
            if (data) data.start = 0;
            return data;
          }
        });

        $('#delete-log, #delete-all-log').click(function () {
          return confirm('{{ __('admin::generic.are_you_sure') }}');
        });
      });
    </script>
@stop
