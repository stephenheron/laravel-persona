jQuery ($) ->
  loginSelector   = Persona.loginSelector
  logoutSelector  = Persona.logoutSelector
  loginUrl        = Persona.loginUrl

  requestConfig = {
    backgroundColor:  Persona.backgroundColor,
    oncancel:         Persona.onCancel,
    privacyPolicy:    Persona.privacyPolicy,
    returnTo:         Persona.returnTo,
    siteLogo:         Persona.siteLogo,
    siteName:         Persona.siteName,
    termsOfService:   Persona.termsOfService
  }

  currentUser = amplify.store('personaUser')

  navigator.id.watch({
    loggedInUser: currentUser,
    onlogin: (assertion) ->
      $.post(loginUrl, { assertion: assertion, _token: Persona.token }).done (response) ->
        if response.status == 'okay'
          amplify.store('personaUser', response.email)
        else
          alert("Sorry, an error occurred and we can't log you in at this time")

        if Persona.returnTo
          window.location.replace(Persona.returnTo)
        else
          location.reload()

    onlogout: ->
      amplify.store('personaUser', null)
  })

  $(loginSelector).click (e) ->
    e.preventDefault()
    navigator.id.request(requestConfig)
  
  $(logoutSelector).click (e) ->
    navigator.id.logout()
