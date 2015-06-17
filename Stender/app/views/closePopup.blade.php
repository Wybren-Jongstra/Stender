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
@stop