export default {
  ajax(context, payload) {
    var fetch_params = {
      method: payload.method,
      credentials: 'same-origin', // send cookies
      headers: {
        'X-Requested-With': 'XMLHttpRequest', // need for ajax detect from php
      },
    }
    var url = payload.url
    if (payload.params) {
      // serialize object as URL parameters
      if (payload.method === "GET" || payload.method === "HEAD") {
        var esc = encodeURIComponent
        var query = Object.keys(payload.params).map(function(k) {
          return esc(k) + '=' + esc(payload.params[k])
        }).join('&')
        if (query) {
          url += ((url.indexOf('?') === -1) ? '?' : '&')+query
        }
        fetch_params.headers['Content-Type'] = 'application/x-www-form-urlencoded'
      } else {
        fetch_params["body"] = payload.params
      }
    }
    return fetch(url, fetch_params).then(function(response) {
      if (!response.ok) {
        throw Error(response.statusText)
      }
      return response
    }).then(function(response) {
      if (payload.isText) {
        return response.text()
      } else {
        return response.json()
      }
    }).then(function(data) {
      context.commit('updateResult', data)
    }).catch(function(error) {
      alert(error)
    })
  }
}
