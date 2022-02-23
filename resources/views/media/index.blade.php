@extends('admin::master')

@section('page_title', __('admin::generic.media'))

@section('content')
    <div class="page-content container-fluid">
        @include('admin::alerts')
        <div class="row">
            <div class="col-md-12">

                <div class="admin-section-title">
                    <h3><i class="admin-images"></i> {{ __('admin::generic.media') }}</h3>
                </div>
                <div class="clear"></div>
                <div id="filemanager">
                    <media-manager
                        base-path="{{ config('admin.media.path', '/') }}"
                        :show-folders="{{ config('admin.media.show_folders', true) ? 'true' : 'false' }}"
                        :allow-upload="{{ config('admin.media.allow_upload', true) ? 'true' : 'false' }}"
                        :allow-move="{{ config('admin.media.allow_move', true) ? 'true' : 'false' }}"
                        :allow-delete="{{ config('admin.media.allow_delete', true) ? 'true' : 'false' }}"
                        :allow-create-folder="{{ config('admin.media.allow_create_folder', true) ? 'true' : 'false' }}"
                        :allow-rename="{{ config('admin.media.allow_rename', true) ? 'true' : 'false' }}"
                        :allow-crop="{{ config('admin.media.allow_crop', true) ? 'true' : 'false' }}"
                        :details="{{ json_encode(['thumbnails' => config('admin.media.thumbnails', []), 'watermark' => config('admin.media.watermark', (object)[])]) }}"
                        ></media-manager>
                </div>
            </div><!-- .row -->
        </div><!-- .col-md-12 -->
    </div><!-- .page-content container-fluid -->
@stop

@section('javascript')
<script>
new Vue({
    el: '#filemanager'
});
</script>
@endsection
