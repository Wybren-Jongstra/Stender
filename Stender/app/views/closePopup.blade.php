@extends('layouts.simpleHeader')
@section('custom-scripts')
    <script>
        /**
         * Updates the parent window
         */
        function updateParent()
        {
            // Removes item from list.
            window.opener.removePopupWindowHandler(this.name);
            // Reload parent, so the new status will be shown
            window.opener.location.reload();
        }

        // Update parent on unload
        window.onunload = updateParent;
        // Close pop-up
        window.close();
    </script>
@endsection
@section('no-script')
    {{ Lang::get('external_accounts.done', ['externalAccount' => $externalAccount]) }}
    {{-- When JavaScript is disabled there is no pop-up but a window --}}
    {{ Lang::get('external_accounts.close_window') }}
@stop