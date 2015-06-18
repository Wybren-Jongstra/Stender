@extends('layouts.simpleHeader')
@section('custom-scripts')
    <script>
        /**
         * Refresh the parent window
         */
        function refreshParent()
        {
            window.opener.location.reload();
        }

        // Reload parent on unload
        window.onunload = refreshParent;
        // Close window
        window.close();
    </script>
@endsection
@section('no-script')
    {{ Lang::get('external_accounts.done', ['externalAccount' => $externalAccount]) }}
    {{-- When JavaScript is disabled there is no pop-up but a window --}}
    {{ Lang::get('external_accounts.close_window') }}
@stop