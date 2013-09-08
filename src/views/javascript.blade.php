<script>
  var Persona = {
    loginSelector:  '{{ $loginSelector }}',
    logoutSelector: '{{ $logoutSelector }}',
    @if ($backgroundColor) backgroundColor: '{{ $backgroundColor }}', @endif
    @if ($onCancel) oncancel: '{{ $onCancel }}', @endif
    @if ($privacyPolicy) privacyPolicy:  '{{ $privacyPolicy }}', @endif
    @if ($returnTo) returnTo: '{{ $returnTo }}', @endif
    @if ($siteLogo) siteLogo: '{{ $siteLogo }}', @endif
    @if ($siteName) siteName: '{{ $siteName }}', @endif
    @if ($termsOfService) termsOfService: '{{ $termsOfService }}', @endif
    token: "{{ csrf_token() }}",
    loginUrl: "{{ action('Heron\Persona\Controllers\AuthController@login') }}"
  }
</script>
<script src="https://login.persona.org/include.js"></script>
<script src="{{ URL::asset('packages/heron/persona/amplify.store.min.js') }}"></script>
<script src="{{ URL::asset('packages/heron/persona/persona.js') }}"></script>
