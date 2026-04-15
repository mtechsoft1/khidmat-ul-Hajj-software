<script>
    window.livewireToken = "{{ csrf_token() }}";
</script>
<script data-turbo-eval="false" data-turbolinks-eval="false" >window.livewire = new Livewire();window.Livewire = window.livewire;window.livewire_app_url = '';window.livewire_token = window.livewireToken;window.deferLoadingAlpine = function (callback) {window.addEventListener('livewire:load', function () {callback();});};window.__livewireStarted = window.__livewireStarted || false;window.addEventListener('alpine:initializing', function () {if (!window.__livewireStarted) {window.livewire.start();window.__livewireStarted = true;}});document.addEventListener("DOMContentLoaded", function () {if (!window.__livewireStarted) {window.livewire.start();window.__livewireStarted = true;}});</script>
