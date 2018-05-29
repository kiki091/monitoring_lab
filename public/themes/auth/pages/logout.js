function logout() {

	showLoading()

	$.get(laroute.route('users_logout', []), function()
    {
    	hideLoading()
        $(location).prop('href', laroute.route('users_login', []));
    });

}