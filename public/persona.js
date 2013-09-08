// Generated by CoffeeScript 1.6.3
(function() {
  jQuery(function($) {
    var currentUser, loginSelector, loginUrl, logoutSelector, requestConfig;
    loginSelector = Persona.loginSelector;
    logoutSelector = Persona.logoutSelector;
    loginUrl = Persona.loginUrl;
    requestConfig = {
      backgroundColor: Persona.backgroundColor,
      oncancel: Persona.onCancel,
      privacyPolicy: Persona.privacyPolicy,
      returnTo: Persona.returnTo,
      siteLogo: Persona.siteLogo,
      siteName: Persona.siteName,
      termsOfService: Persona.termsOfService
    };
    currentUser = amplify.store('personaUser');
    navigator.id.watch({
      loggedInUser: currentUser,
      onlogin: function(assertion) {
        return $.post(loginUrl, {
          assertion: assertion,
          _token: Persona.token
        }).done(function(response) {
          if (response.status === 'okay') {
            amplify.store('personaUser', response.email);
          } else {
            alert("Sorry, an error occurred and we can't log you in at this time");
          }
          if (Persona.returnTo) {
            return window.location.replace(Persona.returnTo);
          } else {
            return location.reload();
          }
        });
      },
      onlogout: function() {
        return amplify.store('personaUser', null);
      }
    });
    $(loginSelector).click(function(e) {
      e.preventDefault();
      return navigator.id.request(requestConfig);
    });
    return $(logoutSelector).click(function(e) {
      return navigator.id.logout();
    });
  });

}).call(this);